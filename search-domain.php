<?php
include "connection.php";
$results_per_page = 20;
//find the total number of results stored in the database
$query = "SELECT * FROM domains ORDER BY vip DESC";
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
$query_domains = "SELECT * FROM domains ORDER BY vip DESC LIMIT " . $page_first_result . ',' . $results_per_page;
$query_domains = mysqli_query($connection,$query_domains);






?>
<!DOCTYPE html>
<html lang="zxx" dir="rtl">

<!-- Mirrored from templates.hibootstrap.com/blim/rtl/dedicated-hosting.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 25 Sep 2021 12:42:55 GMT -->
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
<!--    <link rel="stylesheet" href="assets/css/combiend.css" type="text/css" media="all" />-->
    <style>
        .inputsearch {
            background-color: #0a53be;
            color: whitesmoke;
        }
        .inputsearch:focus{
            background-color: #0a53be;
            color: whitesmoke;
        }
        .inputsearch::placeholder{
            color: whitesmoke;
        }
        .buttonsearch{
            color: #0b0b0b;
            transition: 0.5s;
        }
        .buttonsearch:hover{
            color: whitesmoke;
        }

    </style>
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
                    <h1>همه دامنه ها</h1>
<!--                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>-->
<!--                    <ul class="section-button">-->
<!--                        <li><button class="btn btn-pill">Get Started</button></li>-->
<!--                    </ul>-->
                </div>
            </div>
            <div class="col-sm-12 offset-lg-3 col-lg-3">
                <div class="header-page-image">
                    <img src="assets/images/dedicated-header-shape.png" alt="shape">
                </div>
            </div>
        </div>
    </div>
</header>


<section class="pricing-section p-tb-100">
    <div class="container">
        <div class="section-title section-title-two">
            <h2>دامین دلخواه را بیابید</h2>
<!--            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim </p>-->
        </div>

        <div class="pricing-hosting-table">
            <table>
                <form method="GET" action="">
                    <div class="form-group">


                        <input type="text" class="form-control form-control-lg inputsearch" placeholder="جستجو کنید" name="searchitem">
                        <br>
                        <div class="input-group-append">
                        <select name="categories"  id="select" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <option value="default" selected="selected">دسته بندی مورد نظر</option>
                            <?php
                            $query_categories = "SELECT * FROM `categories`";
                            $query_categories = mysqli_query( $connection , $query_categories );
                            while ($category = mysqli_fetch_assoc($query_categories)){
                                echo "<option id='option' value='".$category['categoryID']."'>".$category['categoryName']."</option>";
                            }
                            ?>
                        </select>
                            </div>
                        <br/>
                        <button class="btn btn-primary buttonsearch" name="search_result" value="search">جستجو کنید</button>

                    </div>
                </form>
                <br>


                <thead>
                <tr>
                    <th>
                        <div class="pricing-header-title">
                            <div class="pricing-header-title-text">نام دامنه</div>
                        </div>
                    </th>
                    <th>
                        شماره تماس
                    </th>
                    <th>
                        قیمت
                    </th>
                    <th>
                        نام فارسی دامنه
                    </th>
                    <th>
                        جزئیات دامنه
                    </th>

                </tr>
                </thead>

                <tbody>
                <?php
                if (isset($_GET["search_result"])):
                    $results_per_pages = 20;
                    if (empty($_GET['categories'])){
                        $_GET['categories'] =  "default";
                    }
                    if ($_GET['categories'] != "default"){


                    $results = "SELECT * FROM  domains WHERE ( (name LIKE '%" . $_GET['searchitem'] . "%' OR  persianname LIKE '%" . $_GET['searchitem'] . "%') AND categoryID LIKE '%" . $_GET['categories'] . "%')";

                    } else{



                    $results = "SELECT * FROM  domains WHERE ( name LIKE '%" . $_GET['searchitem'] . "%' OR  persianname LIKE '%" . $_GET['searchitem'] . "%')";

                }
                    $results = mysqli_query($connection, $results);
                    if (mysqli_num_rows($results)==0){
                        echo "نتیجه ای یافت نشد" ;
                    }


                    $link = "";
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
                if ($_GET['categories'] != "default"){
                    $query_search = "SELECT * FROM domains WHERE (( name LIKE '%" . $_GET['searchitem'] . "%' OR  persianname LIKE '%" . $_GET['searchitem'] . "%' ) AND categoryID LIKE '%" . $_GET['categories'] . "%' ) ORDER BY vip DESC  LIMIT " . $page_first_result . ',' . $results_per_pages;
                }else{
                    $query_search = "SELECT * FROM domains WHERE (( name LIKE '%" . $_GET['searchitem'] . "%' OR  persianname LIKE '%" . $_GET['searchitem'] . "%' ) ) ORDER BY vip DESC  LIMIT " . $page_first_result . ',' . $results_per_pages;
                }
                    $query_search = mysqli_query($connection,$query_search);
                    $pages= $number_of_search;
                    $limit=6 ; // May be what you are looking for

                    if ($pages >=1 && $page <= $pages)
                    {
                        $counter = 1;
                        $link = "<nav aria-label='Page navigation example'  style='display: inline-block'>";
                        if ($page >=2)
                        { $link .= "
                                            <ul class='pagination'  style='display: inline-block'>
                                               <li class='page-item'> 
                        <a class='page-link'  href=\"?searchitem=".$_GET['searchitem']."&search_result=search&page=1\">1 </a></li></ul> ... ";}
                        for ($x=$page; $x<=$pages;$x++)
                        {

                            if($counter < $limit)
                                $link .= " 
                                            <ul class='pagination' style='display: inline-block; '>
                                               <li class='page-item'> 
                                                <a class='page-link' href=\"?searchitem=".$_GET['searchitem']."&search_result=search&page=" .$x."\">".$x." </a>   </li>
  </ul>
";

                            $counter++;
                        }

                        if ($page < $pages - ($limit/2))
                        { $link .= "... " . "
                                            <ul class='pagination'  style='display: inline-block'>
                                               <li class='page-item'> <a class='page-link'  href=\"?searchitem=".$_GET['searchitem']."&search_result=search&page=" .$pages."\">".$pages." </a> </li>  </ul>"; }
                    }
                    while ($resultt = mysqli_fetch_assoc($query_search)):
                    ?>

                        <tr>
                            <td class="td-list-name td-bg"><?php if($resultt['vip']) echo '<img src="assets/images/vip.png" alt="">'; ?><?php echo $resultt['name']; ?></td>
                            <td dir="ltr"><?php echo $resultt['tell']; ?></td>
                            <td><?php if (is_numeric( $resultt['price']))echo number_format( $resultt['price'])." تومان"; else echo  $resultt['price']; ?></td>
                            <td><?php echo $resultt['persianname']; ?></td>
                            <td class="td-orange"><a href="domain-details.php?url=<?= $resultt['url'];?>">جزییات بیشتر</a></td>
                        </tr>
                    <?php
                endwhile;



                else:
                while($query_domain = mysqli_fetch_assoc($query_domains)):
                ?>
                <tr>
                    <td class="td-list-name td-bg"><?php if($query_domain['vip']) echo '<img src="assets/images/vip.png" alt="">'; ?><?php echo $query_domain['name']; ?></td>
                    <td dir="ltr"><?php echo $query_domain['tell']; ?></td>
                    <td><?php  if (is_numeric( $query_domain['price']))echo number_format( $query_domain['price'])." تومان"; else echo  $query_domain['price']; ?></td>
                    <td><?php echo $query_domain['persianname']; ?></td>
                    <td class="td-orange"><a href="domain-details.php?url=<?= $query_domain['url'];?>">جزییات بیشتر</a></td>
                </tr>
                <?php endwhile;

                ?>

                <?php
                $link = "";
                if(isset($_GET['page'])){
                    $page = $_GET['page']; // your current page

                }


                $pages= $number_of_page;
                $limit=6 ; // May be what you are looking for

                if ($pages >=1 && $page <= $pages)
                {
                $counter = 1;
                $link = "<nav aria-label='Page navigation example'  style='display: inline-block'>
                                            ";
                if ($page >= 2)
                { $link .= "<ul class='pagination'  style='display: inline-block'>
                                               <li class='page-item'>  <a class='page-link' href=\"?page=1\" onclick = 'addmoz()'>1 </a> </li></ul> ... ";}
                for ($x=$page; $x<=$pages;$x++)
                {

                if($counter < $limit)
                $link .= "<ul class='pagination'  style='display: inline-block'>
                                               <li class='page-item'>  <a class='page-link' id='searchact".$x."' href=\"?page=" .$x."\" onclick = 'addmoz() '>".$x." </a></li></ul> ";

                $counter++;
                }

                if ($page < $pages - ($limit/2))
                { $link .= "... " . "<ul class='pagination'  style='display: inline-block'>
                                               <li class='page-item'>  <a onclick = 'addmoz()' class='page-link' href=\"?page=" .$pages."\">".$pages." </a> </li></ul>"; }
                }


                endif;
                ?>

                </tbody>

            </table>
            <br>
            <div class="d-flex justify-content-center">
            <?php
            echo $link." </nav> ";
            $active ='' ;
            if (isset($_GET['page'])){

            };
            ?>
            </div>
        </div>
    </div>
</section>

<?php include "layouts/analize.php";?>



<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="assets/js/jquery-3.5.1.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/js/jquery.magnific-popup.min.js"></script>

<script src="assets/js/owl.carousel.min.js"></script>

<script src="assets/js/jquery.ajaxchimp.min.js"></script>

<script src="assets/js/form-validator.min.js"></script>

<script src="assets/js/contact-form-script.js"></script>

<script src="assets/js/jquery.meanmenu.min.js"></script>

<script src="assets/js/script.js"></script>

</body>

<!-- Mirrored from templates.hibootstrap.com/blim/rtl/dedicated-hosting.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 25 Sep 2021 12:42:55 GMT -->
</html>