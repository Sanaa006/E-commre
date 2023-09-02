<?php
include "connect.php";
//Routes
$tmp='includes/template/';//template directory
$lang="includes/languages/";//language directory
$func="includes/functions/";//Fuction directory
$css ='layout/css/';//css directory
$js ='layout/js/';//css directory
//include the important files
include $lang ."en.php";
include $func ."function.php";
include $tmp ."header.php";
//include navbar on all pages Expact the on with $nonavbar variable
if (!isset($nonavbar)) {include $tmp ."navbar.php";}
?>