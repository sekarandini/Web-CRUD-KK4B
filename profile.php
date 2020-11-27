<?php
	session_start();
	include 'db.php';
	if($_SESSION['status login'] != true){
		echo '<script>window.location="login.php"</script>';
	}

	$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['id']."' ");
	$d = mysqli_fetch_object($query)
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
			<h3>Profile</h3>
			<div class="box">
				<form action="" method="POST">
					<input type="text" name="nama" placeholder="Full Name" class="input-control" value="<?php echo $d->admin_name ?>" required>
					<input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $d->username ?>" required>
					<input type="text" name="hp" placeholder="Phone Number" class="input-control" value="<?php echo $d->admin_telp ?>" required>
					<input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $d->admin_email ?>" required>
					<input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo $d->admin_address ?>" required>
					<input type="submit" name="submit" value="Change Profile" class="btn">
				</form>
				<?php
					if (isset($_POST['submit'])) {
						
						$nama 	= ucwords($_POST['nama']);
						$user 	= $_POST['user'];
						$hp 	= $_POST['hp'];
						$email 	= $_POST['email'];
						$alamat = ucwords($_POST['alamat']);

						$update = mysqli_query($conn, "UPDATE tb_admin SET 
												admin_name = '".$nama."',
												username = '".$user."',
												admin_telp = '".$hp."',
												admin_email = '".$email."',
												admin_address = '".$alamat."'
												WHERE admin_id = '".$d->admin_id."' ");
						if ($update) {

							echo '<script>alert("Data Changed Succeded!")</script>';
							echo '<script>window.location="profile.php"</script>';
						}else {
							echo 'failed'.mysqli_error($conn);
						}

					}
				?>
			</div>

			<h3>Change Password</h3>
			<div class="box">
				<form action="" method="POST">
					<input type="password" name="pass1" placeholder="New Password" class="input-control" required>
					<input type="password" name="pass2" placeholder="Confirm New Password" class="input-control" required>
					<input type="submit" name="ubah_password" value="Change Password" class="btn">
				</form>
				<?php
					if (isset($_POST['ubah_password'])) {
						
						$pass1 	= $_POST['pass1'];
						$pass2 	= $_POST['pass2'];

						if ($pass2 != $pass1) {
							echo '<script>alert("Wrong New Password Confirm")</script>';
						}else{

							$u_pass = mysqli_query($conn, "UPDATE tb_admin SET
												password = '".MD5($pass1)."' 
												WHERE admin_id = '".$d->admin_id."' ");
							if ($u_pass) {
								echo '<script>alert("Change Password Succeeded!")</script>';
								echo '<script>window.location="profile.php"</script>';
							}else{
								echo 'failed'.mysqli_error($conn);
							}
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