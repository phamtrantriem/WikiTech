
    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer-left">
                        <div class="footer-logo">
                            <a href="#"><img src="img/footer-logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: hello.colorlib@gmail.com</li>
                        </ul>
                        <div class="footer-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1">
                    <div class="footer-widget">
                        <h5>Information</h5>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Checkout</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Serivius</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-widget">
                        <h5>My Account</h5>
                        <ul>
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Shopping Cart</a></li>
                            <li><a href="#">Shop</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="newslatter-item">
                        <h5>Join Our Newsletter Now</h5>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#" class="subscribe-form">
                            <input type="text" placeholder="Enter Your Mail">
                            <button type="button">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-reserved">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-text">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </div>
                        <div class="payment-pic">
                            <img src="img/payment-method.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.zoom.min.js"></script>
    <script src="js/jquery.dd.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    <script src="sweetalert2/dist/sweetalert2.min.js"></script>
    <script type="text/javascript">
        function getname(ok) {
            var id = $(ok).attr('id');
            console.log('jquery '+id);
            if (id == 'nav-home') {
                $("#nav-shop").removeAttr('class');
                $("#nav-colec").removeAttr('class');
                $("#nav-home").attr('class','active');
            }
            if (id == 'nav-shop') {
                $("#nav-home").removeAttr('class');
                $("#nav-colec").removeAttr('class');
                $("#nav-shop").attr('class','active');
            }
            if (id == 'nav-colec') {
                $("#nav-home").removeAttr('class');
                $("#nav-shop").removeAttr('class');
                $("#nav-colec").attr('class','active');
            }

        }
    </script>
    <script type="text/javascript">
    function insertParam(key, value) {
        const urlParams = new URLSearchParams(window.location.search);

        urlParams.set(key, value);
        return urlParams;
    }
    
    function insertDoubleParam(key, value, key2, value2) {
        const urlParams = new URLSearchParams(window.location.search);

        urlParams.set(key, value);
        urlParams.set(key2, value2);
        return urlParams;
    }

    function login() {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'You have to login to cart!',
          footer: 'You have an account? &nbsp<a href="login.php">Login now</a>'
        })
    }

    function addToCart(productID){
        addToCartHelper(productID);
    }
</script>
<script type="text/javascript">
    var addToCartHelper;
    $(function(){
        addToCartHelper = function(productID) {
            $.get("add-to-cart.php",
                {
                    id : productID,
                },
                function(result) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Added to cart',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    var str = result.split('');
                    if(str['0']==1) {
                        var count_cart = parseInt($('.count-cart').text());
                        console.log(count_cart);
                        $('.count-cart').text(count_cart+1);
                    }
                    $('.subtotal-ajax').html('$'+result);
                }
            );
        }
    });
</script>
<script type="text/javascript">
    $(".onchangevalue").on('change', function postinput(){
            var qty = $(this).val(); // this.value
            var product_id = $(this).attr("data-id");
            var target_ajax = '.responseData_'+product_id;
            $.ajax({ 
                url: 'shopping-cart-ajax.php',
                data: { 
                    qty : qty ,
                    product_id : product_id,
                },
                type: 'post'
            }).done(function(responseData) {
                var str = responseData;
                var str1 = str.split("/");
                $(target_ajax).html('$'+str1['0']);
                console.log(str1['1']);
                $('.subtotal-ajax').html('$'+str1['1']);
                var atag = 'check-out.php?total='+str1['1'];
                $('.checkout-btn-ajax').attr('href',atag);
            }).fail(function() {
                console.log('Failed');
            });
        });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#sendcmt").click(function(){
            var product_id = $("#product_id").val();
            var content = $("#content").val();
            var username = $("#username").val();
            $.post("comment.php", {content: content, product_id: product_id, username: username}, function(result) {
                $(".all_cmt").append('<div class="co-item"><img src="img/product-single/avatar-1.png" alt=""></div><div class="avatar-text"><h5>'+username+' <span>Now</span></h5><div class="at-reply">'+content+'</div></div></div>')});
            $("#content").val('');
            $("#username").val('');     
        });
    });
</script>
</body>

</html>