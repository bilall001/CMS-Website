<?php
    include 'config.php';
    $page = basename($_SERVER['PHP_SELF']);
    
    switch($page){
        case "single.php":
            if(isset($_GET['id'])){
                $sql1 = "SELECT * from post WHERE post_id = {$_GET['id']}";
                $result1 = mysqli_query($connect, $sql1) or die("query failed");
                $row_tile1 = mysqli_fetch_assoc($result1);
                $title = $row_tile1['title'];
            }
            else{
                $title = "Post Not Found";
            }
            break;
        case "category.php":
            if(isset($_GET['cid'])){
                $sql2 = "SELECT * from category WHERE category_id = {$_GET['cid']}";
                $result2 = mysqli_query($connect, $sql2) or die("query failed");
                $row_tile2 = mysqli_fetch_assoc($result2);
                $title = $row_tile2['category_name']. " ". "News";
            }
            else{
                $title = "category Not Found";
            }
            break;
        case "author.php":
            if(isset($_GET['aid'])){
                $sql3 = "SELECT * from user WHERE user_id = {$_GET['aid']}";
                $result3 = mysqli_query($connect, $sql3) or die("query failed");
                $row_tile3 = mysqli_fetch_assoc($result3);
                $title = "News by " . $row_tile3['first_name']. " " .$row_tile3['last_name'] ;
            }
            else{
                $title = "user Not Found";
            }
            break;
        case "search.php":
            if(isset($_GET['search'])){
                $title = $_GET['search'];
            }
            else{
                $title = "Post Not Found";
            }
            break;
            default:
            $title = "News Website";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title;?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
    $sqli = "SELECT * from settings";
    $resulti = mysqli_query($connect, $sqli);
    if(mysqli_num_rows($resulti) > 0){
        while($row = mysqli_fetch_assoc($resulti)){
    ?>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="admin/images/<?php echo $row['logo'];?>"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<?php
        }
    }
    ?>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                if(isset($_GET['cid'])){
                    $cat_id = $_GET['cid'];
                }

                include 'config.php';
                $sql = "SELECT * from category where post > 0";
                $result = mysqli_query($connect, $sql);
                if(mysqli_num_rows($result)> 0){

                
                ?>
                <ul class='menu'>
                <li><a href="index.php">Home</a></li>
                    <?php 
                    while($row = mysqli_fetch_assoc($result)){
                        if(isset($cat_id)){
                            if($row['category_id'] === $cat_id ){
                                $active = 'active';
                            }
                            else{
                                $active = "";
                            }
                        }
                        ?>
                        <li><a class='<?php echo $active ;?>' href="category.php?cid=<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></a></li>
                    <?php 
                } 
                ?>
                </ul>
                <!-- <?php
             } 
             ?> -->
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
