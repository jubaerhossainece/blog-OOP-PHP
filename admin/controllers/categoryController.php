<?php 
    ob_start();
	include '../../config/Config.php';
	include '../../library/Database.php';
	include '../../library/Session.php';
    include '../../helpers/Request.php';
	include '../../helpers/Format.php';

	Session::checkSession();
	$db = new Database;
     $obj = new Request;
     $req = $obj->inputValidate($_GET);
 ?>

<?php 
     //inserting category in database
     if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($req->action)){
        if ($req->action === 'insert') {
            //category input validation
            $obj = new Request;
            $request = $obj->inputValidate($_POST);

            $validation = $obj->validate($request, [
                'name' => ['min:3', 'required', 'unique:tbl_categories']
            ]);

            if($validation){
                header("Location:../categories-create.php");
                ob_end_flush();
                exit;
            }else{
                $query = "INSERT INTO tbl_categories(name) VALUES('$request->name')";
                $insert = $db->insert($query);
                if ($insert) {
                    Session::set('msg', 'Category insertion successful!');
                    header("Location:../categories.php");
                    ob_end_flush();
                    exit;
                }else{
                    Session::set('msg', 'Category insertion failed!');
                    header("Location:../categories-create.php");
                    ob_end_flush();
                    exit;
                }
            }
        }
    }


    //updateing category name in database
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($req->action)){
        if ($req->action === 'update') {
        	if(isset($_GET['cat_id'])){
        		$cat_id = $_GET['cat_id'];
        		$cat_query = "SELECT * FROM  tbl_categories WHERE id=$cat_id";
                $categories = $db->select($cat_query);
                if(!categories){
                    header("Location:../categories.php");
                    ob_end_flush();
                    exit;
                }else{
                    $category = $categories->fetch_object();
                }
        	}else{
                header("Location:../categories.php");
                ob_end_flush();
                exit;
            }

            //category input validation
            $obj = new Request;
            $request = $obj->inputValidate($_POST);
            
            $validation = $obj->validate($request, [
                'name' => ['min:3', 'required', 'unique:tbl_categories,'.$category->id]
            ]);

            if($validation){
                header("Location:../categories-edit.php?category_id=$cat_id");
                ob_end_flush();
                exit;
            }else{
                $query = "UPDATE tbl_categories
                          SET 
                          name='$request->name' 
                          WHERE id = $cat_id";

                $update = $db->update($query);
                if($update){
                    Session::set('msg', 'Category updated successfully!');
                    header("Location:../categories.php");
                    ob_end_flush();
                    exit;
                }else{
                    Session::set('msg', 'Category update failed!');
                    header("Location:../categories-edit.php?category_id=$cat_id");
                    ob_end_flush();
                    exit;
                }
            }
        }
    }

    if (isset($_POST)) {
        $req = $obj->inputValidate($_POST);
    }
    //deleting category from database
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($req->action)){
        if ($req->action === 'delete') {
        	if (isset($req->category_id)) {
				$cat_id = $req->category_id;
				$query = "DELETE FROM tbl_categories WHERE id=$cat_id";
				$delete_cat = $db->delete($query);
				if($delete_cat){
					Session::set('msg', 'Category deleted from database!');
					header("Location:../categories.php");
                    ob_end_flush();
                    exit;
				}else{
					Session::set('msg', 'Category can not be deleted!');
					header("Location:../categories.php");
                    ob_end_flush();
                    exit;
				}
			}
        }
    }
    ob_end_flush();
  ?>