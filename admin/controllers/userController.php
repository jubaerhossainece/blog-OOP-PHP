<?php 
	ob_start();
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
 $obj = new Request;
 $req = $obj->inputValidate($_GET);
 if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($req->action)){
 	if ( $req->action === 'insert') {
		//user input validation
		$array = array_merge($_POST, $_FILES);
		$request = $obj->inputValidate($array);
	    $destination = "../images/users/";

	    $validation = $obj->validate($request, [
	    	'name' => ['required', 'min:4'],
	    	'email' => ['required', 'email', 'unique:tbl_users'],
	    	'password' => ['required', 'min:4'],
	    	'photo' => ['image', 'maxFileSize:1']
	    ]);

	    if ($validation){
	        header("Location:../user-create.php");
            ob_end_flush();
            exit;
	    }else{
			$options = [
				    'cost' => 12,
				];
			$password = password_hash($request->password, PASSWORD_BCRYPT, $options);
	    	//photo upload and unique filename 
	    	if ($request->photo['size'] !== 0 && $request->photo['tmp_name'] !== '') {
			    $file_ext = pathinfo($request->photo['name'], PATHINFO_EXTENSION);
				$filename = uniqid().".".$file_ext;
			    $upload = move_uploaded_file($request->photo['tmp_name'], $destination.$filename);
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
                ob_end_flush();
                exit;
	        }else{
	            Session::set('failure', 'User data insertion failed!');
	            header("Location:../users-create.php");
                ob_end_flush();
                exit;
	        }
	    }
 	}
}



//updateing user data in database
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($req->action)){
	if ($req->action === 'update') {
		if(isset($req->user_id)){
			$user_id = $req->user_id;
			$query = "SELECT * FROM tbl_users WHERE id=$user_id";
			$users = $db->select($query);
			if(!$users){
				header("Location:../users.php");
	            ob_end_flush();
	            exit;
			}else{
				$user = $users->fetch_object();
			}
		}else{
			header("Location:../users.php");
            ob_end_flush();
            exit;
		}
	    $destination = "../images/users/";
		//sanitizing all input values within the global array $_POST
		//user input validation
		$array = array_merge($_POST, $_FILES);
		$obj = new Request;
		$request = $obj->inputValidate($array);

		$validation = $obj->validate($request, [
			'name' => ['required', 'min:4'],
			'password' => ['min:4'],
			'email' => ['required', 'email', 'unique:tbl_users,'.$user->id],
			'photo' => ['image', 'maxFileSize:1']
		]);

	    if($validation){
	    	header("Location:../user-edit.php?user_id=$user_id");
            ob_end_flush();
            exit;
	    }else{
		    if(empty($request->password)){
		        $password = $user->password;
		    }else{
	    		$options = [
					    'cost' => 12,
					];
				$password = password_hash($request->password, PASSWORD_BCRYPT, $options);
		    }

		    //photo upload and unique filename 
	    	if ($request->photo['size'] !== 0 && $request->photo['tmp_name'] !== '') {
			    $file_ext = pathinfo($request->photo['name'], PATHINFO_EXTENSION);
			    $filename = uniqid().".".$file_ext;
			    $upload = move_uploaded_file($request->photo['tmp_name'], $destination.$filename);
			    unlink($destination.$user->image);
	    	}else{
	    		$filename = $user->image;
	    	}

	        $query = "UPDATE tbl_users
			          SET
			          name='$request->name', 
			          email='$request->email', 
			          about='$request->about', 
			          password='$password', 
			          image='$filename'
			          WHERE 
			          id=$user->id";

	        $update = $db->update($query);
	        if ($update) {
	            Session::set('msg', 'User information updated successfully!');
	            header("Location:../users.php"); 
	            ob_end_flush();
	            exit;
	        }else{
	            Session::set('failure', 'User data update failed!');
	            header("Location:../users-edit.php?user_id=$user->id");
	            ob_end_flush();
	            exit;
	        }   
	    }
	} 
}

    //deleting user data from database
    if(isset($req->action) && $req->action == 'delete'){
    	if (isset($req->user_id)) {
			$user_id = $req->user_id;
			$select_query = "SELECT * FROM tbl_users WHERE id=$user_id";
			$users = $db->select($select_query);
			$user = $users->fetch_object();
			$query = "DELETE FROM tbl_users WHERE id=$user_id";
			$delete_user = $db->delete($query);
			if($delete_user){
	    		$destination = "../images/users/";
				if($user->image){
					unlink($destination.$user->image);
				}
				Session::set('msg', 'User profile has been deleted from database!');
				header("Location:../users.php");
	            ob_end_flush();
	            exit;
			}else{
				Session::set('msg', 'User can not be deleted!');
				header("Location:../users.php");
	            ob_end_flush();
	            exit;
			}
		}
    }
    ob_end_flush();
  ?>