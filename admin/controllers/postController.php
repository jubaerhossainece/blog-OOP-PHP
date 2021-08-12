<?php 
	ob_start();
	include '../../config/Config.php';
	include '../../library/Database.php';
	include '../../library/Session.php';
	include '../../helpers/Request.php';

	Session::checkSession();
	$db = new Database;
?>

<?php 
 //inserting post in database
 if($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'insert'){
 	$author_id = Session::get('auth-id');
	//post input validation
	$req = new Request;
	$request = $req->inputValidate($_POST);
	$photo = $_FILES['photo'];
	$destination = "../images/posts/";

    $error1 = Validation::required($request->title, 'Title');
    $error2 = Validation::required($request->body, 'Body');
    $error3 = Validation::required($request->category, 'Category');
    $error4 = Validation::min($request->title, 5, 'Title');
    $error5 = Validation::image($photo, 'photo');
	$error6 = Validation::maxFileSize($photo, 1, 'photo'); 
    $er_array = array($error1, $error2, $error3, $error4, $error5, $error6);
    $error = Validation::error($er_array);

    if ($error){
        header("Location:../post-create.php");
        ob_end_flush();
        exit;
    }else{
    	//photo upload and unique filename 
    	if ($photo['size'] !== 0 && $photo['tmp_name'] !== '') {
		    $file_ext = pathinfo($photo['name'], PATHINFO_EXTENSION);
		    $filename = microtime().".".$file_ext;
		    $upload = move_uploaded_file($photo['tmp_name'], $destination.$filename);
    	}else{
    		$filename = NULL;
    	}

        $query = "INSERT INTO tbl_posts(title, category_id, body, image, author_id, tags) VALUES('$request->title', '$request->category', '$request->body', '$filename', '$author_id', '$request->tags')";
        $insert = $db->insert($query);
        if ($insert) {
            Session::set('msg', 'Post created successfully!');
            header("Location:../posts.php");
            ob_end_flush();
            exit;
        }else{
            Session::set('failure', 'Post data insertion failed!');
            header("Location:../post-create.php");
            ob_end_flush();
            exit;
        }
    }
}


//updateing post data in database
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'update'){
	if (isset($_GET['post_id'])) {
		$post_id = $_GET['post_id'];
		$post_query = "SELECT * FROM tbl_posts WHERE id='".$post_id."'";
		$posts = $db->select($post_query);
		if (!$posts) {
			header('Location:../posts.php');
	        ob_end_flush();
	        exit;
		}else{
			$post = $posts->fetch_object();
		}
	}else{
		header('Location:../posts.php');
        ob_end_flush();
        exit;
	}

	$author_id = Session::get('auth-id');
	//post input validation
	$req = new Request;
	$request = $req->inputValidate($_POST);
	$photo = $_FILES['photo'];
	$destination = "../images/posts/";

    $error1 = Validation::required($request->title, 'Title');
    $error2 = Validation::required($request->body, 'Body');
    $error3 = Validation::required($request->category, 'Category');
    $error4 = Validation::min($request->title, 5, 'Title');
    $error5 = Validation::image($photo, 'photo');
	$error6 = Validation::maxFileSize($photo, 1, 'photo'); 
    $er_array = array($error1, $error2, $error3, $error4, $error5, $error6);
    $error = Validation::error($er_array);

    if ($error){
        header("Location:../post-create.php");
        ob_end_flush();
        exit;
    }else{
    	//photo upload and unique filename 
    	if ($photo['size'] !== 0 && $photo['tmp_name'] !== '') {
		    $file_ext = pathinfo($photo['name'], PATHINFO_EXTENSION);
		    $filename = microtime().".".$file_ext;
		    $upload = move_uploaded_file($photo['tmp_name'], $destination.$filename);
		    unlink($destination.$post->image);
    	}else{
    		$filename = $post->image;
    	}

        $query = "UPDATE tbl_posts
        		SET	
		        title='$request->title', category_id='$request->category', body='$request->body', image='$filename', author_id='$author_id', tags='$request->tags'
		        WHERE 
		        id=$post->id";
        $update = $db->update($query);
        if ($update) {
            Session::set('msg', 'Post has been updated successfully!');
            header("Location:../posts.php");
            ob_end_flush();
            exit;
        }else{
            Session::set('failure', 'Post data update failed!');
            header("Location:../post-create.php");
            ob_end_flush();
            exit;
        }
    }
   }

   //deleting post data from database
    if(isset($_GET['action']) && $_GET['action'] == 'delete'){
    	if (isset($_GET['post_id'])) {
			$post_id = $_GET['post_id'];
			$select_query = "SELECT * FROM tbl_posts WHERE id=$post_id";
			$posts = $db->select($select_query);
			$post = $posts->fetch_object();
			$query = "DELETE FROM tbl_posts WHERE id=$post_id";
			$deleted = $db->delete($query);
			if($deleted){
			    $destination = "../images/posts/";
				if($post->image){
					unlink($destination.$post->image);
				}
				Session::set('msg', 'Post has been deleted from database!');
				header("Location:../users.php");
	            ob_end_flush();
	            exit;
			}else{
				Session::set('msg', 'Post can not be deleted!');
				header("Location:../users.php");
	            ob_end_flush();
	            exit;
			}
		}
    }
	ob_end_flush();
?>