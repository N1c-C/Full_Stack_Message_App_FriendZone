<?php
/**  Login script. Receives email and password by ajax call from login.html / login.js
 * Tests if the user is already logged in - continues to home screen if they are.
 * If not, Retrieves a password if available and compares it with one entered
 * If successful sets logged in cookie and session variables
 * Echoes any errors back to the calling script
 */


session_start();
include "authenticate.php"; // functions used for login process

if ($_SERVER['REQUEST_METHOD'] = "POST" && isset($_POST['email']) && isset($_POST['password'])) {
    /*Check the users credentials*/
    include "pdo_connection.php";


    /* Test if users credentials are correct using prepared statement to limit SQL injection */
    $sql = $pdo->prepare("SELECT password FROM users WHERE email = ?");
    try {
        $sql->execute([$_POST['email']]);
        $row = $sql->fetch();
    }catch(PDOException $err){
        //echo $err->getCode(); // For debugging purposes
        echo ''; // returns empty string causing default error message to be displayed from js
        exit();
    }

    // Test if the user with supplied email is found.
    if ($row != NULL) { // Users email exists
        if (password_verify($_POST['password'], $row['password'])) { // Success!

            setLogin($_POST["email"],$_POST['remember']); // Set logged in cookies. Save session key in users table
            echo "true"; // tell calling ajax fn login was successful.

        } else {
            echo "password"; // Incorrect password - echo calling ajax function login attempt was unsuccessful
            exit();
        }
    }else {
        echo "email"; // No account exits with the email address - echo calling ajax function login attempt was unsuccessful
        exit();
    }

}





