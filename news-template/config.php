<?php
$hostname = "http://localhost/php/news-template/";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "news-site";

$connect = mysqli_connect($servername,$username,$password,$dbname);
if(!$connect){
    echo "Not connected to database" . mysqli_connect_error();
}