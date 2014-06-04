<?php
include("global.inc.php");
$con=mysqli_connect($glob["host"],$glob["user"],$glob["password"],$glob["data_base"]);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

//mysqli_close($con);

?>