<?php
/** Retrieves a users profile and displays it.
 Called a user clicks on user links in messages and comments sections*/

include "loggedIn.php"; // test the user is still logged in

/* Retrieve user details and display customised header (with userName) */
$user = get_user($_COOKIE["login"]);

include "html/header.php"; // includes code to sanitise the users name against XSS

if(!isset($_GET["userName"])) {
    header("Location: home.php"); // return home if correct variable has not  been passed
    exit();
}else{


    /* Prepare an empty profile to display if one hasn't been created yet */
    $empty_profile = array("firstName" => '', "lastName" => '', "phone" => '', "bio" => ''); // define any empty profile

    /* Retrieve the requested user's profile */
    include "pdo_connection.php";

    /* Try to update users table with new profile. Using prepared statement to avoid injection
    since the need to use raw user text. The user should not be restricted by the characters they can type in their bio */



    $sql = $pdo->prepare("SELECT profile FROM users WHERE userName = ?");
    try {
        $sql->execute([$_GET["userName"]]);
    } catch (PDOException $err) {
        header("Location: home.php"); // return home if there is a problem
        exit();
    }
    $row =$sql->fetch();
    /* */

    if ( $row===1 || $row["profile"] == null) {
        $profile = json_decode(json_encode($empty_profile));
    } else {
        $profile = json_decode($row["profile"]);
    }

// display a breadcrumb trail of where the user is.

    echo "
<nav aria-label='breadcrumb' class='pg-disp row'>
  <ol class='breadcrumb' style='position: relative; top: 10px'>
    <h6 class='breadcrumb-item text-muted'>" . sanitise($user["userName"]). "</h6>
    <h6 class='breadcrumb-item active' aria-label ='page'>Display Profile</h6>
  </ol>
</nav>";

    /* Display the profile form adding sanitised stored entries if they exist .*/
    echo "
    <div class='container' id='update-profile my-1'>
        <div class = 'flex-row'>
            <div class = ' msg-box row align-items-center justify-content-center'> <!-- Outline Div with rounded corners -->
                <div class = ' msg-box-top '> <!--Title and poster area -  upper corners rounded (css) -->
                    <div class=' row msg-title justify-content-center '>
                        <div class = 'row'>
                            <div class = 'my-2'>
                                <div>
                                <a id='cancel' onclick='cancelNewPost()' class='link-add-com'  title='Cancel'  aria-label='Cancel post' ><i class= 'fa fa-times float-end pt-1 me-2'></i></a><br>
                                <h4 class=' my-3 w-75'  id='User details' aria-label='User Details' >Profile for " . sanitise($_GET["userName"]) . "</h4>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p class = 'form-control row new-msg-body bg-light mb-0 py-3' >  <!-- main form section of window - lower corners rounded (css) --> 
                    <label>First name:</label>
                    <input class ='form-control mt-0 my-3' type='text' id='firstName' aria-label='firstname' aria-readonly='true' readonly value='" . sanitise($profile->firstName) . "'  > 
                    <label>Last name:</label>
                    <input class ='form-control mt-0 my-' type='text' id='lastName' aria-label='lastname' aria-readonly='true' readonly value='" . sanitise($profile->lastName) . "'>
                    <label>Phone number:</label>
                    <input class ='form-control mt-0 my-' type='tel' id='phone' aria-label='Phone' aria-readonly='true' readonly value='" . sanitise($profile->phone) . "'>
                    <label>Bio:</label>  
                    <textarea  rows='4' id='bio' class='form-control p-2' aria-readonly='true' readonly>" . sanitise($profile->bio) . "</textarea>
                </div> 
            </div>
     </div>
    </div>";

    /* Initate TinyMce Editor */
    echo "<script>
        tinymce.init({
                selector: String('#bio'),
                branding: false,
                menubar: false,
                toolbar: false,
                resize: false,
                statusbar: false,
                readonly : 1
            });
       
    </script>";

}

include "html/footer.html";