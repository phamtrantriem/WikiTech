<?php include('./header.php')?>
<?php 
    if(isset($_GET['submit'])) {
        $fullname = $_GET['fullname'];
        $country = $_GET['country'];
        $province = $_GET['province'];
        $address = $_GET['address'];
        $email = $_GET['email'];
        $phone = $_GET['phone'];
        $username = $_SESSION['username'];
        $total = $_GET['total'];
        $sql_checkout = "insert into checkout (username, checkout_fullname, checkout_country, checkout_province, checkout_address, checkout_email, checkout_phone, checkout_total) value ('". $username ."','" .$fullname. "','". $country ."','". $province ."','".$address."','".$email."',".$phone.",".$total.")";
        $query_checkout = mysqli_query($conn, $sql_checkout);
        $sql_get_checkout_id = "SELECT MAX(checkout_id) AS checkout_id_this FROM checkout";
        $query_get_checkout_id = mysqli_query($conn, $sql_get_checkout_id);
        while($row_get_checkout_id = mysqli_fetch_assoc($query_get_checkout_id)) {
                $checkout_id =  $row_get_checkout_id['checkout_id_this'];
        }
        echo "<script>console.log('Debug Objects: " . $checkout_id . "' );</script>";
        if ($query_checkout) {
            echo ("<script LANGUAGE='JavaScript'>
                        window.alert('Check out successfully!!');
                        </script>");
            foreach($_SESSION['cart'] as $key=>$value) {
            $item[]=$key;
            echo 'key'.$key;
            }
            $str=implode(",",$item);
            $sql="SELECT * from product WHERE product_id in (".$str.")";
            $ketqua=mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($ketqua)) {
                $sql_order_item = "insert into order_item(checkout_id, product_name, quantity) value (". $checkout_id .",'". $row['product_name'] ."',". $_SESSION['cart'][$row['product_id']] .")";
                $query_order_item = mysqli_query($conn,$sql_order_item);
                
                
            }
            $_SESSION['cart'] = null;
        }
    }
?>
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="./index.php"><i class="fa fa-home"></i> Home</a>
                        <a href="./shop.php">Shop</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->
     <?php

    ?>
    <table class="table header-border table-hover verticle-middle" id="product_table">
        <thead>
            <tr>
                <th style="width: 10%" scope="col">#</th>
                <th style="width: 25%" scope="col">Infomation</th>
                <th style="width: 35%" scope="col-5">Product</th>
                <th style="width: 15%" scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $sql_bill = "Select * from checkout where username = ".$_SESSION['username'];
                $result_bill = mysqli_query($conn, $sql_bill);
                echo "</br>";
                if (mysqli_num_rows($result_bill) > 0) {
                    while($row_bill = mysqli_fetch_assoc($result_bill)) {
            ?>  
            <tr>
                <th><?php echo $row_bill['checkout_id']?></th>
                <td data-toggle="popover-hover" data-img="">
                    <p><?php echo $row_bill['checkout_fullname']?></p>
                    <p><?php echo $row_bill['checkout_phone']?></p>
                    <p><?php echo $row_bill['checkout_email']?></p>
                    <p><?php echo $row_bill['checkout_address']?></p>
                    <p><?php echo $row_bill['checkout_province']?></p>
                    <p><?php echo $row_bill['checkout_country']?></p>
                </td>
                <td>
                    <?php 
                        $sql_item = "select * from order_item where checkout_id = ". $row_bill['checkout_id'];
                        $result_item = mysqli_query($conn,$sql_item);
                        if (mysqli_num_rows($result_item) > 0) {
                            while($row_item = mysqli_fetch_assoc($result_item)) {
                    ?>
                    <p><?php echo $row_item['product_name'] ?> X <?php echo $row_item['quantity'] ?></p>
                    <?php 
                        }
                    }
                    ?>
                </td>
                <td>
                    <?php echo $row_bill['checkout_status'] ?>
                </td>
                
            </tr>
            <?php 
                    }
                }
             ?>
            
        </tbody>
    </table>
    <!-- Shopping Cart Section End -->
<?php include('./footer.php')?>