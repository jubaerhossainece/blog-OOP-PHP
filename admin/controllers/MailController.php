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
//make mail important(single mail)
if(isset($req->star) && $req->star !== '' && $req->star > 0){
    $star_id = $req->star;

    $query = "UPDATE tbl_contacts
                          SET 
                          is_important=true
                          WHERE 
                          id=$star_id";
                $update = $db->update($query);
    if($update){
        header("Location:../mail-inbox.php");
        ob_end_flush();
        exit;
    }else{
        header("Location:../mail-inbox.php");
        ob_end_flush();
        exit;
    }        

}

//make mail important(single mail)
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

$req = $obj->inputValidate($_POST);
//mark as read(multiple mail)
if(isset($req->action_type) && $req->action_type == 'mark_as_read'){
 
    $mail_ids = explode(',', $req->mail_array[0]);
 $array = [1,2,3,4];
     $query = "UPDATE tbl_contacts
                SET 
                is_seen=true
                WHERE 
                id IN (".implode(',', $mail_ids).")";
                
     $update = $db->update($query);       

    if($update){
        header("Location:../mail-inbox.php");
        ob_end_flush();
        exit;
    }else{
        header("Location:../mail-inbox.php");
        ob_end_flush();
        exit;
    }             
}

$req = $obj->inputValidate($_POST);
//mark as important(multiple mail)
if(isset($req->action_type) && $req->action_type == 'mark_as_starred'){
 
    $mail_ids = explode(',', $req->mail_array[0]);
 $array = [1,2,3,4];
     $query = "UPDATE tbl_contacts
                SET 
                is_important=true
                WHERE 
                id IN (".implode(',', $mail_ids).")";
                
     $update = $db->update($query);       

    if($update){
        header("Location:../mail-inbox.php");
        ob_end_flush();
        exit;
    }else{
        header("Location:../mail-inbox.php");
        ob_end_flush();
        exit;
    }             
}
 ?>