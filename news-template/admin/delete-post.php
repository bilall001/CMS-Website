<?php
    include 'config.php';
    $post_id = $_GET['id'];
    $cat_id = $_GET['catid'];

    $select = "SELECT * from post WHERE post_id = {$post_id}";
    $query = mysqli_query($connect, $select);
    $row = mysqli_fetch_assoc($query);
    unlink("upload/".$row['post_img']);


    $query = "DELETE FROM post WHERE post_id={$post_id};
    UPDATE category SET post = post - 1 WHERE category_id = {$cat_id}";   

if (mysqli_multi_query($connect, $query)) {
    header("Location:{$hostname}/post.php");
}else{
    die("Query failed: " . mysqli_error($connect));
}


