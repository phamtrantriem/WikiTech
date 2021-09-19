<?php include_once('./connect.php'); ?>
<?php include('login-layout.php')?>
<?php session_start(); ?>
<?php 
    $dangnhapthanhcong = false;
    $username = $password = "";
    $usernameErr = $passwordErr = "";
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $sql = "select * from account where username = '".$_POST['username']."'";
        $ketqua = mysqli_query($conn, $sql);
        if (mysqli_num_rows($ketqua) > 0) {
            while($row = mysqli_fetch_assoc($ketqua)) {
                if (md5($_POST['password']) == $row['password']) {
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['role'] = $row['role'];
                    echo("<script>                  
                        Swal.fire({icon: 'success', title: 'Login successfully!!', showConfirmButton: false, timer: 1500})
                            .then(function (result) {
                                if (result.dismiss === swal.DismissReason.timer) {
                                    window.location.href = 'index.php';
                                }
                            });
                        </script>");
                } else {
                    echo("<script>                  
                        Swal.fire({icon: 'error', title: 'Your account is wrong!!', showConfirmButton: false, timer: 1500});
                        </script>");
                }
            }
        } else {
            echo("<script>                  
                        Swal.fire({icon: 'error', title: 'Your account is wrong!!', showConfirmButton: false, timer: 1500});
                        </script>");
        }
    }
    function check($data) {
        $partten = "/^[A-Za-z0-9_\.]{5,32}$/";
        $check = preg_match($partten ,$data);
        return $check;
    }
?>
<?php mysqli_close($conn);?>

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="index.php"><i class="fa fa-home"></i> Home</a>
                        <span>Login</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Form Section Begin -->

    <!-- Register Section Begin -->
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="login-form">
                        <h2>Login</h2>
                        <form action="./login.php" method="post">
                            <div class="group-input">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username">
                            </div>
                            <div class="group-input">
                                <label for="pass">Password </label>
                                <input type="password" name="password" id="pass">
                            </div>
                            <div class="group-input gi-check">
                                <div class="gi-more">
                                    <label for="save-pass">
                                        Save Password
                                        <input type="checkbox" id="save-pass">
                                        <span class="checkmark"></span>
                                    </label>
                                    <a href="#" class="forget-pass">Forget your Password</a>
                                </div>
                            </div>
                            <button type="submit" class="site-btn login-btn">Sign In</button>
                        </form>
                        <div class="switch-login">
                            <a href="./register.php" class="or-login">Or Create An Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->


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
</body>

</html>