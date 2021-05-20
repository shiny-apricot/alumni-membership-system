<?php
//my first code
$dbhost = "localhost";
$dbuser = "root";
$dbpassword = " ";
$dbname = "loginpage";

if($con = mysqli_connect(!$dbhost, $dbuser, $dbpass, $dbname))
{
    die("failed to connect!");
}
session_start();
    $_SESSION; 
?>

