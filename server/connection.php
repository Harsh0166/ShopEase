<?php
$servername = "localhost";
$username ="root";
$password = "root123";
$dbname = "ecom";

$conn = mysqli_connect($servername,$username,$password,$dbname);

if(!$conn){
    echo "connected successfully";
}
?>