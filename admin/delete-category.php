<?php
include "header.php";
include "config.php";

if(isset($_GET['cat'])){
    $cat_id = $_GET['cat'];

    $sql = "DELETE FROM category WHERE category_id = {$cat_id}";
    $result = $conn->query($sql);

    header("Location:{$hostname }admin/category.php");


}
$conn->close();
?>