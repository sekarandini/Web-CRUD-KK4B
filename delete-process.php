<?php
	
	include 'db.php';

	if (isset($_GET['idk'])) {
		$delete = mysqli_query($conn, "DELETE FROM tb_category WHERE category_id = '".$_GET['idk']."' ");
		echo '<script>window.location="category-data.php"</script>';
	}

	if (isset($_GET['idp'])) {
		$produk = mysqli_query($conn, "SELECT product_image FROM tb_product WHERE product_id = '".$_GET['idp']."' ");
		$p = mysqli_fetch_object($produk);

		unlink('./product/'.$p->product_image);

		$delete = mysqli_query($conn, "DELETE FROM tb_product WHERE product_id = '".$_GET['idp']."' ");
		echo '<script>window.location="product-data.php"</script>';
	}
?>