<?php include 'connection.php';
$details =json_decode(file_get_contents("http://ipwhois.app/json/"));
if (isset($_GET['domain'])){
        $domain_details = "SELECT * FROM `domains` WHERE url = '".$_GET['domain']."'";
        $domain_details = mysqli_query($connection , $domain_details);
        $domain_details = mysqli_fetch_assoc($domain_details);
    }
    else{
       header("Location: 404.html");
    }
?>
<!DOCTYPE html>
<html lang="zxx" dir="rtl">

<!-- Mirrored from templates.hibootstrap.com/blim/rtl/gaming-services.php by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 25 Sep 2021 12:42:59 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="description" content="Aila">
    <meta name="keywords" content="HTML,CSS,JavaScript">
    <meta name="author" content="HiBootstrap">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <title>فروش دامنه <?= $domain_details['name'] ?></title>
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
    <link rel="stylesheet" href="assets/css/all.min.css" type="text/css" media="all"/>
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <style>
        /*@media only screen and (min-width: 600px) {*/
            h1 {
              font-size: 85px !important;
            }

        @media only screen and (max-width: 850px) {
                h1{
                    font-size: 61px!important;
                }
        }
        @media only screen and (min-width:992px ) and (max-width: 1399px) {
            h1{
                font-size: 70px!important;
            }
        }
        /*}*/
        @media only screen and (max-width: 600px) {
            h1 {
              font-size: 50px !important;
            }
        }
		body{
			font-family : IRANSans !important;
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
<header class="header-banner header-page blue-gradient pt-3">
    <?php include "layouts/side_header.php";?>
<div class="container mt-7"style="margin-top:100px; ">
<?php if ($details->country=='Iran'): ?>
    <span dir="rtl fw-bolder" style="color: white !important; z-index: 100"><a class="fw-bolder" style="color: white !important; float: right" href="mailto: info@shopdomain.com">info@shopdomain.com</a></span>
    <h3 class="fw-bolder" dir="ltr" style="font-size: 12px !important; color:white margin-bottom: 20px;">This domain is for sale</h3>
    <h2 class="fw-bolder" style="font-size: 50px; color:white">این دامنه به فروش میرسد:</h2>
    <?php else: ?>
    <span dir="rtl fw-bolder" style="color: white !important;"><a class="fw-bolder" style="color: white !important; float: right" href="mailto: info@shopdomain.com">info@shopdomain.com</a></span>
    <h3 class="fw-bolder" dir="ltr" style="font-size: 15px; color:white; margin-bottom: 20px; text-align: left">This domain is for sale:</h3>
    <h2 class="fw-bolder mb-4" style="font-size: 30px; color:white; top: 30px;" >این دامنه به فروش میرسد:</h2>
    <?php endif; ?>
</div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-12 col-lg-6">
                <div class="header-page-content text-center text-lg-start row">
                    <h1  class="col-sm-12 "><?= $domain_details['name']; ?></h1>
                    <nav aria-label="breadcrumb" >
                        <ol class="breadcrumb flex-column">
<!--                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>-->
                            <li class="breadcrumb-item active" aria-current="page" style="font-size: 25px"><?= $domain_details['persianname'] ?></li>
                            <li class="breadcrumb-item" aria-current="page" style="font-size: 25px">جزئیات دامنه</li>
                        </ol>
                        <a onclick="tel()" href="tel:<?= $domain_details['tell'] ?>" class="btn btn-blue btn-pill align-items-center col-xl-12 col-sm-6 col-lg-12 col-md-12 mt-2">شماره تماس: 09121235667</a>
                        
                        <a target="_blank" href="http://whois.nic.ir/?name=<?= $domain_details['name'] ?>" class="btn btn-blue btn-pill align-items-center col-xl-12 mt-2 col-lg-12 col-md-12 col-sm-6">whois <i class="fa fa-external-link-alt"></i></a>
                    </nav>
                </div>
            </div>
            <div class="col-sm-12 offset-lg-2 col-lg-4">
                <div class="header-banner" style="border:1px solid white; border-radius: 10px;">
                    <div class="info-card">
                        <div class="info-card-inner full-height" style="padding: 0px!important;">
                            <div style="display:    block;  padding: 10px 40px 10px 0px!important;"><p class="text-white-50" style="font-size: 30px;">تبلیغات</p></div>

                            <hr style="margin: 0!important;padding: 0!important;">
                            <div class="info-card-content" style=" padding: 10px!important; background-color: gray; margin-top: 0px!important;">
                                <h4 style="color: white">  <a style="color: white; " target="_blank" title="تیم سئو" href="https://www.teamseo.ir" >تیم سئو</a><p style="float:left;"><a  style="color: whitesmoke; " target="_blank" title="تیم سئو" href="https://www.teamseo.ir" > <STRONG style="left:0px;"> teamseo.ir </STRONG></a></p></h4><br>
                                    <p style="color: white">  <a style="color: white; " target="_blank" title="تیم سئو" href="https://www.teamseo.ir" > تیم سئو بزگترین مرکز مشاوره سئو و بازاریابی دیجیتال</a></p>
                                
                                
                            </div>
                            <hr style="margin: 0!important;padding: 0!important; color: white">
<!--                            <div class="info-card-content" style="background-color: #413F48; padding: 10px!important; margin-top: 0px!important;">-->
<!--                                <h4 style="color: white;"><a style="color: white; margin-top:0px!important; margin-bottom:0px!important;" target="_blank" title="آی تی تیم" href="https://www.itteam.ir" >آی تی تیم</a><p style="float: left; margin-top:0px!important; margin-bottom:0px!important; " ><a  style="color: whitesmoke" target="_blank" title="آی تی تیم" href="https://www.itteam.ir" ><STRONG> itteam.ir </STRONG> </a></p></h4><br>-->
<!--                                <p style="color: white"><a  style="color: white; margin-top:0px!important; margin-bottom:0px!important;" target="_blank" title="آی تی تیم" href="https://www.itteam.ir" >خدمات نرم افزار و سایت و آموزش آی تی تیم</a></p>-->
<!--                                -->
<!--                                -->
<!--                            </div>-->
<!--							<hr style="margin: 0!important;padding: 0!important;">-->
                            <div class="info-card-content mt-0" style=" padding: 10px!important; background-color: gray; margin-top: 0px!important;">
                               
                                 <a  target="_blank" title="استخدام" href="https://itteam.ir/recruitment/" ><p style="color: white">  استخدام کاراموز و برنامه نویس <STRONG> ای تی تیم</STRONG>  </p></a>
                            
                                
                            </div>
							  <hr style="margin: 0!important;padding: 0!important;">
                            <div class="info-card-content" style="background-color: #413F48; padding: 10px!important; margin-top: 0px!important;">
                                <h4 style="color: white;"><a style="color: white; margin-top:0px!important; margin-bottom:0px!important;" target="_blank" title="آی تی تیم" href="https://www.itteam.ir" >آی تی تیم</a><p style="float: left; margin-top:0px!important; margin-bottom:0px!important; " ><a  style="color: whitesmoke" target="_blank" title="آی تی تیم" href="https://www.itteam.ir" ><STRONG> itteam.ir </STRONG> </a></p></h4><br>
                                <p style="color: white"><a  style="color: white; margin-top:0px!important; margin-bottom:0px!important;" target="_blank" title="آی تی تیم" href="https://www.itteam.ir" >خدمات نرم افزار و سایت و آموزش آی تی تیم</a></p>
                                
                                
                            </div>

                </div>
            </div>
        </div>
            </div>
        </div>
    </div>
</header>


<section class="pricing-section pt-100 pb-70">
    <div class="container">
        <div class="pricing-hosting-table">
            <table>
                <thead>
                <tr>
                    <th>
                        <div class="pricing-header-title">
                            <div class="pricing-header-title-text">نام دامنه</div>
                        </div>
                    </th>
                    <th>
                        قیمت
                    </th>

                    <th>
                        شماره تماس
                    </th>
                </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="td-list-name td-bg"><?php if($domain_details['vip']) echo '<img src="assets/images/vip.png" alt="">'; ?> <?= $domain_details['name']; ?></td>
                        <td class="td-check"><?= $domain_details['price']; ?></i></td>
                        <td class="td-check fw-bolder" dir="ltr"><a class="btn-pill" href="tel:<?= $domain_details['tell']; ?>">تماس بگیرید</a></i></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php include "layouts/footer.php";?>

<div class="scroll-top" id="scrolltop">
    <div class="scroll-top-inner">
        <span><i class="flaticon-up-arrow"></i></span>
    </div>
</div>
<?php include "layouts/analize.php";?>
<script>
    function tel(){
        <?php
        $view = "SELECT * FROM viewsclick WHERE  domainname ='".$domain_details['name'] ."'";
        $view = mysqli_query($connection,$view);
        $view = mysqli_fetch_assoc($view);
        $count = $view['views'];
        $count++;
        $ter = "UPDATE viewsclick SET views = '".$count."' WHERE domainname ='".$domain_details['name'] ."'";
        $ter = mysqli_query($connection , $ter);
        ?>
    }
</script>
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
</html>