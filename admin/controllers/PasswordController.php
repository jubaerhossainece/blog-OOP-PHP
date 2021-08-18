<?php 
    ob_start();
	include '../../config/Config.php';
	include '../../library/Database.php';
	include '../../library/Session.php';
    include '../../helpers/Request.php';
	include '../../helpers/Format.php';

	Session::checkSession();
	$db = new Database;
     $obj = new Request;
     $req = $obj->inputValidate($_GET);
 ?>

<?php 
     //verif user before changing password
     if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($req->action)){
        if ($req->action === 'verify') {
            //password input validation
            $obj = new Request;
            $request = $obj->inputValidate($_POST);

            $query = "SELECT password FROM tbl_users WHERE id=".Session::get('auth-id');
            $users = $db->select($query);
            $user = $users->fetch_object();

            if(password_verify($request->password, $user->password)){                
                Session::set('password-reset', 'password_verified');
                header("Location:../password-change.php");
                ob_end_flush();
                exit;
            }else{
                Session::set('msg', 'Password did not match.');
                header("Location:../verify-user.php");
                ob_end_flush();
                exit;
            }
        }
    }


    //updateing user password
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($req->action)){
        if ($req->action == 'updatePassword') {
            //category input validation
            $obj = new Request;
            $request = $obj->inputValidate($_POST);
            $validation = $obj->validate($request, [
                'password' => ['required', 'min: 4']
            ]);

            if ($validation){
                header("Location:../password-change.php");
                exit;
            }else {
                $options = [
                        'cost' => 12,
                    ];
                $password = password_hash($request->password, PASSWORD_BCRYPT, $options);
                 
                 $query = "UPDATE 
                           tbl_users
                           SET 
                           password='$password' 
                          WHERE id =".Session::get('auth-id');
                 
                 $update = $db->update($query);

                 if($update){
                    Session::Set('success-message', 'Your password has been changed successfully.');
                    header("Location:../password-change.php");
                    exit;
                 }else{
                    Session::Set('msg', 'Your not changed has been changed successfully.');
                    header("Location:../password-change.php");
                    exit;
                } 
            }
        }
    }
    ob_end_flush();
  ?>