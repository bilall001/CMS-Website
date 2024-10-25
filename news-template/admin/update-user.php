<?php include "header.php";
include 'config.php';
if($_SESSION['role'] == 0){
   header("location:{$hostname}/post.php");
   exit;
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

                $userid = $_GET['id'];

                $sqli = "SELECT * FROM user WHERE user_id = '$userid'";
                $result = mysqli_query($connect, $sqli);
                if (mysqli_num_rows($result) == 1) {
                    while($row=mysqli_fetch_assoc($result)){                    
                ?>
                <form action="<?php $_SERVER = ['PHP_SELF'] ?>" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="user_id" class="form-control" value="<?php echo $row['user_id']; ?>" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name']; ?>" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name']; ?>" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                            <?php
                            if($row['role']==1){
                                echo '<option value="0">normal User</option>
                            <option value="1" selected>Admin</option>';
                            }else{
                                echo '<option value="0" selected>normal User</option>
                                <option value="1">Admin</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                </form>
                <?php
                    }
                }
                ?>
                <!-- /Form -->
            </div>
        </div>
    </div>
</div>
<?php 
if (isset($_POST['submit'])) {
    $user_id = mysqli_real_escape_string($connect, $_POST['user_id']);
    $fname = mysqli_real_escape_string($connect, $_POST['f_name']);
    $lname = mysqli_real_escape_string($connect, $_POST['l_name']);
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $role = mysqli_real_escape_string($connect, $_POST['role']);
    $update = "UPDATE user SET first_name='$fname', last_name='$lname', username='$username', role='$role' 
    WHERE user_id='$userid'";
$update_query = mysqli_query($connect, $update);

    if($update_query){
        header("Location:{$hostname}/users.php");
    }
    else{
        echo "error";
    }
}
?>
<?php include "footer.php"; ?>