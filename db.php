<?php
$server="localhost";
$user="root";
$password="";
$db="ant_app";

$db=new mysqli($server,$user,$password,$db);
    if($db->connect_error){
        die("Connection failed: " . mysqli_connect_error());
    }
?>