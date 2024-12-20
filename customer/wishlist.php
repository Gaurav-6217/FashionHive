<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
</head>

<body>
    <?php
    include "menu.php";
    include "../shared/connection.php";
    $user_id = $_SESSION['userid'];
    $sql_result = mysqli_query($conn, "select * from wishlist join product on wishlist.pid=product.pid where userid = '$_SESSION[userid]'");
    $size = mysqli_num_rows($sql_result);

    if ($size === 0) {
        echo "<div class='d-flex justify-content-center align-items-center h-50 text-center flex-wrap'>
                <div>
                    <h3 class='text-dark'>Hey, it feels so light</h3>
                    <h5 class='text-secondary'>There is nothing in your wishlist. Let's add some items.</h5>
                    <a href='home.php' class='btn btn-outline-primary mt-4'>ADD ITEMS</a>
                </div>
            </div>";
        die;
    }

    $total = 0;
    echo "<div class='container'>";
    echo "<div class='row' style='margin-top: 70px;'>";
    while ($row = mysqli_fetch_assoc($sql_result)) {
        $total = $total + 1;
        echo "<div class='col-3 product-card' data-wishlist-id='$row[wishlist_id]'>"; // Adjust the column size as needed
        echo "<div class='card mb-2 mt-2' style='max-width: 18rem;'>
                <img class='card-img-top' src='$row[imgpath]' alt='$row[name]' style='height: 13rem'>
                <div class='card-body'>
                    <h5 class='card-title'>$row[name]</h5>
                    <p class='card-text'>$row[details]</p>
                    <h6>Rs. $row[price]</h6>
                    <button class='btn btn-sm btn-outline-danger remove_button' data-id = $row[wishlist_id]>Remove</button>
                    <button class='btn btn-sm btn-outline-primary cart_button' data-id = $row[pid]>Move to cart</button>

                </div>
            </div>";
        echo "</div>";
    }
    echo "</div>";
    echo "</div>";
    ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let cartButtons = document.querySelectorAll('.cart_button'); // Select all buttons with the class 'cartButton'
            let removeButtons = document.querySelectorAll('.remove_button'); // Select all buttons with the class 'wishlistButton'

            cartButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Get the product ID from the data-id attribute
                    let productId = button.getAttribute('data-id');
                    let productCard = document.querySelector(`.product-card[data-cart-id='${productId}']`);

                    console.log(productId);
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
                            // If the deletion was successful, remove the product card from the webpage
                            if (xhr.responseText === 'success') {
                                console.log("card removal successful from the wishlist!");
                                productCard.remove(); // Remove the product card from the DOM
                            } else {
                                console.log("Something went wrong");
                            }
                        }
                    };

                    // Send the request with the data
                    xhr.send(dataToSend);
                });
            });

            // Remove the product from the wishlist
            removeButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Get the product ID from the data-id attribute
                    let productId = button.getAttribute('data-id');
                    // Get the product card element using the data-wishlist-id attribute
                    let productCard = document.querySelector(`.product-card[data-wishlist-id='${productId}']`);

                    // Create a new XMLHttpRequest object
                    let xhr = new XMLHttpRequest();

                    // Configure the request
                    xhr.open('POST', 'remove_wishlist.php', true);

                    // Set the request headers (if needed)
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                    // Define the data which is to be sent
                    let dataToSend = 'userid=<?php echo $user_id ?>&wishlistid=' + productId; // Use the captured productId

                    // Define a callback function to handle the response
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            // If the deletion was successful, remove the product card from the webpage
                            if (xhr.responseText === 'success') {
                                console.log("Deletion successful!");
                                productCard.remove(); // Remove the product card from the DOM
                            } else {
                                console.log("Something went wrong");
                            }
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