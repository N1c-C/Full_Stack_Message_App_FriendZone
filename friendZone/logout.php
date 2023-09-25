<?php
/** Logs the user out
 deletes the session, login and remember me cookies
 redirects to index.php login page and destroys the session*/

setcookie('session','', time() + (-3600));
setcookie('login','',time() + (-3600));
setcookie('remember','',time() + (-3600));
session_start();
session_destroy();

header("location: index.php");






