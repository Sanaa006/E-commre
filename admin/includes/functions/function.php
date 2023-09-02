<?php
/*
=== Title function v1.0  
=== Title function that echo the page title in case the page
=== has the variable $pagetitle and echo default title for other page
*/
function gettitle(){
    global $pagetitle;
    if (isset($pagetitle)){
        echo $pagetitle;
    }
    else{
        echo "Default";
    }
}
/* 
=== Home Redirect function v3.0 
=== [this function accept parameter]
===  $themsg = Echo the  message [error |success |warning]
===  $url= the link you want to redirect to it
===  $statmsg = status of message if success(not null) will take to manage
===  $seconds = seconds before redirecting
*/
function redirctHome($themsg,$url=null,$statmsg=null,$seconds=3){
    
   if($statmsg!=null){
    $url='?do=manage';
    $link='manage page';
   }
   else{
        if ($url === null){
            $url='dashboard.php';
            $link='Home page';
        }
    
        else{
        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !='') {
                $url=$_SERVER['HTTP_REFERER'];
                $link='Presvious page';
            }else{
                $url = 'dashboard.php';
                $link='Home page';
            }
            
        }
   }
    echo $themsg;
    echo "<div class='alert alert-info'>You will redirect to $link after $seconds seconds.</div>";
    header("refresh:$seconds;url= $url");
    exit();
}
/*
=== chack items function v1.0 
=== Function to chack items in database [function eccapt parameter]
=== $select = the item to select [example : user , item , category]
=== $from = the table to select [example : users , items , categories]
=== $value = the value of select [example : sanaa . box ,elctrinac]
*/
function checkitem($select,$from,$value){
    global $con ;
    $statment = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
    $statment-> execute(array($value));
    $count=$statment->rowCount();
    return $count;
}
/* 
=== count number of items function v1.0
=== function to count number of items rows
=== $item = the item of count
=== $table = the table to choose from
*/
function countitem($item,$table){
    global $con;
    $stmt2=$con->prepare("SELECT COUNT($item) FROM $table");
    $stmt2->execute();
    return $stmt2->fetchColumn();
}
/* 
=== Get latest records functions v1.0 
=== function to get latest items from database [users ,items , comments ]
=== $select = field to select
=== $table = the table to choose from
=== $limit = Number of record to get
=== $order = according  what will arranged
*/
function getlatest($select,$table,$order,$limit=5){
    global $con ;
    $getstmt = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
    $getstmt ->execute();
    $rows =$getstmt->fetchAll();
    return $rows;
}