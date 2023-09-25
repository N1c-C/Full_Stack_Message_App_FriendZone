<?php
/** Called by AJAX call from friendzone.js: submibPost()
 * Keeps the data raw and trys to insert the message into the messages table
 * On success returns true or false on failure */

include "loggedIn.php"; // Check user is still logged in



if(isset($_POST["title"]) && isset($_POST["message"])) {

    /* Retrieve user details */
    $user = get_user($_COOKIE["login"]);
    /*Prepare a json object for the message column in the messages table */
    $jsonMsg = array("title"=>$_POST["title"],"message"=>$_POST["message"]);

    include "pdo_connection.php";

    /* Try to add message to the comments table. Using prepared statement to avoid injection
    since the need to use raw user text. The user should not be restricted by the characters they can type */

    $sql = $pdo->prepare("INSERT INTO messages (email,message) VALUES(?,?)");
    try {
        $sql->execute([$user["email"], json_encode($jsonMsg)]);
    } catch (PDOException $err) {
        //echo $err->getMessage(); // for debug un comment
        echo false; // displays an error message to the user
        exit();
    }
    /* Success return to the users home view */
    echo true;
}