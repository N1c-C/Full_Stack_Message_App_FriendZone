<?php
/** Retrieves the users profile and autofills the form
 * Allows the user to edit the details and submit them back the server
 * Stored as a json object.
 * {firstName:,lastName:, Phone:, Bio: }
 * Uses Tiny MCE for bio Text with all options turned off
 */

include "loggedIn.php";

/* Retrieve user details and display customised header (with userName) */
$user = get_user($_COOKIE["login"]);

include "html/header.php"; // includes code to sanitise the users name against XSS

$displayUser=sanitise($user["userName"]);

/* Determine user bio details if they exist */
$empty_profile = array("firstName"=>'', "lastName"=>'', "phone"=>'', "bio"=>''); // define any empty profile

if($user["profile"] == null){
    $profile=json_decode(json_encode($empty_profile));
}else{
    $profile=json_decode($user["profile"]);
}

// display a breadcrumb trail of where the user is.

echo "
<nav aria-label='breadcrumb' class='pg-disp row'>
  <ol class='breadcrumb' style='position: relative; top: 0px'>
    <h6 class='breadcrumb-item text-muted'>".$displayUser."</h6>
    <h6 class='breadcrumb-item active' aria-label ='page'>Update Profile</h6>
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
                                <h4 class=' my-3 w-75'  id='User details' aria-label='User Details' >Profile for ".sanitise($user['email'])." (".sanitise($user['userName']) ." )</h4>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p class = 'form-control row new-msg-body bg-light mb-0 py-3' >  <!-- main form section of window - lower corners rounded (css) --> 
                    <label>First name:</label>
                    <input class ='form-control mt-0 my-3' type='text' id='firstName' aria-label='firstname' value='".sanitise($profile->firstName)."'  > 
                    <label>Last name:</label>
                    <input class ='form-control mt-0 my-' type='text' id='lastName' aria-label='lastname' value='".sanitise($profile->lastName)."'>
                    <label>Phone number:</label>
                    <input class ='form-control mt-0 my-' type='tel' id='phone' aria-label='Phone'  value='".sanitise($profile->phone)."'>
                    <label>Bio:</label>  
                    <textarea  rows='4' id='bio' class='form-control p-2'>".sanitise($profile->bio)."</textarea>
                </div> 
            </div>
       
        <div class = ' msg-box' id='newButton' ><button id='newSubmit' onclick='updateProfile()' class='btn btn-primary float-end '  title='Submit Post'  aria-label='Submit Post'>Update profile</button></div>
     </div>
    </div>";

/* Initate TinyMce Editor */
echo"<script>
        tinymce.init({
                selector: String('#bio'),
                branding: false,
                menubar: false,
                toolbar: false,
                resize: false,
                statusbar: false,
            });
       
    </script>";



include "html/footer.html";