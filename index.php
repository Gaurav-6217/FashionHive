<?php
session_start();
$_SESSION['login_status'] = false;

$username = $_POST['username'];
$password = $_POST['password'];
echo "$username";
$cipher_text = md5($password);

include_once "./shared/connection.php";

$sql_obj = mysqli_query($conn, "select * from user where username = '$username' and password = '$cipher_text'");
$no_of_rows = mysqli_num_rows($sql_obj);

if($no_of_rows == 0) {
    echo "Invalid credential!";
    die;
}

$row = mysqli_fetch_assoc($sql_obj);

// store all the information associated with an user to the session
$_SESSION['login_status'] = true;
$_SESSION['usertype'] = $row['usertype'];
$_SESSION['username'] = $row['username'];
$_SESSION['userid'] = $row['userid'];


if($row['usertype'] == 'Vendor') {
    header("location:./vendor/home.php");
} else if($row['usertype'] == 'Customer') {
    header("location:./customer/home.php");
}

?>