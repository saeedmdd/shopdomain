<?php
include "connection.php";
$results_per_page = 1;
//find the total number of results stored in the database
$query = "SELECT * FROM domains INNER JOIN users ON domains.userID = users.userID WHERE  access_token='".$_COOKIE['user']."'";
$result = mysqli_query($connection, $query);

$number_of_result = mysqli_num_rows($result);
//determine the total number of pages available
$number_of_page = ceil ($number_of_result / $results_per_page);
//determine which page number visitor is currently on
if (!isset ($_GET['page']) ) {
    $page = 1;
} else {
    $page = $_GET['page'];
}
//determine the sql LIMIT starting number for the results on the displaying page
$page_first_result = ($page-1) * $results_per_page;
//find the total number of results stored in the database
$query_domains = "SELECT * FROM domains INNER JOIN users ON domains.userID = users.userID WHERE  access_token='".$_COOKIE['user']."'  LIMIT  " . $page_first_result . ',' . $results_per_page;
$query_domains = mysqli_query($connection,$query_domains);

$errors = [];





    if (!isset($_COOKIE['user'])) {
        header("Location: index.php");

    }
    $query_edit = "SELECT * FROM `users` WHERE access_token = '" . $_COOKIE['user'] . "'";
    $query_edit = mysqli_query($connection, $query_edit);
    $query_edit = mysqli_fetch_assoc($query_edit);
    date_default_timezone_set('Asia/Tehran');
    $errors = [];
    function check_name($firstname, $lastname)
    {
        global $errors;
        $flag=true;
        if (strlen($firstname) < 2){
            array_push($errors,'نام باید حداقل سه حرف باشد');
            $flag=false;
        }
        if (strlen($lastname) < 2){
            array_push($errors,'نام خانوادگی حداقل باید سه حرف باشه');
            $flag=false;
        }

        $firstname1= str_replace(' ', '', $firstname);;
        $lastname1= str_replace(' ', '', $lastname);;

        if (!ctype_alpha($firstname1)){
            array_push($errors,'برای نام خود فقط حروف انگلیسی وارد کنید');
            $flag = false;
        }
        if (!ctype_alpha($lastname1)){

            array_push($errors,'برای نام خانوادگی خود فقط حروف انگلیسی وارد کنید');

            $flag=false;
        }
        return $flag;
    }

    function check_mobile($mobile)
    {
        global $errors;
        $flag=true;
        if (strlen($mobile) > 11 || strlen($mobile) < 11){
            array_push($errors,'شماره موبایل باید یازده حرف باشد و با ضفر شروع شود');
            $flag=false;
        }
        if(preg_match("/^09[0-9]{9}$/", $mobile)) {

        }else{
            array_push($errors, "شماره موبایل معتبر نیست");
            $flag=false;
        }
        return $flag;
    }
function check_password($password,$confirm_password){
    global $errors;
    $flag=true;
    if (strlen($password) < 8){
        array_push($errors,'پسورد باید حداقل هشت حرف باشد');
        return false;
    }
    if ( $password != $confirm_password ){
        array_push($errors,'پسورد ها یکسان نیستند');
        $flag = false;
    }
    return $flag;
}

    function last_password($lastpassword)
    {
        include "connection.php";
        global $errors;
        $flag = true;
        $query = "SELECT password FROM users WHERE access_token='" . $_COOKIE['user'] . "'";
        $query = mysqli_query($connection, $query);
        $query = mysqli_fetch_assoc($query);
        if (sha1($lastpassword) != $query['password']) {
            array_push($errors, 'پسورد قبلی درست خود را وارد کنید');
            $flag = false;
        }

        return $flag;
    }



    function check_uniqe($mobile)
    {
        include "connection.php";
        global $errors;
        $flag = true;
        $check_user = "SELECT `mobile` FROM `users` WHERE  mobile= '" . $mobile . "'  AND access_token!= '" . $_COOKIE['user'] . "'";
        $check_user = mysqli_query($connection, $check_user);
        if (mysqli_num_rows($check_user)) {
            array_push($errors, 'این شماره موبایل قبلا ثبت شده است ');
            $flag = false;

        }
        return $flag;
    }

// for checkingf if the password is true from the user


    if (isset($_POST['signup'])) {
        $signup_date = date('Y:M:D H:i:s');
        if (check_name($_POST['firstname'], $_POST['lastname']) && check_mobile($_POST['mobile']) && check_password($_POST['password'], $_POST['Cpassword']) && check_uniqe($_POST['mobile']) && last_password($_POST['oldpassword'])) {
            $shapas = sha1($_POST['password']);
            $signup_query = "UPDATE `users` SET `firstname`='" . strip_tags($_POST['firstname']) . "', `lastname`='" . strip_tags($_POST['lastname']) . "', `mobile`='" . strip_tags($_POST['mobile']) . "', `password`='" . strip_tags($shapas) . "' WHERE access_token='" . $_COOKIE['user'] . "' ";
            if (mysqli_query($connection, $signup_query)) {
                array_push($errors, 'update up successfully!');

            } else {
                array_push($errors, 'there is a problem update up');
            }


        }
    }


if (isset($_GET['domainid'])) {
    $domain_edit = "SELECT * FROM `domains` WHERE Domainid='".$_GET['domainid']."' ";
    $domain_edit = mysqli_query($connection,$domain_edit);
    $domain_edit = mysqli_fetch_assoc($domain_edit);
    if (isset($_POST['submit'])) {
        $status = true;
        if (empty($_POST['url'])) {
            array_push($errors, "بخش url را کامل کنید");
            $status = false;
        }
        if (empty($_POST['domain_name'])) {
            array_push($errors, "دامین خود را به فارسی وارد کنید");
            $status = false;
        }
        if (empty($_POST['tel'])) {
            array_push($errors, "شماره تلفن خود را وارد کنید");
            $status = false;
        }
        if (empty($_POST['price'])) {
            array_push($errors, "مبلغ دلخواه خود را وارد کنید");
            $status = false;
        }
        if ($_POST['price'] != "بالاترین پیشنهاد") {
            if ($_POST['price'] != "توافقی") {
                if ($_POST['price'] > 2500000000) {
                    array_push($errors, "حداکثر مبلغ دامین دومیلیارد و پونصد تومن معادل بیست و پنج میلیارد ریال می باشد");
                    $status = false;
                }
            }
        }
        if (empty($_POST['categories'])) {
            array_push($errors, "حداقل یک دسته بندی را انتخاب کنید");
            $status = false;
        }
        if ($status) {
            $unique = "SELECT `name` FROM `domains` WHERE name='" . $_POST['url'] . $_POST['domain_ext'] . "' AND Domainid!='".$_GET['domainid']."'";
            $unique = mysqli_query($connection, $unique);

            if (mysqli_num_rows($unique)) {
                array_push($errors, 'این دامین قبلا در سیستم ثبت شده است');

            } else {
                $category = "[" . implode(",", $_POST['categories']) . "]";
                $set_time = time();
                $url = str_replace(".", "-", $_POST['url'] . $_POST['domain_ext']);
                $query = "UPDATE `domains` SET `name`='" . strip_tags($_POST['url']) . $_POST['domain_ext'] . "',`persianname`='" . strip_tags($_POST['domain_name']) . "',`tell`='" . strip_tags($_POST['tel']) . "',`price`='" . strip_tags($_POST['price']) . "',`categoryID`='" . $category . "',`lastupdate`= '" . $set_time . "'  WHERE domainID='".$_GET['domainid']."' ";

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
<!DOCTYPE html>
<html lang="en">


<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پروفایل|<?php echo $query_edit['firstname']." ".$query_edit['lastname']; ?></title>
    <link rel="icon" href="assets/images/tab.png" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="assets/css/bootstrap.rtl.min.css" type="text/css" media="all"/>

    <link rel="stylesheet" href="assets/css/animate.min.css" type="text/css" media="all"/>

    <link rel="stylesheet" href="assets/css/owl.carousel.min.css" type="text/css" media="all"/>
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css" type="text/css" media="all"/>

    <link rel="stylesheet" href="assets/css/meanmenu.min.css" type="text/css" media="all"/>

    <link rel="stylesheet" href="assets/css/magnific-popup.min.css" type="text/css" media="all"/>

    <link rel='stylesheet' href='assets/css/boxicons.min.css' type="text/css" media="all"/>

    <link rel='stylesheet' href='assets/css/flaticon.css' type="text/css" media="all"/>
    <link rel="stylesheet" href="assets/css/responsive.css" type="text/css" media="all"/>
    <link rel="stylesheet" href="combiend.css.css">
    <link rel="stylesheet" href="assets/css/rtl.css" type="text/css" media="all"/>
    <link rel="stylesheet" href="assets/css/select2.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <link rel="stylesheet" href="assets/css/farsi.css">
</head>

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
    * {
        box-sizing: border-box;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        height: 100vh;
        background: #f6f5f7;
    }

    h1 {
        margin: 0;
        font-weight: bold;
    }

    h2 {
        text-align: center;
    }

    p {
        margin: 20px 0 30px;
        font-size: 14px;
        font-weight: 100;
        line-height: 20px;
        letter-spacing: 0.5px;
        color: #fff;
    }

    .text-white {
        color: #fff !important;
        font-size: 30px;
    }

    span {
        font-size: 10px;
    }

    a {
        margin: 15px 0;
        color: #333;
        font-size: 14px;
        text-decoration: none;
        transition: 0.3s;
    }

    a:hover {
        color: #00aeef;
        text-decoration: none;
    }
    .seachitemm::placeholder{
     color: whitesmoke}


    button {
        padding: 12px 45px;
        background-color: #00aeef;
        border-radius: 20px;
        border: 1px solid #00aeef;
        color: #FFFFFF;
        font-size: 12px;
        font-weight: bold;
        transition: transform 80ms ease-in, 0.3s;
        cursor: pointer;
        font-family: IRANSans;
    }
    .button {
        padding: 12px 45px;
        background-color: #00aeef;
        border-radius: 20px;
        border: 1px solid #00aeef;
        color: #FFFFFF;
        font-size: 12px;
        font-weight: bold;
        transition: transform 80ms ease-in, 0.3s;
        cursor: pointer;
        font-family: IRANSans;
    }

    .form-container .ghost {
        margin-top: 10px;
        border: 1px solid #00aeef;
        color: #00aeef;
        display: none;
    }

    button:active {
        transform: scale(0.95);
    }

    button:focus {
        outline: none;
    }

    button.ghost {
        background-color: transparent;
        border-color: #FFFFFF;
    }

    form {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        height: 100%;
        padding: 0 50px;
        background-color: #FFFFFF;
        text-align: center;
        font-family: IRANSans;
    }

    input {
        width: 100%;
        margin: 5px 0;
        padding: 12px 15px;
        background-color: #eee;
        border: none;
        font-family: IRANSans;
    }

    .container {
        width: 768px;
        max-width: 100%;
        min-height: 480px;
        background-color: #fff;
        border-radius: 0px;
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
        position: relative;
        overflow: hidden;
        height: 100vh;
        width: 100%;
    }

    .form-container {
        position: absolute;
        top: 0;
        height: 100%;
        transition: all 0.6s ease-in-out;
    }

    .sign-in-container {
        left: 0;
        width: 50%;
        z-index: 2;
    }

    .container.right-panel-active .sign-in-container {
        transform: translateX(100%);
    }

    .sign-up-container {
        left: 0;
        width: 50%;
        opacity: 0;
        z-index: 1;
    }

    .container.right-panel-active .sign-up-container {
        transform: translateX(100%);
        opacity: 1;
        z-index: 5;
        animation: show 0.6s;
    }

    @keyframes  show {

        0%,
        49.99% {
            opacity: 0;
            z-index: 1;
        }

        50%,
        100% {
            opacity: 1;
            z-index: 5;
        }
    }

    .overlay-container {
        position: absolute;
        top: 0;
        left: 50%;
        width: 50%;
        height: 100%;
        overflow: hidden;
        transition: transform 0.6s ease-in-out;
        z-index: 100;
    }

    .container.right-panel-active .overlay-container {
        transform: translateX(-100%);
    }

    .overlay {
        position: relative;
        left: -100%;
        height: 100%;
        width: 200%;
        background: #FF416C;
        background: -webkit-linear-gradient(to right, #0f3774, #00aeef);
        background: linear-gradient(to right, #0f3774, #00aeef);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: 0 0;
        color: #FFFFFF;
        transform: translateX(0);
        transition: transform 0.6s ease-in-out;
    }

    .container.right-panel-active .overlay {
        transform: translateX(50%);
    }

    .overlay-panel {
        position: absolute;
        top: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        width: 50%;
        height: 100%;
        padding: 0 40px;
        text-align: center;
        transform: translateX(0);
        transition: transform 0.6s ease-in-out;
    }

    .overlay-left {
        transform: translateX(-20%);
    }

    .container.right-panel-active .overlay-left {
        transform: translateX(0);
    }

    .overlay-right {
        right: 0;
        transform: translateX(0);
    }

    .container.right-panel-active .overlay-right {
        transform: translateX(20%);
    }

    .social-container {
        margin: 10px 0;
    }

    .social-container a {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 40px;
        height: 40px;
        margin: 0 5px;
        border: 1px solid #DDDDDD;
        border-radius: 50%;
    }

    /* Responsive */

    /* 576px - 768px */
    @media  screen and (max-width: 768px) {
        .container {
            width: 90%;
        }
    }

    /* 320px - 576px */
    @media  screen and (max-width: 576px) {
        .form-container .ghost {
            display: block;
        }

        .sign-up-container,
        .sign-in-container {
            width: 100%;
        }

        form {
            padding: 0 40px;
        }

        .overlay-container {
            left: 100%;
            width: 100%;
        }

        .container.right-panel-active .sign-up-container,
        .container.right-panel-active .sign-in-container {
            transform: translateX(0%);
        }

        .container.right-panel-active .overlay-container {
            transform: translateX(-200%);
        }

        .overlay-left,
        .overlay-right {
            display: none;
        }
    }
    .hidden {
        display: none;
    }
    a.logout {
        padding: 0 15px;
        border: 1px solid #00aeef;
        color: #00aeef;
        border-radius: 15px;
    }

    a.disabled {
        pointer-events: none;
        cursor: default;
    }

</style>

<body>

    <div class="container <?php if (isset($_GET['domainid']) || isset($_GET['search_result']) || isset($_POST['show_all']) || isset($_GET['page'])) echo 'right-panel-active';?> ">
        <div class="form-container sign-in-container">
            <form action="" method="post">
                <h3>ورود کاربران</h3>
                <div class="space-20"></div>
                <a href="index.php">بازگشت به صفحه اصلی</a>
                <input type="hidden" name="back" value="https://www.aryateb.com">
                <input type="text" class="form-control" placeholder="firstname*" required name="نام" value="<?php if (isset($_COOKIE['user'])) echo $query_edit['firstname'];?>" />
                <input type="text" class="form-control" placeholder="lastname*" required name="نام خانوادگی" value="<?php if (isset($_COOKIE['user'])) echo $query_edit['lastname']; ?>" />
                <input type="email" class="form-control" placeholder="Email Address *" required name="ایمیل" value="<?php if (isset($_COOKIE['user'])) echo $query_edit["email"]; ?>" disabled/>
                <input type="text" class="form-control" placeholder="mobile number*" required name="شماره موبایل" value="<?php if (isset($_COOKIE['user'])) echo $query_edit["mobile"]; ?>" />
                <input type="password" name="oldpassword" class="form-control" placeholder="رمز عبور قدیمی *" required/>
                <input type="password" name="password" class="form-control" placeholder="رمز عبور جدید *" required/>
                <input type="password" name="Cpassword" class="form-control" placeholder="تکرار رمز عبور جدید *" required/>


                <div class="space-40"></div>
                
                <button name="signup" class="mt-2">ویرایش پروفایل</button>
                <a href="index.php"> <div class="button" >بازگشت به خانه</div> </a>
                <input type="hidden" name="_token" value="DsetpsXJQSzEzdYUjpiqKT1DCPSrGf6xdqs3pZPI">
                <ul>
                    <?php
                    foreach ($errors as $error){
                        echo '<li>'.$error.'</li>';
                    }
                    ?>
                </ul>
            </form>

        </div>
        <div class="form-container sign-up-container">
            <form action="" method="post" enctype="multipart/form-data">
                <h3>ویرایش دامنه</h3>
                <div class="space-20"></div>
                <a href="index.php">بازگشت به صفحه اصلی</a>
                <div class="input-group">
                <input type="text" class="form-control" placeholder="domain url" name="url" required value="<?php

                if (isset($_GET['domainid'])){
                    $variable = substr($domain_edit['name'], 0, strpos($domain_edit['name'], "."));
                    echo $variable;
                }
                ?>" />
                <select class="form-control" name="domain_ext" >
                    <option value=".ir">.ir</option>
                    <option value=".com">.com</option>
                    <option value=".net">.net</option>
                    <option value=".org">.org</option>
                    <option value=".xyz">.xyz</option>
                </select>
                </div>
                <select class="form-control select2-multi" name="categories[]" multiple="multiple">
                    <?php

                    $categories_selected = json_decode($domain_edit['categoryID']);
                    $query_categories = "SELECT * FROM `categories`";
                    $query_categories = mysqli_query( $connection , $query_categories );
                    while ($category = mysqli_fetch_assoc($query_categories)){
                        $selected="";
                        foreach ($categories_selected as $category_selected  ){
                            if ($category['categoryID']== $category_selected){
                                $selected= "selected";
                            }
                        }
                        echo "<option ".$selected." value='".$category['categoryID']."'>".$category['categoryName']."</option>";
                    }
                    ?>
                </select>
                <input type="text" class="form-control" placeholder="domain name" name="domain_name" required   value="<?php if (isset($_GET['domainid'])) echo $domain_edit['persianname'];?>"/>
                <input type="text" class="form-control" placeholder="tel:" name="tel"  required value="<?php if (isset($_GET['domainid'])) echo $domain_edit['tell'];?>"/>
                <input dir="rtl" type="number" class="form-control" id="price"  name="price" value="<?php if (isset($_GET['domainid']) && is_numeric($domain_edit['price'])) {echo $domain_edit['price']; } ?>" <?php if (isset($_GET['domainid']) && ($domain_edit['price']== "توافقی" || $domain_edit['price']== "بالاترین پیشنهاد" )) echo "disabled" ?> />
                <br><br><br>
                <input type="checkbox" class="chb" id="highest_offer" name="price" value="بالاترین پیشنهاد"  onclick="disable_price(this.id)" <?php if (isset($_GET['domainid']) && $domain_edit['price']== "بالاترین پیشنهاد") echo "checked"?>>
                <label for="highest_offer">بالاترین پیشنهاد</label><br>
                <input type="checkbox" class="chb" id="agreement" name="price" value="توافقی"  onclick="disable_price(this.id)" <?php if (isset($_GET['domainid']) && $domain_edit['price']== "توافقی") echo "checked"?>>
                <label for="agreement">توافقی</label><br>
                <div class="space-40"></div>
                
                <button name="submit">ویرایش دامنه</button>
                <a href="index.php"> <div class="button" >بازگشت به خانه</div> </a>
                <ul>
                    <?php
                    foreach ($errors as $error){
                        echo '<li>'.$error.'</li>';
                    }
                    ?>
                </ul>
            </form>

        </div>
        <div class="overlay-container">
            <div class="overlay">

                <div class="overlay-panel overlay-left">
                    <div>
                        <div>
                            <form method="GET" action="" style="background-color: transparent">

                                <div class="form-group" >
                                    <input type="text" class="form-control bxs-capsule seachitemm" placeholder="دامین خود را جستجو کنید" name="searchitem" style="background-color: transparent; border-radius: 50px; ">
                                    <br/>
                                    <button  name="search_result" value="search">جستجو</button>
                                </div>
                            </form>

                        </div>
                    <div class="space-30"></div>

                    <table class="table" >
                        <thead class="thead-dark">
                        <tr>

                            <th scope="col">
                               نام دامنه
                            </th>
                            <th scope="col">
                                نام فارسی
                            </th >
                            <th scope="col">
                                قیمت
                            </th>
                            <th scope="col">
                                شماره تماس
                            </th>


                        </tr>
                        <tbody>
                        <?php
                        if (isset($_GET["search_result"])):
                            $results_per_pages = 1;

                            $results = "SELECT * FROM  domains INNER JOIN users ON domains.userID = users.userID  WHERE ( name LIKE '%" . $_GET['searchitem'] . "%' OR  persianname LIKE '%" . $_GET['searchitem'] . "%') AND access_token='".$_COOKIE['user']."' ";
                            $results = mysqli_query($connection, $results);
                            if (mysqli_num_rows($results)==0){
                                echo "نتیجه ای یافت نشد" ;
                            }


                            $link = "";
                            $query_search = "SELECT * FROM domains INNER JOIN users ON domains.userID = users.userID WHERE ( name LIKE '%" . $_GET['searchitem'] . "%' OR  persianname LIKE '%" . $_GET['searchitem'] . "%')  AND access_token='".$_COOKIE['user']."' LIMIT " . $page_first_result . ',' . $results_per_pages;
                            $query_search = mysqli_query($connection,$query_search);




                            while ($resultt = mysqli_fetch_assoc($query_search)):
                                ?>
                                <tr>
                                    <td class="td-list-name td-bg"><?php echo $resultt['name']; ?>&nbsp</td>
                                    <td dir="ltr"><?php echo $resultt['persianname']; ?>&nbsp</td>
                                    <td><?php echo $resultt['price']; ?>&nbsp</td>
                                    <td><?php echo $resultt['tell']; ?>&nbsp</td>

                                </tr>
                        </tbody>
                    </table>
                        <table class="table" >
                            <thead class="thead-dark">
                            <tr>


                                <th style="color: whitesmoke;"  scope="col">
                                    تغییر دامنه &nbsp
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                <td class="td-orange"><a style="color:whitesmoke;" href="<?php if (isset($_GET['search_result']) || isset($_GET['page'] )){echo $_SERVER['REQUEST_URI'].'&domainid='.$resultt['Domainid'];} else if (!isset($_GET['search_result'])){echo $_SERVER['REQUEST_URI'].'?domainid='.$resultt['Domainid']; } ?>">برای تغییر دامنه به این متن کلیک کنید</a></td>

                            </tbody>
                        </table>
                            <?php
                            endwhile;

                            if(isset($_GET['page']) && isset($_GET['searchitem'])){
                                $page = $_GET['page']; // your current page

                            }





                            $number_of_search = mysqli_num_rows($results);

                            $number_of_search = ceil ($number_of_search / $results_per_pages);
//determine which page number visitor is currently on
                            if (!isset ($_GET['page']) ) {
                                $page = 1;
                            } else {
                                $page = $_GET['page'];
                            }
//determine the sql LIMIT starting number for the results on the displaying page
                            $page_first_result = ($page-1) * $results_per_pages;
//find the total number of results stored in the database



                            $pages= $number_of_search;
                            $limit=6 ; // May be what you are looking for

                            if ($pages >=1 && $page <= $pages)
                            {
                                $counter = 1;
                                $link = "";
                                if ($page > 1)
                                { $link .= "<a href=\"?searchitem=".$_GET['searchitem']."&search_result=search&page=1\">1 </a> ... ";}
                                for ($x=$page; $x<=$pages;$x++)
                                {

                                    if($counter < $limit)
                                        $link .= "<a href=\"?searchitem=".$_GET['searchitem']."&search_result=search&page=" .$x."\">".$x." </a>";

                                    $counter++;
                                }

                                if ($page < $pages - ($limit/2))
                                { $link .= "... " . "<a href=\"?searchitem=".$_GET['searchitem']."&search_result=search&page=" .$pages."\">".$pages." </a>";
//                                $counter++;
                                }
                            }

                            echo $link;

                        else:
                            while($query_domain = mysqli_fetch_assoc($query_domains)):
                                ?>
                                <tr>
                                    <td class="td-list-name td-bg"><?php echo $query_domain['name']; ?>&nbsp</td>
                                    <td dir="ltr"><?php echo $query_domain['persianname']; ?>&nbsp</td>
                                    <td><?php echo $query_domain['price']; ?>&nbsp</td>
                                    <td><?php echo $query_domain['tell']; ?>&nbsp</td>

                                </tr>
                        </tbody>
                    </table>
                        <table class="table" >
                            <thead class="thead-dark">
                            <tr>


                                <th style="color: whitesmoke;"  scope="col">
                                    تغییر دامنه &nbsp
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            <td class="td-orange"><a style="color:whitesmoke;" href=" <?php if(isset($_GET['search_result']) || isset($_GET['page'])){echo $_SERVER['REQUEST_URI'].'&domainid='. $query_domain['Domainid'];} else if (!isset($_GET['search_result']) || !isset($_GET['page'])){echo $_SERVER['REQUEST_URI'].'?domainid='. $query_domain['Domainid']; } ?>">برای تغییر دامنه به این متن کلیک کنید</a></td>



                            </tbody>
                        </table>
                            <?php endwhile;
                            $link = "";
                            if(isset($_GET['page'])){
                                $page = $_GET['page']; // your current page

                            }


                            $pages= $number_of_page;
                            $limit=6 ; // May be what you are looking for

                            if ($pages >=1 && $page <= $pages)
                            {
                                $counter = 1;
                                $link = "";
                                if ($page > ($limit/2))
                                { $link .= "<a href=\"?page=1\">1 </a> ... ";}
                                for ($x=$page; $x<=$pages;$x++)
                                {

                                    if($counter < $limit)
                                        $link .= "<a href=\"?page=" .$x."\">".$x." </a>";

                                    $counter++;
                                }

                                if ($page < $pages - ($limit/2))
                                { $link .= "... " . "<a href=\"?page=" .$pages."\">".$pages." </a>"; }
                            }

                            echo "<br>".$link."<br><br>";
                        endif;
                        ?>








                        <br>
                    <h1 class="text-white"  >کاربر گرامی</h1>
                    <p style="text-align: center">برای ویرایش پنل کاربری خود از این بخش وارد شوید!</p>
                    <div class="space-10"></div>
                    <button class="ghost" id="signIn" >ویرایش  پروفایل</button>

                </div>

            </div>
                <div class="overlay-panel overlay-right">
                    <h1 class="text-white">ویرایش دامنه</h1>
                    <div class="space-30"></div>
                    <p>فروشندگان گرامی، برای ورود به بخش مدیریت دامنه ها از این بخش وارد شوید</p>
                    <div class="space-10"></div>
                    <button class="ghost" >مدیریت دامنه ها</button>
                </div>
        </div>
    </div>
    <!-- start avacus singup section -->

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
<script src="assets/js/jquery-library.js"></script>

    <script>
    function startTimer(duration, display) {
        if (display) {
            var timer = duration, minutes, seconds;
            var intervalID = setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    clearInterval(intervalID);
                    $('.timer-show').hide();
                    $('#resent').removeClass('disabled');
                }
            }, 1000);
        }
    }

    window.onload = function () {
        var second = 60,
            display = document.querySelector('#time');
        startTimer(second, display);
    };
</script>
<script>
    $('.ghost').on('click', function(e) {
        $('.container').toggleClass("right-panel-active");
    });
</script>

</body>
</html>
