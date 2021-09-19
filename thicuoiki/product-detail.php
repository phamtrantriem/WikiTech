<?php include('./header.php')?>
<?php 
    if(isset($_GET['product-id'])){
        $sql = "select * from product where product_id = '".$_GET['product-id']."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) 
            $row = mysqli_fetch_assoc($result);

?>
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="./index.php"><i class="fa fa-home"></i> Home</a>
                        <a href="./shop.php">Shop</a>
                        <span>Detail</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad page-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-pic-zoom">
                                <img class="product-big-img" src="<?php echo substr($row['product_image'],3)?>" alt="">
                                <div class="zoom-icon">
                                    <i class="fa fa-search-plus"></i>
                                </div>
                            </div>
                            <div class="product-thumbs">
                                <div class="product-thumbs-track ps-slider owl-carousel">
                                    <div class="pt active" data-imgbigurl="img/products/air-jordan-1-dior.jpg"><img
                                            src="img/products/air-jordan-1-dior.jpg" alt=""></div>
                                    <div class="pt" data-imgbigurl="img/products/air-jordan-1-dior.jpg"><img
                                            src="img/products/air-jordan-1-dior.jpg" alt=""></div>
                                    <div class="pt" data-imgbigurl="img/products/air-jordan-1-dior.jpg"><img
                                            src="img/products/air-jordan-1-dior.jpg" alt=""></div>
                                    <div class="pt" data-imgbigurl="img/products/air-jordan-1-dior.jpg"><img
                                            src="img/products/air-jordan-1-dior.jpg" alt=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-details">
                                <div class="pd-title">
                                    <span></span>
                                    <h3><?php echo $row['product_name']?></h3>
                                    <a href="#" class="heart-icon"><i class="icon_heart_alt"></i></a>
                                </div>
                                <div class="pd-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <span>(5)</span>
                                </div>
                                <div class="pd-desc">
                                    <h5>Instock: <?php echo $row['amount']?></h5>
                                    <h4>$<?php echo $row['product_price']?><span></span></h4>
                                </div>
                                <!-- <div class="pd-color">
                                    <h6>Color</h6>
                                    <div class="pd-color-choose">
                                        <div class="cc-item">
                                            <input type="radio" id="cc-white">
                                            <label for="cc-black"></label>
                                        </div>
                                        <div class="cc-item">
                                            <input type="radio" id="cc-yellow">
                                            <label for="cc-yellow" class="cc-yellow"></label>
                                        </div>
                                        <div class="cc-item">
                                            <input type="radio" id="cc-violet">
                                            <label for="cc-violet" class="cc-violet"></label>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="pd-size-choose">
                                    <div class="sc-item">
                                        <input type="radio" id="sm-size">
                                        <label for="sm-size">s</label>
                                    </div>
                                    <div class="sc-item">
                                        <input type="radio" id="md-size">
                                        <label for="md-size">m</label>
                                    </div>
                                    <div class="sc-item">
                                        <input type="radio" id="lg-size">
                                        <label for="lg-size">l</label>
                                    </div>
                                    <div class="sc-item">
                                        <input type="radio" id="xl-size">
                                        <label for="xl-size">xs</label>
                                    </div>
                                </div>
                                <div class="quantity">
                                    <div class="">
                                        <input style="width: 50px; height: 50px; text-align: center" type="number" value="1">
                                    </div>
                                    <a 
                                    <?php 
                                        if(isset(($_SESSION['username']))) {
                                            if(($_SESSION['username'])!= ''){
                                                echo ' onclick="addToCart('.$_GET["product-id"].')" ';
                                            } else {
                                                echo ' onclick="login()"';
                                            }
                                        }
                                    ?>
                                    href="#" class="primary-btn pd-cart">Add To Cart</a>
                                </div>
                                <ul class="pd-tags">
                                    <li><span>CATEGORIES</span>: </li>
                                    <!-- <li><span>TAGS</span>: Clothing, T-shirt, Woman</li> -->
                                </ul>
                                <div class="pd-share">
                                    <div class="p-code">Sku : 00012</div>
                                    <div class="pd-social">
                                        <a href="#"><i class="ti-facebook"></i></a>
                                        <a href="#"><i class="ti-twitter-alt"></i></a>
                                        <a href="#"><i class="ti-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-tab">
                        <div class="tab-item">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="active" data-toggle="tab" href="#tab-1" role="tab">DESCRIPTION</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-2" role="tab">SPECIFICATIONS</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-3" role="tab">Customer Reviews</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-item-content">
                            <div class="tab-content">
                                <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                                    <div class="product-content">
                                        <div class="row">
                                            <div class="col-lg-7">
                                                <h5>Introduction</h5>
                                                <p><?php echo $row['product_desc']?></p>
                                            </div>
                                            <div class="col-lg-5">
                                                <img src="img/product-single/tab-desc.jpg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-2" role="tabpanel">
                                    <div class="specification-table">
                                        <table>
                                            <tr>
                                                <td class="p-catagory">Customer Rating</td>
                                                <td>
                                                    <div class="pd-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <span>(5)</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Price</td>
                                                <td>
                                                    <div class="p-price">$<?php echo $row['product_price']?></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Availability</td>
                                                <td>
                                                    <div class="p-stock"><?php echo $row['amount']?> in stock</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Weight</td>
                                                <td>
                                                    <div class="p-weight">0,3kg</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-3" role="tabpanel">
                                    <div class="customer-review-option">
                                            <?php 
                                                $sql_cmt = 'select * from comment where product_id = '.$_GET['product-id'];
                                                $result_cmt = mysqli_query($conn, $sql_cmt);
                                                
                                            ?>
                                        <h4>
                                        <?php 
                                            $cmt_count = mysqli_num_rows($result_cmt);
                                            if (!$cmt_count) {
                                                echo '0 Comment';
                                            } else if ($cmt_count>2){
                                                echo $cmt_count.' Comments';
                                            }else {
                                                echo $cmt_count.' Comment';
                                            }
                                        ?></h4>
                                        <div class="comment-option ">
                                        <?php while ($row_cmt = mysqli_fetch_assoc($result_cmt)) {?>
                                            <div class="co-item">
                                                <div class="avatar-pic">
                                                    <img src="img/product-single/avatar-2.png" alt="">
                                                </div>
                                                <div class="avatar-text">
                                                    <div class="at-rating">
                                                    </div>
                                                    <h5><?php echo $row_cmt['username']?> <span><?php echo $row_cmt['timestamp']?></span></h5>
                                                    <div class="at-reply"><?php echo $row_cmt['content']?></div>
                                                </div>
                                            </div>
                                            <?php 
                                                $sql_recmt = 'select * from comment where product_id = '.$_GET['product-id'].' and target_id = ' .$row_cmt['comment_id'];
                                                echo "<script>console.log('Debug Objects: " . $sql_recmt . "' );</script>";
                                                $result_recmt = mysqli_query($conn, $sql_recmt);
                                                if(mysqli_num_rows($result_recmt)>0) {
                                                    while ($row_recmt = mysqli_fetch_assoc($result_recmt)) {
                                            ?>
                                            <div class="row">
                                                <div class="col-lg-1"></div>
                                                <div class="col-lg-11 co-item">
                                                    <div class="avatar-pic">
                                                        <img src="img/product-single/avatar-3.png" alt="">
                                                    </div>
                                                    <div class="avatar-text">
                                                        <div class="at-rating">
                                                        </div>
                                                        <h5><?php echo $row_recmt['username']?> <span><?php echo $row_recmt['timestamp']?></span></h5>
                                                        <div class="at-reply"><?php echo $row_recmt['content']?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <?php 
                                                    }
                                                }
                                            ?>
                                            <?php
                                        }
                                        ?>
                                        </div>
                                        <!-- <div class="personal-rating">
                                            <h6>Your Ratind</h6>
                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div> -->

                                        <div class="leave-comment">
                                            <h4>Leave A Comment</h4>
                                            <?php
                                                if(isset($_SESSION['username'])&&($_SESSION['username']!='')) {
                                                    echo ('
                                                        <form action="" method="post" class="comment-form">
                                                            <input type="hidden" name="product_id" id="product_id" value="'.$_GET["product-id"].'">
                                                            <input type="hidden" name="username" id="username" value="'.$_SESSION["username"].'">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <textarea placeholder="Messages" id="content" name="content"></textarea>
                                                                    <button type="submit" id="sendcmt" class="site-btn">Send message</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    ');
                                                } else {
                                                    echo ('<a href="login.php">Login to comment!</a>');
                                                }    
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->

<?php }?>
<script>
    
</script>
<?php include('./footer.php')?>