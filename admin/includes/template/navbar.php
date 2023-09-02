<nav class="navbar navbar-inverse" role="navigation">
  <div class="container">   
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#app-nav">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="dashboard.php"><?php echo lang('HOME_ADMIN') ?></a>
    </div>
    <div class="collapse navbar-collapse" id="app-nav">
        <ul class="nav navbar-nav ">
        <li ><a class="link" href="catego.php"><?php echo lang('CATEGORIES') ?></a></li>
        <li ><a class="link" href="#"><?php echo lang('ITEMS') ?></a></li>
        <li ><a class="link" href="members.php"><?php echo lang('MEMBERS') ?></a></li>
        <li ><a class="link" href="#"><?php echo lang('STATISTICS') ?></a></li>
        <li ><a class="link" href="#"><?php echo lang('LOGS') ?></a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">  
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sanaa<b class="caret"></b></a>
            <ul class="dropdown-menu">
            <li><a href="members.php?do=edit&userid=<?php echo $_SESSION['ID'] ;?>"> Edit profile</a></li>
            <li><a href="#"> Setting </a></li>
            <li><a href="logout.php">Logout</a></li>
            </ul>
        </li>
        </ul>
    </div>
  </div>
</nav>