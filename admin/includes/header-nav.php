<?php 
    //total unseen messages
    $query = "SELECT COUNT(id) as total FROM tbl_contacts WHERE is_important=false AND is_seen=false";
    $header_total_message = $db->select($query)->fetch_object();

    //latest messages
    $query_unseen = "SELECT * FROM tbl_contacts WHERE is_important=false AND is_seen=false ORDER BY created_at DESC LIMIT 4";
    $header_mails = $db->select($query_unseen);
?>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        
        <div class="nav-header">
            <div class="brand-logo">
                <a href="index.html">
                    <b class="logo-abbr"><img src="assets/libraryimages/logo.png" alt=""> </b>
                    <span class="logo-compact"><img src="assets/library/images/logo-compact.png" alt=""></span>
                    <span class="brand-title">
                        <img src="assets/library/images/logo-text.png" alt="">
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">    
            <div class="header-content clearfix">
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-left">
                    <div class="input-group icons">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"><i class="mdi mdi-magnify"></i></span>
                        </div>
                        <input type="search" class="form-control" placeholder="Search Dashboard" aria-label="Search Dashboard">
                        <div class="drop-down animated flipInX d-md-none">
                            <form action="#">
                                <input type="text" class="form-control" placeholder="Search">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-email-outline"></i>
                                <span class="badge badge-pill gradient-1"><?php echo $header_total_message->total ?></span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class=""><?php echo $header_total_message->total ?> New Messages</span>  
                                    <a href="javascript:void()" class="d-inline-block">
                                        <span class="badge badge-pill gradient-1"><?php echo $header_total_message->total ?></span>
                                    </a>
                                </div>
                               
                <?php
                    if($header_mails){ 
                 ?>                
                                
                                <div class="dropdown-content-body">
                                    <ul>
                        <?php 
                                while($header_mail = $header_mails->fetch_object()){
                            ?>
                                        <li class="notification-unread">
                                            <a href="mail-read.php?mail_id=<?php echo $header_mail->id ?>">
                                                <img class="float-left mr-3 avatar-img" src="assets/library/images/avatar/1.jpg" alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading"><?php echo $header_mail->name ?></div>
                                                    <div class="notification-timestamp"><?php  echo Format::dateForHumans($header_mail->created_at); ?></div>
                                                    <div class="notification-text"><?php echo Format::textShorten($header_mail->subject, 40) ?></div>
                                                </div>
                                            </a>
                                        </li>
                                        <?php 
                                        } 
                                        ?>
                                    </ul>
                                    
                                </div>
                              
                <?php } ?>                
                                
                            </div>
                        </li>
                        <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="badge badge-pill gradient-2">3</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">2 New Notifications</span>  
                                    <a href="javascript:void()" class="d-inline-block">
                                        <span class="badge badge-pill gradient-2">5</span>
                                    </a>
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <?php 
                                        for ($i=0; $i < 4; $i++) { 
                                            
                                         ?>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events near you</h6>
                                                    <span class="notification-text">Within next 5 days</span> 
                                                </div>
                                            </a>
                                        </li>
                                        <?php 
                                            }
                                         ?>
                                    </ul>
                                    
                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown d-none d-md-flex">
                            <a href="javascript:void(0)" class="log-user"  data-toggle="dropdown">
                                <span>English</span>  <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
                            </a>
                            <div class="drop-down dropdown-language animated fadeIn  dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a href="javascript:void()">English</a></li>
                                        <li><a href="javascript:void()">Dutch</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <!-- <span class="activity active"></span> -->
                                <img src="images/users/<?php echo  Session::get('auth-image') ? Session::get('auth-image') : 'avatar.png'; ?>" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <div class="dropdown-header border-bottom">
                                        <div class="dropdown-user-img c-pointer position-relative"   data-toggle="dropdown">
                                            <!-- <span class="activity active"></span> -->
                                            <img src="images/users/<?php echo  Session::get('auth-image') ? Session::get('auth-image') : 'avatar.png'; ?>" alt="">
                                        </div>
                                        <div class="user-name">
                                            <p class="pb-1"><?php echo Session::get('auth-name') ?></p>
                                        </div>
                                    </div>
                                    <ul>
                                        <li>
                                            <a href="app-profile.html"> <i class="fas fa-user"></i> <span>Profile</span></a>
                                        </li>
                                        <li>
                                            <a href="mail-inbox.php">
                                                <i class="fas fa-envelope"></i> <span>Inbox</span> <div class="badge gradient-3 badge-pill gradient-1"><?php echo $header_total_message->total ?></div>
                                            </a>
                                        </li>
                                        
                                        <hr class="my-2">
                                        <li>
                                            <a href="verify-user.php"><i class="fas fa-unlock-alt"></i> <span>Change Password</span></a>
                                        </li>
                                        <li>
                                            <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a>
                                            
                                            <form action="Controllers/LoginController.php?action=logout" method="POST" id="logout-form" class="d-none">

                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>