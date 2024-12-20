<?php
include 'menu.php';
$p_id = $_POST['pid'];

include '../shared/connection.php';
$sql_obj = mysqli_query($conn, "select * from product where pid = $p_id");
$row = mysqli_fetch_assoc($sql_obj);


// Edit product
if(isset($_POST['name'])) {
    mysqli_query($conn, "update product set name = '$_POST[name]' where pid = $p_id");
}
if(isset($_POST['price'])) {
    mysqli_query($conn, "update product set price = $_POST[price] where pid = $p_id");
}
if(isset($_POST['details'])) {
    mysqli_query($conn, "update product set details = '$_POST[details]' where pid = $p_id");
}
if(isset($_POST['category'])) {
    mysqli_query($conn, "update product set category = '$_POST[category]' where pid = $p_id");
}
if(isset($_POST['subcategory'])) {
    mysqli_query($conn, "update product set sub_category = '$_POST[subcategory]' where pid = $p_id");
}
if(isset($_POST['active'])) {
    mysqli_query($conn, "update product set active = '$_POST[active]' where pid = $p_id");
}
if(isset($_POST['code'])) {
    mysqli_query($conn, "update product set code = '$_POST[code]' where pid = $p_id");
}

if (count($_FILES) != 0 && $_FILES['pdt_img']['size'] != 0) {
    $img_path = "../shared/images/" . $_FILES['pdt_img']['name'];
    move_uploaded_file($_FILES['pdt_img']['tmp_name'], $img_path);
    mysqli_query($conn, "update product set imgpath = '$img_path' where pid = $p_id");
}

// Edit page load
echo "<div class='d-flex flex-wrap justify-content-evenly align-items-center vh-100 mt-5'>
        <div class='d-flex flex-wrap vh-100 w-50'>
        <form action='editproduct.php' method='post' class='w-100 p-5' enctype='multipart/form-data'>
            <h1 class='text-center'>Edit Product</h1>
            <input type='hidden' name='pid' value='$p_id' class='form-control'>
            <input type='text' name='name' value='$row[name]' class='form-control mt-2' placeholder='Product Name'>
            <input type='text' name='price' value='$row[price]' class='form-control mt-2' placeholder='Product Price'>
            <textarea name='details' cols='20' rows='5' class='form-control mt-2' placeholder='Product Details'>$row[details]</textarea>
            <input type='text' name='code' value='$row[code]' class='form-contol mt-2' placeholder='Product Code'>

            <label for='category' class='text-success ms-3 mt-2 me-3'>Category</label>
            <select name='category' value='$row[category]' id='category' class='form-contol mt-2'>
                <option value='Electronics'>Electronics</option>
                <option value='Fashion'>Fashion</option>
                <option value='Home'>Home Appliances</option>
                <option value='Sports'>Sports</option>
            </select>
            <label for='subcategory' class='text-success ms-3 mt-2 me-3'>Sub-category</label>
            <select name='subcategory' value='$row[sub_category]' id='subcategory' class='form-contol mt-2'>
                <option value='Bouquet'>Bouquet</option>
                <option value='Desktop'>Desktop</option>
                <option value='Laptop'>Laptop</option>
                <option value='Mobile'>Mobile</option>
                <option value='Shoes'>Shoes</option>
                <option value='Watch'>Watch</option>
            </select>

            <label for='active' class='text-success ms-3 mt-2'>Active</label>
            <select name='active' value='$row[active]' id='active' class='form-control mt-2'>
                <option value='yes'>Yes</option>
                <option value='no'>No</option>
            </select>
            <input type='file' name='pdt_img' value='$row[imgpath]' class='form-control mt-2' accept='.jpg, .jpeg, .png'>
            <div class='text-center'>
                <button type='submit' class='btn btn-success mt-2'>Save</button>
            </div>
        </form>
        </div>

        <div class='d-flex align-items-start align-self-center card mt-2 me-5 h-50' style='width: 18rem;'>
            <img class='card-img-top' src='$row[imgpath]' alt='$row[name]' style='height: 13rem'>
            <div class='card-body'>
                <h5 class='card-title mb-1'>$row[name] ($row[code])</h5>
                <p class='card-text mb-1'>$row[details]</p>
                <h6>Rs. $row[price]</h6>
            </div>
        </div>
    </div>";
?>