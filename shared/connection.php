<?php
// make connection to the database
$conn = new mysqli("localhost", "root", "", "acme23_june");
if ($conn->connect_error) {
    echo "Connection failed.";
    die;
}

?>