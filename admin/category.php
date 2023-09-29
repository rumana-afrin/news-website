<?php include "header.php";
include "config.php";


if( $_SESSION['user_role'] == '0'){
    header("Location:{$hostname }admin/post.php");
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <?php
                 $limit = 3;
                 if(isset($_GET['cat'])){
                    $page = $_GET['cat'];
                 }else{
                    $page = 1;
                 }
                 $offset = ($page - 1) * $limit;
                $sql = "SELECT * FROM category LIMIT {$offset},{$limit}";
                $result = $conn->query($sql) or die("query failed");
                if($result->num_rows > 0){

            
                ?>
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        while($row = $result->fetch_assoc()){

                    
                        ?>
                        <tr>
                            <td class='id'><?php echo $row['category_id'] ?></td>
                            <td><?php echo $row['category_name'] ?></td>
                            <td><?php echo $row['post'] ?></td>
                            <td class='edit'><a href='update-category.php?cat=<?php echo $row['category_id'] ?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?cat=<?php echo $row['category_id'] ?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                       <?php } ?>
                    </tbody>
                </table>
                <?php
                    }
                ?>

                <?php
                $sql1 = "SELECT * FROM category";
                $result1 = $conn->query($sql1) or die("query unsuccessfull");

                if($result1->num_rows > 0){

                    $total_records = $result1->num_rows;
                   

                    $total_page = ceil($total_records/$limit);

                    echo "<ul class='pagination admin-pagination'>";
                    
                    if($page > 1){
                        echo '<li><a href="category.php?cat='.($page - 1).'">prev</a></li>';

                    }
                   for($i=1;  $i <= $total_page; $i++){
                    if($page == $i){
                        $active = "active";
                    }else{
                        $active = "";
                    }
                    
                  
                    echo '<li><a class="'.$active.'" href="category.php?cat='.$i.'">'.$i.'</a></li>';
                   }

                   if($page < $total_page){
                    echo '<li><a href="category.php?cat='.($page + 1).'">next</a></li>';
                   }
                   

                   echo "</ul>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
