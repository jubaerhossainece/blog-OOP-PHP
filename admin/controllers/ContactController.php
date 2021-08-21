<?php 
    ob_start();
    include '../../config/Config.php';
    include '../../library/Database.php';
    include '../../library/Session.php';
    include '../../helpers/Request.php';
    Session::init();

    $db = new Database;
    $obj = new Request;
    $req = $obj->inputValidate($_GET);
?>

<?php 
//inserting post in database
if($_SERVER['REQUEST_METHOD'] == 'POST' && $req->action === 'insert'){
//post input validation
$array = array_merge($_POST);
$req = new Request;
$request = $req->inputValidate($array);

$validation = $req->validate($request, [
    'name' => ['required'],
    'email' => ['required', 'email'],
    'subject' => ['required'],
    'message' => ['required']
]);


if ($validation){
    header("Location:../../contact.php");
    ob_end_flush();
    exit;
}else{
    $query = "INSERT INTO tbl_contacts(name, email, subject, message) VALUES('$request->name', '$request->email', '$request->subject', '$request->message')";
    $insert = $db->insert($query);

    if ($insert) {
        Session::set('msg', 'Your message sent successfully!');
        header("Location:../../contact.php");
        ob_end_flush();
        exit;
    }else{
        header("Location:../../contact.php");
        ob_end_flush();
        exit;
    }
}
}
ob_end_flush();
?> 