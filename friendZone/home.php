<?php
/** Builds the homepage of the user.
 * Includes the header.html script to display a customised header
 * Displays a  page of posts (with any comments) defined by $_SESSION["page"] for the user in  $_SESSION["userView"]
 * All posts are displayed  when $_SESSION["displayFilter"] = '*'
 * 10 posts are displayed per page; the most recent first.
 * adds the footer
 */

include "loggedIn.php";

/* If no page number set start at 0, If no user's posts have been chosen then set display to all posts */

$MSG_PER_PAGE = 10; // Number of posts to display per page
if(!isset($_SESSION["page"])){$_SESSION["page"]= 0;} // set to first page
if(!isset($_SESSION["displayFilter"])){$_SESSION["displayFilter"] = '*';} // set to show all


/* Retrieve user details and display customised header (with userName) */
$user = get_user($_COOKIE["login"]);


include "html/header.php"; // includes code to sanitise the users name against XSS

/* Fetch the number of pages and last page index as $pages : array */
$pages = numOfPages("messages",$MSG_PER_PAGE,$_SESSION["displayFilter"]);


// set the page number as the last one if the  users has jumped to end
if ($_SESSION["page"]=='end') {$_SESSION["page"] = $pages["last"];}

/* Retrieve current page of message posts.
If the returned list is empty then $_SESSION["page"] is decremented and the fetch process tried again.
If the page number is already 0 then exits while loop.
*/
$endOfList = true;
$emptyList = false;

while($endOfList) {

    $offset = $_SESSION["page"] * $MSG_PER_PAGE; // $offset is the starting position in the returned sql query list
    include "pdo_connection.php";
     /* SQL when displaying posts for all users - join with users to retrieve the username */
    if($_SESSION["displayFilter"] == '*') {
        $sql = $pdo->prepare("SELECT messages.*,users.userName as userName FROM messages 
                                    LEFT JOIN users ON messages.email = users.email 
                                    ORDER BY messages.id DESC LIMIT $MSG_PER_PAGE OFFSET $offset");



        try {
            $sql->execute();
        } catch (PDOException $err) {
            // echo $err->getMessage(); // use for debugging
            header("Location: error.php");
        }
    }else{
        /* SQL query when displaying posts for a specific user using join to get the username as well
        SELECT messages.*,users.userName as userName FROM messages LEFT JOIN users ON messages.email = users.email WHERE messages.email = 'nic.chant@gmail.com'*/

        $sql = $pdo->prepare("SELECT messages.*, users.userName as userName FROM messages
                                    LEFT JOIN users ON messages.email = users.email WHERE messages.email = ? 
                                    ORDER BY messages.id DESC LIMIT $MSG_PER_PAGE OFFSET $offset");

        try {

            $sql->execute([$_SESSION["displayFilter"]]);
        } catch (PDOException $err) {
            // echo $err->getMessage(); // use for debugging
            header("Location: error.php");
        }
    }

    /* Successfully carried out query.
     Sanity checks if the user has just used single page incrementing and tried to go beyond the last page -  */
    $messages = $sql->fetchAll();

    if(count($messages)>0){
        $endOfList = false; // end of list has not reached so display the messages
    }elseif($_SESSION["page"] >0){
        $_SESSION["page"] -= 1; // go back to last a page
    }else{
        $endOfList = false;
        $emptyList = true;  // currently, there are no messages to be displayed
    }

}

/* Display current view: who the messages belong to and number of pages. Usability so the user knows what they are looking at */

$displayPage = $_SESSION["page"]+1;

if($_SESSION["displayFilter"] == "*") {
    $userName = "all users";
}else{
    $userName = sanitise(get_userName($_SESSION['displayFilter']));
}

echo "
<nav aria-label='breadcrumb' class='pg-disp row'>
  <ol class='breadcrumb'>
    <h6 class='breadcrumb-item text-muted'>Posts by ".$userName."</h6>
    <h6 class='breadcrumb-item active' aria-label ='page'>Page ".$displayPage." of ".$pages["total"]."</h6>
  </ol>
</nav>";

/* Add page navigation to the top of the page if there are more than a page or results to be displayed
    for better usability to avoid scrolling to the bottom to move on. */
if($pages["total"] > 1) {
    echo "
 <div class=' msg-t-w  align-self-center m-auto mt-5 pt-5'>
    <a onclick='page(-1)' class = 'msg-t-w m-2 page' title='Previous page'   aria-label='Previous page'><i class='fa fa-arrow-circle-left ms-2'></i></a>
    <a onclick='page(0)' class = 'msg-t-w m-2 page' title='First Page'  aria-label='Back to top'><i class='fa fa-arrow-circle-up ms-2'></i></a>
    <a onclick='page(this.dataset.value)' data-value = 'end' class = 'msg-t-w m-3 page' title='Last Page'  aria-label='Last Page'><i class='fa fa-arrow-circle-down ms-2 '></i></a>
    <a onclick='page(1)' class = 'msg-t-w m-2 page' title='Next Page' aria-label='Next Page'><i class='fa fa-arrow-circle-right ms-2'></i></a>
</div>";
}else{
    echo "<div class = 'my-4'></div> "; // provide some space between navbar and messages
}


/*  Start a container for the messages */
echo "<div class='container' id='msg-container'>";

/*Iterate through returned message list if it's not empty */

if(!$emptyList) {
    foreach ($messages as $row) {
        $msg = json_decode($row["message"]);

        /* Display the  title, user, date and content in a friendZone message box.
            Display any comments below this
            All stored 'user created' data is converted to html entities before displaying to avoid XSS
            If a user has a poster account then there is an option to add a comment to a post.
            If the post was written by the user then there is an option to delete it. All comments for the post are also deleted.
        */
        $canDelete = false; // flag to show delete icon if the message belongs to the current user
        if ($user['userName'] == $row['userName']) {
            $canDelete = true;
        }

        /* Retrieve any comments for the message */
        //$sql = $pdo->prepare("SELECT comments.* FROM messages LEFT JOIN comments ON messages.id = comments.message_id WHERE messages.id = {$row['id']}");
        $sql = $pdo->prepare("SELECT comments.*,users.userName as userName FROM comments 
                                    LEFT JOIN users ON comments.email = users.email WHERE comments.message_id = {$row['id']}");
        /*$sql = $pdo->prepare("SELECT * FROM comments WHERE message_id = {$row['id']}");*/
        try {
            $sql->execute();
        } catch (PDOException $err) {
            // echo $err->getMessage(); // use for debugging
            header("Location: error.php");
        }
        $comments = $sql->fetchAll();

        /* Display message.*/
        echo "
    <div class = 'flex-row'>
        <div class = ' msg-box row align-items-center justify-content-center'> <!-- Outline Div with rounded corners -->
            <div class = ' msg-box-top '> <!--Title and poster area -  upper corners rounded (css) -->
                <div class=' row msg-title'> 
                    <div class='column m-2 me-0 float-left msg-t-w'><a onclick='displayProfile(this.dataset.value)' data-value ='" . ($row['userName']) . "' title='User profile' class='icon-usr' ><img height='50' src='img/user-circle-icon.svg'></a></div>
                    <div class = 'column m-2 ms-0 msg-poster float-left msg-t-w' ><a onclick='displayProfile(this.dataset.value)' class='icon-usr-t' title='User profile' data-value ='" . ($row['userName']) . "'<b>" . sanitise($row['userName']) . "</b></a><br>" . get_date($row['date']) . "</div>
                    <div class = 'column m-2 float-left msg-title-text align-self-center msg-t-w''><div class='m-auto'><h5>" . sanitise($msg->title) . "</h5></div></div>
                    <div class = 'column m-2 ms-auto float-end align-self-center msg-t-w'>
                        <div >";

        /* add a delete icon to the users own messages */
        echo ($canDelete) ? "  
                            <a  onclick='delMsg(this.dataset.value)' data-value = {$row['id']} title='Delete this message' class='icon msg-t-w'><i class='fa fa-trash' aria-label='Delete Message'></i></a>" : "";
        echo "                   
                        </div>
                    </div>
                </div>
            </div>
            <div class = 'row msg-box-body bg-light' >  <!-- main form section of window - lower corners rounded (css) -->
                <div class = 'm-3'>".sanitise($msg->message)."</div>
              ";

       /* Display any comments if they exist. */

            echo "<div class='comments'  ></div> 
                <table id='table" . $row['id'] . "' class='table-striped ' >
                <thead >
                    <tr><th>
                        <div class='my-3'><b><em>Comments:</em></b></div>
                    </th></tr>
                </thead>
                <tbody>";
            foreach ($comments as $com) {
                echo "
                <tr class='border-top'>
                    <td class = 'tab-usr' >
                        <div class='ms-4'> <a onclick='displayProfile(this.dataset.value)' href = '#' data-value =" . ($com['userName']) . " class='icon-usr' title='User profile'>
                            <img height='35'  src='img/user-circle-icon.svg'><br><b>" . sanitise($com['userName']) . "</b></a>
                        </div>
                    </td>

                    <td>
                        <div> <em class='small tab-date'>" . get_date($com['date']) . "</em></div>
                        <div class = 'column float-left msg-title-text  msg-t-w'>
                            <div>" . sanitise($com["comment"]) . "</div>
                        </div>
                    </td>
                </tr>";
            }
            echo "</tbody>
            </table>";

        /* If the user is logged in as a 'poster' then include link to add a comment.
        Hide button controls for submit and cancel buttons to be revealed when the add comment link is clicked */
        if($user["poster"]) {
            echo    "<div class = 'row comments my-3 align-content-center'>
                        <div class=' my-4' >
                            <a id='link".$row['id']."' onclick='addCommentBox(this.dataset.value)' class='link-add-com'  title='Add a comment' data-value = '". $row['id'] ."' aria-label='Add comment'><i class= 'fa fa-plus-circle'></i><span class=' ms-3'>Add a comment</span></a>
                            <div hidden id='com_buttons".$row['id']."'>
                            <a id='cancel".$row['id']."' onclick='cancelCommentBox(this.dataset.value)' class='link-add-com'  title='Cancel' data-value = '". $row['id'] ."' aria-label='Cancel comment' ><i class= 'fa fa-times float-end pt-1 me-2'></i></a>
                            <button id='submit".$row['id']."' onclick='submitComment(this.dataset.value)' class='btn btn-primary float-left me-4'  title='Submit Comment' data-value = '". $row['id'] ."' aria-label='Submit comment'>Add Comment</button>
                            </div>
                        </div> 
                        <div class = 'row align-content-center' id='com_". $row['id'] ."'></div> <!-- Append textbox to this div when add comment is clicked -->
                    </div>";
        }
        /* close the remaining div tags */
    echo "</div> 
        </div>
    </div>";
    }
}

/* Display Pagination Icons to move forward / back a page of posts for the current search criteria */

echo "
 <div class=' msg-t-w  align-self-center m-auto mb-5 pb-5'>
    <a onclick='page(-1)' class = 'msg-t-w m-2 page' title='Previous page'   aria-label='Previous page'><i class='fa fa-arrow-circle-left ms-2'></i></a>
    <a onclick='page(0)' class = 'msg-t-w m-2 page' title='First Page'  aria-label='Back to top'><i class='fa fa-arrow-circle-up ms-2'></i></a>
    <a onclick='page(this.dataset.value)' data-value = 'end' class = 'msg-t-w m-3 page' title='Last Page'  aria-label='Last Page'><i class='fa fa-arrow-circle-down ms-2 '></i></a>
    <a onclick='page(1)' class = 'msg-t-w m-2 page' title='Next Page' aria-label='Next Page'><i class='fa fa-arrow-circle-right ms-2'></i></a>
</div>";


echo "</div>"; // close message container

include "html/footer.html";




function numOfPages($table,$nPerPage,$user)
{
    /** Function to determine the number of pages given the number per page required (nPerPage)
     * and the user to search for (user). User = * = all records
     * returns an array. (pages("total"=>number of to be view pages, "last=> index for last page)
     * or false if an error occurs*/

    /* Get count for all users */
    include "pdo_connection.php";
    if ($user == "*") {

        $sql = $pdo->prepare("SELECT COUNT(*) AS total FROM $table");
        try {
            $sql->execute();
        } catch (PDOException $err) {
            // echo $err->getCode(); // For debugging purposes
            return array("total" => "Unknown", "last" => $_SESSION['page']);
        }
    }else{ // searching for posts by a specific user
        $sql = $pdo->prepare("SELECT COUNT(*) AS total FROM $table WHERE email = ?");
        try {
            $sql->execute([$user]);
        } catch (PDOException $err) {
            // echo $err->getCode(); // For debugging purposes
            return array("total" => "Unknown", "last" => $_SESSION['page']);
        }
    }
    $total=$sql->fetch()['total'];
    /* If there are 0 pages  returns 1 */
    return array("total" => (ceil($total / $nPerPage) == 0 ? 1 : ceil($total / $nPerPage)), "last" => (floor($total / $nPerPage)));
}






