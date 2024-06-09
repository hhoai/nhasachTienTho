<?php
include 'classes/user.php';
$clientTT = new user();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $login_check = $clientTT->login($email, $password);
}
?>

<?php
include_once 'lib/session.php';
include_once 'classes/product.php';
include_once 'classes/cart.php';

$cart = new cart();
$totalQty = $cart->getTotalQtyByUserId();
?>

<?php
  require_once 'google-api/vendor/autoload.php';

  // Lấy những giá trị này từ https://console.google.com
  $client_id = '195730806723-lbioafvnql787ss4br9ntd0e5lfpvssm.apps.googleusercontent.com'; 
  $client_secret = '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';
  $redirect_uri = 'http://localhost:800/bookstore/login.php';

  //Thông tin kết nói database
  $db_username = "root"; //Database Username
  $db_password = ""; //Database Password
  $host_name = "localhost"; //Mysql Hostname
  $db_name = 'tt_bookstore'; //Database Name
  ###################################################################

  $client = new Google_Client();
  $client->setClientId($client_id);
  $client->setClientSecret($client_secret);
  $client->setRedirectUri($redirect_uri);
  $client->addScope("email");
  $client->addScope("profile");

  $service = new Google_Service_Oauth2($client);

  // Nếu kết nối thành công, sau đó xử lý thông tin và lưu vào database
  if (isset($_GET['code'])) {
      $client->authenticate($_GET['code']);
      $_SESSION['access_token'] = $client->getAccessToken();
      //header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
      $user = $service->userinfo->get(); //get user info 

      // connect to database
      $mysqli = new mysqli($host_name, $db_username, $db_password, $db_name);
      if ($mysqli->connect_error) {
          die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
      }
      $id = substr($user->id, 0, 8);

      //Kiểm tra xem nếu user này đã tồn tại, sau đó nên login tự động
      $result = $mysqli->query("SELECT COUNT(id) as usercount FROM users WHERE id=$id");
      $user_count = $result->fetch_object()->usercount; //will return 0 if user doesn't exist

      //show user picture
    //   echo '<img src="'.$user->picture.'" style="float: right;margin-top: 33px;" />';
      if($user_count) // Nếu user tồn tại thì show thông tin hiện có
      {
         $login_check = $clientTT->login($user->email, '1');
      }
      else //Ngược lại tạo mới 1 user vào database
      { 
          $statement = $mysqli->prepare("INSERT INTO users (id, email, password, fullname, status, isConfirmed, role_id) VALUES (?,?,'1',?,1,1,2)");
          $statement->bind_param('sss',$id, $user->email, $user->name);
          $statement->execute();
          echo $mysqli->error;
          $login_check = $clientTT->login($user->email, '1');
        }
        header("location:index.php");
      exit;
  }

  //Nếu sẵn sàng kết nối, sau đó lưu session với tên access_token
  if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
      $client->setAccessToken($_SESSION['access_token']);
    } else { // Ngược lại tạo 1 link để login
        // header("location:/bookstore-client/index.php");
    }
    $authUrl = $client->createAuthUrl();
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
    <title>Đăng nhập</title>
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
    <div class="content">
    <div class="featuredProducts">
        <h1>Đăng nhập</h1>
    </div>
    <div class="container-single">
        <div class="login">
            <form action="login.php" method="post" class="form-login">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email..." required>

                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Mật khẩu..." required>
                <p style="color: red;"><?= !empty($login_check) ? $login_check : '' ?></p>

                <a href="forgot_password.php">Quên mật khẩu?</a>   
                <input type="submit" value="Đăng nhập" style="font-size:20px">
            </form>
            <div class="login-gg">
                <hr>
                <p class="text">hoặc</p>
                <?php 
                    if (isset($authUrl)){ 
                        echo '<a class="login-gg-btn" href="'. $authUrl .'" class="btn--with-icon">
                        <!-- <FaGooglePlus class="social-icon" /> -->
                        <i class="fab fa-google-plus social-icon"></i>
                        <div>Kết nối với Google</div>
                        </a>';
                    } 
                    else {
                        echo '<a class="login-gg-btn" href="" class="btn--with-icon">
                        <!-- <FaGooglePlus class="social-icon" /> -->
                        <i class="fab fa-google-plus social-icon"></i>
                        <div>Kết nối với Google</div>
                        </a>';}
                ?>
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