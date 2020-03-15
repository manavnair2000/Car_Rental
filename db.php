<?php
$servername = "localhost";
$username = "root";
$password = "";
$conn =  new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "CREATE DATABASE IF NOT EXISTS car_rental";
$conn->query($sql);
$sql = "USE car_rental";
$conn->query($sql);
?>
