<?php 
require_once('../lib/Crud.php'); 
require_once('../include/header.php');


// if(!$_SESSION["userdata"]){
//   echo "<script> location.replace('$baseurl/dashboard/')</script>";
// }


if($usr){
switch ($usr['roles']) {
  case 'DOCTOR':
    header("location:$baseurl/dashboard/");
    break;
  case 'EMPLOYEE':
    header("location:$baseurl/dashboard/");
    break;
  }
}else{
  header("location:$baseurl/pages/login.php");
}




$mysqli = new Crud();

?>
    <div class="container-scroller">
    
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



<!-- ***************************************************************** -->
            <!-- page header start -->
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Patient 
             
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span> <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
              
            </div>

<?php

if(isset($_GET['phn']) && strlen($_GET['phn']) > 0){
$phone = $_GET['phn'];
$patientSingleData = $mysqli->select_single("SELECT id,name,phone,age,gender from patient where phone='$phone'");
$ChechAmiitedStatus = $mysqli->select_single("SELECT id,roles from admit where patient_id=".$patientSingleData["singledata"]["id"]);

if($patientSingleData['numrows']== 0){
 $msg="<p style='color:red'>NO Patient registered with this phone number.</p>";
 // echo "<script> location.replace('$baseurl/pages/login.php')</script>";
}

}
?>
   <?php  if(isset($_SESSION["msg"])){?>
                <div class="bg-light p-4">
                  <h4 class="text-info text-center">
                      <?= $_SESSION["msg"]; ?>
                    </h4>
                  </div>
    <?php unset($_SESSION["msg"]); } ?>


<?php if((isset($_GET['phn'] ) && strlen($_GET['phn'])) < 1){ ?>
         <!-- ********************************
            SEARCH PATIENT
    *********************************-->
    <div class="row mb-0" id="addPatient">
              <div class="col-12 ">
                <div class="card w-100 mx-auto">
                  <div id="addOrSearch">
                    <div class="row card-body justify-content-center" id="addBtn">
                        <div class="card bg-gradient-primary" style="width: 15rem;">
                            <button class=" btn btn-sm font-weight-normal text-white" id="addPatientBtn" ><i class="mdi mdi-alarm-plus   float-right"></i> Add New Patient 
                            </button>
                        </div>
                    </div>
                    <div class="col-12" id="or">
                      <div class="row justify-content-center text-muted">
                          OR                   
                      </div>
                    </div>
                    <div class="row card-body justify-content-center d-block" id="searchPatient">
                      <form class="form-inline d-flex w-80 col-8 offset-2" method="GET" name="search_patient">
                        <input class="form-control mr-sm-2 fload-right" id="inputSearch" type="search" name="phn" placeholder="Search by phone" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" id="inputSubmit"  disabled type="submit">Search</button>
                      </form>
                      <script>
                        $('#inputSubmit').attr('disabled','disabled');
                          $('#inputSearch').change(function(){
                              if($(this).val != ''){
                                  $('#inputSubmit').removeAttr('disabled');
                              }
                          });
                      </script>
                    </div>
                    </div>
                    <div class="col-8 offset-2 my-2">
                      <?php
                        if(isset($patientSingleData['singledata']) && $patientSingleData['msg'] === 'No data found'){ ?>
                          <p class="mt-5 text-center h2 text-danger justify-content-center mx-auto">Data not found</p>
                        <?php } ?>
                        <?php
                          if(isset($patientSingleData['singledata']) && $patientSingleData['msg']==='data found'){ ?>
                          <div class="p-2 my-2 text-center justitfy-content-center justify-item-center">
                            <img src="../assets/images/icons/patient.png" width="200px" alt="">
                          </div>
                          <table class="table table-bordered">
                            <thead class="table-light">
                              <th><label for="">Name</label></th>
                              <th><label for="">Phone</label></th>
                              <th><label for="">Gender</label></th>
                              <th><label for="">Age</label></th>
                              <?php  
                              if($ChechAmiitedStatus["numrows"] > 0){?> 
                              <th><label for="">Status</label></th>
                              <?php }?>
                            </thead>
                            <tbody>
                              <tr>
                                <td><?=$patientSingleData['singledata']['name'] ?></td>
                                <td><?=$patientSingleData['singledata']['phone'] ?></td>
                                <td><?=$patientSingleData['singledata']['gender'] ?></td>
                                <td><?=$patientSingleData['singledata']['age'] ?></td>
                                <?php  
                              if($ChechAmiitedStatus["numrows"] > 0){?> 
                              <td><label for=""><?= $ChechAmiitedStatus["singledata"]["roles"]?></label></td>
                              <?php }?>
                              </tr>
                            </tbody>
                          </table>
                      <!-- *** NEXT SECTION *** -->

                        <div class="row mt-5">
                          <div class="col-md-4">
                            <div class="card">
                            
                                <button class=" btn btn-sm btn-outline-dark font-weight-normal mb-3" id="appointmentBtn"><i class="mdi mdi-alarm-plus   float-right"></i> Appointment 
                                </button>
                            
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="card">
                            
                                <a href="<?=$baseurl?>/pages/invoice.php?patientid=<?= $patientSingleData['singledata']['id']?>" class=" btn btn-sm btn-outline-dark font-weight-normal mb-3 text-decoration-none" ><i class=" mdi mdi-amplifier  float-right"></i> Test 
                                </a>
                            
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="card">
                              
                           <?php 
                           if(isset($ChechAmiitedStatus["singledata"]["roles"]["ADMITTED"])){?> 
                                    <a href="<?= $baseurl ?>/pages/invoice.php?patientid=<?= $patientSingleData['singledata']['id']?>" class=" btn btn-sm btn-outline-dark font-weight-normal mb-3"><i class="mdi mdi-ambulance  float-right"></i> Release 
                                </a>
                                    <?php } else{ ?>
                                <button class=" btn btn-sm btn-outline-dark font-weight-normal mb-3" id="admitBtn"><i class="mdi mdi-ambulance  float-right"></i> Admit 
                                </button>
                            <?php } ?>
                            </div>
                          </div>
                      </div>
                                <!-- NEXT SECTION END -->
                    <?php }?>
                    </div>
                  

                </div>
              </div>
      </div>

        

<!-- ********************************
            ADD PATIENT 
    *********************************-->

<?php require_once('../components/patient/addpatient.php'); ?>
<!-- ADD PATIENT END -->


<!-- Conditional -->
<?php 
// ! CONDITION START @:SINGLE DATA
if(isset($patientSingleData['singledata']) && $patientSingleData['msg']==='data found'){ ?> 
  
<!-- ********************************
            @:APPOINTMENT 
*********************************-->
<?php require_once('../components/patient/addappointment.php'); ?>
<!-- ********************************
            @:TEST 
*********************************-->
<?php require_once("../components/patient/addtest.php"); ?>
<!-- ********************************
           @:ADMIT 
*********************************-->
<?php require_once("../components/patient/admitPtient.php"); ?>

<?php } ?>

<!-- *** ADMIT END*** -->

<?php if(isset($patientSingleData['singledata'])){ ?>
<?php } ?>


<script>
    
    let $addPatient = $('#addPatient');
    let $addPatientBtn = $('#addPatientBtn');
    let $addPatientForm = $('#addPatientForm');
    let $appointmentBtn = $('#appointmentBtn');
    let $testBtn = $('#testBtn');
    let $admitBtn = $('#admitBtn');
    let $closebtn = $('#closebtn');

	$addPatientBtn.click(function(){
	   $('#addPatient').addClass('d-none');
	   $('#addPatientForm').removeClass('d-none');
	});

	$closebtn.click(function(){
		$('#addPatientForm').addClass('d-none');
		$addPatient.removeClass('d-none');
	});
	$appointmentBtn.click(function(){
	  $('#appointment').toggleClass('d-none');
	  $appointmentBtn.toggleClass('btn-dark');
	  $('#searchPatient').addClass('d-none');
	  $('#or').addClass('d-none');
	  $('#addBtn').addClass('d-none');
	  $('#created_at').addClass('d-none');

	  // $('#test').addClass('d-none');
	  // $testBtn.addClass('btn-outline-dark');
	  // $('#admit').addClass('d-none');
	  // $admitBtn.addClass('btn-outline-dark');

	})
	$testBtn.click(function(){
	  $('#test').toggleClass('d-none');
	  $testBtn.toggleClass('btn-dark');
	})
	$admitBtn.click(function(){
	  $('#admit').toggleClass('d-none');
	  $admitBtn.toggleClass('btn-dark');
    $('#searchPatient').addClass('d-none');
	  $('#or').addClass('d-none');
	  $('#addBtn').addClass('d-none');
	  $('#created_at').addClass('d-none');
	});

//   $.ajax({
//   url:'./patient.php?phn=',
//   method:'get'
// })

// $('#addOrSearch');
	

</script>


<?php
// ! CONDITION END @:ADD PATIENT

  $id = $usr['id'];
// ! *** PATIENT ADDED BY THIS ADMIN ***

$thisAdminData =$mysqli->find("SELECT * FROM patient WHERE created_by=$id or modified_by=$id order by id DESC");
$createdBy = $thisAdminData['singledata'];


if($thisAdminData['numrows'] > 0 && $createdBy){
?>

    <div class="row mt-5" id="created_at">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <h4 class="card-title">Created By You</h4>
                      <div class="search d-flex">
                          <i class="mdi mdi-person-star"></i>
                          <input type="text" class="form-control" placeholder="Search by name">
                        </div>
                        <a href="<?=$baseurl ?>/dashboard/patient.php" class="btn btn-secondary text-white font-weight-bold text-decoration-none">
                          See All Patient
                        </a>
                    </div>
                    <div class="table-responsive mt-3">
                      <!-- ! *** TABLE FROM DATABASE *** -->
                      <table class="table table-hover table-bordered table-striped">
                        <thead>
                          <tr>
                            <th> Id </th>
                            <th> Name</th>
                            <th> Phone </th>
                            <th> Age </th>
                            <th> Created At </th>
                            <th colspan="2"> Action </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          foreach ($createdBy as $admin){?>
                          <tr>
                            <td><?= $admin['id'] ?></td>
                            <td>
                                <a class="btn" href="<?=$baseurl ?>/pages/profile.php?patientid=<?= $admin['id'] ?>">
                                  <?= $admin['name']?>
                                </a> 
                            </td>
                            <td><?= $admin['phone']?></td>
                            <td><?= $admin['age']?></td>
                            <td>
                              <?= $admin['created_at']?>
                            </td>
                            <td>
                            <span class="d-flex justify-content-center">                                
                              <a title="Details" href="<?= $baseurl ?>/pages/profile.php?patientid=<?= $admin['id'] ?>" class="btn-sm bg-primary text-white text-decoration-none m-1">
                              <i class=" mdi mdi-eye"></i>
                            </a>
                            </span>
                            </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
  <?php 
}}
?>  


<!-- *** END THIS ADMIN*** -->

          </div>

          <!-- content-wrapper ends -->
          <!-- partial:include/footer.php -->
          <?php require_once('../include/footer.php') ?>
