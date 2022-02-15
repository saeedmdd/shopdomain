<?php
include("connection.php");
$tableName="domains";
$targetpage = "view_data.php";
$limit =10;
$_GET['searchtext'];


$query = "SELECT COUNT(*) as num FROM $tableName";
$total_pages = mysql_fetch_array(mysql_query($query));
$total_pages = $total_pages['num'];

$stages = 3;
$page = mysql_escape_string($_GET['page']);
if($page){
    $start = ($page - 1) * $limit;
}else{
    $start = 0;
}


// Get page data
$query1 = "SELECT * FROM $tableName  WHERE jobtitle LIKE     
'%$searchtext%' LIMIT $start, $limit";
$result = mysql_query($query1);

// Initial page num setup
if ($page == 0){$page = 1;}
$prev = $page - 1;
$next = $page + 1;
$lastpage = ceil($total_pages/$limit);
$LastPagem1 = $lastpage - 1;
$paginate = '';
if($lastpage > 1)
{
    $paginate .= "<div class='paginate'>";
    // Previous

    if ($page > 1){
        $paginate.= "<a href='$targetpage?page=$prev'>Previous</a>";
    }else{
        $paginate.= "<span class='disabled'>Previous</span>";   }
    // Pages
    if ($lastpage < 7 + ($stages * 2))  // Not enough pages to breaking it up
    {
        for ($counter = 1; $counter <= $lastpage; $counter++)
        {
            if ($counter == $page){
                $paginate.= "<span class='current'>$counter</span>";
            }else{
                $paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}
        }
    }
    elseif($lastpage > 5 + ($stages * 2))   // Enough pages to hide a few?
    {
        // Beginning only hide later pages
        if($page < 1 + ($stages * 2))
        {
            for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
            {
                if ($counter == $page){
                    $paginate.= "<span class='current'>$counter</span>";
                }else{
                    $paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}
            }
            $paginate.= "...";
            $paginate.= "<a href='$targetpage?page=$LastPagem1'>$LastPagem1</a>";
            $paginate.= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";
        }
        // Middle hide some front and some back
        elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
        {
            $paginate.= "<a href='$targetpage?page=1'>1</a>";
            $paginate.= "<a href='$targetpage?page=2'>2</a>";
            $paginate.= "...";
            for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
            {
                if ($counter == $page){
                    $paginate.= "<span class='current'>$counter</span>";
                }else{
                    $paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}
            }
            $paginate.= "...";
            $paginate.= "<a href='$targetpage?page=$LastPagem1'>$LastPagem1</a>";
            $paginate.= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";
        }
        // End only hide early pages
        else
        {
            $paginate.= "<a href='$targetpage?page=1'>1</a>";
            $paginate.= "<a href='$targetpage?page=2'>2</a>";
            $paginate.= "...";
            for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
            {
                if ($counter == $page){
                    $paginate.= "<span class='current'>$counter</span>";
                }else{
                    $paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}
            }
        }
    }
    // Next
    if ($page < $counter - 1){
        $paginate.= "<a href='$targetpage?page=$next'>Next</a>";
    }else{
        $paginate.= "<span class='disabled'>Next</span>";
    }
    $paginate.= "</div>";
}

if(mysqli_num_rows($result) >0){
    while($row = mysqli_fetch_array($result))
    {
        /*echo "<table>";
        echo "<tr > <td>Job Title:</td> <td>{$row['jobtitle']} </td>
    </tr>".
            "<tr > <td>Job Description: </td> <td>
    {$row['jobdescription']}</td> </tr> ".
            "<br>";
        echo "</table>"; */
    }
}
