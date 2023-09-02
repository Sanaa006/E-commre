<?php
/* catagories => [Manages  | Edit | Update | Add | Insert | Dalate | Stats  ] */
 $do=isset($_GET['do']) ?$do=$_GET['do']:'manage'; 
//  if the page is the main page
if($do == 'manage'){
    echo "Welcome you are in manage cotegory page";
    echo '<a href="?do=add">Add new category +</a>';
}
elseif($do=='add'){
    echo "Welcome you are in Add cotegory page";
}
else{
    echo 'Error \' There is no page with this name \' ';
}
