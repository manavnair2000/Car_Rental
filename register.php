<?php
session_start();
include './db.php';
if(isset($_POST['username']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	try{
		$sql = "INSERT INTO car_rental.user (userName,password) VALUES ('$username','$password')";
		$result = $conn->query($sql);
		$_SESSION['userName'] = $username;
		header("Location: index.php");
	}
	catch(Exception $e){
		echo "<script> window.alert('Unable to open account due to :$e->getMessage()') </script>";
	}
}
?>
