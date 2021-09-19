
<?php 
include('connect.php');
session_start();
	if(isset($_POST['qty'])){
        $_SESSION['cart'][$_POST['product_id']] = $_POST['qty'];
        
        $sql_ajax="SELECT * from product WHERE product_id = ".$_POST['product_id'];
        $ketqua_ajax=mysqli_query($conn, $sql_ajax);
        while($row_ajax = mysqli_fetch_assoc($ketqua_ajax)) {
            $responseData = $_SESSION['cart'][$_POST['product_id']]*$row_ajax['product_price'];
            echo $responseData.'/';
            
        }
        
        foreach($_SESSION['cart'] as $key=>$value) {
            $item[]=$key;
        }
        $str=implode(",",$item);
        $sql="SELECT * from product WHERE product_id in (".$str.")";
        $ketqua=mysqli_query($conn, $sql);
        $total=0;
        while($row = mysqli_fetch_assoc($ketqua)) {
            $total+=$_SESSION['cart'][$row['product_id']]*$row['product_price'];
        }
        $SESSION['total'] = $total;
        echo $total;
    }
    exit();
 ?>