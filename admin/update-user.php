<?php 
include "header.php";
include "config.php";



if( $_SESSION['user_role'] == '0'){
    header("Location:{$hostname }admin/post.php");
}
if(isset($_POST['submit'])){
    $UserId = $conn->real_escape_string($_POST['user_id']);
    $User_FName = $conn->real_escape_string($_POST['f_name']);
    $User_LName = $conn->real_escape_string($_POST['l_name']);
    $UserName = $conn->real_escape_string($_POST['username']);
    $User_password = $conn->real_escape_string(md5($_POST['password']));
    $UserRole = $conn->real_escape_string($_POST['role']);

//    $get_user = "SELECT username FROM user WHERE username = '{$UserName}'";
//    $get_user_result = $conn->query($get_user);

//    if($get_user_result->num_rows > 0){
//     echo "username is already exist";
//    }else{
    $sqlUpdate = "UPDATE user SET first_name= '{$User_FName}', last_name= '{$User_LName}', username = '{$UserName}', role = '{$UserRole}', password = '{$User_password}' WHERE user_id = '{$UserId}'";

    $user_result = $conn->query($sqlUpdate);

    header("Location: {$hostname}admin/users.php");

//    }


}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <!-- Form Start -->
                <?php
                include "config.php";

                $userId = $_GET['id'];

                $sql = "SELECT * FROM user WHERE user_id = {$userId}";
                $result = $conn->query($sql);

                // var_dump($result);
                if($result->num_rows>0){
                    while($row = $result->fetch_assoc()){
            //   var_dump($row);

                  
          

                ?>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="user_id" class="form-control" value="<?php echo $row['user_id'];?>" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name'];?>" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name'];?>" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $row['username'];?>" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" value="<?php echo $row['password'];?>" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                        <?php
                        if($row['role'] == 1){
                            echo '  <option value="0">normal User</option>
                            <option value="1" selected>Admin</option>';
                        }else{
                            echo '  <option value="0" selected>normal User</option>
                            <option value="1" >Admin</option>';
                        }
                        ?>
                        </select>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                </form>
                <?php
                      }  }
                ?>
                <!-- /Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>