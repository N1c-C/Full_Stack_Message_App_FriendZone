<?php
/** Include file to make and test a connection to mySQL host USING PDO.
 */

$servername = "localhost";
$username = "root";
$password = "";
$dbName = 'friendZone'; // Name of MySql database to be used.
$attr = "mysql:host=$servername;dbname=$dbName";
$opts =
    [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // set errors to throw exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // set default fetch as an associative array
        PDO::ATTR_EMULATE_PREPARES   => false, // do not allow emulation of prepared statements
    ];

try
{
    $pdo = new PDO($attr, $username, $password, $opts); // Try to connect to the database $dbName
}
catch (\PDOException $err) { // Code block if connection fails to create database

        die("Exception: ".$err->getMessage()." Code: ".$err->getCode()); // Kill the script if another connection error occurs
    }

