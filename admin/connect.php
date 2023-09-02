<?php
// connect with database mysql use php pdo  
      
/* $dsn='mysql:host:localhost;dbname:shop';
$user='root';
$pass='';
 $option= array(PDO::MYSQL_ATTR_INIT_COMMAND =>  "SET NAMES 'UTF8'"
); 
try {
    $con = new PDO($dsn, $user, $pass,$option);
    // set the PDO error mode to exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connected";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
   */
$host = '127.0.0.1';
$db   = 'shop';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$options = [
    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES   => false,
];
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
try {
     $con = new \PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}