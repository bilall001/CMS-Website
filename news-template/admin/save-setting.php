<?php
if (isset($_POST['submit'])) {
    include 'config.php';
    // $fileName = "";
    if(empty($_FILES['logo1']['name'])){
        $fileName = $_POST['old_logo'];
    }
    else{
        $error = array();
        $fileName = $_FILES['logo1']['name'];
        $fileSize = $_FILES['logo1']['size'];
        $fileTmpPath = $_FILES['logo1']['tmp_name'];
        $fileType = $_FILES['logo1']['type'];
        $fileext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $extensions = array("jpeg", "jpg", "png");

        if (in_array($fileext, $extensions) === false) {
            $error[] = "wrong format";
        }
        if ($fileSize > 2097152) {
            $error[] = "sile must be 2 mb or less";
        }

        if (empty($error) == true) {
            move_uploaded_file($fileTmpPath, "images/" . $fileName);
        } else {
            print_r($error);
        }
    }

    $webname = mysqli_real_escape_string($connect, $_POST['website_name']);
    $footer = mysqli_real_escape_string($connect, $_POST['footer_text']);

    if (!empty($fileName)) {
        $sql = "UPDATE settings SET webname='{$webname}', logo='{$fileName}', footerdec='{$footer}'";
    } else {
        $sql = "UPDATE settings SET webname='{$webname}', footerdec='{$footer}'"; // Don't update logo if no new file
    }

    $sql = "UPDATE settings SET webname='{$webname}',logo='{$fileName}',footerdec='{$footer}'";
    // $result = mysqli_multi_query($connect, $sql) or die("query failed");
    if (mysqli_query($connect, $sql)) {
        echo "<script>alert('setting changed Successfully');</script>";
        // header("Location:{$hostname}/settings.php");
        exit;
    } else {
        echo "<script>alert('post failed');</script>";
    }
}
else{
    echo "error"; 
}
