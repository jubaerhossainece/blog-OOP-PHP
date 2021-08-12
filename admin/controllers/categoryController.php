<?php 
	include '../../config/Config.php';
	include '../../library/Database.php';
	include '../../library/Session.php';
    include '../../helpers/Request.php';
	include '../../helpers/Format.php';

	Session::checkSession();
	$db = new Database;
 ?>

 <?php 
 //inserting category in database
 if($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'insert'){
    //category input validation
    $obj = new Request;
    $request = $obj->inputValidate($_POST);
    $error1 = Validation::required($request->name, 'name');
    $error2 = Validation::unique($request->name, 'name', 'tbl_categories');
    $er_array = array(error1, $error2);
    $error = Validation::error($er_array);
    if($error){
        header("Location:../categories-create.php");
    }else{
        $query = "INSERT INTO tbl_categories(name) VALUES('$name')";
        $insert = $db->insert($query);
        if ($insert) {
            Session::set('msg', 'Category insertion successful!');
            header("Location:../categories.php");
        }else{
            Session::set('failure', 'Category insertion failed!');
            header("Location:../categories-create.php");
        }
    }
    }


    //updateing category name in database
    if($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] = 'update'){
    	if(isset($_GET['cat_id'])){
    		$cat_id = $_GET['cat_id'];
    		$name = $_POST['name'];
        $name = Format::validation($name);

    		if(empty($name)){
    			Session::set('empty', 'Category name can not be empty!');
    			header("Location:../categories-edit.php?category_id=$cat_id");
    		}else{
	    		$query = "UPDATE tbl_categories
	    		SET 
	    		name='$name' 
	    		WHERE id = $cat_id";
	    		$update = $db->update($query);
    			if($update){
    				Session::set('msg', 'Category updated successfully!');
    				header("Location:../categories.php");
    			}else{
            Session::set('msg', 'Category update failed!');
            header("Location:../categories-edit.php?category_id=$cat_id");
    			}
    		}
    	}
    }


    //deleting category from database
    if(isset($_GET['action']) && $_GET['action'] == 'delete'){
    	if (isset($_GET['category_id'])) {
				$cat_id = $_GET['category_id'];
				$query = "DELETE FROM tbl_categories WHERE id=$cat_id";
				$delete_cat = $db->delete($query);
				if($delete_cat){
					Session::set('msg', 'Category deleted from database!');
					header("Location:../categories.php");
				}else{
					Session::set('msg', 'Category can not be deleted!');
					header("Location:../categories.php");
				}
			}
    }
  ?>