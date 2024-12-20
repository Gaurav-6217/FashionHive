<?php
// user authorization
session_start();

if (!isset($_SESSION['login_status'])) {
    echo "You skipped login...";
    echo "<a href='../shared/login.html'>Login</a>";
    die;
}

// user has entered wrong credential
if ($_SESSION['login_status'] == false) {
    echo "Invalid login credential!<br>";
    echo "<a href='../shared/login.html'>Login</a>";
    die;
}

if ($_SESSION['usertype'] != 'Customer') {
    echo "Unauthorized access to this user";
    die;
}

include "../shared/connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['userid'];
    $user_address = $_POST['address'];
    $user_name = $_POST['name'];

    $status = mysqli_query($conn, "update user set name = '$user_name', address = '$user_address' where userid = '$user_id'");
    
    // if($status) {
    //     echo "product added successfully";
    // } else {
    //     echo "Product couldn't be added<br>";
    //     echo mysqli_error($conn);
    // }
    // Perform actions based on $param1 and $param2
    // Send a response back to the JavaScript code
    echo "$user_address  $user_name";
} else {
    echo "Invalid request method";
}
