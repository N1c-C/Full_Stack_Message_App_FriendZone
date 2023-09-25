<?php
/** Script to create a new entry in the user's table.
 * Tests that it is a valid email address and username only has permitted charters
 * Performs sanity checks on the password.
 * Tests that the users email is unique
 * Tests the username is unique.
 * If a problem exits an array is echoed back to the caller indicating where the problems are. {"email"=>bool,"password"=>bool,"userName"=>bool}
 * If all requirements are met then the new account is created, logged-in session variables started and the user is
 * transferred to their home page.
 */

include "authenticate.php"; // functions used for login and new accounts
include "pdo_connection.php"; // connection script to friendZone database
session_start();

/* Test if the correct variables exist and that they have been posted */
if (!($_SERVER['REQUEST_METHOD'] = "POST" && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['userName']))) {
    exit("Access denied");
}
/* Initialise return error array for sanity checks */
$errors = array ("emailExists"=>false,"invalidEmail"=>false,"password"=>false,"userNameExists"=>false,"invalidUserName"=>false);


/*Test the email format */
if(!checkEmail($_POST['email'])){$errors["invalidEmail"] = true;}

/* Test the username conforms */
if(!checkText($_POST["userName"])){$errors["invalidUserName"] = true;}

/* Test the password is acceptable */
if(!(checkPwd($_POST['password']))) { $errors["password"] = true;}

/* If email or username ok then test if the email and/or username already exist.
Prepare SQL statement,execute and fetch the result into an array.  */
if(!($errors["invalidEmail"] || $errors["invalidUserName"])){
    $sql = $pdo->prepare("SELECT email,userName FROM users WHERE email = ? OR userName = ?");
    try{

        $sql->execute([$_POST['email'],$_POST["userName"]]);
        $row = $sql->fetch();

    }catch(PDOException $err){    // if unable to connect display a simple error to the user
        // echo $err->getCode(); // For debugging purposes uncomment to display error code
        echo ''; // returns empty string causing default error message to be displayed from js
        exit();
    }

    /* If duplicate email/username exits identify the problem */
    if ($row != NULL) { // at least 1 account exists with a duplicate email or username

        foreach($row as $value){  // loop through the returned values
            if ($value==$_POST['email']){$errors["emailExists"]=true;} // duplicate email
            if($value==$_POST['userName']){$errors["userNameExists"]=true;} // duplicate username
        }
    }
}


/* If there are errors - echo $error array back to caller as a json obj, to display appropriate messages and exit script*/
if($errors["emailExists"] || $errors["userNameExists"] || $errors["password"] || $errors["invalidEmail"] ||$errors["invalidUserName"]){
    echo json_encode($errors);
    exit();
}

/* New account request is valid. Create a new entry in users table
Prepare sql and INSERT Entry */

$sql= $pdo->prepare("INSERT INTO users (email,userName,password,poster) VALUES(?,?,?,?)");

/* Data is stored raw but should be sanitised when used to avoid XSS */
try{
    $poster=0;
    if($_POST["poster"] == "true"){$poster = 1;} //convert user wants to be a  poster flag to 0 or 1 value for SQL


    $sql->execute([$_POST['email'],$_POST['userName'],password_hash($_POST['password'], PASSWORD_DEFAULT),$poster]);

}catch(PDOException $err){
    echo json_encode(array("err"=>$err->getMessage())); // For debugging purposes
    //echo ''; // returns empty string causing default error message to be displayed from js
    exit();
}
/*New user has been added successfully set login cookies */
setLogin($_POST["email"],false); // Set logged in cookies (1hr expiry). Save session key in users table
echo json_encode(array("success"=>true));
exit();




?>
