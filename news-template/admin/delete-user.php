<?php
include 'config.php';
 if($_SESSION['role'] == 0){
    header("location:{$hostname}/post.php");
    exit;
 }
$user_id = $_GET['id'];

$delete = "DELETE FROM user WHERE user_id='$user_id'";
if(mysqli_query($connect,$delete)){
    header ("Location:{$hostname}/users.php");

}else{
    echo "Error deleting the user";
}