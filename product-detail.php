<?php
error_reporting(0);
	include 'db.php';

	$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
	$p = mysqli_fetch_object($produk);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewprot" content="width=device-width, initial-scale=1">
	<title>Chocochu Bakery</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<!-- header -->
	<header>
		<div class="container">
			<h1><a href="index.php">Chocochu Bakery</a></h1>
			<ul>
				<li><a href="product.php">Product</a></li>

			</ul>
		</div>
	</header>

	<!-- search -->
	<div class="search">
		<div class="container">
			<form action="product.php">
				<input type="text" name="search" placeholder="Search Product" value="<?php echo $_GET['search'] ?>">
				<input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
				<input type="submit" name="cari" value="Search Product">
			</form>
		</div>
	</div>

	<!-- product detail -->
	<div class="section">
		<div class="container">
			<h3>Product Detail</h3>
			<div class="box">
				<div class="col-2">
					<img src="product/<?php echo $p->product_image ?>" width="100%">
				</div>
				<div class="col-2">
					<h3><?php echo $p->product_name ?></h3>
					<h4>IDR <?php echo $p->product_price ?></h4>
					<p>Desc : <br>
						<?php echo $p->product_description ?>
					</p>
					<p><a href="https://www.instagram.com/sse.karr/" target="_blank">Contact Admin Via Instagram</a></p>
				</div>
			</div>
		</div>
	</div>

	<!-- footer -->
	<div class="footer">
		<div class="container">
			<small>Copyright &copy; 2020 - Chocochu Bakery. || Contact Us : sekarputri.andini29@gmail.com</small>
		</div>
	</div>

</body>
</html>