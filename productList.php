<?php
include_once 'lib/session.php';
include_once 'classes/product.php';
include_once 'classes/categories.php';
include_once 'classes/cart.php';

$cart = new cart();
$totalQty = $cart->getTotalQtyByUserId();

$product = new product();
$list = $product->getProductsByCateId((isset($_GET['page']) ? $_GET['page'] : 1), (isset($_GET['cateId']) ? $_GET['cateId'] : 1));
$pageCount = $product->getCountPagingClient((isset($_GET['cateId']) ? $_GET['cateId'] : 6));

$categories = new categories();
$categoriesList = $categories->getAll();
?>
<?php
    if (isset($_GET['search'])) {
        $search = addslashes($_GET['search']);
        if (empty($search)) {
            echo '<script type="text/javascript">alert("Yêu cầu dữ liệu không được để trống!");</script>';
        } else {
            $list = $product->getProductByName($search);
           
        }
    } 
?>

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
    <title>Danh sách sản phẩm</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script>
        $(function() {
            $('.fadein img:gt(0)').hide();
            setInterval(function() {
                $('.fadein :first-child').fadeOut().next('img').fadeIn().end().appendTo('.fadein');
            }, 1500);
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
    <div class="content">
    <div class="featuredProducts">
        <h1>Danh sách sản phẩm</h1>
        <form class="c-search" action="" method="get">
            <input type="text" name="search" placeholder="Nhập tên sản phẩm">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <div class="category">
        <p style="padding-top: 20px; text-transform: uppercase;">Danh mục:</p>
        <select onchange="location = this.value;">
            <?php
            foreach ($categoriesList as $key => $value) {
                if ($value['id'] == $_GET['cateId']) { ?>
                    <option selected value="productList.php?cateId=<?= $value['id'] ?>"><?= $value['name'] ?></option>
                <?php } else { ?>
                    <option value="productList.php?cateId=<?= $value['id'] ?>"><?= $value['name'] ?></option>
                <?php } ?>
            <?php }
            ?>
        </select>
    </div>
    <div class="container">
        <?php if ($list) {
            foreach ($list as $key => $value) { ?>
                <div class="card">
                    <div class="imgBx">
                        <a href="detail.php?id=<?= $value['id'] ?>" title="<?= $value['name'] ?>"><img src="admin/uploads/<?= $value['image'] ?>" alt=""></a>
                    </div>
                    <div class="product-content">
                        <div class="productName">
                            <a href="detail.php?id=<?= $value['id'] ?>" title="<?= $value['name'] ?>">
                                <h3><?= $value['name'] ?></h3>
                            </a>
                        </div>
                        <div>
                            Đã bán: <?= $value['soldCount'] ?>
                        </div>
                        <div class="original-price">
                            <?php
                            if ($value['promotionPrice'] < $value['originalPrice']) { ?>
                                Giá gốc: <del><?= number_format($value['originalPrice'], 0, '', ',') ?>VND</del>
                            <?php } else { ?>
                                <p>.</p>
                            <?php } ?>
                        </div>
                        <div class="price">
                            Giá bán: <?= number_format($value['promotionPrice'], 0, '', ',') ?>VND
                        </div>
                        <div class="action">
                            <a class="add-cart" href="add_cart.php?id=<?= $value['id'] ?>">Thêm vào giỏ</a>
                            <a class="detail" href="detail.php?id=<?= $value['id'] ?>">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            <?php }
        } else { ?>
            <h3>Không có sản phẩm nào...</h3>
        <?php  }
        ?>
    </div>
    <div class="pagination">
        <a href="productList.php?page=<?= (isset($_GET['page'])) ? (($_GET['page'] <= 1) ? 1 : $_GET['page'] - 1) : 1 ?>&cateId=<?= (isset($_GET['cateId'])) ? $_GET['cateId'] : 2 ?>">&laquo;</a>
        <?php
        // echo  $pageCount;
        for ($i = 1; $i <= $pageCount; $i++) {
            if (isset($_GET['page'])) {
                if ($i == $_GET['page']) { ?>
                    <a class="active" href="productList.php?page=<?= $i ?>&cateId=<?= (isset($_GET['cateId'])) ? $_GET['cateId'] : 2 ?>"><?= $i ?></a>
                <?php } else { ?>
                    <a href="productList.php?page=<?= $i ?>&cateId=<?= (isset($_GET['cateId'])) ? $_GET['cateId'] : 2 ?>"><?= $i ?></a>
                <?php  }
            } else { ?>
                <a href="productList.php?page=<?= $i ?>&cateId=<?= (isset($_GET['cateId'])) ? $_GET['cateId'] : 1 ?>"><?= $i ?></a>
            <?php  } ?>
        <?php }
        ?>
        <a href="productList.php?page=<?= (isset($_GET['page'])) ? $_GET['page'] + 1 : 2 ?>&cateId=<?= (isset($_GET['cateId'])) ? $_GET['cateId'] : 2 ?>">&raquo;</a>
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