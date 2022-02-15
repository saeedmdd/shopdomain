<?php
include "connection.php";
if (!isset($_COOKIE['user'])){
    header("Location: index.php");
}
$checkinguser = "SELECT userID FROM users WHERE access_token='".$_COOKIE['user']."'";
$checkinguser = mysqli_query($connection,$checkinguser);
if (mysqli_num_rows($checkinguser)){
    if (isset($_GET['domainupdateid'])) {
        $check_update = "SELECT lastupdate FROM `domains` WHERE Domainid = '" . $_GET['domainupdateid'] . "'";
        $check_update = mysqli_query($connection,$check_update);
        $check_update = mysqli_fetch_assoc($check_update);
        $time= time();
        if ($time - $check_update['lastupdate'] >= (60*60*24)){
        $update_query = "UPDATE `domains` SET lastupdate = '".$time."' WHERE  Domainid = '" . $_GET['domainupdateid'] . "'";
        if (mysqli_query($connection, $update_query)) {
            $redirect = 'Location: my-domains.php?seccessupdate';
            header($redirect);
        }
        }
        else{
            $redirect = 'Location: my-domains.php?failedupdate';
            header($redirect);
        }

    }


}
