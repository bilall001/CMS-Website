<?php
if (isset($_POST['submit'])) {
    include 'config.php';

    if(isset($_FILES['fileToUpload'])){
        $error = array();
        $fileName = $_FILES['fileToUpload']['name'];
        $fileSize = $_FILES['fileToUpload']['size'];
        $fileTmpPath = $_FILES['fileToUpload']['tmp_name'];
        $fileType = $_FILES['fileToUpload']['type'];
        $fileext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $extensions = array("jpeg","jpg","png");

        if(in_array($fileext,$extensions) === false){   
        $error[] = "wrong format";
    }
    if($fileSize >2097152 ){
        $error[] = "sile must be 2 mb or less";
    }

    if(empty($error) == true){
        move_uploaded_file($fileTmpPath,"upload/".$fileName);
    }
    else{
        print_r($error);
    }
    }
    session_start();
    $title = mysqli_real_escape_string($connect, $_POST['post_title']);
    $des = mysqli_real_escape_string($connect, $_POST['postdesc']);
    $category = mysqli_real_escape_string($connect, $_POST['category']);
    $date = date("d M,Y");
    $author = $_SESSION['user_id'];
   
    $sql = "INSERT INTO post (title, description, category, post_date, author, post_img) 
        VALUES ('$title', '$des', '$category', '$date', '$author', '$fileName'); 
        UPDATE category SET post = post + 1 WHERE category_id = {$category}";
    // $result = mysqli_multi_query($connect, $sql) or die("query failed");
    if(mysqli_multi_query($connect,$sql)){
        echo "<script>alert('post Added Successfully');</script>";
        header("Location:{$hostname}/post.php");
        exit;
    }
    else{
       echo "<script>alert('post failed');</script>";
    }
   
}
?>