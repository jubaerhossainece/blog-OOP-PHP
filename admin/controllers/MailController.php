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
    $req = $obj->inputValidate($_GET);
?>


<?php 
//make important
if(isset($req->star) && $req->star !== '' && $req->star > 0){
    $star_id = $req->star;

    $query = "UPDATE tbl_contacts
                          SET 
                          is_important=true
                          WHERE 
                          id=$star_id";
                $update = $db->update($query);
    if($update){
        header("Location:../mail-important.php");
        ob_end_flush();
        exit;
    }else{
        header("Location:../mail-inbox.php");
        ob_end_flush();
        exit;
    }        

}

//make un important
if(isset($req->unstar) && $req->star !== '' && $req->unstar > 0){
    $unstar_id = $req->unstar;

    $query = "UPDATE tbl_contacts
                          SET 
                          is_important=false
                          WHERE 
                          id=$unstar_id";
                $update = $db->update($query);
    if($update){
        header("Location:../mail-important.php");
        ob_end_flush();
        exit;
    }else{
        header("Location:../mail-important.php");
        ob_end_flush();
        exit;
    }        

}
 ?>