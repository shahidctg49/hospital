<?php

session_start();
require_once('../lib/Crud.php'); 

$mysqli = new Crud();

// ! *** Appointment*****

if(isset($_POST['appt'])){
  unset($_POST['appt']);
  $_POST['name'] = htmlentities(ucwords($_POST['name']));
  $_POST['message'] = htmlentities(ucwords($_POST['message']));
  $_POST['date'] = htmlentities(ucwords($_POST['date']));
  $_POST['phone'] = htmlentities($_POST['phone']);
  $phone = $_POST['phone'];
  
  $appt = $mysqli->creator('appointment',$_POST);
  if($appt['error']){
    $_SESSION['appt']=$appt['error'];
    echo "<script> location.replace('$baseurl/')</script>";
  }else{
    if($appt['msg']='saved'){
      if($user['roles']=='SUPERAMDMIN' or $user['roles']=='AMDMIN'){
         $_SESSION['appt']="<p style='color:green'>Appointment Submited </p>";
      echo "<script> location.replace('$baseurl/pages/success.php?phn=$phone')</script>";
      }else{
        $_SESSION['appt']="<p style='color:green'>Appointment Submited </p>";
      echo "<script> location.replace('$baseurl/pages/success.php?phn=$phone')</script>";
      }
      
     
    }
  }
  
}

