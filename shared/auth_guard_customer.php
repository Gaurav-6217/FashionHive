<html>

<head>
    <script>
        function checkLogout() {
            const res = confirm("Are you sure, you want to logout?");
            if (res) {
                window.location = '../shared/login.html';
            }
        }
    </script>
</head>

<body>

</body>

</html>
<?php

session_start();
include "auth_guard_style.html";

if (!isset($_SESSION['login_status'])) {
    echo "You skipped login...";
    echo "You skipped login... 1";
    echo "<a href='../shared/login.html'>Login</a>";
    echo "You skipped login... 2";
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

$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
$usertype = $_SESSION['usertype'];

// echo "<div class='userbanner'>
//         <div class='userid'>#$userid</div>
//         <div class='username'>$username</div>
//         <div class='usertype'>$usertype</div>
//         <div class='logout' style='cursor: pointer; text-decoration: underline; color: blue;'>
//             <a onclick='checkLogout()'>Logout</a>
//         </div>
//     </div>"
?>