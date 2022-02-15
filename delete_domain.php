<?php
include "connection.php";
if (!isset($_COOKIE['user'])){
    header("Location: index.php");
}
$checkinguser = "SELECT userID FROM users WHERE access_token='".$_COOKIE['user']."'";
$checkinguser = mysqli_query($connection,$checkinguser);
if (mysqli_num_rows($checkinguser)){
    $checkinguser = mysqli_fetch_assoc($checkinguser);
if (isset($_GET['domainid'])) {
    $delete_query = "DELETE FROM `domains`  WHERE  Domainid = '" . $_GET['domainid'] . "'";
    $delete_logo = "SELECT * FROM `domains` WHERE Domainid = '" . $_GET['domainid'] . "'";
    $delete_logo = mysqli_query($connection, $delete_logo);
    $delete_logo = mysqli_fetch_assoc($delete_logo);
    if (mysqli_query($connection, $delete_query)) {
        unlink($delete_logo['logo']);
        $redirect = 'Location: my-domains.php';
        header($redirect);
    }
}

}
