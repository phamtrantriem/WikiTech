<?php include('./connect.php'); ?>
<?php 
	$content = $_POST['content'];
	$product_id = $_POST['product_id'];
	$username = $_POST['username'];

	$sql = "INSERT INTO comment (product_id,content,username) VALUES ($product_id, '$content', '$username')";
	echo "<script>console.log('Debug Objects: " . $sql . "' );</script>";
	$result = mysqli_query($conn, $sql);
	exit();
?>