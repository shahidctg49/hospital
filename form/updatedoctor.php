<?php 
require_once('../lib/Crud.php'); 
require_once('../include/header.php'); 
$mysqli = new Crud();

if(isset($_SESSION) && !($_SESSION['userdata']['roles']== 'SUPERADMIN') ){
    echo "<script> location.replace('$baseurl/dashboard/')</script>";
}

$msg =$room =$designation = $department = false;
if(isset($_GET['doctorid']) && strlen ($_GET['doctorid']) > 0){
  $doctor_Id = $_GET['doctorid'];
  $selectUser = $mysqli->select_single("select doctor.*, user.name as name, user.id as user_id from doctor join user on user.id=doctor.user_id where doctor.id=$doctor_Id");
  $doctor = $selectUser['singledata'];
}

//   if($selectUser['error']){
//     $msg = $selectUser['error'];
//   }else{
//     $doctor = $selectUser['singledata'];
//   }
// }else{
//   $msg = "No Data Fount";
// }

  // get data with doctors id
     // department
    if($selectUser['numrows'] > 0){      
      $chamber = $doctor['chamber_id'];
      $designationId = $doctor['designation_id'];
      $department_id = $doctor['department_id'];

      // department
      $departmentName  =$mysqli->select_single("SELECT * FROM department where id=$department_id");
      $department = $departmentName['singledata'];

      // room/ chamber 
      if($chamber){
         $roomName =$mysqli->select_single("SELECT * FROM room WHERE id=$chamber");
        $room = $roomName['singledata'];
      }

      // designation
      if($designationId){
       $designationName =$mysqli->select_single("SELECT * FROM designation where id=$designationId");
        $designation = $designationName['singledata'];
      }
    
      }
      // GETTIng all Data
     $departmentData =$mysqli->selector('department','*');
     $departments = $departmentData['selectdata'];


     $roomData =$mysqli->selector('room','*');
     $rooms = $roomData['selectdata'];



     $designationData =$mysqli->selector('designation','*');
     $designations = $designationData['selectdata'];


      // date
      $date=date("Y-m-d");


// if(isset($_SESSION['dct'])){
//     $_SESSION['dct'];
//   }


?>

<div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">

      <div class="container-fluid">
    
    <!-- partial:./navbar.php -->
    <?php
      require_once('../include/navbar.php');
    ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:include/sidebar.php -->
      <?php require_once('../include/sidebar.php') ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

        <div class="d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-12 mx-auto">

<!-- ADD Profile name -->


<!-- profile end -->

              <div class="auth-form-light text-left p-5">
              

<?php 

//   print_r($doctor);
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
    }
    ?>

<h4><?= $msg?></h4>


<form class="pt-3 justify-content-center items-center" method="POST" action="action.php">

    <input type="text" name="id" value="<?=$doctor['id'] ?>" hidden>
  <?php    if($usr['roles']==='SUPERADMIN'){ ?>
  <div class="form-row d-flex">
    <div class="form-group col-md-2 mx-2">
      <label for="inputAddress">Shift</label>
      <select name="shift" id="" class="form-select">
        <option value="<?=$doctor['shift'] ?>"><?=$doctor['shift']?></option>
        <option value="MORNING">Morning</option>
        <option value="EVENING">Evening</option>
        <option value="NIGHT">NIGHT</option>
      </select>
    </div>
    <div class="form-group col-md-2 mx-2">
      <label for="inputAddress">Chamber</label>
      <select name="chamber_id" id="<" class="form-select">
        <option value="<?=$room?$room['id']:null ?>">
          <?= $room?$room['room_type']:'Select Chamber'?>
        </option>
        <?php
        foreach($rooms as $r){ ?>
          <option value="<?= $r['id'] ?>"><?=$r['room_type'] ?></option>
        <?php }  ?>
        
      </select>
    </div>
    <div class="form-group col-md-2 mx-2">
      <label for="inputAddress">Designation</label>
      <select name="designation_id" id="" class="form-select">
        <option value="<?=$designation?$designation['id'] : null?>">
          <?= $designation?$designation['designation_name']:'Select Designation' ?>
        </option>
        <?php foreach($designations as $designation){ ?>
          <option value="<?=$designation['id']?>"><?= $designation['designation_name']?></option>
         <?php  }     ?>
      </select>
    </div>
  </div>
  <?php }    ?>
  <div class="form-row d-flex">
    <?php  if($usr['roles']!=='SUPERADMIN' && $usr['roles'] !== 'ADMIN'){  ?>
    <!-- <input type="text" name="user_id" value="<?=$id ?>" hidden> -->
    <?php    }    ?>
    <div class="form-group col-md-4 mx-2">
      <label for="father">Name:</label>
      <input type="text" readonly name="name" class="form-control" id="father" value="<?=$doctor['name'] ?>">
      <small id="emailHelp" class="form-text text-muted ml-5">
        You cannot change name here.
      </small>
    </div>
    <div class="form-group col-md-4 mx-2">
      <label for="father">Father's Name:</label>
      <input type="text" name="father_name" class="form-control" id="father" value="<?=$doctor['father_name'] ?>">
    </div>
    <div class="form-group col-md-4 mx-2">
      <label for="mother">Mother's Name:</label>
      <input type="text" name="mother_name" class="form-control" id="mother" value="<?=$doctor['mother_name'] ?>" placeholder="Mother's Name">
    </div>
  </div>
  <div class="form-row d-flex">
    <div class="form-group col-md-6 mx-2">
      <label for="gratuated">Gratuated From:</label>
      <input type="text" name="gratuated_from" class="form-control" id="gratuated" value="<?=$doctor['gratuated_from'] ?>" placeholder="College/University Name">
    </div>
    <div class="form-group col-md-6 mx-2">
      <label for="qualify">Qualification:</label>
      <input type="text" name="qualification" value="<?=$doctor['qualification'] ?>" class="form-control" id="qualify" placeholder="Qualification">
    </div>
    
  </div>
  <div class="form-row d-flex">
    <div class="form-group col-md-3 mx-2">
      <label for="date">Date Of Birth:</label>
      <input type="date" max="<?= $date ?>" name="date_of_birth" value="<?=$doctor['date_of_birth'] ?>" class="form-control" id="date" placeholder="Name">
    </div>
    <div class="form-group col-md-3 mx-2">
      <label for="inputAddress">Visit Fee</label>
      <input type="number" name="visit_fee" value="<?=$doctor['visit_fee'] ?>" class="form-control">
    </div>
    <div class="form-group col-md-2 mx-2">
      <label for="gender">Gender:</label>
      <select name="gender" id="" class="form-select">
        <option value="<?= $doctor['gender']?>"><?= $doctor['gender']?></option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="Other">Other</option>
      </select>
    </div>
    <div class="form-group col-md-2 mx-2">
    <label for="gender">Department:</label>
      <select  name="department_id" class="form-select">
        <option selected value="<?=$department?$department['id']:null?>"><?=$department['name']?></option>
    <?php foreach ($departments as $dept){?>
        <option  id="deprtment" value="<?=$dept['id']?>"><?= $dept['name']?></option>
        <?php } ?>
      </select>
    </div>
   
  </div>
  <!-- @MIN -->
 
  <!-- @MIN END -->
  <div class="form-group">
    <div class="form-check mx-5 mt-5">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div>
  <div class="d-flex justify-content-center">
    <button type="submit" name="update_doctor" class="btn btn-primary">Update</button>
  </div>
</form>

<script>
  function mathedPassword(){

    let password = document.getElementById('password').value;
    let cpassword = document.getElementById('cpassword').value;
    if(password!== cpassword){
      document.getElementById('passErr').innerText="Password is not mathed";
    }
    
  }
</script>
</div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->


      </div>
      <!-- page-body-wrapper ends -->
    <?php require_once("../include/footer.php"); ?>