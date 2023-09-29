<?php include "header.php";
include "config.php";


if( $_SESSION['user_role'] == '0'){
    header("Location:{$hostname }admin/post.php");
}

// -------------------UPDATE DATA-----------------
if(isset($_POST['sumbit'])){
    $cat_id = $_POST['cat_id'];
    $cat_name = $_POST['cat_name'];

    $sql1 = "UPDATE category SET category_name = '{$cat_name}' WHERE category_id = {$cat_id}";
    $result1 = $conn->query($sql1);
    header("Location:{$hostname }admin/category.php");

}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                <?php 
                include "config.php";
                if(isset($_GET['cat'])){
                    $category = $_GET['cat'];

                    $sql = "SELECT * FROM category WHERE category_id = '{$category}'";

                    $result =  $conn->query($sql) or die("query unsuccessfull");

                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){

                
                   

                ?>
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $row['category_id'] ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name'] ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php 
                    } } }
                  ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
