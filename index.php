<?php include "connection.php";function secondsToTime($seconds) {
    $seconds = time() - $seconds;
    $time = [];
    $minutes = $seconds / 60;
    $seconds = $seconds % 60;
    $hours = $minutes / 60;
    $minutes = $minutes % 60;
    $days = $hours / 24;
    $hours = $hours % 24;
    $month = $days /30;
    $days = $days % 30;
    $year = $month / 12;
    $month = $month % 12;
    if ((int)($year) != 0){
        $time =  array_merge($time,array( "year" => (int)($year)));
        return [$year,"سال پیش"];
    }
    if ($month != 0){
        $time =  array_merge($time, array("months" => $month));
        return [$month,"ماه پیش"];
    }
    if ($days != 0){
        $time =   array_merge($time,array("days" => $days));
        return [$days,"روز پیش"];
    }
    if ($hours != 0){
        $time =  array_merge($time,array("hours" => $hours));
        return [$hours,"ساعت پیش"];
    }
    if ($minutes != 0){
        $time =  array_merge($time,array("minutes" => $minutes));
        return [$minutes,"دقیقه پیش"];
    }
    if ($seconds != 0){
        $time =   array_merge($time,array("seconds" => $seconds));
        return [$seconds,"ثانیه پیش"];
    }
} ?>

<!DOCTYPE html>
<html lang="zxx" dir="rtl">
<head>
    <script>
        console.log("this site designed and developed by reza hazratgholizadeh namin and saeed madadi");
        console.log("saeed madadi: +989126827403");
        console.log("reza hazratgholizadeh namin: +989378262138");
    </script>
    <script>
        function showResult(str) {
            if (str.length==0) {
                document.getElementById("livesearch").innerHTML="";
                document.getElementById("livesearch").style.border="0px";

                return;
            }
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                    document.getElementById("livesearch").innerHTML=this.responseText;
                    document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                    document.getElementById("livesearch").style.position="absolute";
                    document.getElementById("livesearch").style.top="58px";
                    document.getElementById("livesearch").style.width="100%";
                    document.getElementById("livesearch").style.backgroundColor="white";
                    document.getElementById("livesearch").style.padding="10px";
                    document.getElementById("livesearch").style.borderRadius="23px";


                }
            }
            xmlhttp.open("GET","livesearch/livesearch.php?q="+str,true);
            xmlhttp.send();
        }
    </script>
    <meta charset="utf-8">
    <meta name="description" content="Aila">
    <meta name="keywords" content="HTML,CSS,JavaScript">
    <meta name="author" content="HiBootstrap">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <title>فروشگاه آنلاین دامنه</title>
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
    <script src="assets/js/NumberFormat.js"></script>
    <style>
        .search_live:last-child{
            border-bottom: 1px solid white;
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
<header class="header-banner header-bg-shape-three">

<?php include "layouts/header.php";?>
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="header-width header-main-content-three desk-ml-auto">
                    <div class="header-content-tab">
                        <div class="header-tab-shadow">
                            <div class="header-tab-shadow-inner"></div>
                        </div>
                        <div class="header-tab-alert"><a href="pluscustomer.php"><i class="flaticon-bell-1"></i></div>
                        <div class="header-tab-content">تعرفه فروشنده ویژه</div></a>
                    </div>
                    <h1>  فروشگاه<span> دامنه</span></h1>
                    <ul class="header-content-list" style="display: inline-block">
                        <!--                        <li><i class="flaticon-tick"></i></li>-->
                        <li><i class="flaticon-tick"></i>خرید امن</li>

                        <li><i class="flaticon-tick"></i>پشتیبانی حتی در روز های تعطیل</li>
                    </ul>
                    <div class="domain-search domain-search-three">
                        <form method="GET" action="search-domain.php">
                            <div class="form-group">
                                <input type="text" class="form-control"  name="searchitem" placeholder="دامنه مورد نظر  خود را بیابید...">
                                <!--                                <div class="input-group-append">-->
                                <!--                                    <select class="form-control">-->
                                <!--                                        <option value="1">.com</option>-->
                                <!--                                        <option value="2">.co</option>-->
                                <!--                                        <option value="3">.net</option>-->
                                <!--                                    </select>-->
                                <!--                                </div>-->
                                <button class="btn btn-gradient" name="search_result" value="search">جستجو کنید</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="header-content-image">
                    <img src="assets/images/header-clipart-3.png" alt="clipart">
                </div>
            </div>
        </div>
    </div>
    <div class="header-shape-content">
        <div class="header-shape-item">
            <img src="assets/images/header-shape-3.png" alt="shape">
        </div>
    </div>
</header>
<!--end header-->



<section class="feature-section  pb-70">
    <div class="container">
        <div class="section-title section-title-two">

            <h2>سایت های اماده</h2>
            <p>همین الان صاحب سایت اماده با دامنه بشوید</p>
        </div>
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
                          نام فارسی دامنه
                    </th>
                    <th>
                        قیمت
                    </th>
                    <th>
                        محتوا
                    </th>
                    <th>
                        شماره تماس
                    </th>

                    <th>
                        جزئیات
                    </th>
                </tr>
                </thead>

                <tbody>
                <?php
                $formquery = "SELECT * FROM `domains` WHERE vitrin = 1 ORDER BY lastupdate DESC";
                $formquery = mysqli_query($connection,$formquery);
                while ($fetchform = mysqli_fetch_assoc($formquery)):


                    ?>

                    <tr>
                        <td class="td-list-name td-bg"><?= $fetchform['name']; ?></td>
                        <td class="td-cancel"><?= $fetchform['persianname']; ?></i></td>
                        <td class="td-check"><?php if (is_numeric($fetchform['price']))echo number_format($fetchform['price'])." تومان"; else echo $fetchform['price']; ?></i></td>
                        <td class="td-check"><?php if ($fetchform['content']) echo "دارد"; else echo "ندارد"; ?></i></td>
                        <td class="td-check" dir="ltr"><a target="_blank" href="domain-details.php?url=<?= $fetchform['url'];   ?>">تماس بگیرید</a></td>
                        <td class="td-check"><a target="_blank" href="domain-details.php?url=<?= $fetchform['url'];   ?>">جزئیات بیشتر...</a></td>
                    </tr>

                <?php endwhile; ?>

                </tbody>
            </table>

        </div>
        <br>
        <a href="search-domain.php" target="_blank" class="btn btn-gradient" style="text-align: center">
            موارد بیشتر
        </a>
        <br>
    </div>
</section>




<section class="choose-section pt-100 pb-20">
    <div class="container">
        <div class="section-title section-title-two">

            <h2>دامنه ها</h2>
            <p>دامنه های موجود در شاپ دامین</p>
        </div>
        <div class="pricing-hosting-table">
            <table>
                <thead>
                <tr>
                    <th>
                        <div class="pricing-header-title">
                            <div class="pricing-header-title-text">domain name</div>
                        </div>
                    </th>
                    <th>
                       نام فارسی
                    </th>
                    <th>
                        قیمت
                    </th>
                    <th>
                        محتوا
                    </th>
                    <th>
                        شماره تماس
                    </th>

                    <th>
                        بروزرسانی شده
                    </th>
                    <th>
                        جزئیات
                    </th>
                </tr>
                </thead>

                <tbody>
                <?php
                $formquery = "SELECT * FROM `domains` WHERE vip=0 ORDER BY lastupdate DESC LIMIT 15";
                $formquery = mysqli_query($connection,$formquery);
                while ($fetchform = mysqli_fetch_assoc($formquery)):


                    ?>

                    <tr>
                        <td class="td-list-name td-bg"><?php if($fetchform['vip']) echo '<img src="assets/images/vip.png" alt="">'; ?> <?= $fetchform['name']; ?></td>
                        <td class="td-cancel"><?= $fetchform['persianname']; ?></i></td>
                        <td class="td-check"><?php if (is_numeric($fetchform['price']))echo number_format($fetchform['price'])." تومان"; else echo $fetchform['price']; ?></i></td>
                        <td class="td-check"><?php if ($fetchform['content']) echo "دارد"; else echo "ندارد"; ?></i></td>
                        <td class="td-check" dir="ltr"><a target="_blank" href="domain-details.php?url=<?= $fetchform['url'];   ?>">تماس بگیرید</a></td>
                        <td class="td-check" dir="rtl"><?=  implode( " ",secondsToTime($fetchform['lastupdate'])); ?></td>
                        <td class="td-check"><a target="_blank" href="domain-details.php?url=<?= $fetchform['url'];   ?>">جزئیات بیشتر...</a></td>
                    </tr>

                <?php endwhile; ?>

                </tbody>
            </table>

        </div>
        <br>
        <a href="search-domain.php" target="_blank" class="btn btn-gradient" style="text-align: center">
            موارد بیشتر
        </a>
        <br>
    </div>
</section>

<div class="offer-section position-relative section-ptb-180 overflow-hidden">
    <div class="cloud-shape-bg">
        <div class="cloud-shape-image">
            <img src="assets/images/cloud-shape-1.png" alt="shape">
        </div>
    </div>
    <div class="container position-relative">
        <div class="row margin-minus-box">
            <div class="col-sm-12 col-lg-6">
                <div class="feature-item fluid-height">
                    <div class="feature-item-inner full-height bg-white">
                        <div class="feature-item-thumb">
                            <i class="flaticon-cloud-computing"></i>
                        </div>
                        <div class="feature-item-content">
                            <h3>رایگان در ویترین</h3>
                            <p>در صورت داشتن دامنه با نام مناسب به ما تیک ارسال کرده تا در ویترین به صورت رایگان قرار بگیرید</p>
                            <p><a href="dedicated-hosting.html" class="gradient-text">ارسال تیکت <span><i
                                                class='bx bx-chevron-left'></i></span></a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6">
                <div class="feature-item fluid-height">
                    <div class="feature-item-inner full-height bg-white">
                        <div class="feature-item-thumb">
                            <i class="flaticon-cloud-hosting"></i>
                        </div>
                        <div class="feature-item-content">
                            <h3>Free in the showcase</h3>
                            <p>If you have a domain with a suitable name, send us a check to be in the showcase for free</p>
                            <p><a href="cloud-hosting.html" class="gradient-text">send us a check <span><i
                                                class='bx bx-chevron-left'></i></span></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="platform-section pb-70">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-12 col-lg-6">
                <div class="about-content-item pb-30">
                    <div class="about-content-data">
                        <div class="about-text">
                            <h3>تاثیرات دامنه مناسب بر روی سایت شما</h3>

                        </div>
                        <ul class="about-list">
                            <li>
                                <div class="about-list-check about-list-check-off-white"><i class="flaticon-tick"></i>
                                </div>
                                <div class="about-list-content">
                                    <h3>افزایش کلاس کاری</h3>
                                    <p>با داشتن دامنه منساب با محتوای سایت شما کلاس کاری شما بشدت افزایش خواهد یافت</p>
                                </div>
                            </li>
                            <li>
                                <div class="about-list-check about-list-check-off-white"><i class="flaticon-tick"></i>
                                </div>
                                <div class="about-list-content">
                                    <h3>بهبود سئوی سایت</h3>
                                    <p>دامنه مناسب بدلیل سرچ بالا در گوگل باعث افزایش سئو شما خواهد شد</p>

                                </div>
                            </li>
                            <li>
                                <div class="about-list-check about-list-check-off-white"><i class="flaticon-tick"></i>
                                </div>
                                <div class="about-list-content">
                                    <h3>برندینگ</h3>
                                    <p>دامنه مناسب و رند باعث میشود شرکت شما تبدیل به یک برند شده و مسیر پیشرفت موقثیت شما بشدت افزایش یاید</p>

                                </div>
                            </li>
                            <li>
                                <div class="about-list-check about-list-check-off-white"><i class="flaticon-tick"></i>
                                </div>
                                <div class="about-list-content">
                                    <h3>وارد صفحه اول گوگل شوید</h3>
                                    <p>سئو و تولید محتوا از مهم ترین بخش های سایت شما هستید برای اشنایی با اخرین متود های سئو میتوانید به لینک زیر رجوع کنید</p>
                                    <a href="teamseo.ir"><strong>teamseo.ir</strong></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6">
                <div class="about-content-item desk-pad-left-30 pb-30">
                    <div class="about-content-image image-margin-left">
                        <img src="assets/images/support-2.png" alt="support">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<section class="testimonial-section bg-off-white position-relative overflow-hidden mm">
    <div class="cloud-shape-top">
        <div class="cloud-shape-image">
            <img src="assets/images/cloud-shape-1.png" alt="shape">
        </div>
    </div>
    <div class="container">
        <div class="section-title">

            <h2>چرا شاپ دامین</h2>
        </div>
        <div class="">
            <div class="">
                <div class="item">
                    <div class="row align-items-end">
                        <div class="col-sm-12 col-md-12 col-lg-5">
                            <div class="client-image">

                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 pb-100">
                            <div class="client-carousel-details text-center text-lg-start">
                                <p class="client-carousel-para">شاپ دامین با بدلیل بازدید بالا و همچنین قیمت مناسب برای فروشنده ویژه شدن و داشتن بخش خرید امن برای افرادی ک میخواهد مطمءن خرید کنند بهترین سایت خرید و فروش دامنه میباشید</p>
<!--                                <h3 class="client-carousel-name">Devit m. kotlin</h3>-->
<!--                                <h4 class="client-carousel-designation">CEO & Founder</h4>-->
                            </div>
                        </div>
                    </div>
                </div>
                    </div>
                </div>
            </div>
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