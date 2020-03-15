<?php
session_start();
include './db.php';
try{
	if(isset($_SESSION['userid']))
	{
    $sql="SELECT carRegNo,carName,carPrice,carFile FROM car_rental.car;";
		$result = $conn->query($sql);
		?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Car Rental System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#03a6f3">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .car{
            margin-top : 12px;
        }
    </style>
</head>

<body>
    <header>
        <div class="main-menu">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="index.php"><img src="images/car-logo.jpg" alt="logo" style="width: 100px;"></a>
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
    <section class="recomended-sec">
        <div  class="container" id="product">
            <div class="title">
                <h2>Our Cars</h2>
                <hr>
            </div>
                  <div class="row">
										<?php
				      				if ($result->num_rows > 0) {
												$i=0;
				      					while($row = $result->fetch_array(MYSQLI_ASSOC)) {
				                  ?>
                      <div class="col-lg-3 col-md-6 car">
                          <div class="item">
                              <?php echo "<img src='images/".$row['carFile']."' alt='img'>"; ?>
                              <h3><?php echo $row['carName'];?> </h3>
                              <h6><span class="price">$ <?php echo $row['carPrice'];?></span> / <a onclick="product_page();">Buy Now</a></h6>
                              <script>
                                function product_page(sender)
                                {
                                  var form = document.createElement("form");
																	var val = sender.value;
                                  var element1 = document.createElement("input");
                                  form.method = "POST";
                                  form.action = "product-single.php";
																	element1.type = "text";
                                  element1.value= val;
                                  element1.name='carRegNo';
                                  form.appendChild(element1);
                                  document.getElementById("product").appendChild(form);
                                  form.submit();
                                }
                              </script>
                              <div class="hover">
                                  <a onclick="document.getElementById('<?php echo $i+1;?>').click();">
																	<button id="<?php echo $i+1;?>" onclick="product_page(this);" value="<?php echo $row['carRegNo'];?>" hidden></button>
                                  <span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
                                  </a>
                              </div>
                          </div>
                      </div>
						<?php
						$i=$i+1;
      				}
						}
						else {
      					echo "0 results";
      				}
      			?>
            </div>
        </div>
    </section>
    <section class="about-sec">
        <div class="about-img">
            <figure style="background:url(./images/about-img.jpg)no-repeat;"></figure>
        </div>
        <div class="about-content">
            <h2>About Car Rental System,</h2>
            <p>Our system is developed on cloud so that allour users get low latency. </p>


        </div>
    </section>
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
