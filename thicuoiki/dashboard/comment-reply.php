<?php include('./connect.php')?>
<?php
	if(isset($_GET['comment_id'])) {
		$comment_id = $_GET['comment_id'];
		$product_id = $_GET['product_id'];
		$username = "admin";
		$text = $_GET['text'];
		$sql_cmt = "insert into comment(target_id, product_id, username, content) value (".$comment_id.",".$product_id.",'".$username."','".$text."')";
		$resul_cmt = mysqli_query($conn,$sql_cmt);
		 $data = $sql_cmt;
		 echo $data;
	}
?>