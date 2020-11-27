<?php
	session_start();
	include 'db.php';
	if($_SESSION['status login'] != true){
		echo '<script>window.location="login.php"</script>';
	}
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
			<h1><a href="dashboard.php">Chocochu Bakery</a></h1>
			<ul>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li><a href="profile.php">Profile</a></li>
				<li><a href="category-data.php">Category Data</a></li>
				<li><a href="product-data.php">Product Data</a></li>
				<li><a href="logout.php">Log Out</a></li>
			</ul>
		</div>
	</header>

	<!-- content -->
	<div class="section">
		<div class="container">
			<h3>Product Data</h3>
			<div class="box">
				<p><a href="add-product.php">Add Data</a></p>
				<table border="1" cellspacing="0" class="table">
					<thead>
						<tr>
							<th width="60px">No.</th>
							<th>Category</th>
							<th>Product Name</th>
							<th>Product Price</th>
							<th>Product Description</th>
							<th>Image</th>
							<th>Status</th>
							<th width="150px">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
							$produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id) ORDER BY product_id DESC");
							if (mysqli_num_rows($produk) > 0) {
							while($row = mysqli_fetch_array($produk)){
						?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $row['category_name'] ?></td>
							<td><?php echo $row['product_name'] ?></td>
							<td>IDR <?php echo number_format($row['product_price']) ?></td>
							<td><?php echo $row['product_description'] ?></td>
							<td><a href="product/<?php echo $row['product_image'] ?>" target="_blank"> <img src="product/<?php echo $row['product_image'] ?>" width="50px"></a></td>
							<td><?php echo ($row['product_status'] == 0)? 'Not Active':'Active'; ?></td>
							<td>
								<a href="product-edit.php?id=<?php echo $row['product_id'] ?>">Edit</a> || <a href="delete-process.php?idp=<?php echo $row['product_id'] ?>" onclick="return confirm('Are You Sure Want To Delete?')">Delete</a>
							</td>
						</tr>
					<?php }}else{ ?>
						<tr>
							<td colspan="8">No Data</td>
						</tr>

					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- footer -->
	<footer>
		<div class="container">
			<small>Copyright &copy; 2020 - Chocochu Bakery.</small>
		</div>
	</footer>
</body>
</html>