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

if ($_SESSION['usertype'] != 'Vendor') {
    echo "Unauthorized access to this user";
    die;
}

include "../shared/connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['userid'];
    $p_id = $_POST['pid'];
    $status = mysqli_query($conn, "delete from product where pid = $p_id");

    // if ($status) {
    //     echo "product added successfully";
    // } else {
    //     echo "Product couldn't be added<br>";
    //     echo mysqli_error($conn);
    // }
    // Perform actions based on $param1 and $param2
    // Send a response back to the JavaScript code
    echo "success";
} else {
    echo "Invalid request method";
}
