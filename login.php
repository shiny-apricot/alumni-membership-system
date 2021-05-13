<?php
session_start();
    $_SESSION; 
?>

<!DOCTYPE html>
<html>
    <head>
        <title>
            Login Page
        </title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <body>
            <div class="loginbox">
                <h1>Login Here</h1>
                <form>
                    <p>Username</p>
                    <input type="text" name="" placeholder="Enter Username" >
                    <p>Password</p>
                    <input type="password" name="" placeholder="Enter Password">
                    <input type="submit" name="" value="login">
                    <a href="#">Lost your password?</a><br>
                    <a href="#">Don't have an account?</a>
                </form>
            </div>
        </body>
    </head>
</html>