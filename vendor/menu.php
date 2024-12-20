<?php
include "../shared/auth_guard_vendor.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <title>Fashion-Hive</title>
</head>

<body>
    <style>
        .sticky-navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>

    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between ms-2 me-2 sticky-navbar">
        <a class="navbar-brand" href="#">Fashion-Hive</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="home.php">Home</a>
                <a class="nav-item nav-link" href="upload.php">Add Products</a>
                <a class="nav-item nav-link" href="orders.php">Orders</a>
                <div class="d-flex mx-3">
                    <input class="form-control mr-sm-2 mr-3" type="search" placeholder="Search" aria-label="Search">

                </div>
            </div>
        </div>
        <div>
            <a class='me-3' style='cursor: pointer; text-decoration: none;' onclick='checkLogout()'>Logout</a>
        </div>
    </nav>
</body>

</html>