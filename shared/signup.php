<?php

$username = $_POST['username'];
$password = $_POST['upass1'];
$confirmPassword = $_POST['upass2'];
$user_type = $_POST['user_type'];

// validate the passwords
if($password != $confirmPassword) {
    echo "Password Mismatched";
    die;
}

$cipher_text = md5("$password");

include_once "connection.php";

$status = mysqli_query($conn, "insert into user(username, password, usertype) values('$username', '$cipher_text', '$user_type')");

if($status) {
    echo "Registration Successful!";
    header("location:login.html");
} else {
    echo "Registration Failed! <br>";
    echo mysqli_error($conn);
}

?>