            <div class="col-md-3">
                <div class="stat st-items ">
                    Total Items
                    <span>1300</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-comments ">
                    Total Comments
                    <span>1500</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container latest">
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fas fa-users"></i>
                            Latest <?php echo $latestuser?> Registerd Users
                        </div>
                        <div class="panel-body panel-user">
                            <ul class="list-unstyled latest-user">
                                <?php
                                foreach($thelatest as $user)
                                {
                                    echo "<li>". $user['Username'];
                                       echo'<a href="members.php?do=delete&userid='.$user['UserID'].'"><span class="btn btn-danger pull-right confirm" ><i class="fas fa-times"></i></span></a>' ;
                                       echo '<a href="members.php?do=edit&userid='.$user['UserID'].'"><span class="btn btn-success pull-right " >  <i class="fa fa-edit"></i></span></a>';
                                       if($user['ragstatus']==0){
                                        echo '<a href="members.php?do=activate&userid='.$user['UserID'].'"><i class="btn btn-info pull-right "><i class="fas fa-check"></i></i></a>';
                                        }
                                        <i class="ff"></i>
                                    echo"</li>";
                                }
                                ?>
                            </ul>
                        </div>
                </div>
             </div>
             <div class="col-sm-6">
                <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fas fa-tag"></i>
                            Latest Items
                        </div>
                        <div class="panel-body">
                            Panel content
                        </div>
                </div>
             </div>
         </div>
    </div>