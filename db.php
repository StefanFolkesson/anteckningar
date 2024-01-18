<?php
$server="localhost";
$anvandare="root";
$losenord="";
$db_namn="ant_app";

$db=new mysqli($server,$anvandare,$losenord,$db_namn);
    if($db->connect_error){
        die("Det blev fel på kopplingen: " . mysqli_connect_error());
    }
?>