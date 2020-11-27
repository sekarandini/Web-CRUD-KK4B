
<?php
	include 'db.php';
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
				<input type="text" name="search" placeholder="Search Product">
				<input type="submit" name="cari" value="Search Product">
			</form>
		</div>
	</div>

	<!--category -->
	<div class="section">
		<div class="container">
			<h3>Category</h3>
			<div class="box">
				<?php
					$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC") ;
					if (mysqli_num_rows($kategori) > 0) {
						while ($k = mysqli_fetch_array($kategori)) {
	
				 ?>
				 <a href="product.php?kat=<?php echo $k['category_id'] ?>">
				<div class="col-5">
					<img src="img/icon-category.png" width="50px" style="margin-bottom: 5px;">
					<p><?php echo $k['category_name'] ?></p>
				</div>
				</a>
			<?php }}else{ ?>
				<p>Category Not Found</p>
			<?php } ?>
			</div>
		</div>
	</div>

	<div class="section">
		<div class="container">
			<h3>Our Products!</h3>
			<div class="box">
				<?php 
					$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status =1 ORDER BY product_id DESC LIMIT 4");
					if (mysqli_num_rows($produk) > 0) {
						while ($p = mysqli_fetch_array($produk)){
				?>
				<a href="product-detail.php?id=<?php echo $p['product_id'] ?>">
				<div class="col-4">
					<img src="product/<?php echo $p['product_image'] ?>">
					<p class="nama"><?php echo $p['product_name'] ?></p>
					<p class="harga">IDR <?php echo $p['product_price'] ?></p>
				</div>
				</a>
			<?php }}else{ ?>
				<p>Product Not Found</p>
			<?php } ?>
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