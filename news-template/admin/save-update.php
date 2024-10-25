<?php
include "config.php";
 if(empty($_FILES['new-image']['name'])){
    $fileName = $_POST['old-image'];
}else{
    $error = array();
    $fileName = $_FILES['new-image']['name'];
    $fileSize = $_FILES['new-image']['size'];
    $fileTmpPath = $_FILES['new-image']['tmp_name'];
    $fileType = $_FILES['new-image']['type'];
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


$update_post = "UPDATE post SET 
title = '{$_POST['post_title']}', 
description = '{$_POST['postdesc']}', 
category = {$_POST['category']}, 
post_img = '{$fileName}'
WHERE post_id = {$_POST['post_id']}";

$query = mysqli_query($connect, $update_post) or die("query failed");


    if($query){
        header("Location:{$hostname}/post.php");
        exit;
    }