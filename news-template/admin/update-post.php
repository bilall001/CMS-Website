<?php include "header.php"; ?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <?php
    include 'config.php';
    $id = $_GET['id'];

    $sql = "SELECT * from post
    LEFT JOIN category on post.category = category.category_name
    LEFT JOIN user on post.author = user.user_id
     WHERE post_id = {$id}";
    $result = mysqli_query($connect, $sql) or die("query failed");
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
    ?>
    <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->
        <form action="save-update.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $row['post_id'] ?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $row['title'] ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
                <?php echo $row['description'] ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                    <?php 
                    $sql1 = "SELECT * from category";
                    $result1 = mysqli_query($connect, $sql1) or die("query failed");
                    while($row1 = mysqli_fetch_assoc($result1)){
                        if($row['category']== $row1['category_id']){
                            $selected = "selected";
                        }
                        else{
                            $selected = "";
                        }
                    echo "<option {$selected} value='{$row1['category_id']}'>{$row1['category_name']}</option>";

     } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img  src="upload/<?php echo $row['post_img']?>" height="150px">
                <input type="hidden" name="old-image" value="<?php echo $row['post_img']?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <!-- Form End -->
      </div>
      <?php } ?>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>