<?php
/** Script to add some generic users and fake posts with comments */
include "pdo_connection.php";
/* Basic array of users*/
$users = array(
            array("email"=>"dave.smith@gmail.com","username"=>"smithy","password"=>"TestD@ta","poster"=>0),
            array("email"=>"sally.smith@gmail.com","username"=>"sal","password"=>"TestD@ta","poster"=>0),
            array("email"=>"clint@movies.com","username"=>"clint","password"=>"TestD@ta","poster"=>1),
            array("email"=>"fred.flintstone@dinosaur.com","username"=>"flint","password"=>"TestD@ta","poster"=>1),
            array("email"=>"ann.other@user.com","username"=>"Ann-85","password"=>"TestD@ta","poster"=>1)
);

$sql = $pdo->prepare("INSERT INTO users (email,userName,password,poster) VALUES(?,?,?,?)");
/* bind parameters to variables and insert*/
foreach ($users as $row) {

    $sql->bindParam(1, $row["email"]);
    $sql->bindParam(2, $row["username"]);
    $sql->bindParam(3, $row["password"]);
    $sql->bindParam(4, $row["poster"]);

    /* Execute the query/statement */
    try {
        $sql->execute([$row["email"],  $row["username"], password_hash($row["password"],PASSWORD_DEFAULT), $row["poster"]]);
    } catch (\PDOException $err) {
        die("Error: " . $err->getMessage());
    }
}

/* Add fake messages and comments to the messages and comments tables. */

$messages = array( "message1"=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ornare neque sit amet egestas scelerisque. 
            Nullam ac maximus sem. Quisque porttitor mi vitae gravida sodales. Maecenas ultricies dolor ut auctor elementum. 
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel lacus rhoncus, tempus urna id, malesuada sapien. 
            Morbi nec diam a tellus pretium commodo. In maximus eget ex sit amet dictum. Mauris viverra consectetur ultricies.",
"message2" => "Sed a auctor elit, a mattis eros. Integer vitae ipsum in est dignissim ultrices quis nec tortor. Quisque nunc ex, 
accumsan quis magna ac, suscipit iaculis mi. Donec ut nisi porttitor dui posuere bibendum in vehicula ante. Fusce quis dui ac 
enim hendrerit tempus quis eget odio. Nullam finibus facilisis dolor, vitae tempus ipsum venenatis et. Aliquam dignissim nibh 
neque, vitae sollicitudin dui vestibulum a. In sodales hendrerit tincidunt. Vestibulum in tellus ac risus commodo lobortis sit 
amet vel quam. Quisque condimentum, odio sit amet pulvinar lobortis, leo arcu scelerisque diam, id pharetra odio mi et est. 
Suspendisse venenatis nisi eget diam posuere interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer 
consectetur cursus augue id porta. Curabitur ac placerat ligula. Sed fringilla augue sed leo consectetur feugiat. Donec leo orci, 
consequat a imperdiet a, porta non erat.",

"message3" => "Morbi sed porta velit. Pellentesque blandit lacus tortor, auctor semper mi scelerisque et. Duis in bibendum augue, 
ac egestas velit. Maecenas viverra aliquet ante at blandit. ",

"message4" => "Aenean congue lorem arcu, sit amet faucibus odio pellentesque et. Integer consectetur rutrum dapibus. 
Nam non sodales metus. Fusce luctus dolor eu fringilla feugiat. Proin fermentum nisi in risus posuere hendrerit. 
Suspendisse rutrum tortor et malesuada pharetra. Morbi elementum porttitor tortor, vitae fringilla augue placerat vel. 
Nunc nec mollis lectus. Sed bibendum dui lacinia tristique eleifend. Quisque lobortis condimentum nulla, vel ultrices ipsum malesuada et. 
Suspendisse mi magna, vestibulum tincidunt lorem vel, rhoncus tempus justo.",

"message5" => "Donec ut nisi porttitor dui posuere bibendum in vehicula ante. Fusce quis dui ac 
enim hendrerit tempus quis eget odio. Nullam finibus facilisis dolor, vitae tempus ipsum venenatis et. Aliquam dignissim nibh 
neque, vitae sollicitudin dui vestibulum a. In sodales hendrerit tincidunt. Vestibulum in tellus ac risus commodo lobortis sit 
amet vel quam. Quisque condimentum, odio sit amet pulvinar lobortis, leo arcu scelerisque diam, id pharetra odio mi et est. 
Suspendisse venenatis nisi eget diam posuere interdum. In sodales hendrerit tincidunt. Vestibulum in tellus ac risus commodo lobortis sit 
amet vel quam. Quisque condimentum, odio sit amet pulvinar lobortis, leo arcu scelerisque diam, id pharetra odio mi et est. 
Suspendisse venenatis nisi eget diam posuere interdum."
);

$comments = array(
"comment1" => "In nec consectetur turpis. Nulla sed tempor libero.",
"comment2" => "Vestibulum auctor justo eu massa facilisis bibendum sit amet nec tellus. Pellentesque at ex nec dui feugiat luctus. 
Vivamus ac nibh vehicula, pulvinar massa sit amet, auctor augue.",
"comment3" => "Mauris sit amet euismod nisi, ut mollis dolor. Sed eleifend leo lorem, in lacinia ante feugiat non. 
Ut eget quam faucibus lectus tincidunt pharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit."
);


/* Loop through users and messages and insert into message table. - 25 posts in total.
   For each message loop through comments and users. Add comment if they are a poster 25 * 9 comments in total */

foreach ($messages as $message) {
    $sqlmsg = $pdo->prepare("INSERT INTO messages (email,message) VALUES(?,?)");

    foreach ($users as $row) {
        $sqlmsg->bindParam(1, $row["email"]);
        $sqlmsg->bindParam(2, $message);
        /* Message stored as a JSON obj to allow for future expansion of message field options */
        $jsonmsg = array("title"=>"In sodales hendrerit tincidunt.","message"=>$message);


        /* Execute the query/statement */
        try {

            $sqlmsg->execute([$row["email"],json_encode($jsonmsg)]);

        } catch (\PDOException $err) {
            die("Error: " . $err->getMessage());
        }
        $messageid = (int)$pdo->lastInsertId();  // get the message id to link to comments


        $sqlcom = $pdo->prepare("INSERT INTO comments (email,comment,message_id) VALUES(?,?,?)");

        foreach($comments as $comment){

            foreach($users as $row) {
                if ($row["poster"]) {
                    $sqlcom->bindParam(1, $row["email"]);
                    $sqlcom->bindParam(2, $comment);
                    $sqlcom->bindParam(3, $messageid);
                    try {

                        $sqlcom->execute([$row["email"], $comment, $messageid]);

                    } catch (\PDOException $err) {
                        die("Error: " . $err->getMessage());
                    }
                }
            }
        }

    }
}