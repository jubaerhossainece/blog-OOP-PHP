<?php 
    include '../library/Session.php';
    Session::init();

    include '../config/Config.php';
    include '../library/Database.php';
    include '../helpers/Format.php';
    $db = new Database;
 ?>

 <?php 
    if(Session::get('login') == true){
        header("Location:index.php");
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = Format::validation($_POST['email']);
        $password = Format::validation($_POST['password']);

        $username = mysqli_real_escape_string($db->link, $username);
        $password = mysqli_real_escape_string($db->link, $password);

        $query = "SELECT * FROM tbl_users WHERE email = '$username' AND password = '$password'";
        $result = $db->select($query);

        if($result !=false){
            $row = mysqli_num_rows($result);
            if($row > 0){
                Session::set('login', true);
                $user = $result->fetch_object();
                Session::set('username', $user->email);
                Session::set('name', $user->name);
                Session::set('about', $user->about);

                header("Location:index.php");
            }else{
                Session::set('failed', 'No login data found!');
                header('Location:login.php');
            }
        }else{
            Session::set('failed', 'Credentials did not match!');
            header('Location:login.php');
        }
    }
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
                                 <h4>Rosella</h4>
                                <?php if (Session::get('failed')) {
                                  ?>
                                <div class="bg-danger text-center text-white p-3 bg-lighten-xl">
                                    <?php echo Session::get('failed'); ?>
                                </div>
                                <?php 
                                } 
                                ?>
        
                                <form class="mt-5 mb-5 login-input" method="POST" action="login.php">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>
                                    <button class="btn login-form__btn submit w-100">Sign In</button>
                                </form>
                                <p class="mt-5 login-form__footer">Dont have account? <a href="register.php" class="text-primary">Sign Up</a> now</p>
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