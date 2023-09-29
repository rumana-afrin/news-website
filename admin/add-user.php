<?php
 include "header.php";
 include "config.php";

 session_start();
 
 if( $_SESSION['user_role'] == '0'){
     header("Location:{$hostname }admin/post.php");
 }

if($conn->connect_error){
    echo "Failed to connect to MySQL: " . $conn->connect_error;
   exit();
   
}
// else{
//     echo "Connected to MySQL successfully!";
// }
if(isset($_POST['save'])){
    $fname = $conn->real_escape_string($_POST['fname']);
    $lname = $conn->real_escape_string($_POST['lname']);
    $userName = $conn->real_escape_string($_POST['user']);
    $password = $conn->real_escape_string(md5($_POST['password']));
    $role = $conn->real_escape_string($_POST['role']);


    // echo $sql = "SELECT username FROM user WHERE username= {'$userName'}";
    // die();
   $sql = "SELECT username FROM user WHERE username= '{$userName}'";
    // var_dump($sql);
    $result = $conn->query($sql) or die("query fail");

    if($result->num_rows>0){
        echo "<h2 style='margin:10px;text-align:center;'> username is exist</h2>";
    }else{
        $sql1 = "INSERT INTO user(first_name, last_name, username, password, role) VALUES('{$fname}','{$lname}','{$userName}','{$password}','{$role}')";

        $result1 = $conn->query($sql1);
        header("Location:{$hostname}admin/users.php");
    }

}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF'] ?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Normal User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
