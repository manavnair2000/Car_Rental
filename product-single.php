<?php
session_start();
include './db.php';
try{
	if(isset($_SESSION['userid']))
	{
    $sql="SELECT carRegNo,carName,carPrice,carFile FROM car_rental.car WHERE carRegNo=".$_POST['carRegNo'].";";
    $result = $conn->query($sql);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    
	?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#03a6f3">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <script>
        function enable(){
            document.getElementById("carRegNo").hidden = false;
        }
    </script>
</head>

<body>
    <header>
        <div class="main-menu">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="index.php"><img src="images/car-logo.jpg" alt="logo"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="navbar-item active">
                                <a href="index.php" class="nav-link">Home</a>
                            </li>
                            <li class="navbar-item">
                                <a href="logout.php" class="nav-link">Logout</a>
                            </li>
                        </ul>
							<form class="form-inline my-2 my-lg-0" id="search" action="search.php" method="post">
                            <input class="form-control mr-sm-2" type="search" name="search_key" onsearch="search_page();" placeholder="Search here..." aria-label="Search">
                            <span class="fa fa-search"></span>
														<script>
														function search_page()
														{
															var form = document.getElementById("search");
															form.submit();
														}
													</script>
                        </form>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <div class="breadcrumb">
        <div class="container">
            <a class="breadcrumb-item" href="index.php">Home</a>
            <span class="breadcrumb-item active">Product Page</span>
        </div>
    </div>
    <section class="product-sec">
        <div class="container">
            <h1>
              <?php
        	    if ($result->num_rows > 0) {
                  echo $row['carName'];
                }
                else{
                  echo 'Car has been removed';
                } ?>
                  </h1>
            <div class="row">
                <div class="col-md-6 slider-sec">
                    <!-- main slider carousel -->
                    <div id="myCarousel" class="carousel slide">
                        <!-- main slider carousel items -->
                        <div class="carousel-inner">
                            <div class="active item carousel-item" data-slide-number="0">
								<?php echo "<img src='images/".$row['carFile']."' alt='img' class='img-fluid'>"; ?>
                            </div>
                        </div>
                    </div>
                    <!--/main slider carousel-->
                </div>
                <div class="col-md-6 slider-content">
                    <p>This car is a great car to ride and has smooth handling, power acceleration and packs a punch. </p><br/><br/>
                    <ul>
                        <li>
                            <span class="name">Price</span><span class="clm">:</span>
                            <span class="price final">$ <?php echo $row['carPrice'];?>/quarter</span>
                        </li>
                    </ul><br/><br/>
                    <div class="btn-sec">
                        <form action="new_rent.php" method="post" onsubmit="enable()" >
                            <input type="text" id="carRegNo" name="carRegNo" value="<?php echo $row["carRegNo"] ?>" hidden/>
                            <button type="submit" name="submit" class="btn">Rent Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
<?php
}
else{
		echo "<script>window.location.href='login.html'; </script>";
	}
}
catch(Exception $e){
	echo "<script> window.alert('Unable to process request :$e->getMessage()'); </script>";
}
?>
