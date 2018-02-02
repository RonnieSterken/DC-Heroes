<?php
$con=mysqli_connect("localhost","root","","dc heroes");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $team = array();
  $hero = array();

  $sql = "select * from team";

  $resource = mysqli_query($con,$sql);

  while($row = mysqli_fetch_assoc($resource))
  {
    $team[] = $row;
  }










?>
