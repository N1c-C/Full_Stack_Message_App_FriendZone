<?php
/** Receives a page option via the GET method when a pagination icon is clicked on in the user's home page.
 * Options when $_GET['page'] =  1: next page, -1: previous page, 0: first page, end: last page
 * Updates the appropriate session variable and forwards to home.php to display the results
 */

include "loggedIn.php"; // test if the user is logged in

if(isset($_GET["page"])){
    switch ($_GET["page"]){

        case 0:
            $_SESSION["page"] = 0;
            header("Location: home.php");
            break;
        case 1:
            $_SESSION["page"] += 1;
            echo gettype($_SESSION["page"]);
            header("Location: home.php");
            break;
        case -1:
            ($_SESSION["page"] > 0 ? $_SESSION["page"] -= 1 : $_SESSION["page"]=0); // page number can't be less than one
            header("Location: home.php");
            break;
        case "end":
            $_SESSION["page"] = 'end';
            header("Location: home.php");
            break;
    }
}
header("Location: home.php"); // does nothing if incorrect data has been submitted and displays homepage