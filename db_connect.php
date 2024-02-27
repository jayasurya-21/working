<?php
 $name="localhost";
 $username="root";
 $password="";
 $dbname="ims";
 $conn = mysqli_connect($name, $username, $password, $dbname);
 if(!$conn) {
     die("Connection failed: " . mysqli_connect_error());
 }
 ?>