<?php
session_start();
include './db.php';
try{
    if(isset($_SESSION['userid'],$_POST['carRegNo']))
	{
        $sql="SELECT carRegNo,carName,carPrice,carFile FROM car_rental.car WHERE carRegNo=".$_POST['carRegNo'].";";
        $result = $conn->query($sql);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($result->num_rows > 0) {
            $carName = $row['carName'];
            $carRegNo = $row['carRegNo'];
            $user = $_SESSION['userid'];
            $sql1="INSERT INTO car_rental.car_rent(orderName,carRegNo,userID) VALUES('$carName',$carRegNo,$user);";
            if($result1 = $conn->query($sql1))
            {
                echo "<script>alert('Order Placed Successfully'); location.replace('index.php');</script>";
                echo "Hello";
            }
            else{
                 echo("Error description: " . $conn -> error);
            }
    }
    else {
        echo "<script>alert('Order not placed!! \n Due to some internal error');</script>";
    }
    
}
else{
    echo "<script>window.location.href='login.html'; </script>";
}
}
catch(Exception $e){
    echo "<script> window.alert('Unable to process request :$e->getMessage()'); </script>";
}

?>
