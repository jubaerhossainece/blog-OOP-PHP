<?php 
    include '../library/Session.php';
    include '../config/Config.php';
    include '../helpers/Format.php';
    include '../helpers/PageUrl.php';
    include '../helpers/Request.php';
    include '../library/Database.php';
    $db = new Database;
    $obj = new Request;
    Session::checkSession();
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dahboard for blog</title>
    <!-- Favicon icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" type="assets/library/image/png" sizes="16x16" href="images/favicon.png">
    <!-- Pignose Calender -->
    <!-- <link href="assets/library//plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet"> -->
    <!-- Chartist -->
    <!-- <link rel="stylesheet" href="assets/library//plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="assets/library//plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css"> -->
    <!-- Custom Stylesheet -->
    <link href="assets/library/css/style.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
</head>

