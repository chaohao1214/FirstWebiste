<!DOCTYPE html>

<html>

<head>
	<title>Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style_project2.css">
	<link rel="stylesheet" href="productpage.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<!-- <script src="searchbar.js" defer></script> -->
	<script src="js/listItems.js" defer></script>
</head>

<body>

	<!--Header of the landing page. Includes logo, search bar, sign in page link and cart page link -->
	<div class="header_homepage">
		<div class="logo">
			<h1><a href="home.html"><i class="fa fa-envira">EcoNow</i></a></h1>
		</div>


		<div class="search">
			<form name="searchBar">
				<input type="text" placeholder="Search..." name="container-searchbox">
				<button type="Submit" target="productpage.html"><i class="fa fa-search"></i></button>
			</form>
		</div>
		<div class="sign">
			<h3>Welcome, <a href="signin.html">Sign in </a>
				<h3>
		</div>

		<div class="cart">
			<a href="cart.html" class="cart_page"><i class="fa fa-shopping-cart fa-3x"></i></a>
		</div>
	</div>

	<!--Navigation panel of the landing page -->
	<div class="navigation">
		<a href="productpage.html">Products</a>
		<a href="reusable.html">Reusable Products</a>
		<a href="recyclable.html">Recyclable Products</a>
		<a href="organic.html">Organic Products</a>
	</div>

	<!-- Social media sticky bar -->
	<div class="social_media">
		<a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
		<a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
		<a href="#" class="google"><i class="fa fa-google"></i></a>
		<a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
		<a href="#" class="youtube"><i class="fa fa-youtube"></i></a>
	</div>

	<!-- Banner image with discount offer -->
	<div id="banner">
		<p style="font-size: 30px;">FREE SHIPPING</p>
		<p style="font-size: 20px;">ON ALL ORDERS</p>
	</div>
	<div>
		<h2 class="product_list">Products</h2>
	</div>
	<div class="row" id="list-items">
	</div>

	<!--  Main body of the website having the products list
		     by using javascript to replace code here -->


	<!--Footer of the page -->
	<div class="footer">
		<div class="footer_links">
			<a href="#">Contact Us</a>
			<a href="#">About us</a>
			<a href="#">Customer Support</a>
			<a href="#">Join Our Team</a><br>
			<p>Copyright <a href="home.html">EcoNow</a></p>
		</div>
	</div>
</body>

</html>

<?php
function pdo_connect_mysql() {
    // Update the details below with your MySQL details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'eco_products';
	$con = new PDO("mysql:host=localhost;dbname=eco_products",'root','');
    try {
    	return $con;
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}
// $con = new PDO("mysql:host=localhost;dbname=allproduct",'root','');

if (isset($_POST["submit"])){
    $str = $_POST["container-searchbox"];
    $sth = $con->prepare("SELECT * FROM `products` WHERE name = '$str'");

    $sth->setFetchMode(PDO:: FETCH_OBJ);
    $sth -> execute();

    if($row = $sth->fetch()){
        ?>
        <br><br><br>
        <table>
             <tr>
                <th>Name</th>
                <th>Description</th>
            </tr>
            <tr>
                <td><?php echo $row->Name; ?></td>
                <td><?php echo $row->Description; ?></td>
            </tr>
        </table>
        <?php
    }
   
        else{
            echo "Name Does not exist";
        }
}

?>