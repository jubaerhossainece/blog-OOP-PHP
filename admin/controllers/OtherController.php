<?php 
	ob_start();
	include '../../config/Config.php';
	include '../../library/Database.php';
	include '../../library/Session.php';
	include '../../helpers/Format.php';
	include '../../helpers/Request.php';
	Session::checkSession();
	$db = new Database;
$obj = new Request;
//updateing user data in database
$req = $obj->inputValidate($_GET);
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($req->action)){
	if ($req->action === 'update') {
		if(isset($req->other_id)){
			$other_id = $req->other_id;
			$query = "SELECT * FROM tbl_users WHERE id=$other_id";
			$others = $db->select($query);
			if(!$others){
				header("Location:../others.php");
        ob_end_flush();
        exit;
			}else{
				$other = $others->fetch_object();
			}
		}else{
			header("Location:../others.php");
      ob_end_flush();
      exit;
		}
		$photo = $_FILES['logo'];
	  $destination = "../images/logo/";
		//sanitizing all input values within the global array $_POST
		//user input validation
		$request = $obj->inputValidate($_POST);
			$error1 = Validation::image($photo, 'logo');
			$error2 = Validation::maxFileSize($photo, 1, 'logo'); 
	    //finding if there is any error
	    $er_array = array($error1, $error2);
	    $error = Validation::error($er_array);

	    if($error){
	    	header("Location:../other-edit.php?other_id=$other_id");
        ob_end_flush();
        exit;
	    }else{
		    //photo upload and unique filename 
	    	if ($photo['size'] !== 0 && $photo['tmp_name'] !== '') {
			    $file_ext = pathinfo($photo['name'], PATHINFO_EXTENSION);
			    $filename = "logo".".".$file_ext;
			    $upload = move_uploaded_file($photo['tmp_name'], $destination.$filename);
			    if($other->logo){
				    unlink($destination.$other->logo);			    	
			    }
	    	}else{
	    		$filename = $other->logo;
	    	}

	        $query = "UPDATE tbl_others
	        SET
	        title='$request->title', 
	        slogan='$request->slogan', 
	        copyright='$request->copyright', 
	        logo='$filename'
	        WHERE 
	        id=$other->id";

	        $update = $db->update($query);
	        if ($update) {
	            Session::set('msg', 'Website information updated successfully!');
	            header("Location:../others.php"); 
	            ob_end_flush();
	            exit;
	        }else{
	            Session::set('failure', 'Website data update failed!');
	            header("Location:../other-edit.php?other_id=$other->id");
	            ob_end_flush();
	            exit;
	        }   
	    }
	} 
}
 ?>