<?php include('./header.php')?>
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

    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad">
        <div class="container">
            <form action="your-bill.php" class="checkout-form">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="checkout-content">
                            <a href="#" class="content-btn">Click Here To Login</a>
                        </div>
                        <h4>Biiling Details</h4>
                        <form action="your-bill.php" method="get">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="fir">Full Name<span>*</span></label>
                                    <input type="text" name="fullname" id="fullname" required>
                                </div>
                                <div class="col-lg-12">
                                    <label for="cun">Country<span>*</span></label>
                                    <input type="text" name="country" id="cun" required>
                                </div>
                                <div class="col-lg-12">
                                    <label for="town">Town / City<span>*</span></label>
                                    <input type="text" name="province" id="town" required>
                                </div>
                                <div class="col-lg-12">
                                    <label for="street">Street Address<span>*</span></label>
                                    <input type="text" name="address" id="street" class="street-first" required>
                                </div>
                                <div class="col-lg-6">
                                    <label for="email">Email Address<span>*</span></label>
                                    <input type="text" name="email" id="email" required>
                                </div>
                                <div class="col-lg-6">
                                    <label for="phone">Phone<span>*</span></label>
                                    <input type="text" name="phone" id="phone" required>
                                </div>
                            </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="checkout-content">
                            <input type="text" placeholder="Enter Your Coupon Code">
                        </div>
                        <div class="place-order">
                            <h4>Your Order</h4>
                            <div class="order-total">
                                <ul class="order-table">
                                    <li>Product <span>Total</span></li>
                                    <?php
                                        foreach($_SESSION['cart'] as $key=>$value) {
                                            $item[]=$key;
                                        }
                                        $str=implode(",",$item);
                                        $sql="SELECT * from product WHERE product_id in (".$str.")";
                                        $ketqua=mysqli_query($conn, $sql);
                                        while($row = mysqli_fetch_assoc($ketqua)) {
                                    ?>
                                    <li class="fw-normal"><?php echo $row['product_name']?>&ensp;<i class="fa fa-times"></i>&ensp;<?php echo $_SESSION['cart'][$row['product_id']]?> 
                                        <span>$<?php echo $_SESSION['cart'][$row['product_id']]*$row['product_price'];?></span>
                                    </li>
                                    <?php
                                        }
                                    ?>
                                    <li class="fw-normal">Subtotal <span>$<?php echo $_GET['total']?></span></li>
                                    <input type="hidden" name="total" value="<?php echo $_GET['total']?>">
                                    <li class="total-price">Total <span>$<?php echo $_GET['total']?></span></li>
                                </ul>
                                <div class="payment-check">
                                    <div class="pc-item">
                                        <label for="pc-check">
                                            Cheque Payment
                                            <input type="checkbox" id="pc-check">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="pc-item">
                                        <label for="pc-paypal">
                                            Paypal
                                            <input type="checkbox" id="pc-paypal">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="order-btn">
                                    <button type="submit" name="submit" class="site-btn place-btn">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
<?php include('./footer.php')?>