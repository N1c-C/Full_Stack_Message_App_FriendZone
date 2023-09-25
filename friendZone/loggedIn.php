<?php
/** Included at the top of all scripts
 *Tests if user is currently logged in otherwise returns destroys the session and returns to the login page.
 * By testing log in status the users login cookies are updated for a further 60 mins if remember me is not set
 */

session_start();

include "authenticate.php";



/* Check user is still logged in:*/
if(!loggedIn()){
    session_destroy();
    header("Location: index.php"); // if not return to login page
}
