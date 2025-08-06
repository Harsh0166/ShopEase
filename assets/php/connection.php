<?php
$servername = "localhost";
$username ="root";
$password = "";
$dbname = "shopease";

$conn = mysqli_connect($servername,$username,$password,$dbname);

if(!$conn){
    echo "connected successfully";
}

session_start();
?>