<?php
include "connection.php";
if (!isset($_GET['url'])) {
    header("Location: index.php");
}
else{
    $query = "SELECT * FROM domains INNER JOIN users ON domains.userID=users.userID WHERE url='".$_GET['url']."'";

    $query = mysqli_query($connection,$query);
    $domain_details =  mysqli_fetch_assoc($query);
    // number of views
        $show_views = 0;
        $views = mysqli_query($connection, "SELECT * FROM `views` WHERE DomainID = '".$domain_details['Domainid']."'");
        $views = mysqli_fetch_assoc($views);
        $num_views = $views['NumViews'] + 1;
        if ( mysqli_query($connection,"UPDATE `views` SET `NumViews`='".$num_views."' WHERE DomainID = '".$domain_details['Domainid']."'")){
            $show_views = mysqli_query($connection, "SELECT * FROM `views` WHERE DomainID = '".$domain_details['Domainid']."'");
            $show_views = mysqli_fetch_assoc($show_views);

        }
    // end of views




        if (!empty($domain_details['categoryID'])) {
            $categories = json_decode($domain_details['categoryID']);
            $domain_categories = [];
            foreach ($categories as $category) {
                $domain_categories_query = "SELECT categoryName FROM `categories` WHERE categoryID='" . $category . "'";
                $domain_categories_query = mysqli_query($connection, $domain_categories_query);
                $domain_categories_query = mysqli_fetch_assoc($domain_categories_query);
                array_push($domain_categories, $domain_categories_query['categoryName']);

            }
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
    <title>فروش دامنه <?= $domain_details['name']." | ".$domain_details['persianname']; ?></title>
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




<header class="header-banner header-page blue-gradient">

    <?php include "layouts/side_header.php";?>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-12 col-lg-6">
                <div class="header-page-content text-center text-lg-start">
                    <h1 style="text-transform: lowercase;"><?php $ad = strtolower($domain_details['name']); echo $ad; ?></h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">بازگشت به خانه</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $domain_details['persianname']; ?></li>
                        </ol>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">دسته بندی ها</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php if (!empty($domain_details['categoryID'])) echo implode(' , ',$domain_categories); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-sm-12 offset-lg-3 col-lg-3">
                <div class="header-page-image">
                    <img src="assets/images/vps-header-shape.png" alt="shape">
                </div>
            </div>
        </div>
    </div>
</header>


<section class="pricing-section pt-100 pb-70">
    <div class="container">

        <div class="pricing-hosting-table">
            <table>

                <tbody>

                    <tr>
                        <td class="pricing-header-title-text">دامنه</i></td>
                        <td class="td-cancel"><?= $domain_details['name']; ?></i></td>
                        <!--                        <td class="td-check">--><?php //if (is_numeric($domain_details['price']))echo number_format($domain_details['price'])." تومان"; else echo $domain_details['price']; ?><!--</i></td>-->


                    </tr>
<!--                    <tr>-->
<!--                        <td class="td-check">دامنه با حروف بزرگ</i></td>-->
<!--                        <td class="td-check">--><?//= strtoupper($domain_details['name']); ?><!--</i></td>-->
<!---->
<!---->
<!---->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td class="td-check">دامنه با حروف کوچک</i></td>-->
<!--                        <td class="td-check">--><?//= strtolower($domain_details['name']); ?><!--</i></td>-->
<!---->
<!---->
<!---->
<!--                    </tr>-->
                    <tr>
                        <td class="td-check">تعداد کاراکتر دامنه</i></td>
                        <td class="td-check"><?=  strpos( $domain_details['name'], '.', 0 ) ?></i></td>



                    </tr>

                    <tr>
                        <td class="td-check" dir="ltr">نام فارسی دامنه</td>
                        <td class="td-check"><?= $domain_details['persianname'];   ?></td>
                    </tr>
                    <tr>

                        <td class="td-check">شماره تماس</td>
                        <td class="td-check" dir="ltr"><a href="tel: <?=$domain_details['tell']; ?>"><?= $domain_details['tell']; ?></a></td>
                    </tr>
                    <tr>
                        <td class="td-check" dir="ltr">قیمت</td>
                        <td class="td-check"><?php if (is_numeric($domain_details['price']))echo number_format($domain_details['price'])." تومان"; else echo $domain_details['price']; ?></td>
                    </tr>
                    <tr>
                        <td class="td-check" dir="ltr">محتوا سایت</td>
                        <td class="td-check"><?php if ( $domain_details['content']){echo "دارد";}else{echo "ندارد";}   ?></td>
                    </tr>
                    <tr>
                        <td class="td-check" dir="ltr">دسته بندی ها</td>
                        <td class="td-check"><?php if (!$domain_categories)
                        {echo "ندارد";}
                            else { echo implode(' , ',$domain_categories); }
                            ?></td>
                    </tr>
                    <tr>
                        <td class="td-check" dir="ltr">تعداد بازدید</td>
                        <td class="td-check"><?php echo $show_views['NumViews'];   ?></td>
                    </tr>
                    <tr>
                        <td class="td-check" dir="ltr">توضیحات</td>
                        <td class="td-check"><?php echo $domain_details['url'];   ?></td>
                    </tr>

                </tbody>

                <div class="col-sm-12 col-md-12 col-lg-5 pb-30">
                    <div class="faq-accordion">

                        <div class="faq-accordion-item bg-white">
                            <div class="faq-accordion-header">
                                <h3 class="faq-accordion-title">چرا از پرداخت امن استفاده کنیم؟</h3>
                            </div>
                            <div class="faq-accordion-body">
                                <div class="faq-accordion-body-inner">
                                    <p class="faq-accordion-para">در خرید امن پس از پرداخت مبلغ دامنه ما دامین مورد نظر شما را از فروشنده گرفته و پس از دریافت دامنه مبلغ را به فروشنده مورد نظر پرداخت کرده و دامنه را تحویل شما میدهیم تا خریدی امن را برای شما فراهم کنیم</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>



            </table>
            <br>
            <br><br><br>
            <?php

            if ($domain_details['vitrin'] == 1):
                ?>
                <figure>
                    <img src="assets/images/web/<?=$domain_details['url'] ?>.jpg" alt="Trulli" style="width:100%">

                    

                </figure>

            <?php endif; ?>

    </div>
</section>
<!--related domains-->
<section class="choose-section pt-100 pb-70">
    <div class="container">
        <div class="section-title section-title-two">

            <?php
            $readysites = "SELECT * FROM domains WHERE vitrin = 1";
            $readysites = mysqli_query($connection,$readysites);
            $readysites = mysqli_fetch_assoc($readysites);
            if ($readysites['vitrin'] == 1):

            ?>
                <h2>سایت های اماده</h2>
                <p>سایت های اماده موجود در شاپ دامین</p>
            <?php else: ?>
                <h2>دامنه های مشابه</h2>
                <p>دامنه های موجود در شاپ دامین</p>
            <?php endif; ?>


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
                        جزئیات
                    </th>
                </tr>
                </thead>


                <tbody>
                <?php
                $array_domains = [];
                foreach ($categories as $related_category) {
                    $formquery = "SELECT * FROM `domains` WHERE categoryID LIKE  '%" . $related_category . "%' ORDER BY lastupdate DESC LIMIT 15";
                    $formquery = mysqli_query($connection, $formquery);
                    $same_domain = mysqli_fetch_assoc($formquery);
//                    if ($same_domain['name']!= $domain_details['name']):
                    while ($fetchpush = mysqli_fetch_assoc($formquery)) {
                        array_push($array_domains, $fetchpush['Domainid']);
                    }
                }

                if ($readysites['vitrin'] == 1):

                    $readysites = "SELECT * FROM domains WHERE vitrin = 1";
                    $readysites = mysqli_query($connection,$readysites);
                    while($readysite = mysqli_fetch_assoc($readysites)):
                    ?>
                    <tr>
                        <td class="td-list-name td-bg"><?php if($readysite['vip']) echo '<img src="assets/images/vip.png" alt="">'; ?> <?= $readysite['name']; ?></td>
                        <td class="td-cancel"><?= $readysite['persianname']; ?></i></td>
                        <td class="td-check"><?php if (is_numeric($readysite['price']))echo number_format($readysite['price'])." تومان"; else echo $readysite['price']; ?></i></td>
                        <td class="td-check"><?php if ($readysite['content']) echo "دارد"; else echo "ندارد"; ?></i></td>
                        <td class="td-check"><a target="_blank" href="domain-details.php?url=<?= $readysite['url'];   ?>">تماس بگیرید</a></td>
                        <td class="td-check"><a target="_blank" href="domain-details.php?url=<?= $readysite['url'];   ?>">جزئیات بیشتر...</a></td>
                    </tr>
                <?php
                endwhile;
                else:


                if (empty($array_domains)){
                    echo "<tr><td>دامنه مشابه نیست!</td></tr>";
                }
                else{
                $array_domains = array_unique($array_domains);
                $array_domains = array_diff($array_domains, [$domain_details['Domainid']]);
                        foreach ( $array_domains as $array_domain):
                        $array_query = mysqli_query($connection,"SELECT * FROM `domains` WHERE Domainid = '".$array_domain."'");
                        $fetchform = mysqli_fetch_assoc($array_query);
                    ?>

                    <tr>
                        <td class="td-list-name td-bg"><?php if($fetchform['vip']) echo '<img src="assets/images/vip.png" alt="">'; ?> <?= $fetchform['name']; ?></td>
                        <td class="td-cancel"><?= $fetchform['persianname']; ?></i></td>
                        <td class="td-check"><?php if (is_numeric($fetchform['price']))echo number_format($fetchform['price'])." تومان"; else echo $fetchform['price']; ?></i></td>
                        <td class="td-check"><?php if ($fetchform['content']) echo "دارد"; else echo "ندارد"; ?></i></td>
                        <td class="td-check"><a target="_blank" href="domain-details.php?url=<?= $fetchform['url'];   ?>">تماس بگیرید</a></td>
                        <td class="td-check"><a target="_blank" href="domain-details.php?url=<?= $fetchform['url'];   ?>">جزئیات بیشتر...</a></td>
                    </tr>
                <?php endforeach;
                }
                endif;
                ?>
                </tbody>
            </table>

            <br>
            <a href="search-domain.php" target="_blank" class="btn btn-gradient" style="text-align: center">
                سایر دامنه ها
            </a>
            <br>
        </div>
    </div>
</section>
<!--end related domains-->


<?php include "layouts/footer.php"; ?>

<div class="scroll-top" id="scrolltop">
    <div class="scroll-top-inner">
        <span><i class="flaticon-up-arrow"></i></span>
    </div>
</div>


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