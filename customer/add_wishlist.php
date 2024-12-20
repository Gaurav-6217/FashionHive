<?php
include "../shared/auth_guard_customer.php";
include "../shared/connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $p_id = $_POST['pid'];
    $user_id = $_SESSION['userid'];
    
    $status = mysqli_query($conn, "insert into wishlist(userid, pid) values($user_id, $p_id)");
    
    if($status) {
        echo "product added successfully";
    } else {
        echo "Product couldn't be added<br>";
        echo mysqli_error($conn);
    }
    // Perform actions based on $param1 and $param2
    // Send a response back to the JavaScript code
    echo "Received param1: $p_id and $user_id";
} else {
    echo "Invalid request method";
}