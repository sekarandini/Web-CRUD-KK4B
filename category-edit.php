<?php
	session_start();
	include 'db.php';
	if($_SESSION['status login'] != true){
		echo '<script>window.location="login.php"</script>';
	}

	$kategori = mysqli_query($conn, "SELECT * FROM tb_category WHERE category_id = '".$_GET['id']."' ");
	if (mysqli_num_rows($kategori) == 0) {
		echo '<script>window.location="category-data.php"</script>';
	}
	$k = mysqli_fetch_object($kategori);


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
			<h3>Edit Category Data</h3>
			<div class="box">
				<form action="" method="POST">
					<input type="text" name="nama" placeholder="Category Name" class="input-control" value="<?php echo $k->category_name ?>" required>
					<input type="submit" name="submit" value="Submit" class="btn">
				</form>
				<?php 
					if(isset($_POST['submit'])){

						$nama = ucwords($_POST['nama']);

						$update = mysqli_query($conn, "UPDATE tb_category SET
											category_name = '".$nama."'
											WHERE category_id = '".$k->category_id."'");

						if ($update) {
							echo '<script>alert("Edit Data Succeded!")</script>';
							echo '<script>window.location="category-data.php"</script>';
						}else{
							echo 'Failed'.mysqli_error($conn);
						}
					}
				?>
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