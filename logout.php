<?php
if (isset($_COOKIE['user'])){
    setcookie('user',0,time()-10,'/');
    header("Location: index.php");
}
else{
    header("Location: index.php");
}