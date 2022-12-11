<?php
session_start();
require_once('../lib/Crud.php'); 

$mysqli = new Crud();


if(isset($_SESSION['userdata'])){
  $user = $_SESSION['userdata'];
}else{
header("location:http://localhost/hospital/pages/login.php");

}


// ! *** LOGIN ***
if(isset($_POST["login"])){

    unset($_POST["login"]);
    $_POST["password"]= md5(sha1($_POST["password"]));
  
    $data = $mysqli->selector("user","*",$_POST);
    if($data["numrows"]== 0){
      $_SESSION["msg"]="<p style='color:red'>User name or password is wrong.<br> Please try again!</p>";
      echo "<script> location.replace('$baseurl/pages/login.php')</script>";
    }else{
      $data['selectdata'] = $data['selectdata'][0];
      if($data['selectdata']['status']==1){
        $_SESSION['userdata']=$data['selectdata'];
        $_SESSION['msg']="Login success";
  
        if($data['selectdata']['roles']== 'SUPERADMIN'){
          echo "<script> location.replace('$baseurl/dashboard/')</script>";
        }elseif ($data['selectdata']['roles']== 'ADMIN'){
          echo "<script> location.replace('$baseurl/dashboard/admin.php')</script>";
        }elseif ($data['selectdata']['roles']== 'DOCTOR'){
          $id = $_SESSION['userdata']['id'];
          $checkDoctor = $mysqli->select_single("SELECT * FROM doctor WHERE id=$id");
          if($checkDoctor['numrows'] != 1){
            header("location:$baseurl/form/adddoctor.php");
          }else{
            if($checkDoctor['singledata']["status"] == 1){
              $_SESSION['doctordata']= $checkDoctor['singledata'];
              echo "<script> location.replace('$baseurl/pages/doctor.php')</script>";
            }else{
              $_SESSION['msg']="Your Account has been dissable. Please Contact the Admin.";
            }
          }
          
        }elseif ($data['selectdata']['roles']== 'EMPLOYEE'){
          echo "<script> location.replace('$baseurl/dashboard/emp.php')</script>";
        }else{
          echo "<script> location.replace('$baseurl/pages/login.php')</script>";
        }
  
      }else{
        $_SESSION['msg']="You are not active user. Please contact to admin";
      echo "<script> location.replace('$baseurl/pages/login.php')</script>";
      }
      
      
    }
    
}

//  *** LOGIN END***

// ! *** REGISTRATION ***

if(isset($_POST["reg"])){
    unset($_POST["reg"]);
    unset($_POST["cpassword"]);
    if($user){
      $_POST["created_by"] = $user["id"];
    }
    $_POST["password"] = md5(sha1($_POST["password"]));
    $_POST["email"] = htmlentities(trim($_POST["email"]));
    $_POST["name"] = htmlentities(ucwords($_POST["name"]));
    $_POST["phone"] = htmlentities($_POST["phone"]);
    $data = $mysqli->creator("user",$_POST);
    if($data["error"]){
      $_SESSION["msg"]=$data["msg"];
      echo "<script> location.replace('$baseurl/pages/register.php')</script>";
     
    }else{
      if($data['msg']='saved'){
        $_SESSION['msg']="<p style='color:green'>Registration Successfully</p>";
       
      }
      
      echo "<script> location.replace('$baseurl/pages/login.php')</script>";
  
    }
    
}

//  *** REGISTRATION END***


// *** profile uploas ***
if(isset($_POST["images_upload"])){
  unset($_POST["images_upload"]);
  if($_FILES["avatar"]["name"]){
      $path_parts = pathinfo($_FILES["avatar"]["name"]);
      $image_name=trim($_SESSION["userdata"]["name"]).$_SESSION["userdata"]["id"].uniqid().".".$path_parts["extension"];
      $up=move_uploaded_file($_FILES["avatar"]["tmp_name"],"../assets/images/avatar/".$image_name);
      if($up){
          $_POST["avatar"]=$image_name;
      }
  }   
  $_POST["modified_by"] = $user["id"];
  $_POST["modified_at"] = date("Y-m-d H:i:s");
  
  $id= $user["id"];
  $result=$mysqli->updator("user",$_POST,"id=$id");
  if($result["error"]){
  $_SESSION["msg"] = $result["error"];
  echo "<script> location.replace('$baseurl/pages/profile.php?id=$id') </script>";
  }
  else{
    $userdata = $mysqli->select_single("SELECT * FROM user WHERE id=$id")["singledata"];
   $_SESSION['userdata'] = $userdata;
    $_SESSION["msg"] = "profile picture Change";
  echo "<script> location.replace('$baseurl/pages/profile.php?id=$id') </script>";
  }
}


// *** Change Password 
if(isset($_GET["changePassword"])){
unset($_GET["changePassword"]);

}


// *** forget Password
if(isset($_GET["forgetPassword"])){
  unset($_GET["forgetPassword"]);
  
  }
  



// ! *** Appointment*****

if(isset($_POST["appt"])){
  unset($_POST["appt"]);
  $_POST["name"] = htmlentities(ucwords($_POST["name"]));
  $_POST["message"] = htmlentities(ucwords($_POST["message"]));
  $_POST["date"] = htmlentities(ucwords($_POST["date"]));
  $_POST["phone"] = htmlentities($_POST["phone"]);
  $phone = $_POST["phone"];
  
  $ip["patient_id"]=$_POST["patient_id"];
  
    $ip["discount"] = (int) $_POST["visit_fees"] - $_POST["total"];

  $ip["subtotal"]=(int) $_POST["visit_fees"];
  $ip["total"]= (int) $_POST["total"];
  $ip["payment"] = $ip["total"];
  $ip["remark"]="PAID";  
  

  unset($_POST["remark"]);
  unset($_POST["payment"]);
  unset($_POST["visit_fees"]);
  unset($_POST["discount"]);
  unset($_POST["total"]);

  $ip['ipid'] = uniqid('IP'.date('Ymdhis'));
  
  $appt = $mysqli->creator("appointment",$_POST);
  if($appt["error"]){
    $_SESSION["msg"]=$appt["error"];
    echo $appt["error"];
    // echo "<script> location.replace('$baseurl/')</script>";
  }else{ 
    $ip["appointment_id"]=$appt["insert_id"];
   
    if(isset($_POST["discount"])){
      $ip["discount"]=$_POST["discount"];
    }
    $invoice = $mysqli->creator("invoice_payment",$ip);
    $invoieInsert_id = $invoice["insert_id"];

    if($invoice["error"]){
      $_SESSION["msg"]=$appt["error"];
      echo $invoice["error"];
    }
    if($appt['msg']='saved'){
      // if($user['roles']=='SUPERAMDMIN' or $user['roles']=='AMDMIN'){
         $_SESSION['appt']="<p style='color:green'>Appointment Submited </p>";
      echo "<script> location.replace('$baseurl/view/payinfo.php?invoice=$invoieInsert_id')</script>";
      // }else{
      //   $_SESSION['appt']="<p style='color:green'>Appointment Submited </p>";
      // echo "<script> location.replace('$baseurl/pages/success.php?phn=$phone')</script>";
      //  }
      
     
    }
  }
  
}



//  *** Appointment END*****



// add test
if(isset($_POST["addTest"])){
  unset($_POST["addTest"]);

  $_POST["reference_by"] = htmlentities(ucwords($_POST["reference_by"]));
  if($user){
    $_POST["created_by"] = $user["id"];
  }
  $addtest = $mysqli->creator("test",$_POST);
  if($addtest["error"]){
    $_SESSION["msg"]=$addtest["error"];
    // echo "<script> location.replace('$baseurl')</script>";
  }else{
    if($addtest['msg']='saved'){
      $_SESSION['test']="<p style='color:green'>Test Submited </p>";
      echo "<script> location.replace('$baseurl/pages/patient.php')</script>";
    }
  }
}


// *** ADMIT PATIEN ***

if(isset($_POST["admitPatient"])){
unset($_POST["admitPatient"]);
$_POST["refarecne_by"] = htmlentities(ucwords($_POST["refarecne_by"]));
$_POST["guardian_name"] = htmlentities(ucwords($_POST["guardian_name"]));
$_POST["relationship_with_patient"] = htmlentities(ucwords($_POST["relationship_with_patient"]));
$_POST["entry_time"] .= " ".date('h:i:s') ;
$_POST["roles"] = 'ADMITTED';

if($user){
    $_POST["created_by"] = $user["id"];
  }
  $checkData = $mysqli->select_single("SELECT a.*,r.room_no FROM admit a join room r on a.room_id=r.id WHERE patient_id=".$_POST["patient_id"]);
  if($checkData["numrows"] > 0 && $checkData["singledata"]["roles"]=='ADMITTED'){
    $_SESSION["msg"] = "Patient Already Admited in ban no ".$checkData["singledata"]["room_no"];
    echo "<script> location.replace('$baseurl/pages/admitedpatient.php')</script>";
  }else{
    $admitPatient =  $mysqli->creator("admit",$_POST);
    $id = $admitPatient["insert_id"];
  if($admitPatient["error"]){
    $_SESSION['msg']=$data['error'];
  }else{
    $roomData = $mysqli->select_single("SELECT * FROM room WHERE id=".$_POST["room_id"]);
    $roomSelect = $roomData['singledata'];
  $_SESSION['msg']=$admitPatient['msg'];
  if(  $roomData['numrows'] = $roomSelect["capacity"]){
    $data = $mysqli->updator("room",['availability'=>'NO'],"id=".$_POST["room_id"]);
    
    if($data["error"]){
      echo $data["updated"];
    }
  }    
    echo "<script> location.replace('$baseurl/view/details.php?admitid=$id')</script>";
  }
}

}
// capacity




// ! *** Updated user ***

if(isset($_POST["updateData"])){
  unset($_POST["updateData"]);
    unset($_POST["cpassword"]);
    
    $_POST["modified_by"] = $user["id"];
    $_POST["modified_at"] = date("Y-m-d H:i:s");
    
    $_POST["password"] = md5(sha1($_POST["password"]));
    $_POST["email"] = htmlentities(trim($_POST["email"]));
    $_POST["name"] = htmlentities(ucwords($_POST["name"]));
    $_POST["phone"] = htmlentities($_POST["phone"]);
    if($_POST["status"]==""){
      unset($_POST["status"]);
    }else{
      (int) $_POST["status"];
    }
    $id= $_POST["id"];
    $data = $mysqli->updator("user",$_POST,"id=$id");
    if($data["error"]){
      $_SESSION['msg']=$data['msg'];
      echo "<script> location.replace('$baseurl/pages/updateuser.php?id=$id')</script>";
    }else{
      if($data['msg']='saved'){
        $_SESSION['msg']="<p style='color:green'>Update Successfully</p>";
        echo "<script> location.replace('$baseurl/form/updateuser.php?id=$id')</script>";
      }
  
    }
}



// ! *** ADD PATIENT ***
if(isset($_POST["addPatient"])){
  unset($_POST["addPatient"]);

  $_POST["name"] = htmlentities(ucwords($_POST["name"]));
    $_POST["phone"] = htmlentities($_POST["phone"]);
    $_POST["gender"] = htmlentities($_POST["gender"]);
    $_POST["age"] = htmlentities($_POST["age"]);

    htmlentities($_POST["permanent_address"]);
    htmlentities($_POST["present_address"]);

    if($user){
      $_POST["created_by"] = $user["id"];
    }
    $phone = $_POST["phone"];
    $data = $mysqli->creator("patient",$_POST);
    if($data["error"]){
      $_SESSION['msg']=$data['msg'];
      echo "<script> location.replace('$baseurl/pages/patient.php')</script>";
      
    }else{
      if($data['msg']=='saved'){
        $_SESSION['msg']="<p class='h3 text-success text-center justify-content-center mx-auto'>Patient Added Successfully</p>";
        echo "<script> location.replace('$baseurl/pages/patient.php?phn=$phone')</script>";
       
      }
      
      
  
    }


}



// *** ADD DOCTOR ***

if(isset($_POST["adddoctor"])){
  unset($_POST["adddoctor"]);

  $_POST["father_name"] = htmlentities(ucwords($_POST["father_name"]));
  $_POST["mother_name"] = htmlentities(ucwords($_POST["mother_name"]));
  $_POST["qualification"] = htmlentities(ucwords($_POST["qualification"]));
  $_POST["gratuated_from"] = htmlentities(ucwords($_POST["gratuated_from"]));
  $_POST["gender"] = htmlentities($_POST["gender"]);
    if($user){
      $_POST["created_by"] = $user["id"];
    }
    $data = $mysqli->creator("doctor",$_POST);
    if($data["error"]){
      $_SESSION["dct"]=$data["msg"];
      echo "<script> location.replace('adddoctor.php')</script>";
      
    }else{
      if($data["msg"]=="saved"){
        if($data["selectdata"]["roles"]== "SUPERADMIN"){
          echo "<script> location.replace('$baseurl/dashboard/admin.php')</script>";
        }elseif ($data['selectdata']['roles']== 'ADMIN'){
          echo "<script> location.replace('$baseurl/dashboard/admin.php')</script>";
        }
        $_SESSION['dct']="<p class='h3 text-success text-center justify-content-center mx-auto'>Doctor Added Successfully</p>";
        echo "<script> location.replace('$baseurl/pages/doctor.php')</script>";
      }
    }
}



// Update Doctor

if(isset($_POST["update_doctor"])){
  unset($_POST["update_doctor"]);
  unset($_POST["name"]);
  $id = $_POST["id"];
  unset($_POST["id"]);
  $_POST["father_name"] = htmlentities(ucwords($_POST["father_name"]));
  $_POST["mother_name"] = htmlentities(ucwords($_POST["mother_name"]));
  $_POST["qualification"] = htmlentities(ucwords($_POST["qualification"]));
  $_POST["gratuated_from"] = htmlentities(ucwords($_POST["gratuated_from"]));
  $_POST["gender"] = htmlentities($_POST["gender"]);


  
      $_POST["modified_by"] = $user["id"];
      $_POST["modified_at"] = date("Y-m-d H:i:s");


    $data = $mysqli->updator("doctor",$_POST,"id=$id");
    if($data['error']){
      $_SESSION['msg']=$data['error'];
      echo "<script> location.replace('adddoctor.php?doctorid=$id')</script>";
      
    }else{
      if($data['updated']=='saved'){
        if($data['selectdata']['roles']== 'SUPERADMIN'){
          echo "<script> location.replace('$baseurl/dashboard/doctor.php')</script>";
        }elseif ($data['selectdata']['roles']== 'ADMIN'){
          echo "<script> location.replace('$baseurl/dashboard/doctor.php')</script>";
        }
        $_SESSION['dct']="<p class='h3 text-success text-center justify-content-center mx-auto'>Updated Successfully</p>";
        echo "<script> location.replace('$baseurl/pages/profile.php?doctorid=$id')</script>";
      }
      echo "<script> location.replace('$baseurl/pages/profile.php?doctorid=$id')</script>";
    }
}

// Add department

                                                    // Add Categories


// Add department

if(isset($_POST['dept_form'])){
  unset($_POST['dept_form']);

  $_POST['name'] = htmlentities(ucwords($_POST['name']));
    if($user){
      $_POST['created_by'] = $user['id'];
    }
    $data = $mysqli->creator('department',$_POST);
    if($data['error']){
      $_SESSION['msg']=$data['msg'];
      echo "<script> location.replace('$baseurl/controller/department.php')</script>";
      
    }else{
      if($data['msg']=='saved'){
          echo "<script> location.replace('$baseurl/controller/department.php')</script>";      
        $_SESSION['msg']="<p class='h3 text-success text-center justify-content-center mx-auto'>Department Added Successfully</p>";
        echo "<script> location.replace('$baseurl/pages/doctor.php')</script>";
      }
    }
}

// Add Designation

if(isset($_POST['add_degi'])){
  unset($_POST['add_degi']);
  
  $_POST['designation_name'] = htmlentities(ucwords($_POST['designation_name']));
  $_POST['base_salary'] = htmlentities(ucwords($_POST['base_salary']));
  $_POST['bounus_by_percent'] = htmlentities(ucwords($_POST['bounus_by_percent']));
  $_POST['total_bounus'] = htmlentities(ucwords($_POST['total_bounus']));
  if($user){
    $_POST['created_by'] = $user['id'];
  }
  $data = $mysqli->creator('designation',$_POST);
  if($data['error']){
      $_SESSION['degi']=$data['msg'];
      echo "<script> location.replace('$baseurl/controller/designation.php')</script>";
      
    }else{
      if($data['msg']=='saved'){
          echo "<script> location.replace('$baseurl/controller/designation.php')</script>";      
        $_SESSION['degi']="<p class='h3 text-success text-center justify-content-center mx-auto'>Designation Added Successfully</p>";
        echo "<script> location.replace('$baseurl/pages/doctor.php')</script>";
      }
    }
}


// Add Room

if(isset($_POST['add_room'])){
  unset($_POST['add_room']);


  $_POST['room_no'] = htmlentities(ucwords($_POST['room_no']));
  $_POST['floor'] = htmlentities(ucwords($_POST['floor']));
  
  if($_POST['facilities']){
    $_POST['details'] = json_encode( $_POST['facilities']);
  }else{
    $_POST['details'] = null;
  }

  unset($_POST['facilities']);

    if($user){
      $_POST['created_by'] = $user['id'];
    }
    $data = $mysqli->creator('room',$_POST);
    if($data['error']){
      $_SESSION['room']=$data['msg'];
      echo "<script> location.replace('$baseurl/controller/room.php')</script>";
      
    }else{
      if($data['msg']=='saved'){
          echo "<script> location.replace('$baseurl/controller/room.php')</script>";      
        $_SESSION['room']="<p class='h3 text-success text-center justify-content-center mx-auto'>Room Added Successfully</p>";
        echo "<script> location.replace('$baseurl/pages/doctor.php')</script>";
      }
    }
}


// Add Service

if(isset($_POST['add_service'])){
  unset($_POST['add_service']);

  $_POST['service_name'] = htmlentities(ucwords($_POST['service_name']));
  $_POST['rate'] = htmlentities(ucwords($_POST['rate']));
  $_POST['condition_on'] = htmlentities(ucwords($_POST['condition_on']));
  $_POST['description'] = htmlentities(ucwords($_POST['description']));
  $_POST['duration'] = htmlentities(ucwords($_POST['duration']));
    if($user){
      $_POST['created_by'] = $user['id'];
    }
    $data = $mysqli->creator('service',$_POST);
    if($data['error']){
      $_SESSION['service']=$data['msg'];
      echo "<script> location.replace('$baseurl/controller/service.php')</script>";
      
    }else{
      if($data['msg']=='saved'){
          echo "<script> location.replace('$baseurl/controller/service.php')</script>";      
        $_SESSION['service']="<p class='h3 text-success text-center justify-content-center mx-auto'>service Added Successfully</p>";
        echo "<script> location.replace('$baseurl/pages/doctor.php')</script>";
      }
    }
}


// Add Rate

if(isset($_POST['add_service_rate'])){
  unset($_POST['add_service_rate']);

  $_POST['service_name'] = htmlentities(ucwords($_POST['service_name']));
  $_POST['rate'] = htmlentities(ucwords($_POST['rate']));
    if($user){
      $_POST['created_by'] = $user['id'];
    }
    $data = $mysqli->creator('rate',$_POST);
    if($data['error']){
      $_SESSION['rate']=$data['msg'];
      echo "<script> location.replace('$baseurl/controller/rate.php')</script>";
      
    }else{
      if($data['msg']=='saved'){
          echo "<script> location.replace('$baseurl/controller/rate.php')</script>";      
        $_SESSION['rate']="<p class='h3 text-success text-center justify-content-center mx-auto'>Rate Added Successfully</p>";
        echo "<script> location.replace('$baseurl/pages/doctor.php')</script>";
      }
    }
}
// Add Test

if(isset($_POST['add_test_rate'])){
  unset($_POST['add_test_rate']);

  $_POST['test_name'] = htmlentities(ucwords($_POST['test_name']));
  $_POST['rate'] = htmlentities(ucwords($_POST['rate']));
  $_POST['description'] = htmlentities(ucwords($_POST['description']));
    if($user){
      $_POST['created_by'] = $user['id'];
    }
    $data = $mysqli->creator('test',$_POST);
    if($data['error']){
      $_SESSION['test']=$data['msg'];
      echo "<script> location.replace('$baseurl/controller/test.php')</script>";
      
    }else{
      if($data['msg']=='saved'){
        echo "ok";
          echo "<script> location.replace('$baseurl/controller/test.php')</script>";      
        $_SESSION['test']="<p class='h3 text-success text-center justify-content-center mx-auto'>Test Added Successfully</p>";
      }
    }
}


// * medicinestore

if(isset($_POST['medicinestore'])){
  unset($_POST["medicinestore"]);
  $_POST["name"] = htmlentities(ucwords($_POST["name"]));
  $data = $mysqli->creator('medicinestore',$_POST);
  if($data['error']){
    $_SESSION['msg']=$data['msg'];
    echo "<script> location.replace('$baseurl/controller/medicinestore.php')</script>";
    
  }else{
    if($data['msg']=='saved'){
        echo "<script> location.replace('$baseurl/controller/medicinestore.php')</script>";      
      $_SESSION['msg']="<p class='h3 text-success text-center justify-content-center mx-auto'>Test Added Successfully</p>";
    }
  }

}



// ? UPDATE CATEGORIES



// Update department

if(isset($_POST["update_dept"])){
  unset($_POST["update_dept"]);
  $dept_id=$_POST["id"];
  unset($_POST["id"]);
  
  $_POST["name"] = htmlentities(ucwords($_POST["name"]));
  $_POST["modified_by"] = $user["id"];
  $_POST["modified_at"] = date("Y-m-d H:i:s");
  
  $update = $mysqli->updator("department",$_POST,"id=$dept_id");
  if($update["error"]){
    $_SESSION['msg']=$update['msg'];
    echo "<script> location.replace('$baseurl/pages/editcategories.php?deptId=$dept_id')</script>";
    
  }else{
    if($update['updated']){
      echo "<script> location.replace('$baseurl/controller/department.php')</script>";      
      $_SESSION['msg']="<p class='h3 text-success text-center justify-content-center mx-auto'>Department Updated Successfully</p>";
    }
  }
}


// Update Designation

if(isset($_POST["update_degi"])){
  unset($_POST["update_degi"]);
  $desi_id=$_POST["id"];
  unset($_POST["id"]);

  $_POST["designation_name"] = htmlentities(ucwords($_POST["designation_name"]));
  $_POST["base_salary"] = htmlentities(ucwords($_POST["base_salary"]));
  $_POST["bounus_by_percent"] = htmlentities(ucwords($_POST["bounus_by_percent"]));
  $_POST["total_bounus"] = htmlentities(ucwords($_POST["total_bounus"]));
  $_POST["modified_by"] = $user["id"];
  $_POST["modified_at"] = date("Y-m-d H:i:s");

  $update = $mysqli->updator("designation",$_POST,"id=$desi_id");
  if($update["error"]){
    $_SESSION["msg"]=$update["msg"];
    echo $update['msg'];
    echo "<script> location.replace('$baseurl/pages/editcategories.php?desiId=$desi_id')</script>";
    
  }else{
    if($update['updated']){
      echo "<script> location.replace('$baseurl/controller/designation.php')</script>";      
      $_SESSION['msg']="<p class='h3 text-success text-center justify-content-center mx-auto'>Designation Updated Successfully</p>";
    }
  }
}


// Update Room

if(isset($_POST["update_room"])){
  unset($_POST["update_room"]);
  $room_id=$_POST["id"];
  unset($_POST["id"]);
  
  $_POST["floor"] = htmlentities(ucwords($_POST["floor"]));
  $_POST["room_no"] = htmlentities(ucwords($_POST["room_no"]));
  $_POST["details"] = htmlentities(ucwords($_POST["details"]));
  $_POST["room_type"] = htmlentities(ucwords($_POST["room_type"]));
  $_POST["modified_by"] = $user["id"];
  $_POST["modified_at"] = date("Y-m-d H:i:s");
  
  $update = $mysqli->updator("room",$_POST,"id=$room_id");
  if($update["error"]){
    $_SESSION["msg"]=$update["msg"];
    echo "<script> location.replace('$baseurl/pages/editcategories.php?roomId=$room_id')</script>";
    
  }else{
    if($update['updated']){
      echo "<script> location.replace('$baseurl/controller/room.php')</script>";      
      $_SESSION['msg']="<p class='h3 text-success text-center justify-content-center mx-auto'>Room Updated Successfully</p>";
    }
  }
}



// Update Service

if(isset($_POST["update_service"])){
  unset($_POST["update_service"]);
  $service_id=$_POST["id"];
  unset($_POST["id"]);
  
  $_POST["service_name"] = htmlentities(ucwords($_POST["service_name"]));
  $_POST["rate"] = htmlentities(ucwords($_POST["rate"]));
  $_POST["condition_on"] = htmlentities(ucwords($_POST["condition_on"]));
  $_POST["description"] = htmlentities(ucwords($_POST["description"]));
  $_POST["modified_by"] = $user["id"];
  $_POST["modified_at"] = date("Y-m-d H:i:s");

  $update = $mysqli->updator("service",$_POST,"id=$service_id");
  if($update["error"]){
    $_SESSION["msg"]=$update["msg"];
    echo "<script> location.replace('$baseurl/pages/editcategories.php?serviceId=$service_id')</script>";      
  }else{
    if($update['updated']){
      echo "<script> location.replace('$baseurl/controller/service.php')</script>";      
      $_SESSION['msg']="<p class='h3 text-success text-center justify-content-center mx-auto'>Service Updated Successfully</p>";
    }
  }
}


// Update Rate

if(isset($_POST["update_rate"])){
  unset($_POST["update_rate"]);
  $rate_id=$_POST["id"];
  unset($_POST["id"]);
  
  $_POST["service_name"] = htmlentities(ucwords($_POST["service_name"]));
  $_POST["rate"] = htmlentities(ucwords($_POST["rate"]));
  $_POST["modified_by"] = $user["id"];
  $_POST["modified_at"] = date("Y-m-d H:i:s");
  
  $update = $mysqli->updator("rate",$_POST,"id=$rate_id");
  if($update["error"]){
    $_SESSION["msg"]=$update["msg"];
    echo "<script> location.replace('$baseurl/pages/editcategories.php?roomId=$rate_id')</script>";      
  }else{
    if($update['updated']){
      echo "<script> location.replace('$baseurl/controller/rate.php')</script>";      
      $_SESSION['msg']="<p class='h3 text-success text-center justify-content-center mx-auto'>Room Updated Successfully</p>";
    }
  }
}


// Update Test

if(isset($_POST["update_test"])){
  unset($_POST["update_test"]);
  $test_id=$_POST["id"];
  unset($_POST["id"]);
  
  $_POST["test_name"] = htmlentities(ucwords($_POST["test_name"]));
  $_POST["rate"] = htmlentities(ucwords($_POST["rate"]));
  $_POST["description"] = htmlentities(ucwords($_POST["description"]));
  $_POST["modified_by"] = $user["id"];
  $_POST["modified_at"] = date("Y-m-d H:i:s");

  $update = $mysqli->updator("test",$_POST,"id=$test_id");
  if($update["error"]){
    $_SESSION['msg']=$update['msg'];
    echo "<script> location.replace('$baseurl/pages/editcategories.php?testId=$test_id')</script>";      
  }else{
    if($update['updated']){
      echo "<script> location.replace('$baseurl/controller/test.php')</script>";      
      $_SESSION['msg']="<p class='h3 text-success text-center justify-content-center mx-auto'>Test Updated Successfully</p>";
    }
  }
}

// Update Medicinestore

if(isset($_POST["update_medicinstore"])){
  unset($_POST["update_medicinstore"]);
  $medicinestore_id=$_POST["id"];
  unset($_POST["id"]);
  
  $_POST["name"] = htmlentities(ucwords($_POST["name"]));
  // $_POST["mg"] = htmlentities(ucwords($_POST["mg"]));
  // $_POST["description"] = htmlentities(ucwords($_POST["description"]));
  $_POST["modified_by"] = $user["id"];
  $_POST["modified_at"] = date("Y-m-d H:i:s");

  $update = $mysqli->updator("medicinestore",$_POST,"id=$medicinestore_id");
  if($update["error"]){
    $_SESSION['msg']=$update['msg'];
    echo "<script> location.replace('$baseurl/pages/editcategories.php?mId=$medicinestore_id')</script>";      
  }else{
    if($update['updated']){
      echo "<script> location.replace('$baseurl/controller/medicinestore.php')</script>";      
      $_SESSION['msg']="<p class='h3 text-success text-center justify-content-center mx-auto'>Test Updated Successfully</p>";
    }
  }
}


// prescription

if(isset($_POST["prescription"])){
unset($_POST["prescription"]);

if(isset($_POST["appointment_id"])){
  $_POST["appointment_id"] = ( int) $_POST["appointment_id"];
  
}elseif(isset($_POST["admit_id"])){
  $_POST["admit_id"] = ( int) $_POST["admit_id"];

}
$insert_id = false;
foreach($_POST["outer-list"] as $medicine){
  $medicine["patient_id"] = $_POST["patient_id"];
  $medicine["mg"] = floatval($medicine["mg"]);
  if($medicine["type"] && $medicine["medicine_name"]){
    $create=$mysqli->creator("medicine",$medicine);
    if($create["error"]){
      $_SESSION["msg"] = $create["error"];
    }
    $insert_id[] .= $create["insert_id"];

  }
}
$_POST["medicine_id"] = json_encode($insert_id);
$tests = $description = $advice = [];
foreach($_POST["inner-list"] as $test){
  $tests[] .= $test["test"];
  $description[] .= $test["description"];
  $advice[] .= $test["advice"];
}
echo "<br>";
unset($_POST["outer-list"]);
unset($_POST["inner-list"]);

$_POST["test"] = json_encode($tests);
$_POST["description"] = json_encode($description);
$_POST["advice"] = json_encode($advice);

$prescription = $mysqli->creator("prescription",$_POST);
if($prescription["error"]){
  $_SESSION["msg"] = $prescription["error"];
  echo "<script> location.replace('$baseurl/pages/prescription.php?id=".$_post['patient_id']."')</script>";
}else{
  $inserted_id = $prescription["insert_id"];
  $_SESSION["msg"] = "Prescription added to".$prescription["insert_id"];
  echo "<script> location.replace('$baseurl/view/viewprescriotion.php?presid=$inserted_id')</script>";

}


}








if(isset($_POST["patientcare"])){

}



// *** Add Test Report ***

if(isset($_POST["addreport"])){
  unset($_POST["addreport"]);
  
  $_POST["test_data"] = json_encode($_POST["outer-list"]);
  unset($_POST["outer-list"]);
  if($user){
    $_POST['created_by'] = $user['id'];
  }
  $addReport = $mysqli->creator('report',$_POST);
  if($addReport["error"]){
    $_SESSION["msg"] = $addReport["msg"];
  }else{
    $_SESSION["msg"] = $addReport["msg"]."to".$addReport["insert_id"];
    $insert_id = $addReport["insert_id"];
    echo "<script> location.replace('$baseurl/view/testreport.php?report=$insert_id')</script>";
  }

}


// *** invoice Payment ***

if(isset($_POST["invoice_payment"])){
  unset($_POST["invoice_payment"]);
  $_POST['test_id'] = array();
  if(isset($_POST["outer-list"])){
    foreach($_POST["outer-list"] as $tid){
      $_POST['test_id'][] .= $tid['tid'];
    }
  }
  $pay['test_id'] = json_encode($_POST['test_id']);
  


  if(isset($_POST["appointment_id"])){
  $pay["appointment_id"]=$_POST["appointment_id"];
  }
  if(isset($_POST["admit_id"])){
    $pay["admit_id"]=$_POST["admit_id"];
  }
  if($_POST["remark"] == ""){
    $_POST["remark"]="DUE";
  }
  if($user){
    $_POST['created_by'] = $user['id'];
  }
  if(isset($_POST["duration"])){
    $duration = $_POST["duration"];
  }
  if(isset($_POST["out_time"])){
    $out_time = date("y-m-d h:i:s");
  }
  
  $pay['ipid'] = uniqid('IP'.date('ymdhis'));
  $pay["patient_id"]=$_POST["patient_id"];
  $pay["payment_date"]=$_POST["payment_date"]." ".date('H:i:s');
  $pay["subtotal"]= (int) $_POST["subtotal"];
  $pay["discount"]= (int) $_POST["discount"] == "" ? 0 : $_POST["discount"];
  $pay["tax"]= (int) $_POST["tax"];
  $pay["total"]= (int) $_POST["total"];
  $pay["payment"]= (int) $_POST["payment"];
  $pay["remark"]=ucwords($_POST["remark"]);
  $create=$mysqli->creator("invoice_payment",$pay);

  if($create["error"]){
    $_SESSION["rate"]=$create["msg"];
    echo "<script> location.replace('$baseurl/pages/invoice.php?id=".$pay['patient_id']."')</script>";
    
  }else{
    if($create['msg']=='saved'){
      $insert_id = $create['insert_id'];
      $invoiceData=$mysqli->select_single("SELECT remark,id,admit_id FROM invoice_payment WHERE id=$insert_id")['singledata'];
      $admitId = $invoiceData["admit_id"];
      if($admitId != null && $invoiceData["remark"] =="PAID"){
        $admitUpdate = $mysqli->updator("admit",["roles"=>"RELEASED","duration"=>"$duration","out_time"=>"$out_time"],"id=$admitId");
        if($admitUpdate["error"]){
          $_SESSION["msg"] = $admitUpdate["error"];
        }else{
          $_SESSION["updated"] = $admitUpdate["error"];

          echo "<script> location.replace('$baseurl/view/payinfo.php?invoice=$insert_id')</script>";
        }
      }
      echo "<script> location.replace('$baseurl/view/payinfo.php?invoice=$insert_id')</script>";
      $_SESSION['rate']="<p class='h3 text-success text-center justify-content-center mx-auto'>Invoice Added Successfully</p>";
            
    }
  }
}

// *****************************


if(isset($_POST["update_invoice_payment"])){
  unset($_POST["update_invoice_payment"]);
  $invoiceId = $_POST["id"];
    $remark = "DUE";  
  if($_POST["total"] >= $_POST["payment"]){
    $remark ='PAID';
  }
  
  $payment = $_POST["payment"] + $_POST["paid"];
  $modified_by = $user["id"];
  $modified_at = date("Y-m-d H:i:s");
  // ['remark'=>$remark,'payment'=>$payment,'modified_at'=>$modified_at,'modified_by'=>$modified_by]

  $invoice_update =$mysqli->updator("invoice_payment",['remark'=>$remark,'payment'=>$payment,'modified_at'=>$modified_at,'modified_by'=>$modified_by],"id=$invoiceId");

  if($invoice_update["error"]){
    $_SESSION["msg"]=$invoice_update["updated"];
    echo $invoice_update["updated"];
  }else{
    $invoiceData=$mysqli->select_single("SELECT remark,id,admit_id FROM invoice_payment WHERE id=".$_POST["id"])['singledata'];
      $admitId = $invoiceData["admit_id"];
      if($admitId != null && $invoiceData["remark"] =="PAID"){
        $admitUpdate = $mysqli->updator("admit",["roles"=>"RELEASED","out_time"=>"$modified_at"],"id=$admitId");
        if($admitUpdate["error"]){
          $_SESSION["msg"] = $admitUpdate["error"];
        }else{
          $_SESSION["updated"] = $admitUpdate["updated"];
          echo "<script> location.replace('$baseurl/view/payinfo.php?invoice=$invoiceId')</script>";
        }
      }
      echo "<script> location.replace('$baseurl/view/payinfo.php?invoice=$invoiceId')</script>";
      $_SESSION['msg']="<p class='h3 text-success text-center justify-content-center mx-auto'>Invoice Updated Successfully</p>";
  }


}