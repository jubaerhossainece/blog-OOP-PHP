<?php 
    include '../library/Session.php';
    Session::checkLogin();

    include '../config/Config.php';
    include '../library/Database.php';
    include '../helpers/Format.php';
    $db = new Database;
 ?>
<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login page</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
    <link href="assets/library/css/style.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    
</head>

<body class="h-100">
    
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

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                 <h4 class="text-center mb-3">Login to your account</h4>
                                 <?php echo Session::get('auth-name') ?>
                                    <?php if(Session::get('logout-message')){ ?>
                                        <div class="alert alert-success text-center" role="alert">
                                          <?php  
                                            echo Session::get('logout-message'); 
                                            Session::unsetSession('logout-message');
                                            ?>
                                        </div>
                                    <?php } ?>
        
                                <form class="mt mb-5 login-input" method="POST" action="controllers/LoginController.php?action=login">
                                    <div class="form-group mb-4">
                                        <input type="email" name="email" class="form-control" placeholder="Email" value="<?php if(Session::get('email')){ echo  Session::get('email'); } ?>">
                                        <?php 
                                            if(Session::get('error-email')){
                                        ?>       
                                            <div class="text-danger mt-2">
                                                <strong>                                 
                                                    <?php 
                                                     Session::error('email');
                                                     ?>
                                                </strong>
                                            </div>
                                        <?php        
                                            }
                                         ?>
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                        <?php 
                                            if(Session::get('error-password')){
                                        ?>       
                                            <div class="text-danger mt-2">
                                                <strong>                                 
                                                    <?php 
                                                     Session::error('password');
                                                     ?>
                                                </strong>
                                            </div>
                                        <?php        
                                            }
                                         ?>
                                    </div>
                                    <button class="btn login-form__btn submit w-100">Sign In</button>
                                </form>
                                <p class="mt-5 login-form__footer">Don't have account? <a href="register.php" class="text-primary">Sign Up</a> now</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--**********************************
        Scripts
    ***********************************-->
    <script src="assets/library/plugins/common/common.min.js"></script>
    <script src="assets/library/js/custom.min.js"></script>
    <script src="assets/library/js/settings.js"></script>
    <script src="assets/library/js/gleek.js"></script>
    <script src="assets/library/js/styleSwitcher.js"></script>
</body>
</html>
<?php 
  Session::unsetOld();
?>