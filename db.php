<?php
$server="localhost";
$anvandare="root";
$losenord="";
$db="ant_app";

$db=new mysqli($server,$anvandare,$losenord,$db);
    if($db->connect_error){
        die("Det blev fel på kopplingen: " . mysqli_connect_error());
    }
?>