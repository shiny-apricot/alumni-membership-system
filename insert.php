<?php

include('functions.php');
include('server.php');
if (isset($_POST['update'])) {
    $name = $_POST['username'];
    $gend = $_POST['password'];

    $query = pg_query($db, "INSERT  INTO user_table(name, password) VALUES ('$name','$gend')";

    if ( $query ) {
        echo  "Record Successfully Added!";
    }
    else{
        echo "not valid";
    }
}

?>