<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>

<body>
    <?php
    include "menu.php";
    include "../shared/connection.php";
    

    $user_id = $_SESSION['userid'];
    $sql_result = mysqli_query($conn, "select * from cart join product on cart.pid=product.pid where cart.userid = '$_SESSION[userid]'");
    // $row = mysqli_fetch_assoc($sql_result);

    // num of products in the cart
    $size = mysqli_num_rows($sql_result);

    // show message when cart is empty
    if ($size == 0) {
        echo "<div class='d-flex justify-content-center align-items-center text-center flex-wrap' style='margin-top: 100px;'>
                <div>
                    <h3 class='text-dark'>Hey, it feels so light</h3>
                    <h5 class='text-secondary'>There is nothing in your cart. Let's add some items.</h5>
                    <a href='wishlist.php' class='btn btn-outline-primary mt-4'>ADD ITEMS FROM WISHLIST</a>
                </div>
            </div>";
        die;
    }

    // show the products which was added to the cart
    $total = 0;
    echo "<div class='d-flex justify-content-evenly flex-wrap vh-100' style='margin-top: 70px;'>";
    echo "<ul style='list-style-type: none;'>";
    while ($row = mysqli_fetch_assoc($sql_result)) {
        // calculate the total price of the products in the cart
        $total = $total + $row['price'];
        echo "<li><div class='card mt-2 me-5 product-card' data-product-id='4' data-cart-id='$row[cartid]'>
                <div class='d-flex justify-content-between' style='width: 30rem;'>
                    
                    <div>
                    <img class='img-thumbnail' src='$row[imgpath]' alt='$row[name]' style='height: 10rem; width: 10rem'>
                    </div>
                    <div class='card-body'>
                        <h5 class='card-title mb-1'>$row[name]</h5>
                        <p class='card-text mb-1'>$row[details]</p>
                        <h6>Rs. $row[price]</h6>
                        <button class='btn btn-sm btn-outline-danger remove_button' data-id='$row[cartid]'>Remove</button>
                        <button class='btn btn-sm btn-outline-primary wishlist_button' data-id='$row[pid]'>Move to wishlist</button>
                    </div>
                </div>
            </div></li>";
    }
    echo "</ul>";
    $sql_address_obj = mysqli_query($conn, "select address from user where userid = $_SESSION[userid]");
    $get_address = mysqli_fetch_assoc($sql_address_obj);
    
    echo "<div class='d-flex flex-column align-items-end w-50 mt-2 container'>
            <div class='border p-2 d-flex flex-wrap justify-content-between align-items-center row' style='width: 40rem;'>
                <div class='d-flex flex-column col'>
                    <div>
                        <h6 class=''>Deliver to: </h6>
                    </div>
                    <div>
                        <p class='text-wrap' style='font-size: 13px;'>$get_address[address]</p>
                    </div>
                </div>
                <div class='col-3'>
                    <button class='btn btn-sm btn-outline-primary text-end' id='popup-link'>Add Address</button>
                </div>
            </div>
                <div class='d-flex flex-column align-self-center h-50 w-50 mt-5'>
                    <div class='d-flex flex-wrap row'>
                        <div class='col-lg'>Total MRP </div>
                        <div class='col-lg text-end'>Total MRP </div>
                    </div>
                    <div class='d-flex flex-wrap row'>
                        <div class='col-lg'>Discount on MRP </div>
                        <div class='col-lg text-end'>Total MRP </div>
                    </div>
                    <div class='d-flex flex-wrap row'>
                        <div class='col-lg'>Delivery Charges </div>
                        <div class='col-lg text-end'>Rs.59 </div>
                    </div>
                    <div class='d-flex flex-wrap row'>
                        <div class='col-lg'>Convenience Fee </div>
                        <div class='col-lg text-end'>Rs.15</div>
                    </div>
                    <hr>
                    <div class='d-flex flex-wrap row'>
                        <div class='col-lg'><h6>Total Amount</h6> </div>
                        <div class='col-lg text-end'><h6>Rs.$total</h6></div>
                    </div>
                    
                    <button type='submit' class='btn btn-outline-warning mt-2'>Place Order</button>
                </div>
        </div>
    </div>";

    include "address.php";
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let wishlistButtons = document.querySelectorAll('._button'); // Select all buttons with the class 'cartButton'
            let removeButtons = document.querySelectorAll('.remove_button'); // Select all buttons with the class 'wishlistButton'


            wishlistButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Get the product ID from the data-id attribute
                    let productId = button.getAttribute('data-id');
                    let productCard = document.querySelector(`.product-card[data-product-id='${productId}']`);

                    console.log(productCard);
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

            // Remove the product from the cart
            removeButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Get the product ID from the data-id attribute
                    let productId = button.getAttribute('data-id');
                    // Get the product card element using the data-product-id attribute
                    let productCard = document.querySelector(`.product-card[data-cart-id='${productId}']`);

                    // Create a new XMLHttpRequest object
                    let xhr = new XMLHttpRequest();

                    // Configure the request
                    xhr.open('POST', 'removecart.php', true);

                    // Set the request headers (if needed)
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                    // Define the data which is to be sent
                    let dataToSend = 'userid=<?php echo $user_id ?>&cartid=' + productId; // Use the captured productId

                    // Define a callback function to handle the response
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            console.log(xhr.responseText);
                            // If the deletion was successful, remove the product card from the webpage
                            if (xhr.responseText === 'success') {
                                console.log("Deletion successful!");
                                // Remove the product card from the DOM
                                productCard.remove();
                                
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