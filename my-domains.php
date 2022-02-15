<?php
include "connection.php";
$errors=[];
//include "uploadlogo.php";

if (isset($_POST['submit'])) {
    $status = true;
    if (!preg_match('/^[^\x{600}-\x{6FF}]+$/u', str_replace("\\\\", "", $_POST['domain_name'] ))) {

    } else {
        array_push($errors,'متن فارسی نیست!') ;
        $status = false;
    }
    if (empty($_POST['url'])) {
        array_push($errors, "بخش url را کامل کنید");
        $status = false;
    }
    if (empty($_POST['domain_name'])) {
        $_POST['domain_name'] = $_POST['url'].$_POST['domain_ext'];
    }
    if (empty($_POST['tel'])) {
        array_push($errors, "شماره تلفن خود را وارد کنید");
        $status = false;
    }
    if (empty($_POST['price'])) {
        array_push($errors, "مبلغ دلخواه خود را وارد کنید");
        $status = false;
    }
    if ( $_POST['price']!= "بالاترین پیشنهاد") {
        if ($_POST['price'] != "توافقی") {
            if ($_POST['price'] > 2500000000) {
                array_push($errors, "حداکثر مبلغ دامین دومیلیارد و پونصد تومن معادل بیست و پنج میلیارد ریال می باشد");
                $status = false;
            }
        }
    }
    if (!empty($_POST['tel'])) {


        if (strlen($_POST['tel']) > 11 || strlen($_POST['tel']) < 11){
            array_push($errors,'شماره موبایل باید یازده حرف باشد و با صفر شروع شود');
            $status = false;
        }
        if(preg_match("/^09[0-9]{9}$/", $_POST['tel'])) {

        }else{
            array_push($errors, "شماره موبایل معتبر نیست");
            $status = false;
        }

    }
    if (empty($_POST['categories'])){
        array_push($errors, "حداقل یک دسته بندی را انتخاب کنید");
        $status = false;
    }
        if ($status){
        $unique = "SELECT `name` FROM `domains` WHERE name='" . $_POST['url'] . $_POST['domain_ext'] . "'";
        $unique = mysqli_query($connection, $unique);
        $checkingurl = "https://www.".$_POST['url'].$_POST['domain_ext'];
//    var_dump(filter_var("rasdigimarket.com" , FILTER_VALIDATE_URL));
//    die();
            if (!filter_var($checkingurl , FILTER_VALIDATE_URL)){
                array_push($errors,"دامین ثبت شده معتبر نیست");
            }
            else{
                if (mysqli_num_rows($unique)) {
                    array_push($errors, 'این دامین قبلا در سیستم ثبت شده است');

                } else {
                    $category = "[" . implode(",", $_POST['categories']) . "]";
//                    $logo_url = Upload_Logo('logo');
                    $set_time = time();
                    $url = str_replace(".", "-", $_POST['url'] . $_POST['domain_ext']);
                    $checkinguser = "SELECT userID,mobile FROM users WHERE access_token='" . $_COOKIE['user'] . "'";

                    $checkinguser = mysqli_query($connection, $checkinguser);
                    $checkinguser = mysqli_fetch_assoc($checkinguser);

                    $query = "INSERT INTO `domains`(`name`, `persianname`, `tell`, `price`, `content`, `categoryID`  , `userID` , `lastupdate` , `url`) VALUES ('" . strip_tags($_POST['url']) . $_POST['domain_ext'] . "','" . strip_tags($_POST['domain_name']) . "','" . strip_tags($_POST['tel']) . "','" . strip_tags($_POST['price']) . "','" . strip_tags($_POST['content']) . "','" . $category . "' , '" . $checkinguser['userID'] . "' , '" . $set_time . "' , '" . $url . "')";
                    $query = mysqli_query($connection, $query);
                    if ($query) {
                        array_push($errors, "دامین شما با موفقیت ثبت شده است");
                    } else {
                        array_push($errors, "در سیستم مشکلی رخ داد دوباره امتحان کنید");
                    }
                }
            }
    }

}

?>


<!doctype html>
<html dir="rtl" lang="zxx">
<head>
    <style>
        /* Chrome, Safari, Edge, Opera */
        #price::-webkit-outer-spin-button,
        #price::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        #price[type=number] {
            -moz-appearance: textfield;
        }
        .priced{
            margin-left: 20px;
            direction: rtl;

        }
        .priced::placeholder{
           text-align: right;

            /*background-color: #0b0b0b;*/
        }
    </style>
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
    <link rel="stylesheet" href="assets/css/select2.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="assets/js/select2.min.js"></script>
    </head>
<body>
<div class="preloader blue-gradient">
    <div class="preloader-wrapper">
        <div class="preloader-img">
            <img src="assets/images/loader.gif" alt="preloader">
        </div>
    </div>
</div>


<!--<div class="topbar bg-off-white-two">-->
<!--    <div class="container">-->
<!--        <div class="topbar-inner">-->
<!--            <div class="topbar-item">-->
<!--                <div class="topbar-item-list">-->
<!--                    <div class="topbar-list-thumb">-->
<!--                        <i class="flaticon-chat"></i>-->
<!--                    </div>-->
<!--                    <div class="topbar-list-content">-->
<!--                        <a href="#">Chat With A Consultant</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="topbar-item-list">-->
<!--                    <div class="topbar-list-thumb">-->
<!--                        <i class="flaticon-phone"></i>-->
<!--                    </div>-->
<!--                    <div class="topbar-list-content">-->
<!--                        <a href="tel:678-215-7765">+678-215-7765</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="topbar-item">-->
<!--                <div class="topbar-item-list">-->
<!--                    <div class="topbar-list-thumb">-->
<!--                        <i class="flaticon-chat"></i>-->
<!--                    </div>-->
<!--                    <div class="topbar-list-content">-->
<!--                        <a href="https://templates.hibootstrap.com/cdn-cgi/l/email-protection#274e49414867454b4e4a0944484a"><span-->
<!--                                class="__cf_email__" data-cfemail="b7ded9d1d8f7d5dbdeda99d4d8da">[email&#160;protected]</span></a>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="topbar-item-list navbar-language">-->
<!--                    <button class="language-option" type="button" id="language1" data-bs-toggle="dropdown"-->
<!--                            aria-haspopup="true" aria-expanded="false">-->
<!--                        <span class="lang-name"></span>-->
<!--                        <span class="language-arrow"><i class='bx bx-chevron-down'></i></span>-->
<!--                    </button>-->
<!--                    <div class="dropdown-menu language-top-menu" aria-labelledby="language1">-->
<!--                        <a class="dropdown-item" href="#">-->
<!--                            <img src="assets/images/uk.png" alt="flag" class="dropdown-flag-icon">-->
<!--                            English-->
<!--                        </a>-->
<!--                        <a class="dropdown-item" href="#">-->
<!--                            <img src="assets/images/germany.png" alt="flag" class="dropdown-flag-icon">-->
<!--                            Deutsch-->
<!--                        </a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!--start header-->
<?php include "layouts/header.php";?>
<!--end header-->
<div class="col-sm-12 col-lg-12 p-0" style="height: auto">
    <div class="authentication-item bg-white">
        <div class="authentication-user-panel">
            <div class="authentication-user-header">
                <h1>افزودن دامنه</h1>
            </div>
            <div class="authentication-user-body">
                <div class="authentication-tab">

                </div>
                <div class="authentication-tab-details">
                    <div class="authentication-tab-details-item authentication-tab-details-active" data-authentcation-details="1">
                        <div class="authentication-form">
                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <p style="display: inline-block"><h4 style="color: red; display: inline-block;" > پسوند دامنه</h4></p>
                                        <br>
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="flaticon-domain"></i></span>
                                                </div>

                                                <p>پسوند دامنه</p>
                                                <div class="input-group-append" style="border:1px solid gray;width: 20%; text-align: center; ">

                                                    <select class="form-control" name="domain_ext" dir="ltr">
                                                        <option value=".ir">.ir</option>
                                                        <option value=".com">.com</option>
                                                        <option value=".ایران">.ایران</option>
                                                        <option value=".بازار">.بازار</option>
                                                        <option value=".xyz">.xyz</option>
                                                        <option value=".net">.net</option>
                                                        <option value=".org">.org</option>
                                                        <option value=".vip">.vip</option>
                                                        <option value=".ae">.ae</option>
                                                        <option value=".biz">.biz</option>
                                                        <option value=".asia">.asia</option>
                                                        <option value=".cc">.cc</option>
                                                        <option value=".bz">.bz</option>
                                                        <option value=".club">.club</option>
                                                        <option value=".id.ir">.id.ir</option>
                                                        <option value=".co">.co</option>
                                                        <option value=".im">.im</option>
                                                        <option value=".in">.in</option>
                                                        <option value=".info">.info</option>
                                                        <option value=".me">.me</option>
                                                        <option value=".li">.li</option>
                                                        <option value=".dev">.dev</option>
                                                        <option value=".market">.market</option>
                                                        <option value=".ltda">.ltda</option>
                                                        <option value=".wiki">.wiki</option>
                                                        <option value=".press">.press</option>
                                                        <option value=".best">.best</option>
                                                        <option value=".sh">.sh</option>
                                                        <option value=".store">.store</option>
                                                        <option value=".io">.io</option>
                                                        <option value=".mobi">.mobi</option>
                                                        <option value=".app">.app</option>
                                                        <option value=".football">.football</option>
                                                        <option value=".computer">.computer</option>

                                                        <option value=".name">.name</option>
                                                        <option value=".data">.date</option>
                                                        <option value=".work">.work</option>
                                                        <option value=".art">.art</option>
                                                        <option value=".tk">.tk</option>

                                                        <option value=".pro">.pro</option>
                                                        <option value=".win">.win</option>
                                                        <option value=".pw">.pw</option>
                                                        <option value=".tel">.tel</option>
                                                        <option value=".tips">.tips</option>
                                                        <option value=".bid">.bid</option>
                                                        <option value=".tv">.tv</option>
                                                        <option value=".clinic">.clinic</option>
                                                        <option value=".blog">.blog</option>
                                                        <option value=".domains">.domains</option>
                                                        <option value=".at">.at</option>
                                                        <option value=".style">.style</option>
                                                        <option value="com.co">.com.co</option>
                                                        <option value=".blue">.blue</option>
                                                        <option value=".red">.red</option>
                                                        <option value=".design">.design</option>
                                                        <option value=".us">.us</option>
                                                        <option value=".shop">.shop</option>
                                                        <option value=".ws">.ws</option>
                                                        <option value=".tech">.tech</option>
                                                        <option value=".site">.site</option>
                                                        <option value=".top">.top</option>
                                                        <option value=".website">.website</option>
                                                        <option value=".host">.host</option>
                                                        <option value=".news">.news</option>
                                                        <option value=".online">.online</option>
                                                        <option value=".love">.love</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <p style="display: inline-block"> نام دامنه &nbsp; <h4 style="color: red; display: inline-block;" > بدون پسوند</h4></p>
                                        <br>
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="flaticon-domain"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="دامنه url" name="url" required  />
                                                <div class="input-group-append" style="border:1px solid gray ">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <p style="display: inline-block"> <h4 style="color: red; display: inline-block;" > پیشوند دامنه</h4></p>
                                        <br>
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="flaticon-domain"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder=".www" disabled  />
                                                <div class="input-group-append" style="border:1px solid gray ">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="flaticon-domain"></i></span>
                                                </div>

                                                    <label class="control-label col-sm-2" for="tags">دسته بندی:</label>
                                                    <select class="form-control select2-multi" name="categories[]" multiple="multiple" id="select">
                                                        <?php
                                                        $query_categories = "SELECT * FROM `categories`";
                                                        $query_categories = mysqli_query( $connection , $query_categories );
                                                        while ($category = mysqli_fetch_assoc($query_categories)){
                                                            echo "<option id='option' value='".$category['categoryID']."'>".$category['categoryName']."</option>";
                                                        }
                                                        ?>
                                                    </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="flaticon-web-hosting"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="نام فارسی دامنه" name="domain_name"   />

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="flaticon-phone"></i></span>
                                                </div>

                                                <input type="text" class="form-control" placeholder="شماره تماس:" name="tel" value="<?php

                                                $checkingmobile = "SELECT mobile FROM users WHERE access_token='" . $_COOKIE['user'] . "'";

                                                $checkingmobile = mysqli_query($connection, $checkingmobile);
                                                $checkingmobile = mysqli_fetch_assoc($checkingmobile);
                                                echo $checkingmobile['mobile'];  ?>"  required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="flaticon-right-arrow"></i></span>
                                                </div>
                                                <label class="ml-10">محتوای سایت</label>
                                                <select class="form-control" name="content" >
                                                    <option value="1">دارد</option>
                                                    <option value="0">ندارد</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group mb-20">
                                            <div class="input-group" style="width: 50%;">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="flaticon-tag"></i></span>
                                                </div>
                                                <input type="number" class="form-control priced" id="price"  placeholder="قیمت به تومان" name="price"  />

                                                <input type="checkbox" class="chb" id="highest_offer" name="price" value="بالاترین پیشنهاد"  onclick="disable_price(this.id)">
                                                <label for="highest_offer">بالاترین پیشنهاد</label><br>
                                                <input type="checkbox" class="chb" id="agreement" name="price" value="توافقی"  onclick="disable_price(this.id)">
                                                <label for="agreement">توافقی</label><br>



                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <button class="btn btn-gradient full-width mb-20" name="submit">افرودن دامنه</button>
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

<section class="pricing-section position-relative pt-100 pb-50" style="top: 100px">
    <div class="cloud-shape-bg-fixed bg-off-white-two">
        <div class="cloud-shape-image">
            <img src="assets/images/cloud-shape-1.png" alt="shape">
        </div>
    </div>
    <div class="container position-relative">
        <div class="section-title section-title-two">

            <h2>دامنه های شما</h2>

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
                        شماره تماس
                    </th>
                    <th>
                        قیمت
                    </th>
                    <th>
                        محتوا
                    </th>

                    <th>
                        زمینه ها
                    </th>
                    <th style="color: red">
                        پاک کردن دامنه
                    </th>

                    <th style="color: blue">
                        بروزرسانی
                    </th>
                </tr>
                </thead>

                <tbody>
                <?php
                $formquery = "SELECT * FROM `domains` INNER JOIN users  ON users.userID=domains.userID WHERE access_token= '".$_COOKIE['user']."'";
                $formquery = mysqli_query($connection,$formquery);
                while ($fetchform = mysqli_fetch_assoc($formquery)):


                    ?>

                    <tr>
                        <td class="td-list-name td-bg"><?php if($fetchform['vip']) echo '<img src="assets/images/vip.png" alt="">'; ?> <?= $fetchform['name']; ?></td>
                        <td class="td-cancel"><?= $fetchform['persianname']; ?></i></td>
                        <td class="td-check"><?= $fetchform['tell']; ?></i></td>
                        <td class="td-check"><?php if (is_numeric($fetchform['price']))echo number_format($fetchform['price'])." تومان"; else echo $fetchform['price'];  ?></i></td>
                        <td class="td-check"><?php if ($fetchform['content']) echo "دارد"; else echo "ندارد"; ?></i></td>
                        <td class="td-check"><?php
                            $json_cat=json_decode($fetchform['categoryID']);

                            if ($json_cat){
                            foreach ( $json_cat as  $categorygetn){
                                $categoryname = "SELECT categoryName FROM `categories` WHERE categoryID = '".$categorygetn."'";
                                $categoryname = mysqli_query($connection,$categoryname);
                                $categoryname = mysqli_fetch_assoc($categoryname);
                                echo $categoryname['categoryName'].' , ';
                            }
                            }else{
                                 echo "کتگوری ندارد";
                            }


                            ?></i></td>
                        <td class="td-check"  onclick="return confirm('آیا از حذف دامنه خود اطمینان دارید؟')"><a   href="delete_domain.php?domainid=<?php echo $fetchform['Domainid'];?>"><i class="flaticon-close" style="color: red" title="حذف دامنه" onclick="delete_domain()"></i> </a></td>
                        <td class="td-check"><a href="update-domains.php?domainupdateid=<?php echo $fetchform['Domainid'];?>" onclick="delete_domain()"><i class="flaticon-refresh" style="color: red" title="ویرایش دامنه" onclick="delete_domain()"></i></a></td>


                    </tr>

                <?php endwhile; ?>

                </tbody>
            </table>
        </div>


    </div>

</section>


<script>
    // the selector will match all input controls of type :checkbox
    // and attach a click event handler
    $("input:checkbox").on('click', function() {
        // in the handler, 'this' refers to the box clicked on
        let $box = $(this);
        if ($box.is(":checked")) {
            // the name of the box is retrieved using the .attr() method
            // as it is assumed and expected to be immutable
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            // the checked state of the group/box on the other hand will change
            // and the current value is retrieved using .prop() method
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });

    $('#highest_offer').click(function () {
        if(!this.checked) {
            document.getElementById("price").value = "";
            $('#price').attr('disabled' , false);
        } else {
            document.getElementById("price").value = "بالاترین پیشنهاد";
            $('#price').attr('disabled' , true);
        }
    });
    $('#agreement').click(function () {
        if(!this.checked) {
            document.getElementById("price").value = "";
            $('#price').attr('disabled' , false);
        } else {
            document.getElementById("price").value = "توافقی";
            $('#price').attr('disabled' , true);
        }
    });
</script>
<script>
    $('.select2-multi').select2();
</script>


<?php
if (isset($_GET['failedupdate'])){
    echo '<script>
        alert("برای بروزرسانی باید حداقل بیست ساعت گذشته باشد")

    </script>';
}
if (isset($_GET['seccessupdate'])){
    echo '<script>
        alert("دامنه بروززسانی شد")

    </script>';
}
?>
<script>
$("#select").change(function () {
if($("select option:selected").length > 5) {
//your code here



    $('.select2-container--default').removeClass("select2-container--open");

}
    else if($("select option:selected").length <= 5) {
//your code here


        $('.select2-container--default').addClass("select2-container--open");



    }
});
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