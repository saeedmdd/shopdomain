<html>
<head>
    <title> Pagination </title>
</head>
<body>

<form method="POST" action="" style="background-color: transparent">

    <div class="form-group" >
        <input type="text" class="form-control bxs-capsule" placeholder="Search right here..." name="searchitem" style="background-color: transparent; border-radius: 50px">
        <br/>
        <button class="btn btn-sm btn-success" name="search_result">Search</button>
    </div>
</form>

<form method="POST" action="">
    <button class="btn btn-sm btn-success mt-2" name="show_all">Show all</button>
</form>
<?php
function select_domains_by_search($connection, $searchItem )
{
    include "connection.php";
    $results = "SELECT * FROM  domains  WHERE ( name LIKE '%" . $searchItem . "%' OR  persianname LIKE '%" . $searchItem . "%') AND access_token='".$_COOKIE['user']."'";
    $results = mysqli_query($connection, $results);
    $search_result=[];
    if (mysqli_num_rows($results)==0){
        return false;
    }
    else {
        while ($result = mysqli_fetch_assoc($results)) {
            array_push($search_result,$result['Domainid']);
        }
        return $search_result;
    }
}
include "connection.php";
//database connection
if (isset($_POST['search_result'])) {
    $search_results = select_domains_by_search($connection, $_POST['searchitem']);
    if (!$search_results) {
        echo '<tr>نتیجه ای یافت نشد</tr>';
    } else {


//display the retrieved result on the webpage
        //define total number of results you want per page
        $results_per_page = 1;
//find the total number of results stored in the database

//            print_r($result);
        $number_of_result = count($search_results);
//determine the total number of pages available
        $number_of_page = ceil($number_of_result / $results_per_page);
//determine which page number visitor is currently on
        if (!isset ($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
//determine the sql LIMIT starting number for the results on the displaying page
        $page_first_result = ($page - 1) * $results_per_page;
//retrieve the selected results from database


        foreach ($search_results as $search_result) {

            $query = "SELECT * FROM domains WHERE (access_token='" . $_COOKIE['user'] . "'AND Domainid='".$search_result."') LIMIT " . $page_first_result . ',' . $results_per_page;
            $result = mysqli_query($connection, $query);
//            var_dump($result);
            while ($fetchform = mysqli_fetch_array($result)) {
                $json_cat = json_decode($fetchform['categoryID']);
                $vip = "";
                $content = "";
                $domain_cats = [];
                foreach ($json_cat as $categorygetn) {
                    $categoryname = "SELECT categoryName FROM `categories` WHERE categoryID = '" . $categorygetn . "'";
                    $categoryname = mysqli_query($connection, $categoryname);
                    $categoryname = mysqli_fetch_assoc($categoryname);
                    array_push($domain_cats, $categoryname['categoryName']);
                }

                if ($fetchform['vip']) {
                    $vip = '<img src="assets/images/vip.png" alt="">';
                }
                if ($fetchform['content']) {
                    $content = "دارد";
                } else {
                    $content = "ندارد";
                }
                echo '
                            <tr>
                                <td class="td-list-name td-bg">' . $vip . $fetchform['name'] . ' </td>
                                <td class="td-cancel"> ' . $fetchform['persianname'] . ' </i></td>
                                <td class="td-check"> ' . $fetchform['tell'] . ' </i></td>
                                <td class="td-check"> ' . $fetchform['price'] . ' </i></td>
                                <td class="td-check">' . $content . '</i></td>
                                <td class="td-check">' . implode(" , ", $domain_cats) . '</i></td>
                                <td class="td-check"><a href="delete_domain.php?domainid=' . $fetchform['Domainid'] . '" onclick="delete_domain()"><i class="flaticon-close" style="color: red" title="حذف دامنه" onclick="delete_domain()"></i></a></td>
                                <td class="td-check"><a href="login.php?domainid= ' . $fetchform['Domainid'] . '" onclick="delete_domain()"><i class="flaticon-refresh" style="color: red" title="ویرایش دامنه"></i></a></td>


                            </tr>';


            }


            }

        for($page = 1; $page<= $number_of_page; $page++) {
            echo '<a href = "pagination.php?page=' . $page . '">' . $page . ' </a>';
        }

    }
}

////define total number of results you want per page
//$results_per_page = 1;
////find the total number of results stored in the database
//$query = "select * from  domains WHERE access_token='" . $_COOKIE['user'] . "'";
//$resultt = mysqli_query($connection, $query);
////            print_r($result);
//$number_of_result = mysqli_num_rows($resultt);
////determine the total number of pages available
//$number_of_page = ceil($number_of_result / $results_per_page);
////determine which page number visitor is currently on
//if (!isset ($_GET['page'])) {
//    $page = 1;
//} else {
//    $page = $_GET['page'];
//}
////determine the sql LIMIT starting number for the results on the displaying page
//$page_first_result = ($page - 1) * $results_per_page;
////retrieve the selected results from database
//$query = "SELECT * FROM domains WHERE access_token='" . $_COOKIE['user'] . "' LIMIT " . $page_first_result . ',' . $results_per_page;
//$result = mysqli_query($connection, $query);
////        print_r($resultt);
//while ($fetchform = mysqli_fetch_array($result)) {
//    $json_cat = json_decode($fetchform['categoryID']);
//    $vip = "";
//    $content = "";
//    $domain_cats = [];
//    foreach ($json_cat as $categorygetn) {
//        $categoryname = "SELECT categoryName FROM `categories` WHERE categoryID = '" . $categorygetn . "'";
//        $categoryname = mysqli_query($connection, $categoryname);
//        $categoryname = mysqli_fetch_assoc($categoryname);
//        array_push($domain_cats, $categoryname['categoryName']);
//    }
//
//    if ($fetchform['vip']) {
//        $vip = '<img src="assets/images/vip.png" alt="">';
//    }
//    if ($fetchform['content']) {
//        $content = "دارد";
//    } else {
//        $content = "ندارد";
//    }
//    echo '
//                            <tr>
//                                <td class="td-list-name td-bg">' . $vip . $fetchform['name'] . ' </td>
//                                <td class="td-cancel"> ' . $fetchform['persianname'] . ' </i></td>
//                                <td class="td-check"> ' . $fetchform['tell'] . ' </i></td>
//                                <td class="td-check"> ' . $fetchform['price'] . ' </i></td>
//                                <td class="td-check">' . $content . '</i></td>
//                                <td class="td-check">' . implode(" , ", $domain_cats) . '</i></td>
//                                <td class="td-check"><a href="delete_domain.php?domainid=' . $fetchform['Domainid'] . '" onclick="delete_domain()"><i class="flaticon-close" style="color: red" title="حذف دامنه" onclick="delete_domain()"></i></a></td>
//                                <td class="td-check"><a href="login.php?domainid= ' . $fetchform['Domainid'] . '" onclick="delete_domain()"><i class="flaticon-refresh" style="color: red" title="ویرایش دامنه"></i></a></td>
//
//
//                            </tr>';
//
//
//}
//for($page = 1; $page<= $number_of_page; $page++) {
//    echo '<a href = "pagination.php?page=' . $page . '">' . $page . ' </a>';
//}
//display the link of the pages in URL

?>

<?php
//
//
//
//if (isset($_POST['search_result'])) {
//    $search_results = select_domains_by_search($connection, $_POST['searchitem']);
//    if (!$search_results) {
//        echo '<tr>نتیجه ای یافت نشد</tr>';
//    } else {
//        foreach ($search_results as $search_result) {
//            $formquery = "SELECT * FROM `domains` WHERE access_token = '" . $_COOKIE['user'] . "' AND Domainid='" . $search_result . "'";
//            $formquery = mysqli_query($connection, $formquery);
//            while ($fetchform = mysqli_fetch_assoc($formquery)) {
//                $json_cat = json_decode($fetchform['categoryID']);
//                $vip = "";
//                $content = "";
//                $domain_cats = [];
//                foreach ($json_cat as $categorygetn) {
//                    $categoryname = "SELECT categoryName FROM `categories` WHERE categoryID = '" . $categorygetn . "'";
//                    $categoryname = mysqli_query($connection, $categoryname);
//                    $categoryname = mysqli_fetch_assoc($categoryname);
//                    array_push($domain_cats, $categoryname['categoryName']);
//                }
//
//                if ($fetchform['vip']) {
//                    $vip = '<img src="assets/images/vip.png" alt="">';
//                }
//                if ($fetchform['content']) {
//                    $content = "دارد";
//                } else {
//                    $content = "ندارد";
//                }
//                echo '
//                            <tr>
//                                <td class="td-list-name td-bg">' . $vip . $fetchform['name'] . ' </td>
//                                <td class="td-cancel"> ' . $fetchform['persianname'] . ' </i></td>
//                                <td class="td-check"> ' . $fetchform['tell'] . ' </i></td>
//                                <td class="td-check"> ' . $fetchform['price'] . ' </i></td>
//                                <td class="td-check">' . $content . '</i></td>
//                                <td class="td-check">' . implode(" , ", $domain_cats) . '</i></td>
//                                <td class="td-check"><a href="delete_domain.php?domainid=' . $fetchform['Domainid'] . '" onclick="delete_domain()"><i class="flaticon-close" style="color: red" title="حذف دامنه" onclick="delete_domain()"></i></a></td>
//                                <td class="td-check"><a href="login.php?domainid= ' . $fetchform['Domainid'] . '" onclick="delete_domain()"><i class="flaticon-refresh" style="color: red" title="ویرایش دامنه"></i></a></td>
//
//
//                            </tr>';
//
//
//            }
//        }
//    }
//} else if (!isset($_POST['search_result']) || isset($_POST['show_all'])) {
//    $formquery = "SELECT * FROM `domains` WHERE access_token = '" . $_COOKIE['user'] . "'";
//    $formquery = mysqli_query($connection, $formquery);
//    while ($fetchform = mysqli_fetch_assoc($formquery)) {
//        $json_cat = json_decode($fetchform['categoryID']);
//        $vip = "";
//        $content = "";
//        $domain_cats = [];
//        foreach ($json_cat as $categorygetn) {
//            $categoryname = "SELECT categoryName FROM `categories` WHERE categoryID = '" . $categorygetn . "'";
//            $categoryname = mysqli_query($connection, $categoryname);
//            $categoryname = mysqli_fetch_assoc($categoryname);
//            array_push($domain_cats, $categoryname['categoryName']);
//        }
//
//        if ($fetchform['vip']) {
//            $vip = '<img src="assets/images/vip.png" alt="">';
//        }
//        if ($fetchform['content']) {
//            $content = "دارد";
//        } else {
//            $content = "ندارد";
//        }
//        echo '
//                            <tr>
//                                <td class="td-list-name td-bg">' . $vip . $fetchform['name'] . ' </td>
//                                <td class="td-cancel"> ' . $fetchform['persianname'] . ' </i></td>
//                                <td class="td-check"> ' . $fetchform['tell'] . ' </i></td>
//                                <td class="td-check"> ' . $fetchform['price'] . ' </i></td>
//                                <td class="td-check">' . $content . '</i></td>
//                                <td class="td-check">' . implode(" , ", $domain_cats) . '</i></td>
//                                <td class="td-check"><a href="delete_domain.php?domainid=' . $fetchform['Domainid'] . '" onclick="delete_domain()"><i class="flaticon-close" style="color: red" title="حذف دامنه" onclick="delete_domain()"></i></a></td>
//                                <td class="td-check"><a href="login.php?domainid= ' . $fetchform['Domainid'] . '" onclick="delete_domain()"><i class="flaticon-refresh" style="color: red" title="ویرایش دامنه"></i></a></td>
//
//
//                            </tr>';
//
//    }
//}
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//?>




<html>
<head>
    <title> Pagination </title>
</head>
<body>
<br><br><br><br>
<?php
//database connection


//define total number of results you want per page
$results_per_page = 1;
//find the total number of results stored in the database
$query = "select * from  domains WHERE access_token='" . $_COOKIE['user'] . "'";
$resultt = mysqli_query($connection, $query);

$number_of_result = mysqli_num_rows($resultt);
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
//retrieve the selected results from database
$query = "SELECT * FROM domains WHERE access_token='" . $_COOKIE['user'] . "' LIMIT " . $page_first_result . ',' . $results_per_page;
$result = mysqli_query($connection, $query);
print_r($result);
//display the retrieved result on the webpage
while ($row = mysqli_fetch_array($result)) {
    echo $row['persianname'] . '       ' . $row['name'] . '</br>';
}
//display the link of the pages in URL
for($page = 1; $page<= $number_of_page; $page++) {
    echo '<a href = "pagination.php?page=' . $page . '">' . $page . ' </a>';
}
?>
</body>
</html>




<head>
    <title> Pagination </title>
</head>
<body>
<?php
//database connection

$conn = mysqli_connect('localhost', 'root', '','instagram');
if (! $conn) {
    die("Connection failed" . mysqli_connect_error());
}
else {
    mysqli_select_db($conn, 'pagination');
}
//define total number of results you want per page
$results_per_page = 20;
//find the total number of results stored in the database
$query = "select * from  useres ";
$result = mysqli_query($conn, $query);

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
//retrieve the selected results from database
$query = "SELECT * FROM useres  LIMIT " . $page_first_result . ',' . $results_per_page;
$result = mysqli_query($conn, $query);
//display the retrieved result on the webpage
while ($row = mysqli_fetch_array($result)) {
    echo $row['userid'] . ' ' . $row['username'] . '</br>';
}
//display the link of the pages in URL
for($page = 1; $page<= $number_of_page; $page++) {
    echo '<a href = "New Text Document.php?page=' . $page . '">' . $page . ' </a>';
}
?>
</body>
</html>
















<?php
$ppp = 10;
$rows = mysql_num_rows($query);

$nmpages = ceil($rows/$ppp);

// if current page is not 1, draw PREVIOUS link
if ($pg > 1 && $nmpages != 0) {
    echo "<a href=\"?pg=".($pg-1)."\">&lt;</a> ";
}

For($i = 1 ; $i <= $nmpages ; $i++) {
    If($i == $pg) {
        echo "<a href=\"#\" class=\"selected\"><b>".$i."</b></a> ";
    } else {
        echo "<a href=\"?pg=".$i."\">".$i."</a> ";
    }
}
// if current page less than max pages, draw NEXT link
if ($pg < $nmpages && $nmpages != 0) {
    echo "<a href=\"?pg=".($pg+1)."\">&gt;</a>";
}
?>

<?php
$link = "";
$page = $_GET['pg']; // your current page
// $pages=20; // Total number of pages

$limit=5  ; // May be what you are looking for
$pages=10;
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

echo $link;
?>




<div class="row" style="text-align: center;">
    <ul class="pagination">
        <?php
        $link = "";
        $page = $_GET['page']; // your current page
        // $pages=20; // Total number of pages
        $pages= $number_of_page;
        $limit=6 ; // May be what you are looking for

        if ($pages >=1 && $page <= $pages)
        {
            $counter = 1;
            $link = "";
            if ($page > ($limit/2))
            { $link .= '<li class="page-item active"><a class="page-link" href="?page=1">1</a></li>; ... '; }
            for ($x=$page; $x<=$pages;$x++)
            {

                if($counter < $limit)
                    $link .= '<li class="page-item active"><a class="page-link" href="\?page='.$x.'\">'.$x.'</a></li>';

                $counter++;
            }

            if ($page < $pages - ($limit/2))
            { $link .= "... " . '<li class="page-item active"><a class="page-link" href=\"?page=" '.$pages.'"\">'.$pages.'</a></li>'; }
        }

        echo $link;
        ?>

    </ul>

</div>
<?php
$link = "";
$page = $_GET['page']; // your current page
// $pages=20; // Total number of pages
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

echo $link;
?>

