<?php 
	include '../../config/Config.php';
	include '../../library/Database.php';
	include '../../library/Session.php';
	include '../../helpers/Format.php';

	Session::checkSession();
	$db = new Database;
?>

<?php 
 //inserting category in database
 if($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'insert'){
	//user input validation
    $name = $_POST['name'];
    $name = Format::validation($name);

    $email = $_POST['email'];
    $email = Format::validation($email);

    $about = $_POST['about'];
    $about = Format::validation($about);

    $password = $_POST['password'];
    $password = Format::validation($password);

    Session::set('name', $name);
    Session::set('email', $email);
    Session::set('about', $about);

    $error1 = Format::min($name, 4, 'Name');
    $error2 = Format::min($password, 4, 'Password');

    $error3 = Format::emptyValue($name, 'Name');
    $error4 = Format::emptyValue($email, 'Email');
    $error5 = Format::emptyValue($password, 'Password');

    if(!Format::emptyValue($email, 'Email')){
	    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	    	Session::set('error-email', 'Please write a valid email address!');
	    	$error6 = true;
	    }	
    }

    if ($error1 || $error2 || $error3 || $error3 || $error4 || $error5 || $error6){
        header("Location:../user-create.php");
        exit;
    }else{
		$options = [
			    'cost' => 12,
			];

		$password = password_hash($password, PASSWORD_BCRYPT, $options);

        $query = "INSERT INTO tbl_users(name, email, about, password) VALUES('$name', '$email', '$about', '$password')";
        $insert = $db->insert($query);
        if ($insert) {
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

		//user input validation
    $name = $_POST['name'];
    $name = Format::validation($name);

    $email = $_POST['email'];
    $email = Format::validation($email);

    $about = $_POST['about'];
    $about = Format::validation($about);

    $password = $_POST['password'];
    $password = Format::validation($password);

    $error1 = Format::min($name, 4, 'Name');

    if(!empty($password)){
	    $error2 = Format::min($password, 4, 'Password');    	
    }

    
    $error3 = Format::emptyValue($name, 'Name');
    $error4 = Format::emptyValue($email, 'Email');
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    	Session::set('error-email', 'Please write a valid email address!');
    	$error5 = true;
    }

    if($error1 || $error2 || $error3 || $error4 || $error5){
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

					$password = password_hash($password, PASSWORD_BCRYPT, $options);
			    }

		        $query = "UPDATE tbl_users
		        SET
		        name='$name', email='$email', about='$about', password='$password'
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

    //deleting category from database
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