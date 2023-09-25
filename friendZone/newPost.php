<?php
/** Displays the new post page.
 * Uses tiny mce text editor customised for a simple text only interface.
 */

include "loggedIn.php";

/* Retrieve user details and display customised header (with userName) */
$user = get_user($_COOKIE["login"]);

include "html/header.php"; // includes code to sanitise the users name against XSS

$displayUser=sanitise($user["userName"]);

// display a breadcrumb trail of where the user is.

echo "
<nav aria-label='breadcrumb' class='pg-disp row'>
  <ol class='breadcrumb' style='position: relative; top: 50px'>
    <h6 class='breadcrumb-item text-muted'>".$displayUser."</h6>
    <h6 class='breadcrumb-item active' aria-label ='page'>New Post</h6>
  </ol>
</nav>";

/* Display the new post message box.*/
echo "
    <div class='container' id='newpost my-t mb-2'>
        <div class = 'flex-row'>
            <div class = ' msg-box row align-items-center justify-content-center'> <!-- Outline Div with rounded corners -->
                <div class = ' msg-box-top '> <!--Title and poster area -  upper corners rounded (css) -->
                    <div class=' row msg-title justify-content-center '>
                        <div class = 'row'>
                            <div class = 'my-2'>
                                <div>
                                <a id='cancel' onclick='cancelNewPost()' class='link-add-com'  title='Cancel'  aria-label='Cancel post' ><i class= 'fa fa-times float-end pt-1 me-2'></i></a>
                                <input class='form-control my-3 w-75' type='text' id='title' aria-label='title' placeholder='Subject heading'>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class = 'row new-msg-body bg-light py-3' >  <!-- main form section of window - lower corners rounded (css) -->      
                    <input type='textarea' id='message' class='p-2'>
                </div> 
            </div>
       
        <div class = ' msg-box' id='newButton' ><button id='newSubmit' onclick='submitPost()' class='btn btn-primary float-end '  title='Submit Post'  aria-label='Submit Post'>Post Message</button></div>
     </div>
    </div>";

/* Initate TinyMce Editor */
echo"<script>
        tinymce.init({
                selector: String('#message'),
                branding: false,
                menubar: false,
                toolbar: false,
                resize: false,
                statusbar: false,
                border: false
            });
    </script>";



include "html/footer.html";