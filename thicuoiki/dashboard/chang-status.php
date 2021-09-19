<?php include('connect.php') ?>
<?php 
	if(isset($_GET['id'])) {
		$sql = "update checkout set checkout_status = ".$_GET['value']." where checkout_id = ".$_GET['id'];
		echo("<script>console.log(".$sql.")</script>");
		$query = mysqli_query($conn, $sql);
	}
 ?>