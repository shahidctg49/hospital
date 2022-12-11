<?php  
session_start();
require_once('../config.php');

  if(isset($_SESSION['userdata'])){
    $usr = $_SESSION['userdata'];
  }
  if(isset($_SESSION['doctordata'])){
    $dct = $_SESSION['doctordata'];
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hospital Managment System</title>
    <!-- Jquery -->
    <script src="<?= $baseurl ?>/assets/js/jquery_3.6.js"></script>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css">
    <!-- own css -->
    <link rel="stylesheet" href="../assets/css/app.css" type="text/css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico" />

   
  </head>
  <body>