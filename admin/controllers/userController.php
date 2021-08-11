<?php 
	include '../../config/Config.php';
	include '../../library/Database.php';
	include '../../library/Session.php';
	include '../../helpers/Format.php';
	include '../../helpers/Request.php';

	Session::checkSession();
	$db = new Database;
?>

<?php 
 //inserting user data in database
 if($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'insert'){
	//user input validation
	$obj = new Request;
	$request = $obj->inputValidate($_POST);	
    $photo = $_FILES['photo'];
    $destination = "../images/users/";

    $error1 = Validation::required($request->name, 'Name');
    $error2 = Validation::required($request->email, 'Email');
    $error3 = Validation::required($request->password, 'Password');

    $error4 = Validation::min($request->name, 4, 'Name');
    $error5 = Validation::min($request->password, 4, 'Password');
    $error6 = Validation::email($request->email);
    $error7 = Validation::unique($request->email, 'email', 'tbl_users');

    $error8 = Validation::image($request->photo, 'photo');
    $error9 = Validation::maxFileSize($request->photo, 1, 'photo');   

    $er_array = array($error1, $error2, $error3, $error4, $error5, $error6, $error7, $error8, $error9);
    $error = Validation::error($er_array);

    if ($error){
        header("Location:../user-create.php");
        exit;
    }else{
		$options = [
			    'cost' => 12,
			];
		$password = password_hash($request->password, PASSWORD_BCRYPT, $options);
    	//photo upload and unique filename 
    	if ($photo['size'] !== 0 && $photo['tmp_name'] !== '') {
		    $file_ext = pathinfo($photo['name'], PATHINFO_EXTENSION);
		    $filename = microtime().".".$file_ext;
		    $upload = move_uploaded_file($photo['tmp_name'], $destination.$filename);
    	}else{
    		$filename = NULL;
    	}

        $query = "INSERT INTO tbl_users(name, email, about, password, image) VALUES('$request->name', '$request->email', '$request->about', '$password', '$filename')";
        $insert = $db->insert($query);
    
        if ($insert) {
        	foreach ($_POST as $key => $value) {
        		Session::unsetSession($key);
        	}
            Session::set('msg', 'User created successfully!');
            header("Location:../users.php");
        }else{
            Session::set('failure', 'User data insertion failed!');
            header("Location:../users-create.php");
        }
    }
}



//updateing user data in database
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'update'){
	if(isset($_GET['user_id'])){
		$user_id = $_GET['user_id'];
		$query = "SELECT * FROM tbl_users WHERE id=$user_id";
		$users = $db->select($query);
	}else{
		header("Location:../users.php");
	}
	$photo = $_FILES['photo'];
    $destination = "../images/users/";
	//sanitizing all input values within the global array $_POST
	//user input validation
	$obj = new Request;
	$request = $obj->inputValidate($_POST);

    $error1 = Validation::min($request->name, 4, 'Name');
    if(!empty($password)){
	    $error2 = Validation::min($request->password, 4, 'Password');    	
    }

    $error3 = Validation::required($request->name, 'Name');
    $error4 = Validation::required($request->email, 'Email');
    $error5 = Validation::email($request->email);
    $error6 = Validation::unique($request->email, 'email', 'tbl_users', $user_id);
	$error7 = Validation::image($request->photo, 'photo');
	$error8 = Validation::maxFileSize($request->photo, 1, 'photo'); 
    //finding if there is any error
    $er_array = array($error1, $error2, $error3, $error4, $error5, $error6, $error7, $error8);
    $error = Validation::error($er_array);

    if($error){
    	header("Location:../user-edit.php?user_id=$user_id");
    	exit;
    }else{
	    if($users){
	    	while ($user = $users->fetch_object()) {
			    if(empty($password)){
			        $password = $user->password;
			    }else{
		    		$options = [
						    'cost' => 12,
						];
					$password = password_hash($request->password, PASSWORD_BCRYPT, $options);
			    }

			    //photo upload and unique filename 
		    	if ($photo['size'] !== 0 && $photo['tmp_name'] !== '') {
				    $file_ext = pathinfo($photo['name'], PATHINFO_EXTENSION);
				    $filename = microtime().".".$file_ext;
				    $upload = move_uploaded_file($photo['tmp_name'], $destination.$filename);
				    unlink($destination.$user->image);
		    	}else{
		    		$filename = $user->image;
		    	}

		        $query = "UPDATE tbl_users
		        SET
		        name='$request->name', email='$request->email', about='$request->about', password='$password', image='$filename'
		        WHERE 
		        id=$user->id";

		        $update = $db->update($query);
		        if ($update) {
		            Session::set('msg', 'User information updated successfully!');
		            header("Location:../users.php"); 
		            exit;
		        }else{
		            Session::set('failure', 'User data update failed!');
		            header("Location:../users-edit.php?user_id=$user->id");
		            exit;
		        }
			    }	
	    	}else{
	    	Session::set('msg', 'No data found!');
	    	header("Location:../users.php");
	    	exit;
	    }   
    } 
}

    //deleting user data from database
    if(isset($_GET['action']) && $_GET['action'] == 'delete'){
    	if (isset($_GET['user_id'])) {
				$user_id = $_GET['user_id'];
				$query = "DELETE FROM tbl_users WHERE id=$user_id";
				$delete_user = $db->delete($query);
				if($delete_user){
					Session::set('msg', 'User profile has been deleted from database!');
					header("Location:../users.php");
				}else{
					Session::set('msg', 'User can not be deleted!');
					header("Location:../users.php");
				}
			}
    }
  ?>