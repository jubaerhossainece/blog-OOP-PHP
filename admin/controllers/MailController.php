<?php 
	ob_start();
	include '../../config/Config.php';
	include '../../library/Database.php';
	include '../../library/Session.php';
	include '../../helpers/Format.php';
	include '../../helpers/PageUrl.php';
	include '../../helpers/Request.php';

	Session::checkSession();
    PageUrl::previous();
    PageUrl::current_url();
	$db = new Database;
    $obj = new Request;
    $req = $obj->inputValidate($_GET);
?>


<?php 
//make mail starred(single mail)
if(isset($req->star) && $req->star !== '' && $req->star > 0){
    $star_id = $req->star;
    
    $query = "UPDATE tbl_contacts
                          SET 
                          is_important=true
                          WHERE 
                          id=$star_id";
                $update = $db->update($query);
    if($update){
        PageUrl::back();
        ob_end_flush();
        exit;
    }else{
        PageUrl::back();
        ob_end_flush();
        exit;
    }        

}

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
        PageUrl::back();
        ob_end_flush();
        exit;
    }else{
        PageUrl::back();
        ob_end_flush();
        exit;
    }        

}

//make mail unimportant(single mail)
if(isset($req->unstar) && $req->unstar !== '' && $req->unstar > 0){
    $unstar_id = $req->unstar;

    $query = "UPDATE tbl_contacts
                          SET 
                          is_important=false
                          WHERE 
                          id=$unstar_id";
                $update = $db->update($query);

    if($update){
        PageUrl::back();
        ob_end_flush();
        exit;
    }else{
        PageUrl::back();
        ob_end_flush();
        exit;
    }        

}

$req = $obj->inputValidate($_POST);
//mark as read(multiple mail)
if(isset($req->action_type) && $req->action_type == 'mark_as_read'){
 
    $mail_ids = explode(',', $req->mail_array[0]);
    
     $query = "UPDATE tbl_contacts
                SET 
                is_seen=true
                WHERE 
                id IN (".implode(',', $mail_ids).")";
                
     $update = $db->update($query);       

    if($update){
        PageUrl::back();
        ob_end_flush();
        exit;
    }else{
        PageUrl::back();
        ob_end_flush();
        exit;
    }             
}


$req = $obj->inputValidate($_POST);
//mark as unread(multiple mail)
if(isset($req->action_type) && $req->action_type == 'mark_as_unread'){
 
    $mail_ids = explode(',', $req->mail_array[0]);
    
     $query = "UPDATE tbl_contacts
                SET 
                is_seen=false
                WHERE 
                id IN (".implode(',', $mail_ids).")";
                
     $update = $db->update($query);       

    if($update){
        PageUrl::back();
        ob_end_flush();
        exit;
    }else{
        PageUrl::back();
        ob_end_flush();
        exit;
    }             
}



$req = $obj->inputValidate($_POST);
//mark as important(multiple mail)
if(isset($req->action_type) && $req->action_type == 'mark_as_starred'){
 
    $mail_ids = explode(',', $req->mail_array[0]);
 
     $query = "UPDATE tbl_contacts
                SET 
                is_important=true
                WHERE 
                id IN (".implode(',', $mail_ids).")";
                
     $update = $db->update($query);       

    if($update){
        PageUrl::back();
        ob_end_flush();
        exit;
    }else{
        PageUrl::back();
        ob_end_flush();
        exit;
    }             
}


$req = $obj->inputValidate($_POST);
//send to trash(multiple mail)
if(isset($req->action_type) && $req->action_type == 'mark_as_trashed'){
 
    $mail_ids = explode(',', $req->mail_array[0]);
    $now = new DateTime();

    $now = $now->format('Y-m-d H:i:s');
     $query = "UPDATE tbl_contacts
                SET 
                deleted_at='".$now."'
                WHERE 
                id IN (".implode(',', $mail_ids).")";
                
    $update = $db->update($query);

    if($update){
        PageUrl::back();
        ob_end_flush();
        exit;
    }else{
        PageUrl::back();
        ob_end_flush();
        exit;
    }             
}

 ?>