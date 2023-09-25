<?php
/** Builds correct landing page
 * Tests if a user is currently logged in.
 * If they are then if forwards them to their home
 * If they are not then displays a login page
 */
session_start();

include_once "authenticate.php";

if (!loggedIn()){
/* html for the login screen */
    include "html/login_header.html";
    include "html/login.html";
    include "html/footer.html";
}else{
    header("Location: home.php");

}

