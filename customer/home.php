<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>
    <?php
    include "menu.php";
    include "../shared/connection.php";
    $sql_obj = mysqli_query($conn, "select * from product");
    $user_id = $_SESSION['userid'];

    echo "<div class='container'>";
    echo "<div class='row' style='margin-top: 70px;'>";
    while ($row = mysqli_fetch_assoc($sql_obj)) {
        echo "<div class='col-3'>"; // Adjust the column size as needed
        echo "<div class='card mb-2 mt-2' style='max-width: 18rem;'>
                    <img class='card-img-top' src='$row[imgpath]' alt='$row[name]' style='height: 13rem'>
                    <div class='card-body'>
                        <h5 class='card-title'>$row[name]</h5>
                        <p class='card-text'>$row[details]</p>
                        <h6>Rs. $row[price]</h6>
                        <button class='btn btn-outline-primary cartButton' data-pid=$row[pid]>Cart</button>
                        <button class='btn btn-outline-primary wishlistButton' data-pid=$row[pid]>Wishlist</button>
                    </div>
            
            </div>";
        echo "</div>";
    }
    echo "</div>";
    echo "</div>";
    ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let cartButtons = document.querySelectorAll('.cartButton'); // Select all buttons with the class 'cartButton'
            let wishlistButtons = document.querySelectorAll('.wishlistButton'); // Select all buttons with the class 'wishlistButton'
            
            cartButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Get the product ID from the data-pid attribute
                    let productId = button.getAttribute('data-pid');
                    // Create a new XMLHttpRequest object
                    let xhr = new XMLHttpRequest();

                    // Configure the request
                    xhr.open('POST', 'addcart.php', true);

                    // Set the request headers (if needed)
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                    // Define the data which is to be sent
                    let dataToSend = 'userid=<?php echo $user_id ?>&pid=' + productId; // Use the captured productId
                    console.log(dataToSend);
                    // Define a callback function to handle the response
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            console.log(xhr.responseText);
                        }
                    };

                    // Send the request with the data
                    xhr.send(dataToSend);
                });
            });

            wishlistButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Get the product ID from the data-pid attribute
                    let productId = button.getAttribute('data-pid');
                    // Create a new XMLHttpRequest object
                    let xhr = new XMLHttpRequest();

                    // Configure the request
                    xhr.open('POST', 'add_wishlist.php', true);

                    // Set the request headers (if needed)
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                    // Define the data which is to be sent
                    let dataToSend = 'userid=<?php echo $user_id ?>&pid=' + productId; // Use the captured productId
                    console.log(dataToSend);
                    // Define a callback function to handle the response
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            console.log(xhr.responseText);
                        }
                    };

                    // Send the request with the data
                    xhr.send(dataToSend);
                });
            });
        });
    </script>
</body>

</html>