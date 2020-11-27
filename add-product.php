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
	<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
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
			<h3>Add Product Data</h3>
			<div class="box">
				<form action="" method="POST" enctype="multipart/form-data">
					<select class="input-control" name="kategori" required>
						<option value="">--Choose--</option>
						<?php
							$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
							while ($r = mysqli_fetch_array($kategori)) {
					
						?>
						<option value="<?php echo $r['category_id'] ?>"><?php echo $r['category_name'] ?></option>

					<?php } ?>
					</select>

					<input type="text" name="nama" class="input-control" placeholder="Product Name" required>
					<input type="text" name="harga" class="input-control" placeholder="Product Price" required>
					<input type="file" name="gambar" class="input-control" required>
					<textarea class="input-control" name="deskripsi" placeholder="Product Description"></textarea>
					<select class="input-control" name="status">
						<option value="">--Choose--</option>
						<option value="1">Active</option>
						<option value="0">Not Active</option>
					</select>
					<input type="submit" name="submit" value="Submit" class="btn">
				</form>
				<?php 
					if(isset($_POST['submit'])){

						// print_r($_FILES['gambar']);
						// MENAMPUNG INPUTAN DARI FORM
						$kategori 	= $_POST['kategori'];
						$nama 		= $_POST['nama'];
						$harga 		= $_POST['harga'];
						$deskripsi 	= $_POST['deskripsi'];
						$status 	= $_POST['status'];

						// MENAMPUNG DATA FILE YANG DI UPLOAD
						$filename = $_FILES['gambar']['name'];
						$tmp_name = $_FILES['gambar']['tmp_name'];

						$type1 = explode('.', $filename);
						$type2 = $type1[1];

						$newname = 'pastry'.time().'.'.$type2;

						// MENAMPUNG DATA FORMAT FILE YANG DIIZINKAN
						$tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif' );
						// MEMBUAT VALIDASI FORMAT FILE
						if (!in_array($type2, $tipe_diizinkan)) {
							echo '<script>alert("File Format is not Allowed")</script>';
						}else{
							move_uploaded_file($tmp_name, './product/'.$newname);

							$insert = mysqli_query($conn, "INSERT INTO tb_product VALUES (
										null,
										'".$kategori."',
										'".$nama."',
										'".$harga."',
										'".$deskripsi."',
										'".$newname."',
										'".$status."',
										null ) ");

							if ($insert) {
								echo '<script>alert("Save Data Succeeded!")</script>';
								echo '<script>window.location="product-data.php"</script>';
							}else{
								echo 'Failed Save Data'.mysqli_error($conn);
							}
						}
						//PROSES UPLOAD FILE + INSERT KE DATABASE
						
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
	<script>
        CKEDITOR.replace( 'deskripsi' );
    </script>
</body>
</html>