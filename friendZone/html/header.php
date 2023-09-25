<!DOCTYPE html>
<html lang="en">

<!--Header file for friendZone provides customised navbar showing username
Note Will only work as an included file: uses Authenticate=>sanitise() for username -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FriendZone</title>

    <!-- Chosen css framework -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <!--Icon library-->
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <!--Custom CSS options-->
    <link rel="stylesheet" href="./css/friendzone.css">

    <!--js libraries-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="./js/pwstrength-bootstrap.js"></script>
    <script src="./js/friendzone.js"></script>

    <!--Tinymce Text editor api-->
    <script src="https://cdn.tiny.cloud/1/o16uyg28jfl6yilx53jv7f7kihxxacxwzqx8qzjpylmgd74k/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>


<body>
<div class = "wrapper"> <!-- Container for the page. Maintains full height even when empty -->
    <div class="row">
        <nav class="navbar navbar-expand-md  navbar-light fixed-top">

            <!-- brand image with left and right margins-->

            <a class="navbar-brand  me-5" href="./index.php"><img class="brand-logo" title="Home" src="./img/logo_v4_dark.png" alt="logo" height="50"></a>


            <div class = "search-div">
                <div class="d-flex ms-2 my-3">
                <input class="form-control " type="text" id="search" placeholder="Filter posts by user" aria-label="Search">
                <a class="fa fa-search btn nav-item" id="searchSubmit" onclick="userSearch()" title="Submit search" aria-label="Submit" ></a><br>
                </div><label><span><small id = "search-err" class=" search-err text-danger " aria-label="User Not found"><b>No such user</b></small></span></label>
            </div>

            <!-- Define responsive 'burger menu' for small screens -->
            <button class="navbar-toggler left-burger m-2 me-3 " type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon left-burger"></span>
            </button>
            <!-- menu bar items that will collapse into the burger -->
            <div class="collapse navbar-collapse" id="navbarCollapse" >
                <ul class="navbar-nav ms-auto "> <!-- Set start margin to 0 to force  text links to the right-->
                    <li class="nav-item">
                        <a class="nav-link" href="search.php?userName=*" aria-label="All Posts">All Posts</a>
                    </li>
                    <li class="nav-item">
                        <?php echo "
                        <a class='nav-link nav-text' id = 'myposts' aria-label = 'My Posts' href = 'search.php?userName=".$user["userName"]."'>My posts</a>";
                        ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-text me-md-5" href="newPost.php" aria-label="New Post">New Post</a>
                    </li>
                    <!--Avoid XSS display convert reserved characters to special entities -->
                    <em class="navbar-text nav-text "><?php echo (isset($user["userName"])) ? sanitise($user["userName"]) : "My Profile";?></em>
                    <li class="nav-item">
                        <div class="dropdown me-5">
                            <a class="nav-link nav-text dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-user "></i></a>
                            <ul class="dropdown-menu ">
                                <li><a class="dropdown-item" href="profile.php">Edit Profile</a></li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>

        </nav>
    </div>






