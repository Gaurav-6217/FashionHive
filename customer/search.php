<?php
include "../shared/auth_guard_customer.php";
$seach_query = $_POST['search_query'];
$search_for = strtolower($seach_query);


$pattern = array("/bouquet/", "/clock/", "/computer/", "/desktop/", "/flowers/", "/laptop/", "/mobile/", "/phone/", "/shoe/", "/sneaker/", "/watch/");

for($i = 0; $i < count($pattern); $i++) {
    $pattern_word = $pattern[$i];
    // echo $pattern_word."<br>";
    if(preg_match($pattern_word, $search_for)) {
        $search_keyword = substr($pattern[$i], 1, strlen($pattern[$i]) - 2);
        header("location: subcategories/$search_keyword.php");
        die;
    }
}
?>