<?php
/* 
==================================================
=== Manage members page 
=== You can Add | Edit | Delete Members from here
==================================================
*/
ob_start();
session_start();
$pagetitle="Members";

if(isset($_SESSION['Username'])){
    include 'init.php';
    $do=isset($_GET['do']) ?$do=$_GET['do']:'manage'; 
    //start manage page 
    if($do=='manage'){ //manage member page
        $query='';
        if(isset($_GET['page'])&& $_GET['page']=='panding'){
            $query='AND ragstatus=0';
        }
        //select all users excapt admin
        $stmt=$con->prepare("SELECT * FROM users WHERE 	GroupID !=1 $query") ;   
        //execute the statment
        $stmt->execute();
        //assign to variable
        $rows=$stmt->fetchAll();
        ?>
            <h1 class="text-center">Manage Member</h1>
            <div class="container">   
                <div class="form-group form-search">
                    <div class="col-sm-4 pull-right search">
                        <input  type="search" name="search" id="search"  class="form-control" value="" required="required" title="">
                        <i class="fa fa-search pull-right"></i>
                    </div>
                </div> 
                <a href="members.php?do=add" class="btn btn-primary">Add new member <i class="fa fa-plus"></i></a>             
                <div class="table-responsive"> 
                    <table class="main-table table table-bordered  table-hover" id="recordsTbl">
                        <thead>
                            <tr>
                                <td>#ID</td>
                                <td>UserName</td>
                                <td>Email</td>
                                <td>FullName</td>
                                <td>Registerd Date</td>
                                <td>Control</td>
                            </tr>
                        </thead>
                        <?php
                            foreach($rows as $row){
                                echo '<tr>';
                                    echo '<td>'.$row['UserID'].'</td>';
                                    echo '<td>'.$row['Username'].'</td>';
                                    echo '<td>'.$row['Email'].'</td>';
                                    echo '<td>'.$row['fullName'].'</td>';
                                    echo '<td>'.$row['Date'].' </td>';
                                    echo '<td> 
                                                <a href="members.php?do=edit&userid='.$row['UserID'].'" class="btn btn-success"><i class="fa fa-edit edit"></i> Edit</a>
                                                <a href="members.php?do=delete&userid='.$row['UserID'].'" class="btn btn-danger confirm"><i class="fas fa-times"></i> Delete </a>';
                                                if($row['ragstatus']==0){
                                                    echo '<a href="members.php?do=activate&userid='.$row['UserID'].'" class="btn btn-info activate"> Activate</a>';
                                                }
                                    echo' </td>';
                                echo'</tr>';
                            }
                        ?>
                    </table>
                </div>
                <?php if($stmt->rowcount()<= 0): ?>
                <center><small><em>No  record created yet</em></small></center>
                <?php endif?>
                <center id="no_search" style="display:none"><small><em>No Result</em></small></center>
            
            </div>

        <?php
        echo '';
    }elseif($do=='add'){//Add members page
        ?>
             <h1 class="text-center">Add New Member</h1>
                <div class="container">          
                    <form   class="form-horizontal" method="POST" action="?do=insert" role="form">
                        <!-- start username faild -->
                        <div class="form-group form-group-lg">
                            <label for="input-id" class="col-sm-4 control-label">Username</label>
                            <div class="col-xs-10 col-sm-10 col-md-4 col-lg-4 ">
                                <input type="text" name="username" required="required" class="form-control"  autocomplate="off" placeholder="Username to login into shop" onfocus="this.placeholder = ''"
                                      onblur="this.placeholder = 'Username to login into shop'">
                            </div>
                        </div>
                        <!-- End username faild -->
                        <!-- start password faild -->
                        <div class="form-group ">
                            <label for="input-id" class="col-sm-4 control-label">Password</label>
                            <div class=" col-xs-10 col-sm-10 col-md-4 col-lg-4 ">
                                <input type="password" name="password" class="password form-control  "  required="required" autocomplete="new-password" placeholder="Password must be hard & complex" onfocus="this.placeholder = ''"
                                      onblur="this.placeholder = 'Password must be hard & complex'">
                                      <i class="show-pass far fa-eye fa-2x"></i>
                            </div>
                        </div>
                        <!-- End password faild -->
                        <!-- start Email faild -->
                        <div class="form-group "> 
                            <label for="input-id" class="col-sm-4 control-label">Email</label>
                            <div class="col-xs-10 col-sm-10 col-md-4 col-lg-4">
                                <input type="email"  name="email" required="required" class="form-control " placeholder="Email must be valid" onfocus="this.placeholder = ''"
                                      onblur="this.placeholder = 'Email must be valid'">
                            </div>
                        </div>
                        <!-- End Email faild -->
                        <!-- start Fullname faild -->
                        <div class="form-group">
                            <label for="input-id" class="col-sm-4 control-label">Full Name</label>
                            <div class=" col-xs-10 col-sm-10 col-md-4 col-lg-4 ">
                                <input type="text" name="full" required="required" class="form-control" placeholder="Full Name appear in your profile page" onfocus="this.placeholder = ''"
                                      onblur="this.placeholder = 'Full Name appear in your profile page'" >
                            </div>
                        </div>
                        <!-- End fullname  faild -->
                        <!-- start submit faild -->
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-6 ">
                                <input type="submit" value="Add Member" class="btn btn-primary btn-lg">
                            </div>
                        </div>
                        <!-- End submit faild -->
                    </form>  
                </div>
        <?php    
    } elseif($do=='insert'){
        //insert member page
        
        //chack if user coming from http request
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            ?>
            <h1 class="text-center">Insert Member</h1>
            <div class="container">
            <?php
            $user =$_POST['username'];
            $pass = $_POST['password'];
            $email =$_POST['email'];
            $fullname =$_POST['full'];
            $hashpass=sha1( $_POST['password']);
            //validate the form
            $formerrors=array();
            if(strlen($user) < 4 && strlen($user)>0){
                $formerrors[]='  Username cant be <strong>less than 4 characters</strong> ';
            }
            if(strlen($user) >20){
                $formerrors[]='  Username cant be <strong>more than 20 characters</strong> ';
            }
            if(empty($user)){
                $formerrors[]=' Username cant be <strong>empty</strong>';
            }
            if(empty($pass)){
                $formerrors[]=' Password cant be <strong>empty</strong>';
            }
            if(empty($email)){
                $formerrors[]=' Email cant be <strong>empty</strong>';
            }
            if(empty($fullname)){
                $formerrors[]=' Full Name cant be <strong>empty</strong>';
            } 
            //loop into Errors array and echo it
            foreach($formerrors as $error){
                echo '<div class="alert alert-danger">'.$error .'</div>' ;
            }
            //chack if there is no proceed the update opration 
            if(empty($formerrors)){
                // chack if user exist in database
                $chack= checkitem("Username","users",$user);
                if($chack ==1){
                    $themsg= '<div class="alert alert-danger">sorry the user is exist</div>';
                    redirctHome($themsg,'back');
                }
                else{
                        // insert user info to database 
                        $stmt=$con->prepare("INSERT INTO 
                                            users(Username,Password,Email,fullName,	ragstatus,Date)
                                            VALUES(:zuser,:zpass,:zmail,:zname,1,now())");
                        $stmt->execute(array(
                            'zuser'=>$user,
                            'zpass'=>$hashpass,
                            'zmail'=>$email,
                            'zname'=>$fullname
                        ));
                        //echo success message 
                        $themsg= '<div class="alert alert-success">'.$stmt->rowcount(). ' Record Inserted Successfully!</div>';  
                        redirctHome($themsg,'back','success');
                    }
                }
        
        } else{
            ?>
            <div class="container">
            <?php
            $themsg= '<div class="alert alert-danger">sorry you cant browse this page directly</div>';
            redirctHome($themsg,'back');
            ?>
            </div>
            <?php
        }
        ?>
        </div>
        <?php
    }elseif($do=='edit'){ //edit page 
        //code for protection // chack if get request userid is numeric & get the integer value of it 
        $userid=isset($_GET['userid']) && is_numeric($_GET['userid'])?intval( $_GET['userid']):0;
        //select to bring data user // select all data depand on this id
            $stmt = $con->prepare(" SELECT * FROM users WHERE UserID = ? limit 1 ");
            //Execute query 
            $stmt->execute(array($userid));
            //Fatch the data
            $row=$stmt->fetch();
            //the row count
            $count=$stmt->rowcount();
         //code for emphasis found user with this is
         //if there is row with this ID will show form if not found ID will massage
        if($count>0){?>
            <h1 class="text-center">Edit Member</h1>
                <div class="container">          
                    <form   class="form-horizontal" method="POST" action="?do=update" role="form">
                        <input type="hidden" name="userid" value="<?php echo $userid?>">
                        <!-- start username faild -->
                        <div class="form-group form-group-lg">
                            <label for="input-id" class="col-sm-4 control-label">Username</label>
                            <div class="col-xs-10 col-sm-10 col-md-4 col-lg-4 ">
                                <input type="text" name="username" required="required" class="form-control" value="<?php echo $row['Username'] ?>" autocomplate="off">
                            </div>
                        </div>
                        <!-- End username faild -->
                        <!-- start password faild -->
                        <div class="form-group">
                            <label for="input-id" class="col-sm-4 control-label">Password</label>
                            <div class=" col-xs-10 col-sm-10 col-md-4 col-lg-4 ">
                                <input type="hidden" name="oldpassword" value="<?php echo $row['Password'] ?>" >
                                <input type="password" name="newpassword" class="form-control " autocomplete="new-password" placeholder="leave Blank if you want to change"onfocus="this.placeholder = ''"
                                 onblur="this.placeholder = 'leave Blank if you want to change'">
                            </div>
                        </div>
                        <!-- End password faild -->
                        <!-- start Email faild -->
                        <div class="form-group "> 
                            <label for="input-id" class="col-sm-4 control-label">Email</label>
                            <div class="col-xs-10 col-sm-10 col-md-4 col-lg-4">
                                <input type="email"  name="email" required="required" class="form-control " value="<?php echo $row['Email'] ?>">
                            </div>
                        </div>
                        <!-- End Email faild -->
                        <!-- start Fullname faild -->
                        <div class="form-group">
                            <label for="input-id" class="col-sm-4 control-label">Full Name</label>
                            <div class=" col-xs-10 col-sm-10 col-md-4 col-lg-4 ">
                                <input type="text" name="full" required="required" class="form-control" value="<?php echo $row['fullName'] ?>">
                            </div>
                        </div>
                        <!-- End fullname  faild -->
                        <!-- start submit faild -->
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-6 ">
                                <input type="submit" value="save" class="btn btn-primary btn-lg">
                            </div>
                        </div>
                        <!-- End submit faild -->
                    </form>  
                </div>
        <?php }
        else{
            echo '<div class="container">';
            $themsg= '<div class ="alert alert-danger">there is no sush ID</div>';
            redirctHome($themsg);
            echo'</div>';
         }
    } elseif($do == "update"){//update page
        
        ?>
            <h1 class="text-center">Updae Member</h1>
            <div class="container">
        <?php
        //chack if user coming from http request
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $id   =$_POST['userid'];//userid from name input userid from Form
            $user =$_POST['username'];
            $email =$_POST['email'];
            $fullname =$_POST['full'];
            //pasword trick
            $pass=empty($_POST['newpassword'])?$_POST['oldpassword']:sha1($_POST['newpassword']);
            //validate the form
            $formerrors=array();
            if(strlen($user) < 4 && strlen($user)>0){
                $formerrors[]='  username cant be <strong>less than 4 characters</strong> ';
            }
            if(strlen($user) >20){
                $formerrors[]='  username cant be <strong>more than 20 characters</strong> ';
            }
            if(empty($user)){
                $formerrors[]=' Username cant be <strong>empty</strong>';
            }
            if(empty($email)){
                $formerrors[]=' Email cant be <strong>empty</strong>';
            }
            if(empty($fullname)){
                $formerrors[]=' Full Name cant be <strong>empty</strong>';
            } 
            //loop into Errors array and echo it
            foreach($formerrors as $error){
                echo '<div class="alert alert-danger">'.$error .'</div>' ;
            }
            //chack if there is no proceed the update opration 
            if(empty($formerrors)){
                // update the database with this info
                $stmt = $con->prepare("UPDATE users SET Username = ?, Email = ?, fullName =?,Password=?  WHERE UserID = ?");
                $stmt->execute(array( $user, $email, $fullname,$pass,$id));
                //echo success message 
                $themsg= '<div class="alert alert-success">'.$stmt->rowcount(). ' Record Updated Successfully!</div>';  
                redirctHome($themsg,'back','success');
            }
           
        } else{
            ?>
            <div class="container">
            <?php
            $themsg= '<div class="alert alert-danger">sorry you cant browse this page directly</div>';
            redirctHome($themsg);
            ?>
            </div>
            <?php    
            }
        ?>
        </div>
        <?php
    }elseif($do=='delete'){//delete member page
          
        ?>
            <h1 class="text-center">Delete Member</h1>
            <div class="container">
        <?php

            //code for protection // chack if get request userid is numeric & get the integer value of it 
            $userid=isset($_GET['userid']) && is_numeric($_GET['userid'])?intval( $_GET['userid']):0;
            //select to bring data user // select all data depand on this id
                
            $chack= checkitem("userid","users",$userid);
            if($chack>0){
                $stmt = $con->prepare("DELETE FROM users WHERE UserID = :zuser");
                $stmt->bindParam(":zuser",$userid);
                $stmt->execute();

                $themsg= '<div class="alert alert-success">'.$stmt->rowcount(). ' Record Delete Successfully!</div>';    
                redirctHome($themsg,'back','success');
            }
            else{
                $themsg= '<div class="alert alert-danger">This ID is not exist</div>';
                redirctHome($themsg);
            }
        ?>
        </div>
        <?php    
    }elseif($do=='activate'){//activate members page
        ?>
        <h1 class="text-center">Activate Member</h1>
        <div class="container">
        <?php

        //code for protection // chack if get request userid is numeric & get the integer value of it 
        $userid=isset($_GET['userid']) && is_numeric($_GET['userid'])?intval( $_GET['userid']):0;
        //select to bring data user // select all data depand on this id
            
        $chack= checkitem("userid","users",$userid);
        if($chack>0){
            $stmt = $con->prepare("UPDATE users SET ragstatus = 1 WHERE UserID=? ");
            $stmt->execute(array($userid));

            $themsg= '<div class="alert alert-success">'.$stmt->rowcount(). ' Record Activate Successfully!</div>';    
            redirctHome($themsg,'back','success');
        }
        else{
            $themsg= '<div class="alert alert-danger">This ID is not exist</div>';
            redirctHome($themsg);
        }
        ?>
        </div>
        <?php 
    }
    elseif($do=="search"){

    }
    include $tmp . "footer.php";
}
else{
    header('Location: index.php');
    exit;
}
ob_end_flush();
?>