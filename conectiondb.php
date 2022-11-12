<?php 

$serevername="localhost:3306";
 $username="root";
 $password="";
 $dbase="solar";
  
 $conn = mysqli_connect($serevername,$username,$password,$dbase);
 if(!$conn){
    die("connection faild!" . mysqli_connect_error());
 }




?>