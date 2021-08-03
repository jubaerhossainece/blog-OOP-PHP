<?php 
	include '../../config/Config.php';
	include '../../library/Database.php';
	include '../../library/Session.php';
	include "../../helpers/Validation.php";

	Session::checkSession();
	$db = new Database;
?>

<?php 
 //inserting category in database
 if($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'insert'){
 	$author_id = Session::get('auth_id');
	//user input validation
    $title = $_POST['title'];
    $title = Validation::sanitize($title);

    $category = $_POST['category'];
    $category = Validation::sanitize($category);

    $body = $_POST['body'];
    $body = Validation::sanitize($body);

    $photo = $_POST['photo'];
    $photo = Validation::sanitize($photo);

    $error1 = Validation::required($title, 'Title');
    $error2 = Validation::required($body, 'Body');
    $error3 = Validation::required($category, 'Category');

    $error4 = Validation::min($title, 5, 'Title');

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
    $name = Validation::sanitize($name);

    $email = $_POST['email'];
    $email = Validation::sanitize($email);

    $about = $_POST['about'];
    $about = Validation::sanitize($about);

    $password = $_POST['password'];
    $password = Validation::sanitize($password);

    $error1 = Validation::required($name, 'Name');
    $error2 = Validation::required($email, 'Email');

    $error3 = Validation::min($name, 4, 'Name');
    $error4 = Validation::min($password, 4, 'Password');

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