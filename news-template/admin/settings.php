<?php include "header.php"; ?>   
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Edit Website Settings</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <?php
                    $sql = "SELECT * from settings";
                    $result = mysqli_query($connect, $sql);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                    
                    ?>
                <!-- Form -->
                <form action="save-setting.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="website_name">Website Name</label>
                        <input type="text" name="website_name" value="<?php echo $row['webname']?>" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="website_logo">Website Logo</label>
                       <input type="file" name="logo1" required>
                       <img src="images/<?php echo $row['logo']?>" alt="">
                       <input type="hidden" value="images/<?php echo $row['logo']?>" name="old_logo" required>
                    </div>
                    <div class="form-group">
                        <label for="footer_text">Footer Text</label>
                        <input name="footer_text" value="<?php echo $row['footerdec']?>" class="form-control" rows="3" required></input>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Save Settings" required />
                </form>
                <!--/Form -->
                <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
