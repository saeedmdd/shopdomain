<?php
include "connection.php";
if (!isset($_COOKIE['user'])){
    header("Location: index.php");

}
$query_edit = "SELECT * FROM `users` WHERE access_token = '".$_COOKIE['user']."'";
$query_edit = mysqli_query($connection , $query_edit);
$query_edit = mysqli_fetch_assoc($query_edit);
date_default_timezone_set('Asia/Tehran');
$errors=[];
function check_name($firstname,$lastname){
    global $errors;
    $flag=true;
    if (strlen($firstname) < 2){
        array_push($errors,'please fill firstname correctly');
        $flag=false;
    }
    if (strlen($lastname) < 2){
        array_push($errors,'please fill lastname correctly');
        $flag=false;
    }
    return $flag;
}
function check_mobile($mobile){
    global $errors;
    $flag=true;
    if (strlen($mobile) < 11){
        array_push($errors,'Please fill mobile number correctly');
        $flag=false;
    }
    return $flag;
}
function last_password($lastpassword){
    include "connection.php";
    global $errors;
    $flag = true;
    $query = "SELECT password FROM users WHERE access_token='".$_COOKIE['user']."'";
    $query = mysqli_query($connection , $query);
    $query = mysqli_fetch_assoc($query);
    if ( sha1($lastpassword) != $query['password'] ){
        array_push($errors,'پسورد قبلی درست خود را وارد کنید');
        $flag = false;
    }

    return $flag;
}
function check_password($password,$confirm_password){

    global $errors;
    $flag=true;
    if (strlen($password) < 8){
        array_push($errors,'Password should be at list 8 characters');
        return false;
    }

    if ( $password != $confirm_password ){
        array_push($errors,'Passwords do not match!');
        $flag = false;
    }
    return $flag;
}
function check_uniqe($mobile){
    include "connection.php";
    global $errors;
    $flag=true;
    $check_user="SELECT `mobile` FROM `users` WHERE  mobile= '".$mobile."'  AND access_token!= '".$_COOKIE['user']."'";
    $check_user = mysqli_query($connection,$check_user);
    if (mysqli_num_rows($check_user)){
        array_push($errors,'youve already signed up <a href="#">sign in?</a>');
        $flag = false;

    }
    return $flag;
}
// for checkingf if the password is true from the user


if (isset($_POST['signup'])){
    $signup_date = date('Y:M:D H:i:s');
    if (check_name($_POST['firstname'],$_POST['lastname']) && check_mobile($_POST['mobile']) && check_password($_POST['password'], $_POST['Cpassword']) && check_uniqe($_POST['mobile']) && last_password($_POST['oldpassword']) )
    {
        $shapas = sha1($_POST['password']);
        $signup_query = "UPDATE `users` SET `firstname`='".strip_tags($_POST['firstname'])."', `lastname`='".strip_tags($_POST['lastname'])."', `mobile`='".strip_tags($_POST['mobile'])."', `password`='".strip_tags($shapas)."' WHERE access_token='".$_COOKIE['user']."' ";
        if (mysqli_query($connection , $signup_query)){
            array_push($errors,'update up successfully!');

        }
        else{
            array_push($errors,'there is a problem update up');
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
                    <button class="ghost btn btn-success"></button>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6 p-0">
                <div class="authentication-item bg-white">
                    <div class="authentication-user-panel">
                        <div class="authentication-user-header">
                            <a href="index.php"><img src="assets/images/logo-blue.png" alt="logo"></a>
                            <h1>Welcome to Blim</h1>
                        </div>
                        <div class="authentication-user-body">
                            <div class="authentication-tab">
                                <div class="authentication-tab-item" data-authentcation-tab="1">
                                    <i class="flaticon-user-2"></i>
                                    Register
                                </div>

                            </div>
                            <div class="authentication-tab-details-item  authentication-tab-details-active" data-authentcation-details="1">
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
                                                               placeholder="firstname*" required name="firstname" value="<?php if (isset($_COOKIE['user'])) echo $query_edit['firstname'];?>" />
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
                                                               placeholder="lastname*" required name="lastname" value="<?php if (isset($_COOKIE['user'])) echo $query_edit['lastname']; ?>" />
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
                                                        <input type="email" class="form-control"
                                                               placeholder="Email Address *" required name="email" value="<?php if (isset($_COOKIE['user'])) echo $query_edit["email"]; ?>" disabled/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group mb-20">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="flaticon-user"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="mobile number*" required name="mobile" value="<?php if (isset($_COOKIE['user'])) echo $query_edit["mobile"]; ?>" />
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
                                                        <input type="password" name="oldpassword" class="form-control"
                                                               placeholder="Old password *" required/>
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
                                                               placeholder="New password *" required/>
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
                                                               placeholder="Confirm Password *" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <button class="btn btn-gradient full-width mb-20" name="signup">Edit profile</button>
                                            </div>
                                        </div>
                                        <div class="authentication-account-access mb-20">
                                            <div class="authentication-account-access-item">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="check2">
                                                    <label class="form-check-label" for="check2">Click here to get
                                                        newsletter</label>
                                                </div>
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
    </div>
</div>
</div>
</div>
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
<script src="assets/js/jquery-library.js"></script>
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