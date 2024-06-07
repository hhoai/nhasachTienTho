<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://use.fontawesome.com/2145adbb48.js"></script>
<script src="https://kit.fontawesome.com/a42aeb5b72.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="./images/favicon.png" />
    <title>Checkout</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script>
        $(function() {
            $('.fadein img:gt(0)').hide();
            setInterval(function() {
                $('.fadein :first-child').fadeOut().next('img').fadeIn().end().appendTo('.fadein');
            }, 5000);
        });
    </script>
</head>
<style>
    <?php include './css/style.css'; ?>
</style>
<body>
    <nav>
        <label class="logo"><a href="index.php">
            <img src="./images/logo.png" alt="" style="width: 120px;">
        </a></label>
        <ul>
            <li><a href="index.php" class="active">Trang chủ</a></li>
            <li><a href="productList.php">Sản phẩm</a></li>
            
            <li><a href="order.php" id="order">Đơn hàng</a></li>
            <li>
                <a href="checkout.php">
                    Giỏ hàng
                    <i class="fa fa-shopping-bag"></i>
                    <!-- <sup class="sumItem">
                        <?= ($totalQty['total']) ? $totalQty['total'] : "0" ?>
                    </sup> -->
                </a>
            </li>
            <?php
            if (isset($_SESSION['user']) && $_SESSION['user']) { ?>
                <li><a href="info.php" id="signin">Thông tin cá nhân</a></li>
                <li><a href="logout.php" id="signin">Đăng xuất</a></li>
            <?php } else { ?>
                <li><a href="register.php" id="signup">Đăng ký</a></li>
                <li><a href="login.php" id="signin">Đăng nhập</a></li>
            <?php } ?>
        </ul>
    </nav>
        <section class="banner">
        <div class="fadein">
            <?php
            // display images from directory
            // directory path
            $dir = "./images/slider/";

            $scan_dir = scandir($dir);
            foreach ($scan_dir as $img) :
                if (in_array($img, array('.', '..')))
                    continue;
            ?>
                <img src="<?php echo $dir . $img ?>" alt="<?php echo $img ?>">
            <?php endforeach; ?>
        </div>
    </section>
    <div class="featuredProducts">
        <h1>Địa chỉ nhận hàng</h1>
    </div>
    
    <div class="infor_man">
            <form action="add_order.php" method="post" class="form-login">
                <label for="fullName">Họ tên người nhận</label>
                <input type="text" id="fullName" name="fullName" placeholder="Họ tên..." required>

                <label for="numberPhone">Số điện thoại</label>
                <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="Số điện thoại..." required oninput="validatePhoneNumber(this)">
                
                <label for="address">Địa chỉ</label>
                <textarea name="address" id="address" cols="30" rows="5" required></textarea>

                <input type="submit" value="Gửi" name="submit">
            </form>
        </div>

    
    <footer>
        <div class="social">
            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        </div>
        <ul class="list" style="background-color:white">
            <li>
                <a href="./">Trang Chủ</a>
            </li>
            <li>
                <a href="productList.php">Sản Phẩm</a>
            </li>
        </ul>
        <p class="copyright">copy by HB-SHOP.com 2022</p>
    </footer>
    </body>

    <script>
    function validatePhoneNumber(input) {
        var phoneNumber = input.value;
        var regex = /^[0-9]{10}$/;

        if (!regex.test(phoneNumber)) {
            input.setCustomValidity('Số điện thoại không đúng định dạng!');
        } else {
            input.setCustomValidity('');
        }
    }
    </script>

</html>