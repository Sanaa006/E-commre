<?php

function lang($phrase){
    static $lang=array(
       //navbar links
       'HOME_ADMIN' => 'Home',
       'CATEGORIES' => 'Categories',
       'ITEMS'      => 'Items',
       'MEMBERS'    => 'Members',
       'STATISTICS' => 'Statistics',
       'LOGS'       => 'Logs',
        
    );
    return $lang[$phrase];
}