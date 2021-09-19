<?php
    include('connect.php');
    session_start();
    if (isset($_GET['id'])) {
        $id=$_GET['id'];
        if(isset($_SESSION['cart'][$id])) {
            $qty_shop = $_SESSION['cart'][$id] + 1;
        } else {
            $qty_shop=1;
            $result = '1';
            echo $result.'/';
        }
        $_SESSION['cart'][$id]=$qty_shop;
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
    exit();
?>