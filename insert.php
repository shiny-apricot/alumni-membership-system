<?php

include('functions.php');
include('server.php');
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $gend = $_POST['gender'];
    $phone = $_POST['phone'];

    $query = pg_query($db_conn, "INSERT  INTO member(member_id, name, gender, phone_number ) VALUES ('$id','$name','$gend','$phone');");
    if ( $query ) {
        echo  "Record Successfully Added!";
    }
}

?>