<?php
  include "config/config.php";
  include "library/Database.php";
  include "helpers/Format.php";
  include 'library/Session.php';
  include 'helpers/Request.php';

  $db = new Database;
  $obj = new Request;
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="seo & digital marketing">
    <meta name="keywords" content="marketing,digital marketing,creative, agency, startup,promodise,onepage, clean, modern,seo,business, company">
    <meta name="author" content="Themefisher.com">

   <title><?php echo Format::title(); ?> page</title>
    <!-- bootstrap.min css -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css">
    <!-- Icofont Css -->
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.css">
    <!-- animate.css -->
    <link rel="stylesheet" href="assets/plugins/animate-css/animate.css">
    <!-- Icofont -->
    <link rel="stylesheet" href="assets/plugins/icofont/icofont.css">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/custom.css">


</head>


<body data-spy="scroll" data-target=".fixed-top">
<nav class="navbar navbar-expand-lg fixed-top trans-navigation">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img src="assets/images/logo.png" alt="" class="img-fluid b-logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i class="fa fa-bars"></i>
                </span>
              </button>

            <div class="collapse navbar-collapse justify-content-end" id="mainNav">
                <ul class="navbar-nav ">
                   <li class="nav-item dropdown">
                        <a class="nav-link smoth-scroll " href="index.php">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link smoth-scroll " href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link smoth-scroll" href="admin/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link smoth-scroll " href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--MAIN HEADER AREA END -->
  <head>