<?php
/** Recieves posted data from home.js:submit comment ajax call
 * Tests if the user is still logged in.
 * Tests the received comment is not empty but leaves the data raw in order to keep good user functionality.
 * Retrieves the current user's details and tests they are a poster and can add comments
 * If conditions met: Returns santised data for the calling function to append to the appropriate place in the DOM
  */

include "loggedIn.php";

/* Test posted data is acceptable.
 Only Letters numbers and white space allowed  */

if(isset($_POST["msgId"]) && isset($_POST["comment"])) {
    //

    if ($_POST["comment"] == '') { // Test comment is not empty
        echo json_encode(array("error"=>true)); // causes simple error message to be display in the comments section
        exit();
    } else {
        /* Retrieve user details */
        $user = get_user($_COOKIE["login"]);


        if($user["poster"]) { // yes user is allowed to post comments
            include "pdo_connection.php";
            /* Try to add comment to the comments table*/
            $sql = $pdo->prepare("INSERT INTO comments (email,comment,message_id) VALUES(?,?,?)");
            try {
                $sql->execute([$user["email"], $_POST["comment"], $_POST["msgId"]]);

            } catch (PDOException $err) {
                //echo $err->getMessage(); // for debug un comment
                echo json_encode(array("error" => true));
                exit();
            }
            /* The comment has been inserted successfully
                Return a json obj of sanitised  userName / Comment text and the creation date to the Ajax call */
            $lastId = $pdo->lastInsertId(); // obtain the last iD to obtain the creation date

            try {
                $sql = $pdo->query("SELECT email, comment ,date FROM comments WHERE id = '$lastId'");
            } catch (PDOException $err) {
                //echo $err->getMessage(); // for debug un comment
                /* The message has been updated but unable to update the comments display go to the home page
                    which will force a reload with updated comments */
                echo json_encode(array("reload"=>true));
                exit();
            }
            $row = $sql->fetch(); // read into assoc array
            /* get the username associated with the email */

            echo json_encode(array("userName" => sanitise(get_userName($row["email"])), "comment" => sanitise($row["comment"]), "date" => get_date($row["date"])));
        }else{

            echo json_encode(array("notPoster"=>true));
        }
    }

}else{
    /* Incorrect data has been sent*/
    echo json_encode(array("error"=>true));
    }






