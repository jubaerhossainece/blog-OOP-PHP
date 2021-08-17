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
	//post input validation
	$array = array_merge($_POST, $_FILES);
	$req = new Request;
	$request = $req->inputValidate($array);

	$validation = $req->validate($request, [
		'name' => ['required'],
		'body' => ['required'],
		'photo' => ['image', 'maxFileSize:1']
	]);

	$destination = "../images/pages/";


    if ($validation){
        header("Location:../page-create.php");
        ob_end_flush();
        exit;
    }else{
    	//photo upload and unique filename 
    	if ($request->photo['size'] !== 0 && $request->photo['tmp_name'] !== '') {
		    $file_ext = pathinfo($request->photo['name'], PATHINFO_EXTENSION);
		    $filename = uniqid().".".$file_ext;
    	}else{
    		$filename = NULL;
    	}

        $query = "INSERT INTO tbl_pages(name, body, image) VALUES('$request->name', '$request->body', '$filename')";
        $insert = $db->insert($query);

        if ($insert) {
        	if ($request->photo['size'] !== 0 && $request->photo['tmp_name'] !== '') {
			    $upload = move_uploaded_file($request->photo['tmp_name'], $destination.$filename);
        	}

            Session::set('msg', 'Page created successfully!');
            header("Location:../pages.php");
            ob_end_flush();
            exit;
        }else{
            Session::set('failure', 'Page data insertion failed!');
            header("Location:../page-create.php");
            ob_end_flush();
            exit;
        }
    }
}


//updateing post data in database
if($_SERVER['REQUEST_METHOD'] == 'POST' && $req->action == 'update'){
	if (isset($req->page_id)) {
		$page_id = $req->page_id;
		$page_query = "SELECT * FROM tbl_pages WHERE id='".$page_id."'";

		$pages = $db->select($page_query);
		if (!$pages) {
			header('Location:../pages.php');
	        ob_end_flush();
	        exit;
		}else{
			$page = $pages->fetch_object();
		}
	}else{
		header('Location:../pages.php');
        ob_end_flush();
        exit;
	}

	//post input validation
	$array = array_merge($_POST, $_FILES);
	$req = new Request;
	$request = $req->inputValidate($array);

	$validation = $req->validate($request, [
		'name' => ['required'],
		'body' => ['required'],
		'photo' => ['image', 'maxFileSize:1']
	]);

	$destination = "../images/pages/";

    if ($validation){
        header("Location:../page-edit.php?page_id=$page_id");
        ob_end_flush();
        exit;
    }else{
    	//photo upload and unique filename 
    	if ($request->photo['size'] !== 0 && $request->photo['tmp_name'] !== '') {
		    $file_ext = pathinfo($request->photo['name'], PATHINFO_EXTENSION);
		    $filename = uniqid().".".$file_ext;
    	}else{
    		$filename = $page->image;
    	}
        $query = "UPDATE tbl_pages
        		SET	
		        name='$request->name', 
		        body='$request->body', 
		        image='$filename'
		        WHERE 
		        id=$page->id";
		       
        $update = $db->update($query);

        if ($update) {
        	if($request->photo['size'] !== 0 && $request->photo['tmp_name'] !== ''){    		
			    $upload = move_uploaded_file($request->photo['tmp_name'], $destination.$filename);
			    unlink($destination.$page->image);
        	}

            Session::set('msg', 'Page has been updated successfully!');
            header("Location:../pages.php");
            ob_end_flush();
            exit;
        }else{
            Session::set('failure', 'Page data update failed!');
            header("Location:../page-edit.php?page_id=$page_id");
            ob_end_flush();
            exit;
        }
    }
   }

   //deleting post data from database
    if(isset($req->action) && $req->action == 'delete'){
    	if (isset($req->page_id)) {
			$page_id = $req->page_id;
			$select_query = "SELECT * FROM tbl_pages WHERE id=$page_id";
			$pages = $db->select($select_query);
			if ($pages) {
				$page = $pages->fetch_object();
			}else{
				header("Location:../pages.php");
	            ob_end_flush();
	            exit;
			}

			$query = "DELETE FROM tbl_pages WHERE id=$page_id";
			$deleted = $db->delete($query);
			if($deleted){
			    $destination = "../images/pages/";
				if($page->image){
					unlink($destination.$page->image);
				}
				Session::set('msg', 'Post has been deleted from database!');
				header("Location:../pages.php");
	            ob_end_flush();
	            exit;
			}else{
				Session::set('msg', 'Post can not be deleted!');
				header("Location:../pages.php");
	            ob_end_flush();
	            exit;
			}
		}
    }
	ob_end_flush();
?>