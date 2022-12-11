<?php 
  require_once('../lib/Crud.php'); 
  require_once('../include/header.php'); 

  $mysqli = new Crud();

  if($usr['roles'] !== 'SUPERADMIN' ){
    header("location:$baseurl/pages/login.php");
  }

?>
<div class="container-scroller">

  <!-- partial:./navbar.php -->
  <?php
    require_once('../include/navbar.php');
  ?>
  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial:include/sidebar.php -->
    <?php require_once('../include/sidebar.php'); ?>
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <?php
          $mysqli = new Crud();
          $data = $mysqli->selector('user','*');
          $patient = $mysqli->counter("user","roles='PETANT'");
          $doctor = $mysqli->counter("user","roles='DOCTOR'");
          $employee = $mysqli->counter("user","roles='EMPLOYEE'");
          // $SUPERADMIN = $mysqli->selector("user","COUNT(roles='SUPERADMIN')");

          $user = $data['selectdata'];
          if($data['error']){
            $_SESSION['msg']=$data['msg'];
            echo "error";
          }
        ?>
        <!-- page header start -->
        <div class="page-header">
          <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
              <i class="mdi mdi-home"></i>
            </span> Dashboard
          </h3>
          <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page">
                <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
              </li>
            </ul>
          </nav>
        </div>

        <div class="row justify-content-center">
          <!-- Session for Categories -->
          <?php 
            if(isset($_SESSION['msg'])){
              echo  $_SESSION['msg'];
              unset ($_SESSION['msg']);
            }
          ?>

          <!-- Department form -->
              
          <?php 
            if(isset($_GET['deptId']) && strlen($_GET['deptId']) > 0){
            ?>
            <div class="col-md-5 grid-margin stretch-card" id="departmentform">
              <div class="card">
                <p class="closebtn"> <i class="mdi mdi-close-circle-outline cursor-pointer text-danger" 
                  onclick="$('#test').toggleClass('d-none'); $testBtn.toggleClass('btn-dark');"> </i></p>
                
                <?php
                  $dept_id=$_GET['deptId'];
                  $dept_data=$mysqli->select_single("select * from department where id=$dept_id");
                  $deptartment=$dept_data['singledata'];
                ?>
                <!-- Department Data -->
                <h2 class=" text-dark text-center h2">Department</h2>
                <div class="row ">
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title text-muted">Update Department</h4>
                        <!-- edit deprtme -->
                        <form class="justify-content-center items-center" method="POST" id="editdeptform" action="<?= $baseurl ?>/form/action.php" >
                          <input type="text" value="<?= $_GET['deptId'] ?>" name="id" hidden>   
                          <div class="form-row col-md-12 d-flex">                    
                            <div class="form-group col-md-6 mx-2">
                              <input type="text" value="<?= $deptartment['name'] ?>" name="name" required class="form-control" id="name" placeholder="Name">
                            </div>
                            <div class="form-group col-md-6 mx-2">                  
                              <input  minlength="11" type="submit" maxlength="11" name="update_dept" class="form-control" value="Update" >
                            </div>                    
                          </div>
                        </form>
                  </div>
                  </div>
                </div>
                </div>
              </div>
            </div>
            <?php 
              }
            ?>
          <!-- department end -->

          <!-- Designation form -->
          <?php 
            if(isset($_GET['desigId']) && strlen($_GET['desigId']) > 0){ 
            ?>
            <div class="col-md-7 grid-margin stretch-card" id="designationform">
              <div class="card">
                <div class="card-body">

                  <?php 
                    $desi_id=$_GET['desigId'];
                    $desi_data=$mysqli->select_single("select * from designation where id=$desi_id")['singledata'];
                  ?>

                  <h4 class="card-title">Update Designation</h4>
                  <form class="pt-3 justify-content-center items-center" method="POST" action="<?=$baseurl?>/form/action.php">
                    <input type="text" name="id" value="<?=$_GET['desigId'] ?>" hidden>
                    <div class="form-row d-flex">
                      <div class="form-group col-md-6 mx-2">
                        <label for="designation_name">Designation Name: </label>
                        <input type="text" value="<?= $desi_data['designation_name']; ?>" name="designation_name" required class="form-control" id="designation_name" placeholder="Designation Name">
                      </div>
                      <div class="form-group col-md-6 mx-2">
                        <label for="base_salary">Basic Salary: </label>
                        <input type="text" value="<?= $desi_data['base_salary']; ?>" name="base_salary" required class="form-control" id="base_salary" placeholder="Basic Salary">
                      </div>
                    </div>
                    <div class="form-row d-flex">
                      <div class="form-group col-md-6 mx-2">
                        <label for="bounus_by_percent">Bonus: </label>
                        <input type="text" value="<?= $desi_data['bounus_by_percent']; ?>" name="bounus_by_percent" required class="form-control" id="bounus_by_percent" placeholder="Bonus in percent">
                      </div>
                      <div class="form-group col-md-6 mx-2">
                        <label for="total_bounus">Total Bonus: </label>
                        <input type="text" value="<?= $desi_data['total_bounus']; ?>" name="total_bounus" required class="form-control" id="total_bounus" placeholder="Total Bonus">
                      </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary"  name="update_degi">Update Designation</button>
                    </div>
                  </form>
                </div>
              </div>
              <?php  }?>

            </div>
          <!-- designation end -->

          <!-- Room form -->

          <?php 
            if(isset($_GET['roomId']) && strlen($_GET['roomId']) > 0){ ?>
            <div class="col-md-7 grid-margin stretch-card" id="roomform">
              <div class="card">
                <div class="card-body">
                  <?php
                    $room_id=$_GET['roomId'];
                    $room_data=$mysqli->select_single("select * from room where id=$room_id")['singledata'];
                  ?>
                  <h4 class="card-title">Update Room</h4>
                  <form class="pt-3 justify-content-center items-center" method="POST" action="<?=$baseurl?>/form/action.php">
                    <input type="text" name="id" value="<?=$_GET['roomId'] ?>" hidden>
                    <div class="form-row d-flex">
                      <div class="form-group col-md-6 mx-2">
                        <label for="floor">Floor: </label>
                        <input type="text" value="<?= $room_data['floor'] ?>" name="floor" required class="form-control" id="floor" placeholder="Floor Name">
                      </div>
                      <div class="form-group col-md-6 mx-2">
                        <label for="room_no">Room No: </label>
                        <input type="text" value="<?= $room_data['room_no'] ?>" minlength="3" maxlength="11" name="room_no" required class="form-control" id="room_no" placeholder="Room No">
                      </div>
                    </div>
                    <div class="form-row d-flex">
                      <div class="form-group col-md-4 mx-2">
                        <label for="details">Detail: </label>
                        <input type="text" value="<?= $room_data['details'] ?>" name="details" class="form-control" id="details" placeholder="Details">
                      </div>
                      <div class="form-group col-md-4 mx-2">
                        <label for="gender">Room Type:</label>
                        <select id="gender"  name="room_type" class="form-control">
                          <option value="<?= $room_data['room_type'] ?>"><?= $room_data['room_type'] ?></option>
                          <option value="CHAMBER">CHAMBER</option>
                          <option value="GENERAL-CABIN">GENERAL-CABIN</option>
                          <option value="VIP-CABIN">VIP-CABIN</option>
                          <option value="OT">OT</option>
                        </select>
                      </div>
                    </div>
                    <div class="d-flex justify-content-center">
                      <button type="submit" class="btn btn-primary" name="update_room">Add Room</button>
                    </div>
                  </form>
                </div>
              </div>
              <?php
              } 
              ?>
            </div>
            
          <!-- Room end -->

          <!-- service form -->

          <?php 
            if(isset($_GET['serviceId']) && strlen($_GET['serviceId']) > 0){ ?>
            <div class="card">
              <div class="bg-info card-body">
                <?php
                  $service_id=$_GET['serviceId'];
                  $rate_data=$mysqli->select_single("select * from service where id=$service_id")['singledata'];
                ?>
                <h4 class="card-title">Update Service</h4>
                <form class="pt-3 justify-content-center items-center" method="POST" action="<?=$baseurl?>/form/action.php">
                  <input type="text" name="id" value="<?=$_GET['serviceId'] ?>" hidden>
                  <div class="form-row d-flex">
                    <div class="form-group col-md-6 mx-2">
                      <label for="service_name">Service Name: </label>
                      <input type="text" value="<?= $rate_data['service_name'] ?>" name="service_name" required class="form-control" id="service_name" placeholder="Service Name">
                    </div>	 	 
                    <div class="form-group col-md-6 mx-2">
                      <label for="rate">Rate </label>
                      <input type="text" value="<?= $rate_data['rate'] ?>" minlength="3" maxlength="11" name="rate" required class="form-control" id="rate" placeholder="Rate">
                    </div>
                  </div>
                  <div class="form-row d-flex">
                    <div class="form-group col-md-6 mx-2">
                      <label for="condition_on">Condition On </label>
                      <input type="text" value="<?= $rate_data['condition_on'] ?>" name="condition_on" required class="form-control" id="condition_on" placeholder="Condition On">
                    </div>
                    <div class="form-group col-md-6 mx-2">
                      <label for="description">Description </label>
                      <textarea type="text" minlength="3" maxlength="11" name="description"  class="form-control" id="description" placeholder="Description"><?= $rate_data['description'] ?></textarea>
                    </div>
                  </div>
                  <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary" name="update_service">Update</button>
                  </div>
                </form>
              </div>
            </div>
            <?php
            } 
            ?>

          <!-- service end -->

          <!-- Rate Form -->
              
          <?php 
            if(isset($_GET['rateId']) && strlen($_GET['rateId']) > 0){ ?>
            <div class="card">
              <div class="bg-info card-body">
                <?php
                  $rate_id=$_GET['rateId'];
                  $rate_data=$mysqli->select_single("select * from rate where id=$rate_id")['singledata'];
                ?>
                <h4 class="card-title">Update Rate</h4>
                <form class="pt-3 justify-content-center items-center" method="POST" action="<?=$baseurl?>/form/action.php">
                  <input type="text" name="id" value="<?=$_GET['rateId'] ?>" hidden>
                  <div class="form-row d-flex">
                    <div class="form-group col-md-6 mx-2">
                      <label for="service_name">Service Name: </label>
                      <input type="text" value="<?= $rate_data['service_name'] ?>" name="service_name" required class="form-control" id="service_name" placeholder="Service Name">
                    </div>
                    <div class="form-group col-md-6 mx-2">
                      <label for="rate">Rate </label>
                      <input type="text" value="<?= $rate_data['rate'] ?>" minlength="3" maxlength="11" name="rate" required class="form-control" id="rate" placeholder="Rate">
                    </div>
                  </div>
                  <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary" name="update_rate">Update</button>
                  </div>
                </form>
              </div>
            </div>
            <?php
            } 
            ?>

          <!-- Rate end -->

          <!-- Test Form -->
              
          <?php 
            if(isset($_GET['testId']) && strlen($_GET['testId']) > 0){ ?>
            <div class="card">
              <div class="bg-info card-body">
                <?php
                  $test_id=$_GET['testId'];
                  $test_data=$mysqli->select_single("select * from test where id=$test_id")['singledata'];
                ?>
                <h4 class="card-title">Update Test</h4>
                <form class="pt-3 justify-content-center items-center" method="POST" action="<?=$baseurl?>/form/action.php">
                  <input type="text" name="id" value="<?=$_GET['testId'] ?>" hidden>
                  <div class="form-row d-flex">
                    <div class="form-group col-md-4 mx-1">
                      <label for="test_name">Test Name: </label>
                      <input type="text" value="<?= $test_data['test_name'] ?>" name="test_name" required class="form-control" id="test_name" placeholder="Test Name">
                    </div>
                    <div class="form-group col-md-4 mx-1">
                      <label for="rate">Rate </label>
                      <input type="text" value="<?= $test_data['rate'] ?>" minlength="3" maxlength="11" name="rate" required class="form-control" id="rate" placeholder="Rate">
                    </div>
                    <div class="form-group col-md-4 mx-1">
                      <label for="description">Rate </label>
                      <textarea type="text" height="200" minlength="3" maxlength="11" name="description" required class="form-control" id="description" placeholder="Description"><?= $test_data['description'] ?></textarea>
                    </div>
                  </div>
                  <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary" name="update_test">Update</button>
                  </div>
                </form>
              </div>
            </div>
            <?php
            } 
            ?>

          <!-- Test end -->

          <!-- Medicinestore Form -->
              
          <?php 
            if(isset($_GET['mId']) && strlen($_GET['mId']) > 0){ ?>
            <div class="card">
              <div class="bg-info card-body">
                <?php
                  $medicinestore_id=$_GET['mId'];
                  $medicinestore_data=$mysqli->select_single("select * from medicinestore where id=$medicinestore_id")['singledata'];
                ?>
                <h4 class="card-title">Update Rate</h4>
                <form class="pt-3 justify-content-center items-center" method="POST" action="<?=$baseurl?>/form/action.php">
                  <input type="text" name="id" value="<?=$_GET['mId'] ?>" hidden>
                  <div class="form-row d-flex">
                    <div class="form-group mx-2">
                      <select name="type" id="" class="form-select" required>
                        <option value="<?= $medicinestore_data['type'] ?>"><?= $medicinestore_data['type'] ?></option>
                        <option value="TAB">TAB</option>
                        <option value="INJ">INJ</option>
                    </select>
                    </div>
                    <div class="form-group mx-2">
                      <input type="text" value="<?= $medicinestore_data['name'] ?>" name="name" required class="form-control" id="name" placeholder="Name">
                    </div>
                    <div class="form-group mx-2">
                      <input type="text" value="<?= $medicinestore_data['mg'] ?>" name="mg" required class="form-control" id="mg" placeholder="MG">
                    </div>
                    <div class="form-group mx-2">
                      <input type="text" value="<?= $medicinestore_data['total_dose'] ?>" name="total_dose" required class="form-control" id="total_dose" placeholder="total_dose">
                    </div>
                    <div class="form-group mx-2">
                      <input type="text" value="<?= $medicinestore_data['rate'] ?>" minlength="3" maxlength="11" name="rate" required class="form-control" id="rate" placeholder="Rate">
                    </div>
                  </div>
                  <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary" name="update_medicinstore">Update</button>
                  </div>
                </form>
              </div>
            </div>
            <?php
            } 
            ?>

          <!-- Medicinestore end -->

          </div>
        </div>
      </div>
    </div>
  </div>
<script>

  let $designationbtn = $('#designationbtn');
  let $departmentBtn = $('#departmentBtn');
  let $serviceBtn = $('#serviceBtn');
  let $roomBtn = $('#roomBtn');
  let $rateBtn = $('#rateBtn');
  let $closebtn = $('#closebtn');
  
	$departmentBtn.click(function(){
    $('#departmentform').toggleClass('d-none');
	  //  $('#addPatientForm').removeClass('d-none');
	});
  


	$rateBtn.click(function(){
    $('#rate_form').toggleClass('d-none');
	  //  $('#addPatientForm').removeClass('d-none');
	});

	$closebtn.click(function(){
		$('#departmentform').addClass('d-none');
		$addPatient.removeClass('d-none');
	});
	$designationbtn.click(function(){
	  $('#designationform').toggleClass('d-none');
	  // $appointmentBtn.toggleClass('btn-dark');

	  // $('#test').addClass('d-none');
	  // $testBtn.addClass('btn-outline-dark');
	  // $('#admit').addClass('d-none');
	  // $admitBtn.addClass('btn-outline-dark');

	})
	$roomBtn.click(function(){
	  $('#roomform').toggleClass('d-none');
	  // $testBtn.toggleClass('btn-dark');
	})
	$serviceBtn.click(function(){
	  $('#service_form').toggleClass('d-none');
	  // $admitBtn.toggleClass('btn-dark');
	})
</script>
<!-- content-wrapper ends -->
<!-- partial:include/footer.php -->
<?php require_once('../include/footer.php'); ?>
 