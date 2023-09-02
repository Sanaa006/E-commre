<?php
 session_start();
 $nonavbar='';
 $pagetitle="Login";
 include "init.php";
if(isset($_SESSION['Username'])){
    header('Location: deshboard.php');// redirect to dashboard page
} 
//chack if user coming from http request
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST['user'];
    $password=$_POST['pass'];
    $hashedpass=sha1($password);

    //chack if the user exist already in database
    $stmt = $con->prepare(" SELECT 
                                 UserID, Username , Password
                            FROM 
                                 users
                            WHERE
                                 username = ?
                            AND 
                                 Password = ?
                            AND 
                                 GroupID=1  
                            limit 1 
                        ");
    $stmt->execute(array($username,$hashedpass));
    $row=$stmt->fetch();
    $count=$stmt->rowcount();
    
    //if count>0 this mean the database content record about this Username
     if($count>0){
       // print_r($row);
        $_SESSION['Username']=$username;//register session name
        $_SESSION['ID']=$row['UserID'];//register session ID
        header('Location: dashboard.php');// redirect to dashboard page
        exit; 
    } 
}
?>

    <form class="login" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
        <h1 class="text-center text-login">Login Admin</h1>
        <input class="form-control input-group input-group-lg" type="text" name="user" placeholder="Username" required="required" autocomplete="off" onfocus="this.placeholder = ''"
                onblur="this.placeholder = 'Username'">
        <input class="form-control  input-group input-group-lg" type="password" name="pass" placeholder="Password" required="required" autocomplete="off"onfocus="this.placeholder = ''"
            onblur="this.placeholder = 'Password'">
        <input class="btn btn-primary btn-block btn-lg" type="submit" value="Login">
    </form>
    
<?php
include $tmp . "footer.php";
?>

