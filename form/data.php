<?php
session_start();
require_once('../lib/Crud.php'); 

$mysqli = new Crud();


if(isset($_SESSION['userdata'])){
  $user = $_SESSION['userdata'];
}else{
header("location:http://localhost/hospital/pages/login.php");

}

// *** Depertment Data ***

if(isset($_GET['department'])){
    $department_id= $_GET['department'];
  
    $data = $mysqli->custome_query("select doctor.id, user.name from doctor join user on user.id=doctor.user_id where doctor.department_id=$department_id");
    if($data['numrows'] > 0){
      $value="<option value=''>Select Doctor</option>";
	  foreach($data['selectdata'] as $d){
		  $value.="<option value='".$d['id']."'>".$d['name']."</option>";
	  }
    }else{
      $value="<option value=''>No Doctor Found</option>";
    }
	
	echo json_encode(array('msg'=>$value));
    
}




// user shift data
if(isset($_GET['time'])){
    $timeid= $_GET['time'];
    $patientid= $_GET['patientId'];
  
    $Doctordata = $mysqli->custome_query("select doctor.shift,doctor.visit_fee,doctor.id as doctor_id, user.id from doctor join user on user.id=doctor.user_id where doctor.id=$timeid");

   


    if($Doctordata['numrows'] > 0){
    $value=$Doctordata['selectdata'];
	  foreach($Doctordata['selectdata'] as $d){
      $fees = $d["visit_fee"];
      $doctorId = $d["doctor_id"];
        switch ($d['shift']) {
            case 'MORNING':
                $time = '7:00AM-3:00PM';
                break;
            
            case 'EVENING':
                $time = "3:00PM-11:00PM";
                break;
            
            case 'NIGHT':
                $time = '11:00PM-8:00AM';
                break;
            
            default:
            $time = '3:00PM-11:00PM';
                break;
        }
        
      }

      $chachApp = $mysqli->find("SELECT ip.payment_date,ip.appointment_id,d.id as doctor_id,d.visit_fee
      from invoice_payment ip 
        JOIN appointment a
          on a.id=ip.appointment_id
          JOIN doctor d 	 
        on a.doctor_id=d.id
      where ip.patient_id=$patientid AND doctor_id=$doctorId
      ORDER BY ip.payment_date DESC");
      $discount = "No discount";
      $total = $fees;
      
      if($chachApp["numrows"] > 0){
        if(date("y-m-d H:i:s",strtotime("-2 months")) > $chachApp["singledata"][0]["payment_date"] && $chachApp["singledata"][0]['appointment_id'] != null ){
          $discount = 20;
          $total = $fees - $fees * $discount / 100;
        }
      }

      $value = ["fees"=>floatval($fees),"time"=> (string) $time,"discount" => floatval($discount),"total"=>floatval($total) ];
    }else{
      $value ="error";
    }
	
	echo json_encode($value);
    
}



if(isset($_GET['rate'])){
  $service_id= $_GET['rate'];

  $data = $mysqli->custome_query("select doctor.id, user.name from doctor join user on user.id=doctor.user_id where doctor.department_id=$department_id");
  if($data['numrows'] > 0){
    $value="<option value=''>Select Doctor</option>";
  foreach($data['selectdata'] as $data){
    $value.="<option value='".$data['id']."'>".$data['name']."</option>";
  }
  }else{
    $value="<option value=''>No Doctor Found</option>";
  }

echo json_encode(array('msg'=>$value));
  
}


if(isset($_GET["roomType"])){
  $roomType = $_GET["roomType"];
  $roomData = $mysqli->custome_query("SELECT * FROM room WHERE room_type='$roomType'");
  if($roomData['numrows'] > 0){
    $value="<option value=''>Select Room</option>";

  foreach($roomData['selectdata'] as $room){
    $disabled= false;
    if($room['availability'] == 'NO'){
      $disabled = 'disabled';
    }
    $rate = $room['rate'];
    $value .="<option value='".$room['id']."'$disabled data-rate=$rate>".$room['room_no']."</option>";
  }


  }else{
    $value="<option value=''>No Data Found</option>";
  }


  echo json_encode(array($value));
}





?>