<?php 
	ob_start();
	include '../../config/Config.php';
	include '../../library/Database.php';
	include '../../library/Session.php';
	include '../../helpers/Request.php';

	Session::checkSession();
	$db = new Database;
	 $obj = new Request;
	 $req = $obj->inputValidate($_GET);
?>

<?php 
 //inserting post in database
 if($_SERVER['REQUEST_METHOD'] == 'POST' && $req->action === 'insert'){
 	$author_id = Session::get('auth-id');
	//post input validation
	$array = array_merge($_POST, $_FILES);
	$req = new Request;
	$request = $req->inputValidate($array);

	$validation = $req->validate($request, [
		'title' => ['required', 'min:5'],
		'body' => ['required'],
		'category' => ['required'],
		'photo' => ['image', 'maxFileSize:1']
	]);
	$destination = "../images/posts/";


    if ($validation){
        header("Location:../post-create.php");
        ob_end_flush();
        exit;
    }else{
    	//photo upload and unique filename 
    	
    	//photo upload and unique filename 
    	if ($request->photo['size'] !== 0 && $request->photo['tmp_name'] !== '') {
		    $file_ext = pathinfo($request->photo['name'], PATHINFO_EXTENSION);
		    $filename = uniqid().".".$file_ext;
    	}else{
    		$filename = NULL;
    	}

        $query = "INSERT INTO tbl_posts(title, category_id, body, image, author_id, tags) VALUES('$request->title', '$request->category', '$request->body', '$filename', '$author_id', '$request->tags')";
        $insert = $db->insert($query);

        if ($insert) {
        	if ($request->photo['size'] !== 0 && $request->photo['tmp_name'] !== '') {
			    $upload = move_uploaded_file($request->photo['tmp_name'], $destination.$filename);
        	}

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
if($_SERVER['REQUEST_METHOD'] == 'POST' && $req->action == 'update'){
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

	//post input validation
	$array = array_merge($_POST, $_FILES);
	$req = new Request;
	$request = $req->inputValidate($array);

	$validation = $req->validate($request, [
		'title' => ['required', 'min:5'],
		'body' => ['required'],
		'category' => ['required'],
		'photo' => ['image', 'maxFileSize:1']
	]);

	$destination = "../images/posts/";

    if ($validation){
        header("Location:../post-create.php");
        ob_end_flush();
        exit;
    }else{
    	//photo upload and unique filename 
    	if ($request->photo['size'] !== 0 && $request->photo['tmp_name'] !== '') {
		    $file_ext = pathinfo($request->photo['name'], PATHINFO_EXTENSION);
		    $filename = uniqid().".".$file_ext;
    	}else{
    		$filename = $post->image;
    	}
        $query = "UPDATE tbl_posts
        		SET	
		        title='$request->title', 
		        category_id='$request->category', 
		        body='$request->body', 
		        image='$filename', 
		        author_id='$post->author_id', 
		        tags='$request->tags'
		        WHERE 
		        id=$post->id";
		       
        $update = $db->update($query);

        if ($update) {
        	if($request->photo['size'] !== 0 && $request->photo['tmp_name'] !== ''){    		
			    $upload = move_uploaded_file($request->photo['tmp_name'], $destination.$filename);
			    unlink($destination.$post->image);
        	}

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
    if(isset($_GET['action']) && $req->action == 'delete'){
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