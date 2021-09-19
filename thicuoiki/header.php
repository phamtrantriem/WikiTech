<?php include('./connect.php')?>
<?php
    session_start();
?>
<?php
    $total =0;
    if(isset($_SESSION['cart'])){
        if (1) {
            foreach($_SESSION['cart'] as $key=>$value) {
                $item[]=$key;
                // echo 'key'.$key;
            }
            $str=implode(",",$item);
            $sql="SELECT * from product WHERE product_id in (".$str.")";
            $ketqua=mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($ketqua)) {
                $total+=$_SESSION['cart'][$row['product_id']]*$row['product_price'];
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>dlwlrma</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="sweetalert2/dist/sweetalert2.min.css">

</head>
    <style>
        a:hover {
            color: #a6a6a6;
        }
    </style>
<body>
    <!-- Page Preloder -->
<!--     <div id="preloder">
        <div class="loader"></div>
    </div> -->

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="ht-left">
                    <div class="mail-service">
                        <i class=" fa fa-envelope"></i>
                        dlwlrma@email.com
                    </div>
                    <div class="phone-service">
                        <i class=" fa fa-phone"></i>
                        <a style="color: #000" href="tel:0915058058"><span>0915058058</span></a>
                    </div>
                </div>
                <div class="ht-right">
                    <div class="login-panel">
                        <?php
                            if(isset(($_SESSION['username']))) {
                                if(($_SESSION['username'])!= '') {
                                    echo ' <span href="#"><i class="fa fa-user"></i>'.$_SESSION['username'].'</span>';
                                    if(isset(($_SESSION['username']))) {
                                        if(($_SESSION['username'])!= '') {
                                            $sql_role = "Select role from account where username = '".$_SESSION['username']."'";
                                            $ketqua = mysqli_query($conn, $sql_role);
                                            if (mysqli_num_rows($ketqua) > 0) {
                                                while($row1 = mysqli_fetch_assoc($ketqua)) {
                                                    $role = 'ADMIN';
                                                    if(strcmp($row1['role'], $role) == 0  ) {
                                                        echo '  <a class="font-weight-bold" style="color:#595959; margin-left: 5px;" href="./dashboard/index.php">Manage</a>';
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    echo ' <a class="font-weight-bold" style="color:#595959; margin-left: 5px;" href="./logout.php">Logout</a>';
                                } else {
                                    echo '<a href="./login.php" style="color:#595959" class=""><i class="fa fa-user"></i>Login</a>';
                                }
                            }else {
                                echo '<a href="./login.php" style="color:#595959" class=""><i class="fa fa-user"></i>Login</a>';
                            }
                        ?>   
                    </div>
                    
                    
                    <div class="lan-selector">
                        <select class="language_drop" name="countries" id="countries" style="width:300px;">
                            <option value='yt' data-image="img/flag-1.jpg" data-imagecss="flag yt"
                                data-title="English">English</option>
                            <option value='yu' data-image="img/flag-2.jpg" data-imagecss="flag yu"
                                data-title="Bangladesh">German </option>
                        </select>
                    </div>
                    <div class="top-social">
                        <a href="#"><i class="ti-facebook"></i></a>
                        <a href="#"><i class="ti-twitter-alt"></i></a>
                        <a href="#"><i class="ti-linkedin"></i></a>
                        <a href="#"><i class="ti-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="logo">
                            <a href="./index.php">
                                <img src="img/logo1.jpg" style="width: 100%;" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7" style="padding-top: 22px">
                        <div class="advanced-search">
                            <button type="button" class="category-btn">All Categories</button>
                            <div class="input-group">
                                <input type="text" name="key" id="search_text" placeholder="What do you need?">
                                <button onclick="window.location.search = insertParam('key', $('#search_text').val())" type="submit"><i class="ti-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <?php 
                        if(isset($_SESSION['username'])) {
                            if(($_SESSION['username'])!= '') {
                                $role_user = '';
                                $sql_role = "Select role from account where username = '".$_SESSION['username']."'";
                                $ketqua = mysqli_query($conn, $sql_role);
                                if (mysqli_num_rows($ketqua) > 0) {
                                    while($row1 = mysqli_fetch_assoc($ketqua)) {
                                        $role = 'ADMIN';
                                        $countgh = '0';
                                        if(isset($_SESSION['cart'])) {
                                            $countgh = count($_SESSION['cart']);
                                        }
                                        if(strcmp($row1['role'], $role) == 1  ) {
                                        
                    ?>
                    <div class="col-lg-3 text-right col-md-3" style="padding-top: 22px">
                        <ul class="nav-right">
                            <!-- <li class="heart-icon">
                                <a href="#">
                                    <i class="icon_heart_alt"></i>
                                    <span>1</span>
                                </a>
                            </li> -->
                            <li class="cart-icon">
                                <a href="#">
                                    <i class="icon_bag_alt"></i>
                                    <span class="count-cart"><?php echo $countgh?></span>
                                </a>
                                <div class="cart-hover">
                                    <div class="select-items">
                                        <table>
                                            <tbody>
                                                <?php
                                                if(!isset($_SESSION['cart']) or count($_SESSION['cart'])==0) {
                                                } else {
                                                    foreach($_SESSION['cart'] as $key=>$value) {
                                                        $item[]=$key;
                                                    }
                                                    $str=implode(",",$item);
                                                    $sql="SELECT * from product WHERE product_id in (".$str.")";
                                                    $ketqua=mysqli_query($conn, $sql);
                                                    while($row = mysqli_fetch_assoc($ketqua)) {
                                                ?>
                                                <tr>
                                                    <td class="si-pic"><img style="width: 50px" src="<?php echo substr($row['product_image'],3)?>" alt=""></td>
                                                    <td class="si-text">
                                                        <div class="product-selected">
                                                            <p>$<?php echo $row['product_price']?> &ensp;<i class="fa fa-times"></i>&ensp;<?php echo $_SESSION['cart'][$row['product_id']]?></p>
                                                            <h6><?php echo $row['product_name'] ?></h6>
                                                        </div>
                                                    </td>
                                                    <td class="si-close">
                                                        <i class="ti-close"></i>
                                                    </td>
                                                </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="select-total">
                                        <!-- <span>total:</span>
                                        <h5>$<?php echo $total?></h5> -->
                                    </div>
                                    <div class="select-button">
                                        <a href="shopping-cart.php" class="primary-btn view-card">VIEW CART</a>
                                        <a href="check-out.php?total=<?php echo $total?>" class="primary-btn checkout-btn">CHECK OUT</a>
                                    </div>
                                </div>
                            </li>
                            <?php
                                
                            ?>
                            <li class="cart-price subtotal-ajax">$<?php echo $total?></li>
                        </ul>
                    </div>
                    <?php
                                        }
                                    }
                                }
                            } 
                        } 
                    ?>
                    
                </div>
            </div>
        </div>
        <div class="nav-item">
            <div class="container">
                <div class="nav-depart">
                    <div class="depart-btn">
                        <i class="ti-menu"></i>
                        <span>All departments</span>
                        <ul class="depart-hover">
                            <li class="active"><a href="#">Women’s Clothing</a></li>
                            <li><a href="#">Men’s Clothing</a></li>
                            <li><a href="#">Underwear</a></li>
                            <li><a href="#">Kid's Clothing</a></li>
                            <li><a href="#">Brand Fashion</a></li>
                            <li><a href="#">Accessories/Shoes</a></li>
                            <li><a href="#">Luxury Brands</a></li>
                            <li><a href="#">Brand Outdoor Apparel</a></li>
                        </ul>
                    </div>
                </div>
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li onclick="getname(this)" name="home" id="nav-home" ><a href="./index.php">Home</a></li>
                        <li onclick="getname(this)" name="shop" id="nav-shop"><a href="./shop.php">Shop</a></li>
                        <li onclick="getname(this)" name="collection" id="nav-colec"><a href="#">Collection</a>
                            <ul class="dropdown">
                                <li><a href="#">Men's</a></li>
                                <li><a href="#">Women's</a></li>
                                <li><a href="#">Kid's</a></li>
                            </ul>
                        </li>
                        <li onclick="getname(this)"><a href="./blog.html">Blog</a></li>
                        <li onclick="getname(this)"><a href="./contact.html">Contact</a></li>
                        <li onclick="getname(this)"><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="./blog-details.html">Blog Details</a></li>
                                <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                                <li><a href="./check-out.html">Checkout</a></li>
                                <li><a href="./faq.html">Faq</a></li>
                                <li><a href="./register.html">Register</a></li>
                                <li><a href="./login.html">Login</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header>
    <!-- Header End -->
