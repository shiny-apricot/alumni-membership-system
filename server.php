<?php
    session_start();

    $username = "";
    $email = "";
    $password1 = "";
    $password2 = "";

    $errors = array();

    // connect to the database
    $db = mysqli_connect('localhost', 'root', '');

    // create table in the current database
    $db_selected = mysqli_select_db($db,'loginpage_yasininal');


    if (!$db_selected) {
        $sql = 'CREATE DATABASE loginpage_yasininal';
        mysqli_query($db,$sql);
        mysqli_close($db);
    }
   
    $sql_create_table = "CREATE TABLE IF NOT EXISTS user_table (
                            id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            username VARCHAR(50) NOT NULL,
                            email VARCHAR(50) NOT NULL,
                            password VARCHAR(50) NOT NULL)";
                            
    mysqli_query($db, $sql_create_table);
  

    //if the register button is clicked
    if (isset($_POST['register']))
    {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password1 = mysqli_real_escape_string($db, $_POST['password1']);
        $password2 = mysqli_real_escape_string($db, $_POST['password2']);

        // ensure that form fields are fileld properly
        if(empty($username))
        {
            array_push($errors, "Username is required");
        }
        if(empty($email))
        {
            array_push($errors, "Email is required");
        }
        if(empty($password1))
        {
            array_push($errors, "Password is required");
        }
        if(empty($password2))
        {
            array_push($errors, "You need to confirm your password");
        }
        if($password1 != $password2) 
        {
            array_push($errors, "The two passwords do not match");
        }

        //if there are no errors, save user to database
        if(count($errors) == 0){
            $password = md5($password1); //encrypt password before strong in database
            $sql = "INSERT INTO user_table (username, email, password) VALUES ('$username', '$email', '$password')";

            mysqli_query($db, $sql);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: mainpage.php'); //redirect to home page 
        }    
    }

    //login
    if(isset($_POST['login'])) {
        header('location: home.html');
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        // ensure that form fields are filled properly
        if(empty($username)){
            array_push($errors, "Username is required");
        }
        if(empty($password)){
            array_push($errors, "Password is required");
        }
        if(count($errors)==0){
            $password = md5($password); //encrypt password before comparing with that from database
            $query = "SELECT * FROM user_table WHERE username='$username' AND password='$password'";
            $result = mysqli_query($db, $query);

            echo mysqli_num_rows($result);
            echo $password;

            
            if(mysqli_num_rows($result) == 1){
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                header('location: home.html'); //redirect to home page 
            }
            else{
                array_push($errors, "Wrong username/password combination.!");
            }
        }
    }

    //logout
    if(isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }

    //update
    if(isset($_POST['update'])) {

        echo '<script type="text/javascript"> alert("Okey") </script>';

        $origin_username = $_SESSION['username'];
        
        $up_username = mysqli_real_escape_string($db, $_POST['up_username']);
        $up_email = mysqli_real_escape_string($db, $_POST['up_email']);
        $up_password = mysqli_real_escape_string($db, $_POST['up_password']);
        $up_password2 = mysqli_real_escape_string($db, $_POST['up_password2']);

        // ensure that form fields are field properly
        if(empty($up_username))
        {
            array_push($errors, "Username is required");
        }
        if(empty($up_email))
        {
            array_push($errors, "Email is required");
        }
        if(empty($up_password))
        {
            array_push($errors, "Password is required");
        }
        if(empty($up_password2))
        {
            array_push($errors, "You need to confirm your password");
        }
        if($up_password != $up_password2) 
        {
            array_push($errors, "The two passwords do not match");
        }

        //if there are no errors, update the user credentials
        if(count($errors) == 0){

            $up_password = md5($up_password); //encrypt password before strong in database
            $sql = "UPDATE user_table SET username= '$up_username', email= '$up_email', password= '$up_password' WHERE username='$origin_username'";

            mysqli_query($db, $sql);
            $_SESSION['username'] = $up_username;
            $_SESSION['success'] = "User Credentials Updated";
            
            header('location: mainpage.php'); //redirect to home page 
        }else{
            echo "hataaa!!!";
        }

        // session_destroy();
        // unset($_SESSION['username']);
        // header('location: login.php');
    }



?>