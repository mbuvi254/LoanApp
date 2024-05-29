<?php 

$conn= new mysqli('localhost','cyberma3_mbuvi','3030Mbuvi@','cyberma3_lms')or die("Could not connect to mysql".mysqli_error($con));
if(!$conn){
  echo "Error Database!";
}
