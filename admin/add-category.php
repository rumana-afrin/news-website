<?php include "header.php";
include "config.php";


if($_SESSION['user_role'] == '0'){
    header("Location:{$hostname }admin/post.php");
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->

                  <?php
                  include "config.php";
                  if(isset($_POST['save'])){
                    $category = $_POST['cat'];

                    $sql = "INSERT INTO category(category_name) VALUES ('{$category}')";
                    $result = $conn->query($sql);

                    header("Location:{$hostname}admin/category.php");


                  }
                  ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
