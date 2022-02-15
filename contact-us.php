<?php include "connection.php";
$errors = [];
function check_mobile($mobile){
    global $errors;
    $flag = 0;
    if (strlen($mobile) > 11 || strlen($mobile) < 11){
        array_push($errors,'شماره موبایل باید یازده حرف باشد و با ضفر شروع شود');
        $flag++;
    }
    if(preg_match("/^09[0-9]{9}$/", $mobile)) {

    }else{
        array_push($errors, "شماره موبایل معتبر نیست");
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

$queryVuser = "SELECT * FROM users WHERE  access_token='".$_COOKIE['user']."' ";
$queryVuser = mysqli_query($connection , $queryVuser);
$queryVuser = mysqli_fetch_assoc($queryVuser);
$queryVuser = $queryVuser["userID"];
if (!$queryVuser){
    $queryVuser = "unsigned";
}
if(isset($_POST['emailsender'])){
    if (( check_email($_POST['email']) + check_mobile($_POST['phone_number'])) == false ){
        $querysend = "INSERT INTO `email`( `name`, `email`, `phonenumber`, `title`, `text`, `userid`) VALUES ('".$_POST['name']."','".$_POST['email']."','".$_POST['phone_number']."','".$_POST['msg_subject']."','".$_POST['message']."','".$queryVuser."')";

        mysqli_query($connection,$querysend);
        array_push($errors,"پیام شما ارسال شد و در اسرع به ان پاسخ خواهیم داد");
    }
}



?>



<!DOCTYPE html>
<html lang="zxx" dir="rtl">

<!-- Mirrored from templates.hibootstrap.com/blim/rtl/contact-us.php by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 25 Sep 2021 12:43:44 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="description" content="Aila">
    <meta name="keywords" content="HTML,CSS,JavaScript">
    <meta name="author" content="HiBootstrap">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <title>Blim - Domain & Hosting Company HTML Template</title>
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
    <style>
        .email::placeholder {
            text-align: right;
            /*direction: rtl!important;*/
        }
    </style>
</head>
<body>

<div class="preloader blue-gradient">
    <div class="preloader-wrapper">
        <div class="preloader-img">
            <img src="assets/images/loader.gif" alt="preloader">
        </div>
    </div>
</div>




<!--start header-->
 <?php include "layouts/header.php";?>
<!--end header-->
<section class="contact-us-section pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="box-card fluid-height">
                    <div class="box-card-inner box-card-black full-height default-box-shadow">
                        <div class="box-card-content text-center">
                            <div class="box-card-icon blue-gradient">
                                <i class="flaticon-email"></i>
                            </div>
                            <div class="box-card-details">
                                <h3>ارسال ایمیل</h3>
                                <ul class="box-card-list">
                                    <li><i class="flaticon-chat"></i><a class="link-us"
                                                                        href="mailto: topdomainsell.com@gmail.com"><span
                                                    class="__cf_email__" data-cfemail="4f262129200f2d232622612c2022">&nbsp;پست الکترونیکی</span></a>
                                    </li>
                                    <li><a class="link-us"
                                                                         href="https://www.info.blim.com/">topdomainsell.com@gmail.com&nbsp;</a><i class="flaticon-email"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="box-card fluid-height">
                    <div class="box-card-inner blue-gradient full-height default-box-shadow">
                        <div class="box-card-content text-center">
                            <div class="box-card-icon bg-white">
                                <i class="flaticon-phone-call-1"></i>
                            </div>
                            <div class="box-card-details">
                                <h3>تماس بگیرید</h3>
                                <ul class="box-card-list">
                                    <li><i class="flaticon-phone"></i><a href="tel:+989121235667">09121235667</a></li>
                                    <li><i class="flaticon-phone-call"></i><a href="tel: 02188881502">021-88881502</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 offset-md-3 offset-lg-0">
                <div class="box-card fluid-height">
                    <div class="box-card-inner bg-white full-height default-box-shadow">
                        <div class="box-card-content text-center">
                            <div class="box-card-icon blue-gradient">
                                <i class="flaticon-pin"></i>
                            </div>
                            <div class="box-card-details">
                                <h3>آدرس</h3>
                                <p>تهران-میدان ونک- نبش گاندی شمالی پلاک 2 واحد 3</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="comment-section pt-100 pb-70 blue-gradient-with-opacity" id="contactus">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-12 col-lg-4 pb-30">
                <div class="comment-content-item">
                    <div class="about-content-image image-margin-left desk-pad-right-20">
                        <img src="assets/images/support-2.png" alt="support">
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-8 pb-30">
                <div class="comment-content-item">
                    <div class="comment-area bg-white">
                        <div class="sub-section-title">
                            <h3>پیام خود را ارسال کنید</h3>
                            <p>ایمیل شما نمایش داده نخواهد شد تمام فیلد ها را پر کنید</p>
                        </div>
                        <div class="comment-input-area mt-30">
                            <form method="POST">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="flaticon-user"></i></span>
                                                </div>
                                                <input type="text" name="name" id="name" class="form-control" required
                                                       data-error="لطفا نام و نام خانوادگی خود را وارد کنید" placeholder="نام و نام خانوادگی"/>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="flaticon-user"></i></span>
                                                </div>
                                                <input type="email" name="email" id="email" class="form-control email"
                                                       required data-error="لطفا ایمیل خود را وارد کنید"
                                                       placeholder="ایمیل"/>
                                            </div>

                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="flaticon-phone-call"></i></span>
                                                </div>
                                                <input type="text" name="phone_number" id="phone_number" required
                                                       data-error="لطفا موبایل خود را کامل کنید" class="form-control"
                                                       placeholder="شماره موبایل"/>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="flaticon-book"></i></span>
                                                </div>
                                                <input type="text" name="msg_subject"
                                                       class="form-control" required
                                                       data-error="وارد کردن موضوع الزامی است" placeholder="موضوع"/>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="flaticon-envelope"></i></span>
                                                </div>
                                                <textarea name="message" class="form-control" id="message" rows="5"
                                                          required data-error="لطفا موضوع خود را بنویسید"
                                                          placeholder="پیام..."></textarea>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-check mb-20">
                                            <input type="checkbox" class="form-check-input" id="check1">
                                            <label class="form-check-label" for="check1"><a
                                                        href="terms-conditions.html">تمام شرایط </a> و <a
                                                        href="privacy-policy.html"> ضوابط </a>قبول می کنیم</label>
                                        </div>

                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <button class="btn btn-gradient" name="emailsender">
                                            پیام ارسال کنید
                                        </button>
                                        <div id="msgSubmit"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </form>
                            <ul>
                                <?php
                                foreach ($errors as $error){
                                    echo '<li>'.$error.'</li>';
                                }

                                ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="map-section">
    <div class="map-iframe">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d809.4290446755143!2d51.41131062924276!3d35.7577801870604!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f8e06949012fe8b%3A0x128b73f5fca93bad!2z2K_Zgdiq2LHYp9iz2YbYp9ivINix2LPZhduMIDEyNTUg2KrZh9ix2KfZhg!5e0!3m2!1sen!2snl!4v1634982645415!5m2!1sen!2snl" style="border:0;" allowfullscreen="" loading="lazy"></iframe>    </div>
</div>


<?php include "layouts/footer.php"; ?>

<div class="scroll-top" id="scrolltop">
    <div class="scroll-top-inner">
        <span><i class="flaticon-up-arrow"></i></span>
    </div>
</div>

<?php include "layouts/analize.php";?>
<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
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

<!-- Mirrored from templates.hibootstrap.com/blim/rtl/contact-us.php by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 25 Sep 2021 12:43:45 GMT -->
</html>