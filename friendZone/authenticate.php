<?php
/** Set of functions used for authenticating a user is logged in or a new user has entered acceptable values */

function loggedIn(): bool
{
    /** Returns true if 'session' or 'remember' cookie is set and (along with 'login' cookie) matches the stored session
     * value retrieves the user's username, 'poster' flag and stores the values in session variables
     */
    include "pdo_connection.php";

    if((isset($_COOKIE["session"]) || isset($_COOKIE["remember"]) ) && isset($_COOKIE["login"])) {
        $sql = $pdo->prepare("SELECT userName, poster, session FROM users WHERE email = ?");
        try {
            $sql->execute([$_COOKIE["login"]]);
        } catch (PDOException $err) {
            //echo $err->getCode(); // For debugging purposes
            return false; // error so logg the user out
        }
        $row = $sql->fetch();
        /* Only test if a result is returned */
        if (isset($row["session"])){

            /* test if user selected remember me. The cookie is not reset - so they will be logged out after a year */
            if (isset($_COOKIE["remember"])){
                if ($row["session"] == $_COOKIE['remember']){ // success
                    return true;
                }else{
                    return false;
                }
            }
            /* Test if their session is valid*/
            if ($row["session"] == $_COOKIE['session']) { // valid login status
                /* Reset the expiry time of cookies, so they still expire after one hour of in activity */
                setcookie('session', $_COOKIE["session"], time() + (3600)); // for security
                setcookie('login', $_COOKIE["login"], time() + (3600));
                return true;
            }
        }
    }
    return false; // logged out or expired cookies (after 1 hours of inactivity)
}

function setLogin($email,$remember){
    /**  Sets session cookie using a random key (not session id) with a 1 hour expiry. The cookie gets updated after activity
     * so the user will be logged out after an arbitrary 1 hour of inactivity. They will stay logged in if they should
     * close the browser session and return to it with in that time frame.
     * if remember me is true a 'remember' cookie is set with an expiry time of 1 year. Keeping them logged in until
     * they log out in that time
     */

    include "pdo_connection.php";
    $key = keyGen(); // for security
    if($remember == "true"){
        setcookie('remember',$key, time() + (86400 * 365)); // set cookie for the year
        setcookie('login',$email,time() + (86400 * 365)); // account that is logged in
    }else{
        setcookie('session',$key, time() + (3600)); // set session cookies for 1 hour
        setcookie('login',$email,time() + (3600)); // account that is logged in
    }


    /* store the key in the users table to be used as conformation when accessing data */
    $sql = $pdo->prepare("UPDATE users SET session = '$key' WHERE email = ?");
    try{
        $sql->execute([$email]);
    }catch(PDOException $err){
        //echo $err->getCode(); // For debugging purposes
        echo ''; // returns empty string causing default error message to be displayed from js
        exit();
    }
}
function get_userName($email){
    /** Given an email */
    /* Given a email returns the username */
    include "pdo_connection.php";
    $sql = $pdo->prepare("SELECT userName FROM users WHERE email = ?");
    try{
        $sql->execute([$email]);
        $row = $sql->fetch();
        return $row["userName"]; // the query was successful return email address for username
    }catch(PDOException $err){
        // echo $err->getMessage()
    }
    return '*'; // the query was unsuccessful set filter to all users
}

function keyGen($length = 25): string
{
    /** Returns a random key (25 chars) used to as a cookie value to indicate a user is logged in successfully */
    $charset= array_merge(range('A', 'Z'),range('a', 'z'),range('0', '1'));
    $key = '';
    for ($i = 0; $i < $length; $i++) {
        $key .= $charset[rand(0, count($charset) - 1)];
    }
    return $key;
}

function checkPwd($pwd){
    /** Checks the password entered meets the criteria set. Returns true if it does.
     * It must be 8 or more characters.
     * There should be at least one capital letter
     * There should be at least oone special character
     * converts str to array a loops trough the letters testing against ranges
     */
    $MINLEN = 8; // Set the min length for the password
    $capital = false;
    $special = false;
    $pwdLen = false;
    $specialchars = array_merge(range('!','/'),range(':','@'),range('[','`')); // Create an array of special characters

    if (strlen($pwd) >= $MINLEN){$pwdLen = true;} // Meets length criteria
    foreach(str_split($pwd) as $char){
        if(in_array($char ,range('A', 'Z'))){$capital = true;} // Meets the capital letter criteria
        if(!in_array($char,$specialchars)){$special = true; } // Meets the special character criteria
    }
    if($pwdLen && $special && $capital){
        return true;
    }else{
        return false;
    }
}

function checkText ($text): bool
{
    /** Validates username to only have letters numbers and whitespace
     * Returns bool */
    $text = sanitise($text);
    // uses regular expression to define allowed chars
    if (preg_match("/^[a-zA-Z-' _0-9]*$/", $text)) {
        return true;
    }
    return false;
}
function checkNumbers ($text):bool
{
    /** Validate $text only contains numbers and whitespace
     * Returns bool
     */
    // uses regular expression to define allowed chars
    if (preg_match("/^[ 0-9]*$/", $text)) {
        return true;
    }
    return false;
}

function checkCharsOnly($text):bool
{
    /** Validate $text only contains letters and whitespace
     * Returns bool
     */
    // uses regular expression to define allowed chars
    if (preg_match("/^[a-zA-Z ]*$/", $text)) {
        return true;
    }
    return false;
}

function checkEmail ($email): bool
{
    /** Validates format of the email using PHP FILTER against RFC 822 some domains not supported
    Returns bool */
    $email = sanitise($email);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}


function sanitise($str): string
{
    /** Receives a string returns a sanitised str to avoid cross scripting issues */
    $str = trim($str);    // lose extra whitespace
    $str = stripslashes($str); // remove backslash characters
    // use html entities for reserved characters
    return htmlentities($str);
}

function get_date($timestamp){
    /** Receives an iso timestamp in mySQL form YYYY-MM-DD HH:MM:SS .
     * Performs string manipulation.
     * Returns a more readable date and time DD/MM/YY HH:MM to keep with simple uncluttered interface
     */
    $date = substr($timestamp,8,2)."/".substr($timestamp,5,2)."/".substr($timestamp,2,2);
    $time = substr($timestamp,11,5);
    return $date." ".$time;
}



function get_user($email){
    /** Retrieve details for a user given the email address
     * returns an array of userName, poster flag, date joined and profile (array)
     */
    include "pdo_connection.php";
    $sql = $pdo->prepare("SELECT userName, poster, email, profile FROM users WHERE email = ?");

    try{
        $sql->execute([$email]);
    }catch(PDOException $err){
        //echo $err->getCode(); // For debugging purposes
        return false;
    }
    return $sql->fetch();
}
?>