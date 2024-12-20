<?php
include "menu.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <title>Upload Products</title>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <form action="upload.php" method="post" class="w-50 p-5" enctype="multipart/form-data">
            <h1 class="text-center">Upload Product</h1>
            <input type="text" name="name" id="" class="form-control mt-2" placeholder="Product Name" required>
            <input type="text" name="price" id="" class="form-control mt-2" placeholder="Product Price" required>
            <textarea name="details" id="" cols="20" rows="5" class="form-control mt-2" placeholder="Product Details" required></textarea>
            <input type="text" name="code" id="" class="form-contol mt-2" placeholder="Product Code" required>

            <label for="category" class="text-success ms-3 mt-2 me-3">Category</label>
            <select name="category" id="category" class="form-contol mt-2" required>
                <option value="Electronics">Electronics</option>
                <option value="Fashion">Fashion</option>
                <option value="Home">Home Appliances</option>
                <option value="Sports">Sports</option>
            </select>

            <label for="subcategory" class="text-success ms-3 mt-2 me-3">Sub-category</label>
            <select name="subcategory" id="subcategory" class="form-contol mt-2" required>
                <option value="Bouquet">Bouquet</option>
                <option value="Desktop">Desktop</option>
                <option value="Laptop">Laptop</option>
                <option value="Mobile">Mobile</option>
                <option value="Shoes">Shoes</option>
                <option value="Watch">Watch</option>
            </select>
            <br>
            <label for="active" class="text-success ms-3 mt-2">Active</label>
            <select name="active" id="active" class="form-control mt-2" required>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>

            <input type="file" name="pdt_img" id="" class="form-control mt-2" accept=".jpg, .jpeg, .png">
            <div class="text-center">
                <button type="submit" class="btn btn-success mt-2">Save</button>
            </div>

        </form>
    </div>
</body>

</html>

<?php

include_once "../shared/auth_guard_vendor.php";
$user_id = $_SESSION['userid'];

include_once "../shared/connection.php";
// if no file uploaded
if (count($_FILES) == 0) die;

$img_path = "../shared/images/" . $_FILES['pdt_img']['name'];
move_uploaded_file($_FILES['pdt_img']['tmp_name'], $img_path);



$status = mysqli_query($conn, "insert into product(name, price, details, category, active, code, imgpath, uploaded_by) values('$_POST[name]',
 $_POST[price], '$_POST[details]', '$_POST[category]', '$_POST[active]', '$_POST[code]', '$img_path', $user_id)");

if ($status) {
    echo "Product uploaded successfully!<br>";
} else {
    echo "Error while uploading product<br>";
    echo mysqli_error($conn);
}

?>