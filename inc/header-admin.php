<!--Main Content Start -->
<section class="content">

<!-- Header -->
<header class="top-head container-fluid">
    <button type="button" class="navbar-toggle pull-left">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <!-- Search -->
    <form role="search" class="navbar-left app-search pull-left hidden-xs">
      <input type="text" placeholder="Search..." class="form-control">
    </form>

      
    
    <!-- Right navbar -->
    <ul class="list-inline navbar-right top-menu top-right-menu">  
        <!-- mesages  
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="fa fa-envelope-o "></i>
                <span class="badge badge-sm up bg-purple count">4</span>
            </a>
            <ul class="dropdown-menu extended fadeInUp animated nicescroll" tabindex="5001">
                <li>
                    <p>Messages</p>
                </li>
                <li>
                    <a href="#">
                        <span class="pull-left"><img src="img/avatar-2.jpg" class="img-circle thumb-sm m-r-15" alt="img"></span>
                        <span class="block"><strong>John smith</strong></span>
                        <span class="media-body block">New tasks needs to be done<br><small class="text-muted">10 seconds ago</small></span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="pull-left"><img src="img/avatar-3.jpg" class="img-circle thumb-sm m-r-15" alt="img"></span>
                        <span class="block"><strong>John smith</strong></span>
                        <span class="media-body block">New tasks needs to be done<br><small class="text-muted">3 minutes ago</small></span>
                    </a>
                </li>
                <li>
                    <a href="../page/login/logout.php">
                        <span class="pull-left"><img src="img/avatar-4.jpg" class="img-circle thumb-sm m-r-15" alt="img"></span>
                        <span class="block"><strong>John smith</strong></span>
                        <span class="media-body block">New tasks needs to be done<br><small class="text-muted">10 minutes ago</small></span>
                    </a>
                </li>
                <li>
                    <p><a href="../page/login/logout.php" class="text-right">See all Messages</a></p>
                </li>
            </ul>
        </li>
        --> 
        <!-- /messages -->
        <!-- Notification --> 
        <!-- /Notification -->
        <li class="dropdown text-center">
            <a data-toggle="dropdown" class="dropdown-toggle" href="../page/login/logout.php">
                <img alt="" src="../assets/back-end/img/icon.png" class="img-circle profile-img thumb-sm">
                <span class="username"><?php echo $_SESSION['nama']; ?> </span> <span class="caret"></span>
            </a>
            <ul class="dropdown-menu extended pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
               <li><a href="../page/login/logout.php"><i class="fa fa-sign-out"></i> Log Out</a></li>
            </ul>
        </li>       
    </ul>
    <!-- End right navbar -->
      
    </ul>
    <!-- End right navbar -->

</header>
<!-- Header Ends -->