<?php
/** Script to update a users profile.
 * Receives form data and updates the user's profile column
 */



include "loggedIn.php"; // Check user is still logged in



if(isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["phone"]) && isset($_POST["bio"])) {

    /* Sanity check data is acceptable */


    if(!checkCharsOnly($_POST["firstName"])){
        $response["firstName"]=true; // last name contains non letter characters
    }
    if(!checkCharsOnly($_POST["lastName"])){
        $response["lastName"]=true; // last name contains non letter characters
    }
    if(!checknumbers($_POST["phone"])){
        $response["phone"]=true; // phone number contains non numerical values
    }

    if(isset($response)){  // errors in form entry have been found return result to calling function
        echo json_encode($response);
        exit();
    }
    /* Data is acceptable Retrieve user details */
    $user = get_user($_COOKIE["login"]);


    /*Prepare a json object for the bio column in the messages table */
    $jsonProfile = json_encode(array("firstName"=>$_POST["firstName"],"lastName"=>$_POST["lastName"],"phone"=>$_POST["phone"],"bio"=>$_POST["bio"]));



    include "pdo_connection.php";

    /* Try to update users table with new profile. Using prepared statement to avoid injection
    since the need to use raw user text. The user should not be restricted by the characters they can type in their bio */

    $sql = $pdo->prepare("UPDATE users SET profile = ? WHERE email = ?");
    try {
        $sql->execute([$jsonProfile, $user["email"]]);
    } catch (PDOException $err) {
        echo $err->getMessage(); // for debug un comment
        echo json_encode(array("error"=>true)); // displays an error message to the user
        exit();
    }
    /* Success return to the users home view */
    echo json_encode(array("success"=>true));
}