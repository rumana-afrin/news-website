<?php

include "config.php";


if( $_SESSION['user_role'] == '0'){
    header("Location:{$hostname }admin/post.php");
}

// ------------------code for delete-------------
$get_user_id = $_GET['id'];

$delete_user = "DELETE FROM user WHERE user_id = {$get_user_id}";

$result = $conn->query($delete_user) or die("query failed");

if($result){
    echo "<p>delete user successfully</P>";
    header("Location:{$hostname }admin/users.php");
}

$conn->close();
?>