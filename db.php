<?php
 header("Access-Control-Allow-Origin: *");
 $con = mysqli_connect("localhost","root","","mtps") or die ("could not connect database");
 if (mysqli_connect_errno())
  {
  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>