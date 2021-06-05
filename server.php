<?php
    session_start();

    $username = "";
    $email = "";
    $password1 = "";
    $password2 = "";

    $errors = array();

    $db_host = "ec2-54-228-139-34.eu-west-1.compute.amazonaws.com";
    $db_name = "d7hvhj4nd7k2ob";
    $db_user = "ckhbnszmophocn";
    $db_password = "3d71b1cc99d3b995a555a6b41b31539fbb0a9b68bf0d34aedf20269e1a69e461";
    // connect to the database

    // $db = mysqli_connect('localhost', 'root', '');
    $db = pg_connect("host=$db_host dbname=$db_name user=$db_user password=$db_password");

    // create table in the current database
    // $db_selected = mysqli_select_db($db,'loginpage_yasininal');


    // if (!$db_selected) {
    //     $sql = 'CREATE DATABASE loginpage_yasininal';
    //     pg_query($db,$sql);
    //     pg_close($db);
    // }
   
    // $sql_drop = "DROP TABLE IF EXISTS user_table";
    // $sql_create_table = "CREATE TABLE IF NOT EXISTS user_table (
    //     id SERIAL PRIMARY KEY,
    //     username VARCHAR(50) NOT NULL,
    //     password VARCHAR(50) NOT NULL)";
                            
    $sql_username = "admin";
    $sql_password = md5("admin");

    // echo "$sql_username <br>";
    // echo "$sql_password <br>";


    $sql_insert_admin = "INSERT INTO user_table (username,password) VALUES ('$sql_username','$sql_password')";

    // pg_query($db, $sql_drop);                        
    // $isCreated = pg_query($db, $sql_create_table);
    pg_query($db, $sql_insert_admin);

    // if($isCreated){
    //     echo "created successfuly <br>";
    // }

   
  

    //if the register button is clicked
    if (isset($_POST['register']))
    {
        // $username = mysqli_real_escape_string($db, $_POST['username']);
        // $email = mysqli_real_escape_string($db, $_POST['email']);
        // $password1 = mysqli_real_escape_string($db, $_POST['password1']);
        // $password2 = mysqli_real_escape_string($db, $_POST['password2']);

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

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
            $sql = "INSERT INTO user_table (username, password) VALUES ('$username', '$password')";

            // mysqli_query($db, $sql);
            pg_query($db, $sql);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: homepage.html'); //redirect to home page 
        }    
    }

    //login
    if(isset($_POST['login'])) {
        // header('location: homepage.html');
        // $username = mysqli_real_escape_string($db, $_POST['username']);
        // $password = mysqli_real_escape_string($db, $_POST['password']);

        $username = $_POST['username'];
        $password = $_POST['password'];

        // ensure that form fields are filled properly
        if(empty($username)){
            array_push($errors, "Username is required");
        }
        if(empty($password)){
            array_push($errors, "Password is required");
        }

        if(count($errors)==0){
            $password = md5($password); //encrypt password before comparing with that from database
            $query = "SELECT * FROM user_table WHERE username = 'admin' AND password = '21232f297a57a5a743894a0e4a801fc3'";


            echo "$password <br>";
            echo "$username <br>";

             // $result = mysqli_query($db, $query);
            $result = pg_query($db, $query);
            echo "$result <br>";

            echo pg_num_rows($result);
            
            if(pg_num_rows($result) >= 1){
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                echo "successfull";
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

            pg_query($db, $sql);
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