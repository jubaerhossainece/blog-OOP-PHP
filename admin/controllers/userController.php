<?php 
	include '../../config/Config.php';
	include '../../library/Database.php';
	include '../../library/Session.php';
	include '../../helpers/Format.php';
	include '../../helpers/Validation.php';

	Session::checkSession();
	$db = new Database;
?>

<?php 
 //inserting user data in database
 if($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'insert'){
	//user input validation
    $name = $_POST['name'];
    $name = Validation::sanitize($name);

    $email = $_POST['email'];
    $email = Validation::sanitize($email);

    $about = $_POST['about'];
    $about = Validation::sanitize($about);

    $password = $_POST['password'];
    $password = Validation::sanitize($password);

    $photo = $_FILES['photo'];

    $destination = "../images/users/";

    Session::set('name', $name);
    Session::set('email', $email);
    Session::set('about', $about);

    $error1 = Validation::required($name, 'Name');
    $error2 = Validation::required($email, 'Email');
    $error3 = Validation::required($password, 'Password');

    $error4 = Validation::min($name, 4, 'Name');
    $error5 = Validation::min($password, 4, 'Password');
    $error6 = Validation::email($email);
    $error7 = Validation::unique($email, 'email', 'tbl_users');

    $error8 = Validation::image($photo, 'photo');
    $error9 = Validation::maxFileSize($photo, 1, 'photo');   

    $er_array = array($error1, $error2, $error3, $error4, $error5, $error6, $error7, $error8, $error9);
    $error = Validation::error($er_array);

    if ($error){
        header("Location:../user-create.php");
        exit;
    }else{
		$options = [
			    'cost' => 12,
			];

		$password = password_hash($password, PASSWORD_BCRYPT, $options);
    	//photo upload and unique filename 
	    $file_ext = pathinfo($photo['name'], PATHINFO_EXTENSION);
	    $filename = microtime().".".$file_ext;
	    $upload = move_uploaded_file($file_temp, $destination.$filename);

        $query = "INSERT INTO tbl_users(name, email, about, password, image) VALUES('$name', '$email', '$about', '$password', '$filename')";
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

	$variable = ($_POST);
	foreach ($variable as $key => $value) {
		echo "field is ".$key." and value is ".$value."<br><br>";
	}

	//user input validation
    $image = $_FILES['photo'];
    $name = $_POST['name'];
    $name = Validation::sanitize($name);

    $email = $_POST['email'];
    $email = Validation::sanitize($email);

    $about = $_POST['about'];
    $about = Validation::sanitize($about);

    $password = $_POST['password'];
    $password = Validation::sanitize($password);
    echo $name;
    echo $password;
    echo $image['name'];
    return;
    $error1 = Validation::min($name, 4, 'Name');

    if(!empty($password)){
	    $error2 = Validation::min($password, 4, 'Password');    	
    }

    $error3 = Validation::required($name, 'Name');
    $error4 = Validation::required($email, 'Email');
    $error5 = Validation::email($email);
    $error6 = Validation::unique($email, 'email', 'tbl_users');

    if ($photo) {
    	echo 'has photo';
    	return;
		$error8 = Validation::image($photo, 'photo');
		$error9 = Validation::maxFileSize($photo, 1, 'photo'); 
    }else{
    	echo 'no photo';
    	return;
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