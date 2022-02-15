<?php
include "connection.php";
$errors=[];
if (isset($_GET['id'])){
    $edit = "SELECT * FROM `domains` WHERE Domainid='".$_GET['id']."'";
    $edit = mysqli_query($connection,$edit);
    $edit = mysqli_fetch_assoc($edit);
    if (isset($_POST['submit'])) {
        if (!empty($_POST['url']) && !empty($_POST['domain_name']) && !empty($_POST['tel']) && !empty($_POST['price'])) {
            $unique = "SELECT `name` FROM `domains` WHERE name='" . $_POST['url'] . $_POST['domain_ext'] . "'";
            $unique = mysqli_query($connection, $unique);
            $domainname = mysqli_fetch_assoc($unique);
            if (mysqli_num_rows($unique) && $edit['name'] != $domainname['name'] ) {
                array_push($errors, 'this domain has been already added');
            } else {
                $queryedit = "UPDATE `domains` SET `name`='".strip_tags($_POST['url'].$_POST['domain_ext']) . "',`persianname`='".strip_tags($_POST['domain_name'])."',`tell`='".strip_tags($_POST['tel'])."',`price`='".strip_tags($_POST['price'])."',`content`='".strip_tags($_POST['price'])."' WHERE Domainid='".$_GET['id']."'";
                if (mysqli_query($connection, $queryedit)) {
                    array_push($errors, "domain edited successfully");
                } else {
                    array_push($errors, "There is an error");
                }
            }
        } else {
            array_push($errors, "please fill out the form!");
        }
    }
}
else {
    if (isset($_POST['submit'])) {

        if (!empty($_POST['url']) && !empty($_POST['domain_name']) && !empty($_POST['tel']) && !empty($_POST['price'])) {
            $unique = "SELECT `name` FROM `domains` WHERE name='" . $_POST['url'] . $_POST['domain_ext'] . "'";
            $unique = mysqli_query($connection, $unique);
            if (mysqli_num_rows($unique)) {
                array_push($errors, 'this domain has been already added');
            } else {
                $query = "INSERT INTO `domains`(`name`,`persianname`, `tell`, `price`, `content`) VALUES ('" . $_POST['url'] . $_POST['domain_ext'] . "','" . $_POST['domain_name'] . "','" . $_POST['tel'] . "','" . $_POST['price'] . "','" . $_POST['content'] . "')";
                if (mysqli_query($connection, $query)) {
                    array_push($errors, "domain added successfully");
                } else {
                    array_push($errors, "There is an error");
                }
            }
        } else {
            array_push($errors, "please fill out the form!");
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
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <title>Blim - Domain & Hosting Company HTML Template</title>
    <link rel="icon" href="assets/images/tab.png" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="assets/css/bootstrap.rtl.min.css" type="text/css" media="all" />

    <link rel="stylesheet" href="assets/css/animate.min.css" type="text/css" media="all" />

    <link rel="stylesheet" href="assets/css/owl.carousel.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css" type="text/css" media="all" />

    <link rel="stylesheet" href="assets/css/meanmenu.min.css" type="text/css" media="all" />

    <link rel="stylesheet" href="assets/css/magnific-popup.min.css" type="text/css" media="all" />

    <link rel='stylesheet' href='assets/css/boxicons.min.css' type="text/css" media="all" />

    <link rel='stylesheet' href='assets/css/flaticon.css' type="text/css" media="all" />

    <link rel="stylesheet" href="assets/css/style.css" type="text/css" media="all" />

    <link rel="stylesheet" href="assets/css/responsive.css" type="text/css" media="all" />

    <link rel="stylesheet" href="assets/css/rtl.css" type="text/css" media="all" />
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
            <div class="col-sm-12 col-lg-6 p-0" >
                <div class="authentication-item authentication-img-bg blue-gradient">
                    <table class="table" style="color: white;  ">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Domain url</th>
                            <th scope="col">Domain name</th>
                            <th scope="col">tel</th>
                            <th scope="col">content</th>
                            <th scope="col">price</th>
                            <th scope="col">edit</th>
                            <th scope="col">delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $domains = "SELECT * FROM `domains` ORDER BY Domainid DESC";
                        $domains = mysqli_query($connection,$domains);
                        $count = 1;
                        while ($domain=mysqli_fetch_assoc($domains)){
                            $content="ندارد";
                            if ($domain['content']){
                                $content="دارد";
                            }
                            echo '<tr>
                            <th scope="row">'.$count++.'</th>
                            <td>'.$domain['name'].'</td>
                            <td>'.$domain['persianname'].'</td>
                            <td>'.$domain['tell'].'</td>
                            <td>'.$content.'</td>
                            <td>'.$domain['price'].'</td>
                            <td><a href="adddomain.php?id='.$domain['Domainid'].'" style="color: whitesmoke">edit</a></td>
                            <td>delete</td>
                        </tr>';
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6 p-0">
                <div class="authentication-item bg-white">
                    <div class="authentication-user-panel">
                        <div class="authentication-user-header">
                            <h1>Add domain</h1>
                        </div>
                        <div class="authentication-user-body">
                            <div class="authentication-tab">
                                <div class="authentication-tab-item authentication-tab-active" data-authentcation-tab="1">
                                    <i class="flaticon-user-1"></i>
                                    admin
                                </div>
                            </div>
                            <div class="authentication-tab-details">
                                <div class="authentication-tab-details-item authentication-tab-details-active" data-authentcation-details="1">
                                    <div class="authentication-form">
                                        <form method="post" action="" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group mb-20">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="flaticon-domain"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="domain url" name="url" required value="<?php

                                                            if (isset($_GET['id'])){
                                                                $variable = substr($edit['name'], 0, strpos($edit['name'], "."));
                                                                echo $variable;
                                                            }
                                                            ?>" />
                                                            <div class="input-group-append" style="border:1px solid gray ">
                                                                <select class="form-control" name="domain_ext"  value="<?php if (isset($_GET['id'])) echo $edit['content']; ?>">
                                                                    <option value=".ir">.ir</option>
                                                                    <option value=".com">.com</option>
                                                                    <option value=".net">.net</option>
                                                                    <option value=".org">.org</option>
                                                                    <option value=".xyz">.xyz</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group mb-20">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="flaticon-web-hosting"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="domain name" name="domain_name" name="url" required value="<?php if (isset($_GET['id'])) echo $edit['persianname'];?>" required />

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group mb-20">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="flaticon-phone"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="tel:" name="tel" required  name="url" required value="<?php if (isset($_GET['id'])) echo $edit['tell']; else echo '09121235667'; ?>"/>
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
                                                            <select class="form-control" name="content" value="<?php if (isset($_GET['id'])) echo $edit['content']; ?>">
                                                                <option value="1">دارد</option>
                                                                <option value="0">ندارد</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group mb-20">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="flaticon-tag"></i></span>
                                                            </div>
                                                            <input type="image" class="form-control" placeholder="price" name="price" required value="<?php if (isset($_GET['id'])) echo $edit['price']; else echo 'توافقی'; ?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group mb-20">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="flaticon-tag"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="price" name="price" required value="<?php if (isset($_GET['id'])) echo $edit['price']; else echo 'توافقی'; ?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <button class="btn btn-gradient full-width mb-20" name="submit"><?php if(isset($_GET['id'])) echo 'Edit domain'; else echo 'Add domain'; ?></button>
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
