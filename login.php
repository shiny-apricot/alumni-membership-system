<?php include('server.php'); ?>

<!DOCTYPE html>
<html>

<head>
    <title>
        Sign In
    </title>
    <link rel="stylesheet" type="text/css" href="styleUpdate.css">

<body>
    <div id="header">
        <section id="lw">
            <img id="logo" src="image/logo.png" alt="Logo">
        </section>
        <!-- <div id="empty"></div> -->
        <section id="intro">
            <img id="welcom" src="image/welcomeTo.png" alt="welcome">
            <img id="tobb" src="image/tobb.png" alt="tobb">
        </section>
    </div>

    <div class="loginbox">
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