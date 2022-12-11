<?php 

require_once('../include/header.php');
require_once('../lib/Crud.php');


$mysqli = new Crud();

if(isset($_SESSION) && !($_SESSION['userdata']['roles']== 'SUPERADMIN') ){
    echo "<script> location.replace('$baseurl/dashboard/')</script>";
}

if(isset($_SESSION['msg'])){
  $msg = $_SESSION['msg'];
  unset($_SESSION['msg']);
}


?>
<div class="container-scroller">
      <!-- partial:./navbar.php -->
  <?php require_once('../include/navbar.php'); ?>
      <!--  partial -->
  <div class="container-fluid page-body-wrapper">
        <!-- partial:include/sidebar.php -->
  <?php require_once('../include/sidebar.php'); ?>
        <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
      <?php
      // ! *** USER'S PROFILE***
      if(isset($_GET['id']) && strlen($_GET['id']) > 0){ 
        $user_Id = $_GET['id'];
        $selectUser = $mysqli->select_single("SELECT * FROM user Where id=$user_Id");
        $profile = $selectUser['singledata'];
      ?>     
        <!-- start profile -->
      <div class="wrapper bg-white py-5">
          <div class="row  mx-5">
              <div class="col-md-6">
                  <h4 for="text-muted">Account settings</h4>
              </div>
              <div class="col-md-6 pt-md-0 pt-3 d-flex justify-content-end">
                  <a class="btn btn-gradient-primar"  
                  href="<?= $baseurl ?>/form/updateuser.php?id=<?=$user_Id?>">Edit Profile</a>
              </div>
          </div>
    <!-- show profile -->

    <!-- edit -->
          <div class="d-flex align-items-start py-3 border-bottom justify-content-start mb-2 ">
            <?php if($usr['avatar']!== null){ ?>
              <img src="../assets/images/avatar/<?= $usr['avatar'] ?>" class="img rounded-circle mx-5" alt="" width="100px"/>
              <?php }else{  ?>
                <img src="../assets/images/faces-clipart/pic-4.png" class="img rounded-circle mx-5" alt="" width="100px"/>
                  <?php } ?>
                  <div>
                    <h4><?=$selectUser['singledata']['name'] ?></h4>
                    <p class="text-muted"><?=$selectUser['singledata']['address']?></p>
                    <button class="btn btn-sm btn-outline-dark" id="changeProfile">
                      Change Profile Picture
                    </button>
                    <button class="btn btn-sm btn-outline-dark d-none" id="closeFileUp">
                        Chancel
                    </button>
                    <!-- image uploads -->
                    <div class="my-4 d-none" id="fileUp">
                    <form class="pl-sm-4 pl-2" method="POST" action="<?= $baseurl ?>/form/action.php" enctype="multipart/form-data" id="img-section">
                        <input type="file" name="avatar" class="btn-sm button border">
                        <button type="submit" name="images_upload" class="btn  button border">
                            Upload
                        </button>
                    </form>
                    
                    </div>
                    <?php if(isset($msg)) echo $msg;  ?>
                  </div>
                  <script>
                    let $changeProfile = $("#changeProfile");
                    let $closeFileUp = $("#closeFileUp");
                    let $fileUp = $("#fileUp");

                    $changeProfile.click(function(){
                        $closeFileUp.toggleClass('d-none');
                        $changeProfile.toggleClass('d-none');
                        $fileUp.toggleClass('d-none');
                    });
                    $closeFileUp.click(function(){
                        $closeFileUp.toggleClass('d-none');
                        $changeProfile.toggleClass('d-none');
                        $fileUp.toggleClass('d-none');
                    });
                  </script>
          </div>
          
          <!-- form to div converted -->
          <div class="pt-3 justify-content-center items-center">
            <div class="form-row ">
              <input type="text" value="<?=$user_Id?>" hidden>
              <?php  if(isset($_SESSION) && ($_SESSION['userdata']['roles']== 'SUPERADMIN') ){?>
            <div class="row d-flex input-group py-2 justify-content-center">
              <div class=" col-md-4 d-flex">
              <span class="input-group-text">Roles:</span>
                  <input type="text" readonly value="<?=$profile['roles']?>" class="form-control form-control bg-white" id="phone" >
                </div>
              <div class="col-md-4 d-flex">
              <span class="input-group-text">Status:</span>
                <input type="text" readonly value="<?=$profile['status']== 0 ? 'DEACTIVE' : 'ACTIVE'?>" class="form-control bg-white form-control" id="phone">
              </div>
            </div>
            <?php } ?> 
              <div class="row d-flex input-group py-2 justify-content-center">
                <div class=" col-md-4 d-flex">
                  <span class="input-group-text">Email</span>
                  <input type="text" value="<?=$profile['email']?>" readonly class="form-control bg-white">
                </div>
                <div class=" col-md-4 d-flex">
                  <span class="input-group-text">Phone:</span>
                  <input type="text" value="<?=$profile['phone']?>" class="form-control bg-white">
                </div>
              </div>  
                
              <div class="row d-flex input-group py-2 justify-content-center">
                <div class=" col-md-4 d-flex">
                  <span class="input-group-text">Address:</span>
                  <input type="text" value="<?=$profile['address']?>" readonly class="form-control bg-white">
                </div>
                <div class=" col-md-4 d-flex">
                  <span class="input-group-text">City:</span>
                  <input type="text"  class="form-control">
                </div>
              </div> 
              <div class="row d-flex input-group py-2 justify-content-center">
                <div class=" col-md-4 d-flex">
                  <span class="input-group-text">State:</span>
                  <input type="text" value="<?=$profile['address']?>" readonly class="form-control bg-white">
                </div>
                <div class=" col-md-4 d-flex">
                  <span class="input-group-text">Zip:</span>
                  <input type="text"  class="form-control">
                </div>
              </div> 
            
            </div>
            <div class="d-flex justify-content-center ">
              <!-- <button type="submit" class="btn btn-outline-dark my-4"  name="deactive">Deactive Account</button> -->
          </div>
        </div>
        <?php
        if($profile['roles']== 'DOCTOR'){
          $selectdoctor = $mysqli->select_single("SELECT * FROM doctor Where user_id=$user_Id");
          $doctorid = $selectdoctor["singledata"]["id"];
          if($selectdoctor['numrows'] > 0){ ?>
          <div class="pt-3 justify-content-center items-center">

          <div class="row">    
            <div class="wrapper mx-5"> 
          <!-- doctors table -->
            <div class="row">
              <div class=" col-10 offset-2 d-flex justify-content-between my-4 m-2">
                <h4>Doctor's Information</h4>
                <span >
                  <a href="<?= $baseurl ?>/form/updatedoctor.php?doctorid=<?=$user_Id?>"><i class=" mdi mdi-border-color" style="cursor:pointer"></i></a>
                  <i class=" mdi mdi-chevron-down" style="cursor:pointer" onclick="$('#doctorProfile').toggleClass('d-none')"></i>
                </span>
              </div>

            <?php $doctor = $selectdoctor['singledata'];  ?>
          
              <div class="pt-3 justify-content-center items-center" id="doctorProfile">
                <!-- <div class="form-row ">              -->
                  <div class="row d-flex input-group py-2 justify-content-center">
                    <div class=" col-md-4 d-flex">
                    <span class="input-group-text">Father name:</span>
                        <input type="text" readonly value="<?=$doctor['father_name']?>" class="form-control form-control bg-white" id="phone" >
                      </div>
                    <div class="col-md-4 d-flex">
                    <span class="input-group-text">Mother name:</span>
                      <input type="text" readonly value="<?=$doctor['mother_name']?>" class="form-control bg-white form-control" id="phone">
                    </div>
                  </div>        
                  <div class="row d-flex input-group py-2 justify-content-center">
                    <div class=" col-md-4 d-flex">
                      <span class="input-group-text">Gratuated from</span>
                      <input type="text" value="<?=$doctor['gratuated_from']?>" readonly class="form-control bg-white">
                    </div>
                    <div class=" col-md-4 d-flex">
                      <span class="input-group-text">Qualification:</span>
                      <input type="text" readonly value="<?=$doctor['qualification']?>" class="form-control bg-white">
                    </div>
                  </div>  
                  <div class="row d-flex input-group py-2 justify-content-center">
                    <div class=" col-md-4 d-flex">
                      <span class="input-group-text">Shift:</span>
                      <input type="text" value="<?=$doctor['shift']?>" readonly class="form-control bg-white">
                    </div>
                    <div class=" col-md-4 d-flex">
                      <span class="input-group-text">Consulant Fees:</span>
                      <input type="text" readonly class="form-control form-control bg-white" value="<?= $doctor['visit_fee']?>tk">
                    </div>
                  </div> 
                  <div class="row d-flex input-group py-2 justify-content-center">
                    <div class=" col-md-4 d-flex">
                      <?php 
                      $id = $doctor['department_id'];
                      $department =  $mysqli->select_single("SELECT name FROM department Where id=$id")['singledata'];
                      ?>
                      <span class="input-group-text">Department:</span>
                      <input type="text" value="<?=$department['name']?>" readonly class="form-control bg-white">
                      
                    </div>
                    <div class=" col-md-4 d-flex">
                      <span class="input-group-text">Date Of Birth:</span>
                      <input type="text" value="<?=$doctor['date_of_birth']?>" readonly class="form-control bg-white">
                    </div>
                  </div> 
                </div>
              </div>
              <div class="row">
                
    <div class="col-md-12 d-flex justify-content-between mt-4">
    <h4 class="text-muted">Patinet History</h4>
    <span>
        <i class=" mdi mdi-chevron-down pointer" style="cursor:pointer" onclick="$('#medical').toggleClass('d-none');"></i>
      </span>
    </div><hr>
    <div class="text-center align-item-center" id="medical">
      <h5 class="text-muted">Appointment History</h5>
      <!-- *** *** -->
      <?php
        // $mdhistory = $mysqli->selector("appointment", "*", "patient_id=$patient_Id")["selectdata"];
        $dctappointmentHistory = $mysqli->custome_query("SELECT a.*,p.id as patient_id,p.name,p.gender,p.age FROM appointment a JOIN doctor d ON a.doctor_id=d.id JOIN patient p ON a.patient_id=p.id  WHERE doctor_id=$doctorid ORDER BY a.date DESC
        ");
          $dctappointment = $dctappointmentHistory["selectdata"];
      ?>
      <!--? ****** -->
          <div class="row mx-1">
          <table class="table">
            <thead>
              <th>Patient</th>
              <th>Phone</th>
              <th>Gender</th>
              <th>Issues</th>
              <th>Date and Time</th>
              <th colspan="2">Action</th>
            </thead>
            <?php
            if($dctappointmentHistory["numrows"] > 0){
              foreach($dctappointment as $app){?>
            <tbody>            <tr>
              <td><?= $app["name"]?></td>
              <td><?= $app["phone"]?></td>
              <td><?= $app["gender"]?></td>
              <td><?= $app["message"]?></td>
              <td>
                <?= $app["time"]?><br>
                <?= $app["date"]?>
              </td>
              <td>
              <span class="d-flex justify-content-center">                                
                              <a title="Details" href="<?= $baseurl ?>/pages/profile.php?patientid=<?= $app['patient_id'] ?>" class="btn-sm bg-primary text-white text-decoration-none m-1">
                              <i class=" mdi mdi-eye"></i>
                            </a>
                            <!-- check appointment in prescription -->
                            <?php 
                              $checkApp = $mysqli->select_single("SELECT * from prescription WHERE appointment_id=".$app["id"]);
                              if($checkApp["numrows"] > 0){ ?>
                              <a title="View Prescriotion" href="<?= $baseurl ?>/view/viewprescriotion.php?presid=<?=$checkApp["singledata"]["id"]?>" class="btn-sm bg-warning text-decoration-none text-white m-1">
                              <i class="mdi mdi-file-document-box"></i>
                              </a>
                            <?php }else{ ?>
                              <a title="Prescription" href="<?= $baseurl ?>/pages/prescription.php?appointmentid=<?= $app['id'] ?>" class="btn-sm bg-info text-decoration-none text-white m-1" >
                              <i class="mdi mdi-note-plus"></i>
                              </a>
                           <?php }  ?>
                           <!-- <a title="Release Request" href="<?= $baseurl ?>/form/deleteuser.php?id=<?= $app['id'] ?>" class="btn-sm bg-warning text-decoration-none text-white m-1" onclick="confirm('Are you sure?')">
                              <i class=" mdi mdi-export"></i>
                              </a> -->
                            </span>
              </td>
            </tr>
            <?php  }} ?>
            </tbody>

            </table>
          </div>
      
    </div>
    
              </div>
            </div>
       
  </div>
  </div>
  
  

  <?php }}?>



    </div>
        <!-- end profile -->

<!-- Patient Profile -->
      
<?php 
  } elseif(isset($_GET['patientid']) && strlen($_GET['patientid']) > 0){

// ! PATIENT's Profile
  $patient_Id = $_GET['patientid'];
  
  $patientProfile = $mysqli->select_single("SELECT * FROM patient Where id=$patient_Id");
  $patient = $patientProfile['singledata'];
  ?>
  <div class="row">
    <div class="wrapper bg-white p-5">
    <div class="col-md-12">
      <div class="d-flex justify-content-between">
        <h4 class="text-muted">Patient Information</h4>
        <!-- <span >
          <i class=" mdi mdi-chevron-down" style="cursor:pointer"></i>
        </span> -->
      </div>
      <hr>
      <div class="row">
      <div class="col-md-4 text-center">
      <img src="../assets/images/icons/patient.png" class="img rounded-circle mx-5" alt="" width="100px"/>     
          <h3 class="m-2"><?= $patient['name']?></h3>  
      </div>
      <div class="col-md-8">
        <div class="row d-flex input-group py-2">
          <div class=" col-md-6 d-flex">
            <span class="input-group-text">Name</span>
            <input type="text" value="<?= $patient['name']?>" readonly class="form-control bg-white">
          </div>
          <div class=" col-md-6 d-flex">
            <span class="input-group-text">Address:</span>
            <input type="text" value="<?= $patient['present_address']?>" class="form-control">
          </div>
        </div>          
        <div class="row d-flex input-group py-2">
          <div class=" col-md-6 d-flex">
            <span class="input-group-text">Weight:</span>
            <input type="text" value="<?= $patient['weight']?>" class="form-control">
          </div>
          <div class=" col-md-6 d-flex">
            <span class="input-group-text">Contact</span>
            <input type="text" value="<?= $patient['phone']?>" readonly class="form-control bg-white">
          </div>
        </div>          
        <div class="row d-flex input-group py-2">
          <div class=" col-md-6 d-flex">
            <span class="input-group-text">Age</span>
            <input type="text" value="<?= $patient['age']?>" readonly class="form-control bg-white">
          </div>
        </div>          
      </div>
      </div>
    </div>
   
    <div class="col-md-12 d-flex justify-content-between mt-4">
    <h4 class="text-muted">Medical History</h4>
    <span>
        <i class=" mdi mdi-chevron-down pointer" style="cursor:pointer" onclick="$('#medical').toggleClass('d-none');"></i>
      </span>
    </div><hr>
    <div class="text-center align-item-center" id="medical">
      <h5 class="text-muted">Appointment History</h5>
      <!-- *** *** -->
      <?php
        // $mdhistory = $mysqli->selector("appointment", "*", "patient_id=$patient_Id")["selectdata"];
        $appointmentHistory = $mysqli->custome_query("SELECT a.*,a.id as appointment_id ,d.id,d.department_id,d.visit_fee,d.user_id,dep.id,dep.name as department_name, u.id,u.name 
        FROM appointment a 
          JOIN doctor d
            on a.doctor_id=d.id
            JOIN user u 
            ON d.user_id=u.id 
            JOIN department dep 
            on dep.id=a.department_id 
          WHERE a.patient_id=$patient_Id ORDER BY a.date DESC");
          $appointment = $appointmentHistory["selectdata"];

          
      ?>
      <!--? ****** -->

      <table class="table">
        <thead>
          <th>Doctor</th>
          <th>Department</th>
          <th>Issues</th>
          <th>Date and Time</th>
          <th colspan="2">Action</th>
        </thead>
        <?php
        if($appointmentHistory["numrows"] > 0){;
          foreach($appointment as $app){?>
        <tr>
          <td><?= $app["name"]?></td>
          <td><?= $app["department_name"]?></td>
          <td><?= $app["message"]?></td>
          <td>
                              <?= $app["time"]?> <br><br>
                              <?php $d = explode("-",$app["date"]); echo $d[2]."/".$d[1]."/".$d[0]; ?>
                            </td>
          <td>
          <span class="d-flex justify-content-center">                                
                              <a title="Appointment Card" target="_blank" href="<?= $baseurl ?>/view/appointmentcard.php?aid=<?= $app['appointment_id'] ?>" class="btn-sm bg-primary text-white text-decoration-none m-1">
                              <i class="mdi mdi-account-card-details"></i>
                            </a>
                             <!-- check appointment in prescription -->
                             <?php 
                              $checkApp = $mysqli->select_single("SELECT * from prescription WHERE appointment_id=".$app["appointment_id"]);
                              if($checkApp["numrows"] > 0){
                                 ?>
                              <a title="View Prescriotion" href="<?= $baseurl ?>/view/viewprescriotion.php?presid=<?=$checkApp["singledata"]["id"]?>" class="btn-sm bg-success text-decoration-none text-white m-1">
                              <i class="mdi mdi-file-document-box"></i>
                              </a>
                            <?php }else{ ?>
                              <a title="Prescription" href="<?= $baseurl ?>/pages/prescription.php?appointmentid=<?= $app['id'] ?>" class="btn-sm bg-info text-decoration-none text-white m-1" >
                              <i class="mdi mdi-note-plus"></i>
                              </a>
                           <?php }  ?>
                              <!-- <a title="Release Request" href="<?= $baseurl ?>/form/deleteuser.php?id=<?= $app["appointment_id"] ?>" class="btn-sm bg-warning text-decoration-none text-white m-1" onclick="confirm('Are you sure?')">
                              <i class=" mdi mdi-export"></i>
                              </a> -->
                            </span>
          </td>
        </tr>
        <?php  }} ?>
      </table>
    </div>
    
    </div>  
  </div>



<?php  } ?>


    </div>
          <!-- content-wrapper ends -->
          <!-- partial:include/footer.php -->
          <?php require_once('../include/footer.php') ?>