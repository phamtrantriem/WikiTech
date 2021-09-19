<?php include('./header.php')?>

<?php
    if(isset($_POST['submit'])){
        foreach($_POST['qty'] as $key=>$value) {
            $_SESSION['cart'][$key]=$value;
            echo "<script>console.log('Debug Objects: " . $value . "' );</script>";
        
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
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th class="p-name">Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th><i class="ti-close"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(!isset($_SESSION['cart']) or count($_SESSION['cart'])==0) {
                                        echo '<tr><td colspan="5" ></br><h3 class="text-center text-monospace text_uppercase">Your cart is cleared.</h3></td>';
                                    } else {
                                        echo "<form action='./shopping-cart.php' method='post'>";
                                        foreach($_SESSION['cart'] as $key=>$value) {
                                            $item[]=$key;
                                            echo 'key'.$key;
                                        }
                                        $str=implode(",",$item);
                                        $sql="SELECT * from product WHERE product_id in (".$str.")";
                                        $ketqua=mysqli_query($conn, $sql);
                                        while($row = mysqli_fetch_assoc($ketqua)) {
                                ?>
                                <tr id="product_<?php echo $row['product_id']?>">
                                    <td class="cart-pic first-row">
                                        <img style="width: 150px" src="<?php echo substr($row['product_image'],3)?>" alt="">
                                    </td>
                                    <td class="cart-title first-row">
                                        <h5><?php echo $row['product_name']?></h5>
                                    </td>
                                    <td class="p-price first-row">$<?php echo $row['product_price']?></td>
                                    <td class="qua-col first-row">
                                        <div class="quantity">
                                            <div class="">
                                                <!-- <input type="text" name="qty[<?php echo $row['product_id']?>]" value="<?php echo $_SESSION['cart'][$row['product_id']];?>"> -->
                                                <input type="number" style="width: 50px" class="onchangevalue" data-id="<?php echo $row['product_id']?>" name="qty" id="<?php echo $row['product_id']?>" value="<?php echo $_SESSION['cart'][$row['product_id']];?>">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="total-price responseData_<?php echo $row['product_id']?> first-row"> $ <?php echo $_SESSION['cart'][$row['product_id']]*$row['product_price'];?></td>
                                    <td class="close-td first-row">
                                        <a onclick="ConfirmDelete(<?php echo $row['product_id']?>)" href=""><i class="ti-close"></i></a>
                                    </td>
                                </tr>
                                <?php  
                                        }      
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="cart-buttons">
                                <a href="shop.php" class="primary-btn continue-shop">Continue shopping</a>
                                <button type="submit" name="submit" href="#" class="primary-btn up-cart">Update cart</button>
                            </div>
                            <div class="discount-coupon">
                                <h6>Discount Codes</h6>
                                <div action="#" class="coupon-form">
                                    <input type="text" placeholder="Enter your codes">
                                    <button type="submit" class="site-btn coupon-btn">Apply</button>
                               
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="subtotal">Subtotal <span class="subtotal-ajax">$<?php echo $total?></span></li>
                                    <li class="cart-total">Total <span class="subtotal-ajax">$<?php echo $total?></span></li>
                                </ul>
                                <a href="check-out.php?total=<?php echo $total?>" class="proceed-btn checkout-btn-ajax">PROCEED TO CHECK OUT</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
    <script type="text/javascript">
        function ConfirmDelete(id) {
            $.ajax({
                url:"shopping-cart-delete.php?id="+id,
                method:"GET",
                success:function(data){ 
                    Swal.fire({
                      icon: 'success',
                      title: data,
                      timer: 1500
                    })
                    $('#product_'+id).remove();
                },
                error: function (jqXHR, exception) {
                    if(jqXHR.status==401) {
                        Swal.fire({
                          icon: 'error',
                          title: jqXHR.status+": "+jqXHR.responseText,
                          timer: 1500
                        })
                    }
                }
            });  
        }
        
        
    </script>

<?php include('./footer.php')?>