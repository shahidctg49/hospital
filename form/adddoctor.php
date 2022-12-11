<?php 
require_once('../lib/Crud.php'); 

$mysqli = new Crud();

if(isset($_SESSION) && !($_SESSION['userdata']['roles']== 'SUPERADMIN') ){
    echo "<script> location.replace('$baseurl/dashboard/')</script>";
}

require_once('../include/header.php'); 
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
              <div class="auth-form-light text-left p-5">
              <h3>Add Doctor's Information</h3>
              


<?php 
   if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
        }

        $id = false;
        // get user id
        if(isset($_GET['id']) && strlen($_GET['id']) > 0){
          $id = $_GET['id'];
        }
        $id = $usr['id'];
        // doctors
        $usersData =$mysqli->custome_query("SELECT * FROM user WHERE roles='DOCTOR'");        
        $userdoctor = $usersData['selectdata'];
        
        // department
        $departmentData =$mysqli->selector('department','*');
        $department = $departmentData['selectdata'];

        // chambers
        $roomData =$mysqli->selector('room','*');
        $rooms = $roomData['selectdata'];

        // designation
        $designationData =$mysqli->selector('designation','*');
        $designations = $designationData['selectdata'];

        // date
        $date=date("Y-m-d");
        ?>
<form class="pt-3 justify-content-center items-center" method="POST" action="action.php">
  <?php
  if(isset($_SESSION['dct'])){
    $_SESSION['dct'];
  }
  ?>
                
  <?php    if($usr['roles']==='SUPERADMIN'){ ?>
  <div class="form-row d-flex">
    <div class="form-group col-md-4 mx-2">
      <label for="father">User's Name:</label>
      <select name="user_id" id="" class="form-control">
        <option value="">Select User...</option>
        <?php foreach($userdoctor as $doctor){ ?>
          <option value="<?= $doctor['id']?>"><?= $doctor['name']?></option>
         <?php  }     ?>
      </select>
    </div>
    <div class="form-group col-md-2 mx-2">
      <label for="inputAddress">Shift</label>
      <select name="shift" id="" class="form-control">
        <option value="MORNING">Morning</option>
        <option value="EVENING">Evening</option>
        <option value="NIGHT">Night</option>
      </select>
    </div>
    <div class="form-group col-md-2 mx-2">
      <label for="inputAddress">Chamber</label>
      <select name="chamber_id" id="" class="form-control">
        <option value="">Chamber....</option>
        <?php foreach($rooms as $room){ ?>
          <option value="<?=$room['id']?>"><?= $room['room_type']?>-<?= $room['room_no']?></option>
         <?php  }     ?>
      </select>
    </div>
    <div class="form-group col-md-2 mx-2">
      <label for="inputAddress">Designation</label>
      <select name="designation_id" id="" class="form-control">
        <option value="">Designation....</option>
        <?php foreach($designations as $designation){ ?>
          <option value="<?= $designation['id']?>"><?= $designation['designation_name']?></option>
         <?php  }     ?>
      </select>
    </div>
  </div>
  <?php }    ?>
  <div class="form-row d-flex">
    <?php  if($usr['roles']!=='SUPERADMIN' && $usr['roles'] !== 'ADMIN'){  ?>
    <input type="text" name="user_id" value="<?=$id ?>" hidden>
    <?php    }    ?>
    <div class="form-group col-md-6 mx-2">
      <label for="father">Father's Name:</label>
      <input type="text" name="father_name" class="form-control" id="father" placeholder="Father's Name">
    </div>
    <div class="form-group col-md-6 mx-2">
      <label for="mother">Mother's Name:</label>
      <input type="text" name="mother_name" class="form-control" id="mother" placeholder="Mother's Name">
    </div>
  </div>
  <div class="form-row d-flex">
    <div class="form-group col-md-6 mx-2">
      <label for="gratuated">Gratuated From:</label>
      <input type="text" name="gratuated_from" class="form-control" id="gratuated" placeholder="College/University Name">
    </div>
    <div class="form-group col-md-6 mx-2">
      <label for="qualify">Qualification:</label>
      <input type="text" name="qualification" class="form-control" id="qualify" placeholder="Qualification">
    </div>
    
  </div>
  <div class="form-row d-flex">
    <div class="form-group col-md-3 mx-2">
      <label for="date">Date Of Birth:</label>
      <input type="date" max="<?= $date ?>" name="date_of_birth" class="form-control" id="date" placeholder="Name">
    </div>
    <div class="form-group col-md-3 mx-2">
      <label for="inputAddress">Visit Fee</label>
      <input type="number" name="visit_fee" class="form-control">
    </div>
    <div class="form-group col-md-2 mx-2">
      <label for="gender">Gender:</label>
      <select name="gender" id="" class="form-control">
        <option value="">Gender</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="Other">Other</option>
      </select>
    </div>
    <div class="form-group col-md-2 mx-2">
    <label for="gender">Department:</label>
      <select  name="department_id" class="form-control">
        <option selected>Department...</option>
    <?php foreach ($department as $dept){?>
        <option  id="deprtment" value="<?=$dept['id'] ?>"><?= $dept['name']?></option>
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
    <button type="submit" name="adddoctor" class="btn btn-primary">Submit</button>
  </div>
</form>
</div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->


      </div>
      <!-- page-body-wrapper ends -->
    <?php require_once("../include/footer.php"); ?>