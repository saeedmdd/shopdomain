<?php
include 'connection.php';
$list_ = file_get_contents('wordpressdomains.txt');
$list_ = strip_tags($list_);
$data_array = explode("\n", $list_);
$i = 0;
foreach ($data_array as $domain){
    $i++;

    $domain = trim($domain);
    $url = str_replace(".","-",$domain);
    $time  = time();
    $query = "INSERT INTO `domains`( `name`, `persianname`, `tell`, `price`,`pay`,`vip`,`vitrin`,`content` , `userID`, `logo`, `categoryID`, `url`, `lastupdate`) VALUES 
                                    ('".$domain."','".$domain."','+989121235667','tavafoghi',0,1,1,1,'1','null','[10,12,13,15]','".$url."','".$time."')";
    echo $query.'<br>';
    if (mysqli_query($connection,$query)){
        echo $i."-"."success<br>";
    }
    else{
        echo $i."-"."failed<br>";
    }
}
