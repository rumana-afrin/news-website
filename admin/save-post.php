<?php 
include "config.php";
if(isset($_FILES['fileToUpload'])){
    $errors = array();
  $file_name = $_FILES['fileToUpload']['name'];
  $file_size = $_FILES['fileToUpload']['size'];
  $file_tmp = $_FILES['fileToUpload']['tmp_name'];
  $file_type = $_FILES['fileToUpload']['type'];
  $file_ext = strtolower(end(explode('.',$file_name)));
  $extention = array('jpg','png','jpeg');

  if(in_array($file_ext,$extention) === false){
    $error[] = "this extension file is not allowed. please chose jpg, png, jpeg";
  }
  if($file_size > 2097152){
    $error[] = "file size must be 2mb or lower";
  }
  if(empty($errors) == true){
    move_uploaded_file($file_tmp ,"upload/" . $file_name);
  }else{
    print_r($errors);
    die;
  }


}
session_start();
$title = $conn->real_escape_string($_POST['post_title']);
$description = $conn->real_escape_string($_POST['postdesc']);
$category = $conn->real_escape_string($_POST['category']);
var_dump($category);
$date = date("d M, Y");
$auther = $_SESSION['user_id'];

$sql = "INSERT INTO post(title,description,category,post_date,author,post_img) VALUES('{$title}','{$description}',{$category},'{$date}',{$auther},'{$file_name}');";

$sql .= "UPDATE category SET post = post + 1 WHERE category_id  = '{$category}'";
// var_dump($title, $description, $category, $date, $auther, $file_name);

if($conn->multi_query($sql)){
    header("Location:{$hostname }admin/post.php");
}else{
    echo '<div class="alert alert-danger">query failed</div>';
}
?>