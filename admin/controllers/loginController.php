<?php 
    ob_start();
    include '../../config/Config.php';
    include "../../library/Session.php";
    include "../../library/Database.php";
    include "../../helpers/Validation.php";

    Session::init();
 ?>
<?php
    //logout section
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'logout') {
        session_destroy();
        Session::init();    
        Session::set('logout-message', 'You are logged out now!');
        header("Location:../login.php");
        ob_end_flush();
        exit;        
    }

    //login section
    if($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'login'){
        $db = new Database;
        $email = Validation::sanitize($_POST['email']);
        $password = $_POST['password'];
        $password = Validation::sanitize($password);

        $query = "SELECT * FROM tbl_users WHERE email = '$email'";
        $result = $db->select($query);

        if($result == false){
            Session::set('error-email', 'Your email address did not match our record!');
            Session::set('email', $email);
            header('Location:../login.php');
            ob_end_flush();
            exit;
        }else{
            $user = $result->fetch_object();
            if (password_verify($password, $user->password)) {
                Session::set('login', true);
                $auth_keys = ['login', 'auth-keys'];
                foreach ($user as $key => $value) {
                    if($key != 'password'){
                        $key = 'auth-'.$key;
                        array_push($auth_keys, $key);
                        Session::set($key, $value);                        
                    }
                }

                Session::set('auth-keys', $auth_keys);
                header("Location:../index.php");
                ob_end_flush();
                exit;
            }else{
                Session::set('error-password', 'Password did not match!');
                Session::set('email', $email);
                header("Location:../login.php");
                ob_end_flush();
                exit;
            }

        }
    }
    ob_end_flush();
 ?>