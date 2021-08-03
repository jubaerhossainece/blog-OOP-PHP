<?php 
    include '../../config/Config.php';
    include "../../helpers/Format.php";
    include "../../library/Session.php";
    include "../../library/Database.php";

    Session::init();
 ?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $db = new Database;
        $email = Format::validation($_POST['email']);
        $password = $_POST['password'];

        $query = "SELECT * FROM tbl_users WHERE email = '$email'";
        $result = $db->select($query);

        if($result == false){
            Session::set('error-email', 'Your email address did not match our record!');
            Session::set('email', $email);
            header('Location:../login.php');
        }else{
            $user = $result->fetch_object();
            if (password_verify($password, $user->password)) {
                Session::set('login', true);

                Session::set('auth_id', $user->id);
                Session::set('auth_email', $user->email);
                Session::set('auth_name', $user->name);
                Session::set('auth_about', $user->about);
                header("Location:../index.php");
            }else{
                Session::set('error-password', 'Password did not match!');
                Session::set('email', $email);
                header("Location:../login.php");
            }

        }
    }
 ?>