<?php

include "connection.php";
if (isset($_COOKIE['user'])){
    header("Location: index.php");
}
date_default_timezone_set('Asia/Tehran');
$errors=[];

function check_name($firstname,$lastname){
    global $errors;
    $flag = 0;

    if (strlen($firstname) < 2){
        array_push($errors,'نام باید حداقل سه حرف باشد');
        $flag++;

    }
    if (strlen($lastname) < 2){
        array_push($errors,'نام خانوادگی حداقل باید سه حرف باشه');
        $flag++;
    }

    $firstname1= str_replace(' ', '', $firstname);;
    $lastname1= str_replace(' ', '', $lastname);;

    if (!ctype_alpha($firstname1)){
        array_push($errors,'برای نام خود فقط حروف انگلیسی وارد کنید');
        $flag ++;
    }
    if (!ctype_alpha($lastname1)){

        array_push($errors,'برای نام خانوادگی خود فقط حروف انگلیسی وارد کنید');

    $flag++;
    }
    return $flag;
}

function check_email($email){
    global $errors;
    $flag = 0;

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

    } else {
        array_push($errors,"$email,'ایمیل معتبر وارد کنید'");

        $flag++;
    }
    return $flag;
}
function check_mobile($mobile){
    global $errors;
    $flag = 0;
    if (strlen($mobile) > 11 || strlen($mobile) < 11){
        array_push($errors,'شماره موبایل باید یازده حرف باشد و با صفر شروع شود');
        $flag++;
    }
    if(preg_match("/^09[0-9]{9}$/", $mobile)) {

    }else{
        array_push($errors, "شماره موبایل معتبر نیست");
        $flag++;
    }
    return $flag;
}
function check_password($password,$confirm_password){
    global $errors;
    $flag = 0;
    if (strlen($password) < 8){
        array_push($errors,'پسورد باید حداقل هشت حرف باشد');
        $flag++;
    }
    if ( $password != $confirm_password ){
        array_push($errors,'پسورد ها یکسان نیستند');
        $flag++;
    }
    return $flag;
}
function check_uniqe($email,$mobile){
    include "connection.php";
    $flag = 0;
    global $errors;
//    $flag=true;
    $check_user="SELECT `email`, `mobile` FROM `users` WHERE ( email='".$email."' OR mobile= '".$mobile."' )";
    $check_user = mysqli_query($connection,$check_user);
    if (mysqli_num_rows($check_user)){
        array_push($errors,'این شماره موبایل یا ایمیل قبلا ثبت شده است ');
        $flag++;

    }
    return $flag;
}

if (isset($_POST['signup'])){
   $signup_date = date('Y:M:D H:i:s');
    if ((check_name($_POST['firstname'],$_POST['lastname']) + check_email($_POST['email']) + check_mobile($_POST['mobile']) + check_password($_POST['password'],$_POST['Cpassword']) + check_uniqe($_POST['email'],$_POST['mobile'])) == false ){
        $signup_query = "INSERT INTO `users`(`firstname`, `lastname`, `email`, `mobile`, `password`, `SignedupAt`, `LoggedinAt`) VALUES ('".$_POST['firstname']."','".$_POST['lastname']."','".strtolower($_POST['email'])."','".$_POST['mobile']."','".sha1($_POST['password'])."','".$signup_date."','".$signup_date."')";
        if (mysqli_query($connection , $signup_query)){
          $access_token  = mysqli_insert_id($connection);
          $access_token_hashed = base64_encode($access_token);
          $access_token_hashed = sha1($access_token_hashed);
          for ($i = 0 ; $i < rand(10,60);$i++){
              $access_token_hashed = base64_encode($access_token_hashed);
          }
          $query_token = "UPDATE `users` SET `access_token`='".sha1($access_token_hashed)."' WHERE userID = '".$access_token."'";
          if (mysqli_query($connection,$query_token)){

              array_push($errors,'ثبت نام با موقیت انجام شد');
              
          }
        }
        else{
            array_push($errors,'مشکلی در ثبت نام به وجود امد  دوباره سعی کنید');
        }
    }

}
if (isset($_POST['login'])) {
    if (!empty($_POST['username_number']) && !empty($_POST['passwordlogin'])) {
        $pwd = sha1($_POST['passwordlogin']);
        $query = "SELECT * FROM `users` WHERE (email = '" . $_POST['username_number'] . "' OR mobile = '".$_POST['username_number']."' ) AND  password = '" . $pwd . "'";
        $query = mysqli_query($connection, $query);
        if (mysqli_num_rows($query)) {
            $signup_date = date('Y:M:D H:i:s');
            $querylogin = "UPDATE `users` SET `LoggedinAt`='".$signup_date."' WHERE email = '".$_POST['username_number']."'";
            $querylogin = mysqli_query($connection,$querylogin);
            array_push($errors, "login is successful");
            $query = mysqli_fetch_assoc($query);
            if($_POST["rememberme"]=='1' || $_POST["rememberme"]=='on')
            {

                setcookie("user", $query["access_token"], time() + (86400 * 30* 7 ), "/");  //604800 = 7 day

            }
            else {

                setcookie("user", $query["access_token"], time() + (86400 * 30), "/"); // 86400 = 1 day
            }

            header("Location: index.php");
        }
        else{
            array_push($errors, "login failed");
        }
    }
    else{
        array_push($errors, "تمام فیلد ها را پر کنید");
    }
}
?>

<!DOCTYPE html>
<html lang="zxx" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Aila">
    <meta name="keywords" content="HTML,CSS,JavaScript">
    <meta name="author" content="HiBootstrap">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <title>خرید و فروش دامنه</title>
    <link rel="icon" href="assets/images/tab.png" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="assets/css/bootstrap.rtl.min.css" type="text/css" media="all"/>

    <link rel="stylesheet" href="assets/css/animate.min.css" type="text/css" media="all"/>

    <link rel="stylesheet" href="assets/css/owl.carousel.min.css" type="text/css" media="all"/>
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css" type="text/css" media="all"/>

    <link rel="stylesheet" href="assets/css/meanmenu.min.css" type="text/css" media="all"/>

    <link rel="stylesheet" href="assets/css/magnific-popup.min.css" type="text/css" media="all"/>

    <link rel='stylesheet' href='assets/css/boxicons.min.css' type="text/css" media="all"/>

    <link rel='stylesheet' href='assets/css/flaticon.css' type="text/css" media="all"/>

    <link rel="stylesheet" href="assets/css/style.css" type="text/css" media="all"/>

    <link rel="stylesheet" href="assets/css/responsive.css" type="text/css" media="all"/>

    <link rel="stylesheet" href="assets/css/rtl.css" type="text/css" media="all"/>
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>

<div class="preloader blue-gradient">
    <div class="preloader-wrapper">
        <div class="preloader-img">
            <img src="assets/images/loader.gif" alt="preloader">
        </div>
    </div>
</div>


<div class="authentication-section">
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-sm-12 col-lg-6 p-0">
                <div class="authentication-item authentication-img-bg blue-gradient">
                    <div class="authentication-info">
                        <div class="authentication-info-img">
                            <img src="assets/images/authentication.png" alt="shape">
                        </div>
                        <div class="authentication-info-title section-title section-title-two">
                            <h2>خرید و فروش دامنه</h2>
                            <p>معتبرترین سایت خرید و فروش دامنه تماس متسقیم با فروشنده و دارای خرید امن</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6 p-0">
                <div class="authentication-item bg-white">
                    <div class="authentication-user-panel">
                        <div class="authentication-user-header">
                            <a href="index.php"><img src="assets/images/logo-blue.png" alt="logo"></a>
                            <h1>فروشگاه دامنه</h1>
                        </div>
                        <div class="authentication-user-body">
                            <div class="authentication-tab">
                                <div class="authentication-tab-item <?php if (!isset($_POST['signup'])) echo 'authentication-tab-active';?>"
                                     data-authentcation-tab="1">
                                    <i class="flaticon-user-1"></i>
                                    وارد شوید
                                </div>
                                <div class="authentication-tab-item <?php if (isset($_POST['signup'])) echo 'authentication-tab-active';?>" data-authentcation-tab="2">
                                    <i class="flaticon-user-2"></i>
                                    ثبت نام کنید
                                </div>
                            </div>
                            <div class="authentication-tab-details">
                                <div class="authentication-tab-details-item <?php if (!isset($_POST['signup'])) echo 'authentication-tab-details-active';?>"
                                     data-authentcation-details="1">
                                    <div class="authentication-form">
                                        <form method="post" action="">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group mb-20">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="flaticon-user"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                   placeholder="ایمیل*" required name="username_number"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group mb-20">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="flaticon-user"></i></span>
                                                            </div>
                                                            <input type="password" name="passwordlogin" class="form-control"
                                                                   placeholder="رمز عبور" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <ul>
                                                        <?php
                                                        foreach ($errors as $error){
                                                            echo '<li>'.$error.'</li>';
                                                        }

                                                        ?>

                                                    </ul>
                                                    <button class="btn btn-gradient full-width mb-20" name="login">وارد شوید</button>
                                                </div>
                                            </div>
                                            <div class="authentication-account-access mb-20">
                                                <div class="authentication-account-access-item">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="check1" name="rememberme">
                                                        <label class="form-check-label" for="check1">من را به یاد داشته باش</label>
                                                    </div>
                                                </div>
                                                <div class="authentication-account-access-item">
                                                    <div class="authentication-link">

                                                        <a href="forget-password.html">رمز ورود خود را فراموش کردید؟</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>

                                </div>
                                <div class="authentication-tab-details-item <?php if (isset($_POST['signup'])) echo 'authentication-tab-details-active';?>" data-authentcation-details="2">
                                    <div class="authentication-form">
                                        <form method="post" action="">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group mb-20">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="flaticon-user"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                   placeholder="نام به حروف لاتین*" required name="firstname" value="<?php if (isset($_POST['signup'])) echo $_POST['firstname']; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group mb-20">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="flaticon-user"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                   placeholder="نام خانوادگی به حروف لاتین*" required name="lastname" value="<?php if (isset($_POST['signup'])) echo $_POST['lastname']; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group mb-20">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                            class="flaticon-user"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                   placeholder="ادرس ایمیل*" required name="email" value="<?php if (isset($_POST['signup'])) echo $_POST['email']; ?>" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group mb-20">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="flaticon-user"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="شماره موبایل با صفر*" required name="mobile" value="<?php if (isset($_POST['signup'])) echo $_POST['mobile']; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group mb-20">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="flaticon-user"></i></span>
                                                            </div>
                                                            <input type="password" name="password" class="form-control"
                                                                   placeholder="رمز ورود*" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group mb-20">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="flaticon-user"></i></span>
                                                            </div>
                                                            <input type="password" name="Cpassword" class="form-control"
                                                                   placeholder="تکرار رمز دوم *" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <ul>
                                                        <?php
                                                        foreach ($errors as $error){
                                                            echo '<li>'.$error.'</li>';
                                                        }

                                                        ?>

                                                    </ul>
                                                    <button class="btn btn-gradient full-width mb-20" name="signup">ثبت نام کنید</button>
                                                </div>
                                            </div>
                                            <div class="authentication-account-access mb-20">
                                                <div class="authentication-account-access-item">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="check2">

                                                    </div>
                                                </div>
                                            </div>

                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="assets/js/jquery-3.5.1.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/js/jquery.magnific-popup.min.js"></script>

<script src="assets/js/owl.carousel.min.js"></script>

<script src="assets/js/jquery.ajaxchimp.min.js"></script>

<script src="assets/js/form-validator.min.js"></script>

<script src="assets/js/contact-form-script.js"></script>

<script src="assets/js/jquery.meanmenu.min.js"></script>

<script src="assets/js/script.js"></script>
</body>

</html>