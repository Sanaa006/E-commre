<?php
/* 
======================================
=== Template page 
======================================
*/
ob_start();
session_start();
$pagetitle="";
if(isset($_SESSION['Username'])){
    include 'init.php';
    $do=isset($_GET['do']) ?$do=$_GET['do']:'manage'; 
    if($do=='manage'){

    }elseif($do=='add'){

    }elseif($do=='insert'){

    }elseif($do=='edit'){ 

    }elseif($do == "update"){

    }elseif($do=='delete'){ 

    }elseif($do=='activate'){
    }    
    include $tmp . "footer.php";
}else{
        header('Location: index.php');
        exit; 
    }
ob_end_flush();