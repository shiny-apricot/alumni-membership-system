<?php include('server.php'); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>
            Sign In
        </title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <body>
            <div class="loginbox">
                <h1>Log In</h1>
                    <form name="input-group" action="login.php" method="post">
                        <?php include('errors.php'); ?>
                        <div class="input-group">
                            <p>Username</p>
                            <input type="text" name="username">
                        </div>
                        <div class="input-group">
                            <p>Password</p>
                            <input type="password" name="password">
                        </div>
                        <div class="input-group">
                            <button type="submit" name="login" class="btn">LOGIN</button>
                        </div>
                    </form>
            </div>
        </body>
    </head>
</html>