<?php

/** Search script used to test if a particular user exists to display their messages on the current user's homepage.
 * Receives data from both POST and GET methods.
 * Sets $_SESSION["displayFilter"] to the required email if the passed userName exists it exists.
 * Provides a false response to an Ajax call from home.js:search() if the searched user does not exist
 * which causes an error message to be displayed to the user.
 * Otherwise, returns sets true and the calling function redirects to home.php
 */

include "loggedIn.php"; // check they are still logged

/* get method used from homepage links to view either the users messages or all messages
Still tests that the user exists in case someone has tried to access the page directly */

if(isset($_GET["userName"])){
    switch($_GET["userName"]){
        case "*":
            $_SESSION["displayFilter"]="*"; // all posts view
            break;
        default:
            if(search($_GET["userName"],"users","userName")){ // test if the user exists
                $_SESSION["displayFilter"]= get_email($_GET["userName"]); // if so set display to their posts
            }else{
                $_SESSION["displayFilter"]="*"; // The userName sent does not exist so set the view to all posts
            }
    }
header("Location: home.php"); // display homepage with new view
}

/* Check for POSTed data from home.js:search() */
if(isset($_POST["userName"])){
    if(search($_POST["userName"],"users","userName")){ // test if the user exists
        $_SESSION["displayFilter"]=get_email($_POST["userName"]); // if so set display filter to their posts
        echo true;
    }else{
        echo false; // returns an error to the ajax call to display an error message.
}}

function get_email($userName){
    /* Given a username returns the email address */
    include "pdo_connection.php";
    $sql = $pdo->prepare("SELECT email FROM users WHERE userName = ?");
    try{
        $sql->execute([$userName]);
        $row = $sql->fetch();
        return $row["email"]; // the query was successful return email address for username
    }catch(PDOException $err){
        // echo $err->getMessage()
    }
    return '*'; // the query was unsuccessful set filter to all users
}


function search($query,$tableName,$colName): bool
{
    /**  $query,StableName,$colName : Str
     * Searches for query in dbase's tableName::colName
     Returns a bool */

    include "pdo_connection.php";

    $sql = $pdo->prepare("SELECT 1 FROM $tableName WHERE $colName = ?");

    try{
        $sql->execute([$query]);

       if($sql->fetch() != null){ return true;} // the query was successful
    }catch(PDOException $err){
        // echo $err->getMessage()
    }
    return false; // the query was unsuccessful
}