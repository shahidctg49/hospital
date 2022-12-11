<?php
session_start();
if(isset($_SESSION) && !($_SESSION['userdata']['roles']== 'SUPERADMIN') ){
    echo "<script> location.replace('$baseurl/dashboard/')</script>";
}



require_once('../lib/Crud.php'); 
$mysqli = new Crud();

    if(!($_SESSION['userdata']['roles']== 'SUPERADMIN') ){
        echo "<script> location.replace('$baseurl/dashboard/')</script>";
    }
    if(isset($_GET['id']) && strlen($_GET['id']) > 0){
      $id = $_GET['id'];
        $_POST['modified_by']= $_SESSION['userdata']['id'];
        $_POST['modified_at']= date('Y-m-d H:i:s');
        $_POST['status']= 0;


    $deleted = $mysqli->updator('user',$_POST,"id=$id");
    if($deleted['error']){
        $_SESSION['delete']=$deleted['error'];
        // echo "<script> location.replace('$baseurl/pages/updateuser.php?id=$id')</script>";
      }else{
        if($deleted['updated']){
          $_SESSION['delete']="<p style='color:green'>Account Deactivated Successfully</p>";
          header("location:http://localhost/hospital/dashboard");
        //   echo "<script> location.replace('$baseurl/form/updateuser.php?id=$id')</script>";
        }
    }
  }

  if(isset($_GET['pid']) && strlen($_GET['pid']) > 0){
    $id = $_GET['pid'];
      $_POST['modified_by']= $_SESSION['userdata']['id'];
      $_POST['modified_at']= date('Y-m-d H:i:s');
      $_POST['status']= 0;


  $deleted = $mysqli->updator('user',$_POST,"id=$id");
  if($deleted['error']){
      $_SESSION['delete']=$deleted['error'];
      // echo "<script> location.replace('$baseurl/pages/updateuser.php?id=$id')</script>";
    }else{
      if($deleted['updated']){
        $_SESSION['delete']="<p style='color:green'>Account Deactivated Successfully</p>";
        header("location:http://localhost/hospital/dashboard");
      //   echo "<script> location.replace('$baseurl/form/updateuser.php?id=$id')</script>";
      }
  }
}

  // Delete Department

  if(isset($_GET['deptId']) && strlen($_GET['deptId']) > 0){
    $id = $_GET['deptId'];
    $_POST['modified_by']= $_SESSION['userdata']['id'];
    $_POST['modified_at']= date('Y-m-d H:i:s');
    
    $checkData = $mysqli->select_single("SELECT status FROM department WHERE id=$id")["singledata"]["status"];
    if($checkData == 0){
      $_POST['status'] = 1;
    }else{
      $_POST['status'] = 0;
    }

  $deleted = $mysqli->updator('department',$_POST,"id=$id");
  if($deleted['error']){
      $_SESSION['delete']=$deleted['msg'];
      echo "<script> location.replace('$baseurl/pages/updateuser.php?id=$id')</script>";
    }else{
      if($deleted['updated']){
        $_SESSION['delete']="<p style='color:green'>Account Deactivated Successfully</p>";
        echo "<script> location.replace('$baseurl/controller/department.php')</script>";
      }
    }
  }

  // Delete Designation

  if(isset($_GET['desiId']) && strlen($_GET['desiId']) > 0){
    $id = $_GET['desiId'];
    $_POST['modified_by']= $_SESSION['userdata']['id'];
    $_POST['modified_at']= date('Y-m-d H:i:s');
    $_POST['status']= 0;


  $deleted = $mysqli->updator('designation',$_POST,"id=$id");
  if($deleted['error']){
      $_SESSION['msg']=$deleted['msg'];
      echo "<script> location.replace('$baseurl/pages/updateuser.php?id=$id')</script>";
    }else{
      if($deleted['updated']){
        $_SESSION['msg']="<p style='color:green'>Account Deactivated Successfully</p>";
        header("location:http://localhost/hospital/pages/categories.php");
        echo "<script> location.replace('$baseurl/form/updateuser.php?id=$id')</script>";
      }
    }
  }

  // Delete Room

  if(isset($_GET['roomId']) && strlen($_GET['roomId']) > 0){
    $id = $_GET['roomId'];
    $_POST['modified_by']= $_SESSION['userdata']['id'];
    $_POST['modified_at']= date('Y-m-d H:i:s');
    $_POST['status']= 0;


  $deleted = $mysqli->updator('room',$_POST,"id=$id");
  if($deleted['error']){
      $_SESSION['msg']=$deleted['msg'];
      echo "<script> location.replace('$baseurl/pages/updateuser.php?id=$id')</script>";
    }else{
      if($deleted['updated']){
        $_SESSION['msg']="<p style='color:green'>Account Deactivated Successfully</p>";
        header("location:http://localhost/hospital/pages/categories.php");
        echo "<script> location.replace('$baseurl/form/updateuser.php?id=$id')</script>";
      }
    }
  }

