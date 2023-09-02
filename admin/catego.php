<?php
/* 
======================================
=== Categories page 
======================================
*/
ob_start();
session_start();
$pagetitle="Categories";
if(isset($_SESSION['Username'])){
    include 'init.php';
    $do=isset($_GET['do']) ?$do=$_GET['do']:'manage'; 
    if($do=='manage'){
        $sort='ASC';
        $array_sort=['DESC','ASC'];
        if(isset($_GET['sort'])&&in_array($_GET['sort'],$array_sort)){
            $sort=$_GET['sort'];
        }
        $stmt2=$con->prepare("SELECT * FROM categ ORDER BY Orderring $sort ") ;   
        $stmt2->execute();
        $cats=$stmt2->fetchAll();?>
        <h1 class="text-center">Manage Category</h1>
        <div class="container category">
        <a href="catego.php?do=add" class="btn btn-primary  add-cat ">Add new category <i class="fa fa-plus"></i></a>     
            <div class="panel panel-default">
                  <div class="panel-heading">
                        <h3 class="panel-title "><i class="fas fa-tasks"></i> Manage Category
                            <div class="option pull-right">
                                <i class="fa fa-sort" ></i> Ordering:[ 
                                <a href="?sort=ASC" class="<?php if($sort=='ASC'){echo 'active';} ?>"> Asc </a> |
                                <a href="?sort=DESC" class="<?php if($sort=='DESC'){echo 'active';} ?>"> Desc </a> ]
                                <i class="fa fa-eye" ></i> View:[
                                <span class="active" data-view="full">Full </span> |
                                <span data-view="classic" >Classic </span>]
                            </div>
                        </h3>
                  </div>
                  <div class="panel-body">
                        <?php
                        foreach($cats as $cat){
                            echo '<div class="cat">';
                                echo '<div class="hidden-buttons">';
                                    echo '<a href="catego.php?do=edit&&catid='.$cat['ID'].'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit </a>';
                                    echo '<a href="catego.php?do=delete&&catid='.$cat['ID'].'" class="confirm btn btn-xs btn-danger"> <i class="fas fa-times"></i> Delete</a>';
                                echo'</div>';

                                echo '<h3>'. $cat['Name'].'</h3>';
                                echo "<div class='full-view'>";
                                    $description_cat=$cat['Description']==''?"The categoty has no description ":$cat['Description'];
                                    echo '<p>'.$description_cat.'</p>';
                                    if($cat['Visibility']==1){echo "<span class='visibility'><i class='fas fa-eye-slash'></i> Hidden</span>";}
                                    if($cat['Allow_Comment']==1){echo "<span class='Comment'><i class='fas fa-times'></i>comment Disabled</span>";}
                                    if($cat['Allow_Ads']==1){echo "<span class='ads'><i class='fas fa-times'></i>Advertise Disabled</span>";}
                                echo"</div>";
                            echo'</div>';
                            echo "<hr>";
                        }
                        ?>
                  </div>
            </div>  
         </div>
        <?php
    }elseif($do=='add'){//Add Category page?>
        <h1 class="text-center">Add New Category</h1>
        <div class="container">          
            <form   class="form-horizontal" method="POST" action="?do=insert" role="form">
                <!-- start Name faild -->
                <div class="form-group form-group-lg">
                    <label for="input-id" class="col-sm-4 control-label">Name</label>
                    <div class="col-xs-10 col-sm-10 col-md-4 col-lg-4 ">
                        <input type="text" name="name" required="required" class="form-control"  autocomplate="off" placeholder="Name of the cotegory" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Name of the cotegory'">
                    </div>
                </div>
                <!-- End Name faild -->
                <!-- start Description faild -->
                <div class="form-group ">
                    <label for="input-id" class="col-sm-4 control-label">Description</label>
                    <div class=" col-xs-10 col-sm-10 col-md-4 col-lg-4 ">
                        <input type="text" name="description" class=" form-control"  placeholder="Describe the Catgory" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Describe the Catgory'">
                    </div>
                </div>
                <!-- End Description faild -->
                <!-- start Orderring faild -->
                <div class="form-group "> 
                    <label for="input-id" class="col-sm-4 control-label">Orderring</label>
                    <div class="col-xs-10 col-sm-10 col-md-4 col-lg-4">
                        <input type="text"  name="orderring"   class="form-control " placeholder="Number to arringe the Categories " onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Number to arringe the Categories '">
                    </div>
                </div>
                <!-- End Orderring faild -->
                <!-- start Visibility faild -->
                <div class="form-group">
                    <label for="input-id" class="col-sm-4 control-label">Visibile</label>
                    <div class=" col-xs-10 col-sm-10 col-md-4 col-lg-4 ">
                        <div>
                            <input type="radio" name="visibility" id="vis-yes" value="0" checked='checked'>
                            <label for="vis-yes">Yes</label>
                        </div>
                        <div>
                            <input type="radio" name="visibility" id="vis-No" value="1">
                            <label for="vis-No">No</label>
                        </div>
                    </div>
                </div>
                <!-- End Visibility faild -->
                 <!-- start commenting faild -->
                 <div class="form-group">
                    <label for="input-id" class="col-sm-4 control-label">Allow Comment</label>
                    <div class=" col-xs-10 col-sm-10 col-md-4 col-lg-4 ">
                        <div>
                            <input type="radio" name="commenting" id="com-yes" value="0" checked='checked' >
                            <label for="com-yes">Yes</label>
                        </div>
                        <div>
                            <input type="radio" name="commenting" id="com-No" value="1">
                            <label for="com-No">No</label>
                        </div>
                    </div>
                </div>
                <!-- End commenting faild -->
                 <!-- start ads faild -->
                 <div class="form-group">
                    <label for="input-id" class="col-sm-4 control-label">Allow Ads</label>
                    <div class=" col-xs-10 col-sm-10 col-md-4 col-lg-4 ">
                        <div>
                            <input type="radio" name="ads" id="ads-yes" value="0" checked='checked'>
                            <label for="ads-yes">Yes</label>
                        </div>
                        <div>
                            <input type="radio" name="ads" id="ads-No" value="1">
                            <label for="ads-No">No</label>
                        </div>
                    </div>
                </div>
                <!-- End ads faild -->
                <!-- start submit faild -->
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-6 ">
                        <input type="submit" value="Add Category" class="btn btn-primary btn-lg">
                    </div>
                </div>
                <!-- End submit faild -->
            </form>  
        </div>
    <?php    
    }elseif($do=='insert'){
        //insert category page   
        //chack if user coming from http request
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            ?>
            <h1 class="text-center">Insert Category</h1>
            <div class="container">
            <?php
            //Get variable From the Form  
            $name       =$_POST['name'];
            $desc       =$_POST['description'];
            $order      =$_POST['orderring'];
            $visibile   =$_POST['visibility'];
            $comment    =$_POST['commenting'];
            $ads        =$_POST['ads'];
           
            // chack if cotegory exist in database
            $errorchacks=array();
            $chackname= checkitem("Name","categ",$name);
            $chackorder= checkitem("Orderring","categ",$order);
            if($chackorder==1){
                $errorchacks[]= 'sorry the order Category is exist'; 
            }
            if($chackname==1 ){
                $errorchacks[]= 'sorry the Category is exist';    
            }
            if(!empty($errorchacks)){
                foreach($errorchacks as $errorchack){
                echo"<div class='alert alert-danger'>.$errorchack.</div>"; 
                }
                redirctHome('','back');
              }
            if(empty($errorchacks)){
                    // insert Category info to database 
                    $stmt=$con->prepare("INSERT INTO 
                                        categ(Name ,Description,Orderring,Visibility,Allow_Comment,	Allow_Ads)
                                        VALUES(:zname,:zdesc,:zorder,:zvisibile,:zcomment,:zads)");
                    $stmt->execute(array(
                        'zname'    =>$name,
                        'zdesc'    =>$desc,
                        'zorder'   =>$order,
                        'zvisibile'=>$visibile,
                        'zcomment' =>$comment,
                        'zads'     =>$ads
                    ));
                    //echo success message 
                    $themsg= '<div class="alert alert-success">'.$stmt->rowcount(). ' Record Inserted Successfully!</div>';  
                    redirctHome($themsg,'back','success');
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

    }elseif($do=='edit'){
        //code for protection // chack if get request catid is numeric & get the integer value of it 
        $catid=isset($_GET['catid']) && is_numeric($_GET['catid'])?intval( $_GET['catid']):0;
        //select to bring data user // select all data depand on this id
        $stmt = $con->prepare(" SELECT * FROM categ WHERE ID = ? ");
        //Execute query 
        $stmt->execute(array($catid));
        //Fatch the data
        $cat=$stmt->fetch();
        //the row count
        $count=$stmt->rowcount();
         //code for emphasis found user with this is
         //if there is row with this ID will show form if not found ID will massage
        if($count>0){?>
            <h1 class="text-center">Edit Category</h1>
            <div class="container">          
                <form   class="form-horizontal" method="POST" action="?do=update" role="form">
                    <input type="hidden" name="catid" value="<?php echo $catid?>">
                    <!-- start Name faild --> 
                    <div class="form-group form-group-lg">
                        <label for="input-id" class="col-sm-4 control-label">Name</label>
                        <div class="col-xs-10 col-sm-10 col-md-4 col-lg-4 ">
                            <input type="text" name="name" required="required" class="form-control" value="<?php echo $cat['Name']; ?>" placeholder="Name of the cotegory" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Name of the cotegory'">
                        </div>
                    </div>
                    <!-- End Name faild -->
                    <!-- start Description faild -->
                    <div class="form-group ">
                        <label for="input-id" class="col-sm-4 control-label">Description</label>
                        <div class=" col-xs-10 col-sm-10 col-md-4 col-lg-4 ">
                            <input type="text" name="description" class=" form-control" value="<?php echo $cat['Description']; ?>"  placeholder="Describe the Catgory" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Describe the Catgory'">
                        </div>
                    </div>
                    <!-- End Description faild -->
                    <!-- start Orderring faild -->
                    <div class="form-group "> 
                        <label for="input-id" class="col-sm-4 control-label">Orderring</label>
                        <div class="col-xs-10 col-sm-10 col-md-4 col-lg-4">
                            <input type="text"  name="orderring" class="form-control " value="<?php echo $cat['Orderring']; ?>" placeholder="Number to arringe the Categories " onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Number to arringe the Categories '">
                        </div>
                    </div>
                    <!-- End Orderring faild -->
                    <!-- start Visibility faild -->
                    <div class="form-group">
                        <label for="input-id" class="col-sm-4 control-label">Visibile</label>
                        <div class=" col-xs-10 col-sm-10 col-md-4 col-lg-4 ">
                            <div>
                                <input type="radio" name="visibility" id="vis-yes" value="0" <?php if($cat['Visibility']==0){echo 'checked';}?> >
                                <label for="vis-yes">Yes</label>
                            </div>
                            <div>
                                <input type="radio" name="visibility" id="vis-No" value="1"  <?php if($cat['Visibility']==1){echo 'checked';}?> >
                                <label for="vis-No">No</label>
                            </div>
                        </div>
                    </div>
                    <!-- End Visibility faild -->
                    <!-- start commenting faild -->
                    <div class="form-group">
                        <label for="input-id" class="col-sm-4 control-label">Allow Comment</label>
                        <div class=" col-xs-10 col-sm-10 col-md-4 col-lg-4 ">
                            <div>
                                <input type="radio" name="commenting" id="com-yes" value="0" <?php if($cat['Allow_Comment']==0){echo 'checked';}?> >
                                <label for="com-yes">Yes</label>
                            </div>
                            <div>
                                <input type="radio" name="commenting" id="com-No" value="1" <?php if($cat['Allow_Comment']==1){echo 'checked';}?>>
                                <label for="com-No">No</label>
                            </div>
                        </div>
                    </div>
                    <!-- End commenting faild -->
                    <!-- start ads faild -->
                    <div class="form-group">
                        <label for="input-id" class="col-sm-4 control-label">Allow Ads</label>
                        <div class=" col-xs-10 col-sm-10 col-md-4 col-lg-4 ">
                            <div>
                                <input type="radio" name="ads" id="ads-yes" value="0" <?php if($cat['Allow_Ads']==0){echo 'checked';}?> >
                                <label for="ads-yes">Yes</label>
                            </div>
                            <div>
                                <input type="radio" name="ads" id="ads-No" value="1" <?php if($cat['Allow_Ads']==1){echo 'checked';}?>>
                                <label for="ads-No">No</label>
                            </div>
                        </div>
                    </div>
                    <!-- End ads faild -->
                    <!-- start submit faild -->
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-6 ">
                            <input type="submit" value="Save" class="btn btn-primary btn-lg">
                        </div>
                    </div>
                    <!-- End submit faild -->
                </form>  
            </div>
        <?php
        }
        else{
            echo '<div class="container">';
            $themsg= '<div class ="alert alert-danger">there is no sush ID</div>';
            redirctHome($themsg);
            echo'</div>';
        }         

    }elseif($do == "update"){
        ?>
            <h1 class="text-center">Updae category</h1>
            <div class="container">
        <?php
        //chack if user coming from http request
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            //get veriables from the Form 
            $id   =$_POST['catid'];//userid from name input userid from Form
            $name =$_POST['name'];
            $desc =$_POST['description'];
            $order =$_POST['orderring'];
            $visibile =$_POST['visibility'];
            $comment =$_POST['commenting'];
            $ads =$_POST['ads'];
           
                // update the database with this info
                $stmt = $con->prepare("UPDATE
                                            categ
                                       SET
                                            Name  = ?,
                                            Description = ?,
                                            Orderring =?,
                                            Visibility=?,
                                            Allow_Comment=?,
                                            Allow_Ads=? 
                                       WHERE
                                             ID = ?");
                $stmt->execute(array( $name, $desc, $order,$visibile,$comment,$ads,$id));
                //echo success message 
                $themsg= '<div class="alert alert-success">'.$stmt->rowcount(). ' Record Updated Successfully!</div>';  
                redirctHome($themsg,'back','success');
            
           
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

    }elseif($do=='delete'){ 
        ?>
        <h1 class="text-center">Delete category</h1>
        <div class="container">
    <?php

        //code for protection // chack if get request catid is numeric & get the integer value of it 
        $catid=isset($_GET['catid']) && is_numeric($_GET['catid'])?intval( $_GET['catid']):0;
        //select to bring data user // select all data depand on this id
            
        $chack= checkitem("ID"," categ",$catid);
        if($chack>0){
            $stmt = $con->prepare("DELETE FROM  categ WHERE ID = :zid");
            $stmt->bindParam(":zid",$catid);
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

    }
      
    include $tmp . "footer.php";
}else{
        header('Location: index.php');
        exit; 
    }
ob_end_flush();