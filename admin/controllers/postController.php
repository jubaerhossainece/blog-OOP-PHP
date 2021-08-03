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
 	$author_id = Session::get('auth_id');
	//user input validation
    $title = $_POST['title'];
    $title = Format::validation($title);

    $category = $_POST['category'];
    $category = Format::validation($category);

    $body = $_POST['body'];
    $body = Format::validation($body);

    $photo = $_POST['photo'];
    $photo = Format::validation($photo);

    $error1 = Format::emptyValue($title);
    $error2 = Format::emptyValue($body);
    $error3 = Format::emptyValue($category);

    $error4 = Format::min($title, 5, 'Title');

    if($nameLen || $passwordLen){
    	header("Location:../user-create.php");
    	exit;
    }

    if ($error1 || $error2 || $error3 || $error4){
        header("Location:../user-create.php");
    }else{
        $query = "INSERT INTO tbl_posts(title, category_id, body, image, author_id, tags) VALUES('$title', '$category_id', '$body', '$image', '$author_id', '$tags')";
        $insert = $db->insert($query);
        if ($insert) {
            Session::set('msg', 'Post created successfully!');
            header("Location:../posts.php");
        }else{
            Session::set('failure', 'Post data insertion failed!');
            header("Location:../post-create.php");
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
		header("Location:../posts.php");
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

    if(empty($name)){
        Session::set('error-name', 'User name can not be empty!');
    }
    
    if (empty($email)) {
        Session::set('error-email', 'User email can not be empty!');
    }

    $nameLen = Format::min($name, 4, 'Name');
    $passwordLen = Format::min($password, 4, 'Password');

    if($nameLen || $passwordLen){
    	header("Location:../user-edit.php?user_id=$user_id");
    	exit;
    }

    if($users){
    	while ($user = $users->fetch_object()) {
    		if (empty($name) || empty($email)){
		        header("Location:../user-edit.php?user_id=$user->id");
		        exit;
		    }else{
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
    	}
    }else{
    	Session::set('msg', 'No data found!');
    	header("Location:../users.php");
    	exit;
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