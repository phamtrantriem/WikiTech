<?php include('./header.php')?>
<?php 
    if(isset($_GET['key']) && $_GET['key']!= '') {
        echo '<script>console.log("'.$_GET['key'].'")</script>';
        $sql_search = "select * from product where product_name like '%".$_GET['key']."%'";
        $sql_s = "where product_name like '%".$_GET['key']."%'";
        $result = mysqli_query($conn, $sql_search);
    } else {
        $sql_s = '';
    }
?>

<?php
    $limit = 6;
    if(isset($_GET['paginate'])) {
        $_SESSION['paginate'] = (int)$_GET['paginate'];
        // header('Location: '.$_SERVER['REQUEST_URI']);
    }
    if(isset($_SESSION['paginate'])) {
        $limit = (int)$_SESSION['paginate'];
    }
    $sql_pagi = "select count(product_id) as total from product";
    $result = mysqli_query($conn,$sql_pagi);
    $row = mysqli_fetch_assoc($result);
    $total_records = $row['total'];
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    
    $total_page = ceil($total_records/$limit);
    if($current_page > $total_page) {
        $current_page = $total_page;
    }else if($current_page < 1) {
        $current_page = 1;
    }
    $start = ($current_page-1)*$limit;

    if(isset($_GET['min']) && $_GET['min']) {
        if($sql_s) {
            $sql_s.= ' and product_price > '.$_GET['min']; 
            //edit lai, to cha nho
        } else {
            $sql_s= 'where product_price > '.$_GET['min']; 
        }
    }
    if(isset($_GET['max']) && $_GET['max']) {
        if($sql_s) {
            $sql_s .= ' and product_price < '.$_GET['max'];
        } else {
            $sql_s= 'where product_price < '.$_GET['max']; 
        }
    }
    if(isset($_GET['category']) && $_GET['category']) 
    {
        if($sql_s) {
            $sql_s .= ' and category_id = '.$_GET['category'];
        } else {
            $sql_s= 'where category_id = '.$_GET['category']; 
        }
    }
    echo $sql_s;

    $sql_pagi = "select * from product ".$sql_s." limit ".$start.",".$limit;
     //echo '<script>console.log("'.$_SESSION['paginate'].'")</script>';
    $result = mysqli_query($conn, $sql_pagi);
?>


    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="index.php"><i class="fa fa-home"></i> Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
                    <div class="filter-widget">
                        <h4 class="fw-title">Categories</h4>
                        <ul class="filter-catagories">
                            <?php 
                                $sql_category = "select * from category";
                                $result_category = mysqli_query($conn,$sql_category);
                                if (mysqli_num_rows($result_category) > 0) {
                                    while($row_category = mysqli_fetch_assoc($result_category)) {
                                        echo '<li><a href="#" onclick="category_click('.$row_category['category_id'].')">'.$row_category['category_name'].'</a></li>';
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                    <div class="filter-widget">
                        <h4 class="fw-title">Brand</h4>
                        <div class="fw-brand-check">
                            <?php 
                                $sql_brand = "select * from brand";
                                $result_brand = mysqli_query($conn,$sql_brand);
                                if (mysqli_num_rows($result_brand) > 0) {
                                    while($row_brand = mysqli_fetch_assoc($result_brand)) {
                            ?>
                            <div class="bc-item">
                                <label for="bc-<?php echo $row_brand['brand_name']?>">
                                    <?php echo $row_brand['brand_name']?>
                                    <input type="checkbox" id="bc-<?php echo $row_brand['brand_name']?>">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <?php            
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <div class="filter-widget">
                        <h4 class="fw-title">Price</h4>
                        <div class="filter-range-wrap">
                            <div class="range-slider">
                                <div class="price-input">
                                    <input type="text" id="minamount" value="<?php if (isset($_GET['min'])){
                                        echo '$'.$_GET['min'];
                                    }?>">
                                    <input type="text" id="maxamount" value="<?php if (isset($_GET['min'])){
                                        echo '$'.$_GET['min'];
                                    }?>">
                                </div>
                            </div>
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                data-min="0" data-max="1000">
                                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                <span tabindex="0" style="" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                <span tabindex="0" style="" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            </div>
                        </div>
                        <button onclick="searchClick()" class="filter-btn">Filter</button>
                    </div>
                    <div class="filter-widget">
                        <h4 class="fw-title">Color</h4>
                        <div class="fw-color-choose">
                            <div class="cs-item">
                                <input type="radio" id="cs-black">
                                <label class="cs-black" for="cs-black">Black</label>
                            </div>
                            <div class="cs-item">
                                <input type="radio" id="cs-violet">
                                <label class="cs-violet" for="cs-violet">Violet</label>
                            </div>
                            <div class="cs-item">
                                <input type="radio" id="cs-blue">
                                <label class="cs-blue" for="cs-blue">Blue</label>
                            </div>
                            <div class="cs-item">
                                <input type="radio" id="cs-yellow">
                                <label class="cs-yellow" for="cs-yellow">Yellow</label>
                            </div>
                            <div class="cs-item">
                                <input type="radio" id="cs-red">
                                <label class="cs-red" for="cs-red">Red</label>
                            </div>
                            <div class="cs-item">
                                <input type="radio" id="cs-green">
                                <label class="cs-green" for="cs-green">Green</label>
                            </div>
                        </div>
                    </div>
                    <div class="filter-widget">
                        <h4 class="fw-title">Size</h4>
                        <div class="fw-size-choose">
                            <div class="sc-item">
                                <input type="radio" id="s-size">
                                <label for="s-size">s</label>
                            </div>
                            <div class="sc-item">
                                <input type="radio" id="m-size">
                                <label for="m-size">m</label>
                            </div>
                            <div class="sc-item">
                                <input type="radio" id="l-size">
                                <label for="l-size">l</label>
                            </div>
                            <div class="sc-item">
                                <input type="radio" id="xs-size">
                                <label for="xs-size">xs</label>
                            </div>
                        </div>
                    </div>
                    <div class="filter-widget">
                        <h4 class="fw-title">Tags</h4>
                        <div class="fw-tags">
                            <a href="#">Towel</a>
                            <a href="#">Shoes</a>
                            <a href="#">Coat</a>
                            <a href="#">Dresses</a>
                            <a href="#">Trousers</a>
                            <a href="#">Men's hats</a>
                            <a href="#">Backpack</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="product-show-option">
                        <div class="row">
                            <div class="col-lg-7 col-md-7">
                                <div class="select-option">
                                    <select class="sorting">
                                        <option value="">Default Sorting</option>
                                    </select>
                                    <select class="sorting" name="paginate" id="paginate" onchange="item_per_pageClick(this.value);">
                                        <?php
                                            for ($i=3; $i < 15; $i+=3) { 
                                                if (isset($_SESSION['paginate'])) {
                                                    if($_SESSION['paginate'] == $i) {
                                                        echo '<option value="'.$i.'" selected >'.$i.'</option>';
                                                    } else {
                                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                                    }
                                                } else {
                                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                                }
                                                
                                            }
                                        ?>
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 text-right">
                                <!-- <p>Show 01- 09 Of 36 Product</p> -->
                            </div>
                        </div>
                    </div>
                    <div class="product-list">
                        <div class="row ">
                            <?php 
                                echo '<script>console.log("'.$sql_pagi.'")</script>'; 
                                $num_row = mysqli_num_rows($result);
                                if($num_row > 0)
                                                          
                                    while($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="col-lg-4 col-sm-6">
                                <div class="product-item">
                                    <div class="pi-pic" style="width: 250px; height: 250px; ">
                                        <img src="<?php echo substr($row['product_image'],3) ?>" alt="">
                                        <div class="sale pp-sale">Sale</div>
                                        <div class="icon">
                                            <i class="icon_heart_alt"></i>
                                        </div>
                                        <ul>
                                            <li class="w-icon active">
                                                <a href="#"
                                                <?php 
                                                    if(isset(($_SESSION['username']))) {
                                                        if(($_SESSION['username'])!= ''){
                                                            echo ' onclick="addToCart('.$row["product_id"].')" ';
                                                        } else {
                                                            echo ' onclick="login()"';
                                                        }
                                                    }
                                                ?>
                                                >
                                                <i class="icon_bag_alt"></i></a></li>
                                            <li class="quick-view"><a href="product-detail.php?product-id=<?php echo $row['product_id']?>">+ View</a></li>
                                            <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="pi-text">
                                        <div class="catagory-name">
                                            <?php 
                                                $sql_category_product = "select category_name from category where category_id = ".$row['category_id'];
                                                $result_category_product = mysqli_query($conn, $sql_category_product);
                                                echo mysqli_fetch_assoc($result_category_product)['category_name'];
                                            ?>
                                        </div>
                                        <a href="#">
                                            <h5><?php echo $row['product_name']?></h5>
                                        </a>
                                        <div class="product-price">
                                            <?php echo '$'.$row['product_price']?>
                                            <!-- <span>$35.00</span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                    }
                            ?>
                        </div>
                    </div>
                    <!-- panigation -->
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <?php
                                if ($current_page > 1 && $total_page > 1) {
                                    echo '<li class="page-item">
                                    <button class="page-link" style="color:#000" onclick="paginationClick('.($current_page-1).')"><i class="fa fa-long-arrow-left"></i></button>
                                    </li>';
                                }
                                for ($i = 1; $i <= $total_page; $i++){
                                    if ($i == $current_page){
                                        echo '<li class="page-item">
                                        <button class="page-link" style="color: white; background: #6f6f6f" onclick="return false" href="#">'.$i.'</button> 
                                        </li> ';
                                    }
                                    else{
                                        echo '<li class="page-item">
                                        <button class="page-link" style="color:#000" onclick="paginationClick('.($i).')">'.$i.'</button>
                                        </li>';
                                    }
                                }
                                if ($current_page < $total_page && $total_page > 1) {
                                    echo '<li class="page-item">
                                    <button class="page-link" style="color:#000" onclick="paginationClick('.($current_page+1).')"><i class="fa fa-long-arrow-right"></i></button>
                                    </li>';
                                }
                            ?>
                        </ul>
                    </nav>
                    
                    <!-- <div class="loading-more">
                        <i class="icon_loading"></i>
                        <a href="#">
                            Loading More
                        </a>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->

<script>
    
    function searchClick() {
        var min_value = $('#minamount').val().substr(1);
        var max_value = $('#maxamount').val().substr(1);
        console.log(min_value);
        window.location.search = insertDoubleParam('min', min_value, 'max', max_value);
    }
    function paginationClick(number) {
        window.location.search = insertParam('page', number);
    }
    function item_per_pageClick(number) {

        window.location.search = insertParam('paginate', number);
    }
    function category_click(category) {

        window.location.search = insertParam('category', category);
    }
    //cậu thử tạo btn gọi searchClick() với 2 input 1 cái id là min-value 1 cái là max-value thử
</script>
<?php include('./footer.php')?>