<?php

include "../shared/connection.php";

$user_id = $_SESSION['userid'];

?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <link rel='stylesheet' href='st.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <script src='https://kit.fontawesome.com/e1a8580b8d.js' crossorigin='anonymous'></script>
</head>

<body>
    <div class="overlay"></div>
    <div id='popup-window'>
        <div class='nav'>
            <a>Add Delivery Address</a>
            <a id='close-button'><i class='fa-solid fa-circle-xmark fa-lg' style='color: #2662c9;'></i></a>
        </div>
        <div class='overflow'>
            <div class='save'>
                <input type='text' class='int' placeholder='Name*' id='user-name'>
                <input type='tel' name='' class='int' id='' placeholder='Mobile No*'>
            </div>
            <div class='save'>
                <hr>
                <p>ADDRESS</p>
                <input type='number' id='numberInput' placeholder='Pin Code*'>
                <input type='text' id='user-address' placeholder='Address (House No./Building No.)'>
                <input type='text' placeholder='Locality/Town*'>
            </div>
            <div class='div-input'>
                <input type='text' class='mini' placeholder='City/District*'>
                <input type='text' placeholder='State*'>

            </div>

            <div class='save-as'>
                <hr>
                <p>SAVE ADDRESS AS</p>
                <input type='checkbox' name='' id='w'>
                <label for='w'>Work</label>

                <br>
                <input type='checkbox' name='' id='h'>
                <label for='h'>Home</label>
            </div>

        </div>
        <div>
            <button class='footer-btn' data-id='<?php $user_id ?>'>ADD ADDRESS</button>
        </div>
    </div>

    <script>
        // Get the elements by their IDs
        let popupLink = document.getElementById('popup-link');
        let popupWindow = document.getElementById('popup-window');
        let closeButton = document.getElementById('close-button');
        let overlay = document.querySelector(".overlay");
        let addButton = document.querySelector(".footer-btn");



        let nameInput = document.querySelector('.int[placeholder="Name*"]');
        let mobileInput = document.querySelector('.int[placeholder="Mobile No*"]');
        let pinCodeInput = document.getElementById("numberInput");
        let addressInput = document.querySelector('input[placeholder="Address (House No./Buliding No.)"]');
        let localityInput = document.querySelector('input[placeholder="Locality/Town*"]');
        let cityInput = document.querySelector('.mini[placeholder="City/District*"]');
        let stateInput = document.querySelector('input[placeholder="State*"]');
        let workAddressCheckbox = document.querySelector('input[type="checkbox"][value="work"]');
        let homeAddressCheckbox = document.querySelector('input[type="checkbox"][value="home"]');
        // Show the pop-up window when the link is clicked
        popupLink.addEventListener('click', function(event) {
            event.preventDefault();
            overlay.style.display = "block";
            popupWindow.style.display = 'block';
        });

        // Hide the pop-up window when the close button is clicked
        closeButton.addEventListener('click', function() {
            popupWindow.style.display = 'none';
            overlay.style.display = "none";
            nameInput.value = "";
            mobileInput.value = "";
            pinCodeInput.value = "";
            addressInput.value = "";
            localityInput.value = "";
            cityInput.value = "";
            stateInput.value = "";
            workAddressCheckbox.checked = false;
            homeAddressCheckbox.checked = false;
        });

        addButton.addEventListener('click', function() {
            let userAddress = document.getElementById('user-address');
            let userName = document.getElementById('user-name');

            let user_address = userAddress.value;
            let user_name = userName.value;
            console.log(user_address);
            // Get the product ID from the data-pid attribute
            let productId = addButton.getAttribute('data-id');
            // Create a new XMLHttpRequest object
            let xhr = new XMLHttpRequest();

            // Configure the request
            xhr.open('POST', 'set_address.php', true);

            // Set the request headers (if needed)
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            // Define the data which is to be sent
            let dataToSend = 'userid=<?php echo $user_id ?>&address=' + user_address +'&name=' + user_name; // Use the captured productId
            console.log(dataToSend);
            // Define a callback function to handle the response
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText);
                    alert("Address added successfully!");
                }
            };

            // Send the request with the data
            xhr.send(dataToSend);
        });
    </script>
</body>

</html>