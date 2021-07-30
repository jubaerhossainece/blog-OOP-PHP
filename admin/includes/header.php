<?php 
    include '../config/Config.php';
    include '../helpers/Format.php';
    include '../library/Database.php';
    $db = new Database;
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dahboard for blog</title>
    <!-- Favicon icon -->
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

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">