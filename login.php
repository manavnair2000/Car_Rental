<?php
session_start();
include './db.php';
$username = $_POST['username'];
$password = $_POST['password'];
//$sql = "SELECT * FROM manav.emp WHERE username='$username' AND password='$password'";
//$result = $conn->query($sql);
$stmt = $conn->prepare('SELECT * FROM car_rental.user WHERE userName = ? and password = ?');
$stmt->bind_param('ss', $username,$password);
$stmt->execute();
$result = $stmt->get_result();
if(!$row = $result->fetch_assoc())
{
    echo "<script> alert('Your Username or Password is Incorrect !!! Please Signup'); window.open('register.html','_self')</script>";
}
else {
    $_SESSION['userid'] = $row['userID'];
    $_SESSION['username'] = $row['userName'];
    header("Location: index.php");
	exit();
}
?>
