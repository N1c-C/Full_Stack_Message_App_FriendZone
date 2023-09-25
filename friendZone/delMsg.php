<?php

/** Called when confirmation to delete button is clicked
 * Tests the user is still logged in
 * Confirms the current user is the person who posted the message
 * If all conditions are met: deletes the message which will cascade and delete all associated comments with it.
  */

include "loggedIn.php";


if (isset($_POST['msgId'])){ // test correct variable has been posted

/* Retrieve user details */
$user = get_user($_COOKIE["login"]);

/* Confirm the message to be deleted was posted by the current user */
    include "pdo_connection.php";
    $sql = $pdo->prepare("SELECT email FROM messages WHERE id = ?");

    try {
        $sql->execute([$_POST['msgId']]);

    } catch (PDOException $err) {
        //echo $err->getMessage(); // for debug uncomment
        header("Location: error.php"); // goto error page if there is a problem
        exit();
    }
    if ($sql->fetch()["email"] == $user["email"]) { // yes current user posted the message

        /* Try to delete message from  messages table*/
        $sql = $pdo->prepare("DELETE FROM messages WHERE id = ? ");
        try {
            $sql->execute([$_POST['msgId']]);

        } catch (PDOException $err) {
            //echo $err->getMessage(); // for debug uncomment
            header("Location: error.php"); // goto error page if there is a problem
            exit();
        }
        header("Location: home.php");// message deleted return to the users home page (updates listed view)
        exit();
    }
}

header("Location: error.php"); // the current user did not post the message.

