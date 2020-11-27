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
			<h3>Category Data</h3>
			<div class="box">
				<p><a href="add-category.php">Add Category</a></p>
				<table border="1" cellspacing="0" class="table">
					<thead>
						<tr>
							<th width="60px">No.</th>
							<th>Category</th>
							<th width="150px">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
							$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
							if (mysqli_num_rows($kategori) > 0) {
								while($row = mysqli_fetch_array($kategori)){ 
						?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $row['category_name'] ?></td>
							<td>
								<a href="category-edit.php?id=<?php echo $row['category_id'] ?>">Edit</a> || <a href="delete-process.php?idk=<?php echo $row['category_id'] ?>" onclick="return confirm('Are You Sure Want To Delete?')">Delete</a>
							</td>
						</tr>
					<?php }}else{ ?>
						<tr>
							<td colspan="3">No Data</td>
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