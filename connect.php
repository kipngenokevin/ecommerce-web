<?php
$user ="root";
$password="";
$db = "victoria_carpets";
$db = new mysqli('localhost',$user,$password,$db) or die("PLease Try Again After A Short While");
$query ="SELECT*FROM products";

//echo "string";
?>
