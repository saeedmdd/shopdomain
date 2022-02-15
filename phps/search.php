<?php
include "connection.php";

function select_domains_by_search($connection, $searchItem )
{
    include "connection.php";
    $results = "SELECT * FROM  domains  WHERE  name LIKE '%" . $searchItem . "%' OR  persianname LIKE '%" . $searchItem . "%'";
    $results = mysqli_query($connection, $results);
    $search_result=[];
    if (mysqli_num_rows($results)==0){
        return false;
    }
    else {
        while ($result = mysqli_fetch_assoc($results)) {
            array_push($search_result,$result['name']);
        }
        return $search_result;
    }
}

print_r(  select_domains_by_search($connection, "alo"));

?>

<div class="row">
    <div class="col-4">
        <form method="GET" action="index.php">
            <input type="text" style='display:none'  name="cmd" value="search">
            <input type="text" style='display:none'  name="orderby" value="">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search right here..." name="searchitem">
                <br/>
                <button class="btn btn-sm btn-success">Search</button>
            </div>
        </form>
    </div>