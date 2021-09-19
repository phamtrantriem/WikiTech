<?php include('./connect.php')?>
<?php
	if(isset($_GET['product_id'])){
		$product_id = $_GET['product_id'];
		$sql_pr = 'delete from product where product_id = '.$product_id;
		$result_pr = mysqli_query($conn, $sql_pr);
	}
	if(isset($_GET['category_id'])) {
		$category_id = $_GET['category_id'];
		$sql_cate = 'delete from category where category_id = '.$category_id;
		$result_cate = mysqli_query($conn, $sql_cate);
	}
	if(isset($_GET['account_id'])) {
		$id = $_GET['account_id'];
		$sql_ac = "delete from account where id = '".$id."'";
		$result_ac = mysqli_query($conn, $sql_ac);
	}
	if(isset($_GET['comment_id'])) {
		$comment_id = $_GET['comment_id'];
		$sql_cmt = "delete from comment where comment_id = ".$comment_id;
		$resul_cmt = mysqli_query($conn,$sql_cmt);
	}
?>