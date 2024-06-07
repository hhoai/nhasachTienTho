<?php
include 'classes/product.php';
include_once 'classes/cart.php';

$cart = new cart();
$totalQty = $cart->getTotalQtyByUserId();

$product = new product();
$result = $product->getProductbyId($_GET['id']);
if (!$result) {
    echo 'Không tìm thấy sản phẩm!';
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<style>
    <?php include './css/style.css'; ?>
</style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://use.fontawesome.com/2145adbb48.js"></script>
<script src="https://kit.fontawesome.com/a42aeb5b72.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="./images/favicon.png" />
    <title><?= $result['name'] ?></title>
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
                    <sup class="sumItem">
                        <?= ($totalQty['total']) ? $totalQty['total'] : "0" ?>
                    </sup>
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
        <h1>Sản phẩm</h1>
    </div>
    <div class="content">
    <div class="container-single">
        <div class="image-product">
            <img src="admin/uploads/<?= $result['image'] ?>" alt="" style="width: 400px; height:fit-content">
        </div>
        <div class="info">
            <div class="name">
                <h2><?= $result['name'] ?></h2>
            </div>
            <div class="price-single">
                Giá bán: <b><?= number_format($result['promotionPrice'], 0, '', ',') ?>VND</b>
            </div>
            <?php
            if ($result['promotionPrice'] < $result['originalPrice']) { ?>
                <div>
                    Giá gốc: <del><?= number_format($result['originalPrice'], 0, '', ',') ?>VND</del>
                </div>
            <?php }
            ?>
            <div class="des">
                <p>Số lượng còn: <?= $result['qty'] ?></p>
                <p>Đã bán: <?= $result['soldCount'] ?></p>
                <?= $result['des'] ?>
            </div>
            <div class="add-cart-single">
                <a href="add_cart.php?id=<?= $result['id'] ?>">Thêm vào giỏ</a>
            </div>
        </div>
    </div>
    </div>
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
         <p class="copyright">copy by Tien Tho Bookstore 2023</p>
    </footer>
</body>

</html>