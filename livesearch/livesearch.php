<?php
$connection = mysqli_connect("localhost", "teamseoi_domainshop", 'Zx123456789@',"teamseoi_domainshop");
$q = $_GET["q"];
if ( strlen($q) > 0 ) {
    $query_search = "SELECT * FROM domains WHERE  (name LIKE '%" . $q . "%') OR  ( persianname LIKE '%" . $q . "%' )  ORDER BY vip DESC  LIMIT 10 ";
    $query_search = mysqli_query($connection , $query_search);
    if (mysqli_num_rows($query_search)==0){
        echo "<span>نتیجه ای یافت نشد!</span>";
        }
    else {
        echo '<ul>';
        while ($result = mysqli_fetch_assoc($query_search)) {
            echo "<li class='search_live' style='padding-top:5px; border-bottom: 0.5px solid grey;'><a target='_blank' href='domain-details.php?url=".$result['url']."'>" . $result['name'] ."</a></li>";
        }
        echo '</ul>';
    }

}
