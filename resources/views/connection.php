<?php
$con = mysqli_connect("localhost","kasaposi_usersdb","jakarta19kasa","kasaposi_db");
if(mysqli_connect_errno($con))
{
	echo "Failed to connect to MySQL:".mysqli_connect_error();
}
else
{
	echo "";
}
?>