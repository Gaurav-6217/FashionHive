<?php
include "menu.php";
?>

<html>

<head>
</head>

<body>
    <h1 class="text-center mb-2" style="margin-top: 70px;">Uploaded Products</h1>

</body>

</html>

<?php

include "../shared/connection.php";
$user_id = $_SESSION['userid'];
$sql_obj = mysqli_query($conn, "select * from product where uploaded_by='$_SESSION[userid]'");

echo "<div class='container'>";
echo "<div class='row'>";
while ($row = mysqli_fetch_assoc($sql_obj)) {
    echo "<div class='col-3 product-card d-flex flex-wrap' data-product-id='$row[pid]'>";
    echo "<div class='card mb-1 mt-2' style='width: 18rem;'>
            <img class='card-img-top' src='$row[imgpath]' alt='$row[name]' style='height: 13rem'>
            <div class='card-body'>
            <h5 class='card-title'>$row[name] ($row[code])</h5>
            <p class='card-text'>$row[details]</p>
            <h6>Rs. $row[price]</h6>
            <div class='d-flex'>
                <form action='editproduct.php' method='post' class='d-flex'>
                    <input type='hidden' name='pid' value='$row[pid]'>
                    <button type='submit' class='btn btn-outline-primary mt-2'>Edit</button>
                </form>
                <div class='ms-3'>
                    <button class='btn btn-outline-danger removeButton mt-2' data-id=$row[pid]>Remove</button>
                </div>
            </div>
        </div>
        </div>";
    echo "</div>";
}
echo "</div>";
echo "</div>";

?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let removeButtons = document.querySelectorAll(".removeButton");
        // Remove the product from the cart
        removeButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Get the product ID from the data-id attribute
                let productId = button.getAttribute('data-id');
                // Get the product card element using the data-product-id attribute
                let productCard = document.querySelector(`.product-card[data-product-id='${productId}']`);

                // Create a new XMLHttpRequest object
                let xhr = new XMLHttpRequest();

                // Configure the request
                xhr.open('POST', 'remove_product.php', true);

                // Set the request headers (if needed)
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                // Define the data which is to be sent
                let dataToSend = 'userid=<?php echo $user_id ?>&pid=' + productId; // Use the captured productId

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