<?php
// if we do write session_start before session_destroy then 
// the page will still show the data even after logout
session_start();
session_destroy();
header("location:login.html");
?>