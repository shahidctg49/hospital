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
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>

<?php


$patientSingleData = $mysqli->select_single("SELECT id,name,phone,age,gender from patient");




?>




<!--  ! **************************************** -->
<?php
 $id = $usr['id'];
$patientData = $mysqli->selector('patient','*');


// ! *** CONDITION START FOR ALL PATIENT ***


$patient = $patientData['selectdata'];
if($patientData['error']){
  $_SESSION['msg']=$patientData['msg'];
  echo "error";
}


?>

  <!-- ! *** SHOW DETHAILs *** -->

            <div class="row mt-5">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <h4 class="card-title">ALL Patient</h4>
                      <div class="search d-flex">
                          <i class="mdi mdi-person-star"></i>
                          <input type="text" class="form-control" placeholder="Search by name">
                        </div>
                        <a href="<?=$baseurl ?>/pages/patient.php" class="btn btn-secondary text-white font-weight-bold text-decoration-none">
                          Add Patient
                        </a>
                    </div>
                    <div class="table-responsive mt-3">
                      <!-- ! *** TABLE FROM DATABASE *** -->
                      <table class="table table-hover table-bordered table-striped">
                        <thead class="table-light">
                          <tr>
                            <th> Id </th>
                            <th> Name</th>
                            <th> Phone </th>
                            <th> Age </th>
                            <th> Created By </th>
                            <th> Modified By </th>
                            <th> Status </th>
                            <th colspan="2"> Action </th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                        if($patientSingleData['numrows'] > 0){
                          foreach ($patient as $p){?>
                          <tr>
                            <td><?= $p['id']?></td>
                            <td>
                                <!-- <img src="../assets/images/faces/face3.jpg" class="me-2" alt="image"> -->
                                <a class="btn" href="<?=$baseurl ?>/pages/profile.php?patientid=<?= $p['id'] ?>">
                                  <?= $p['name']?>
                                </a> 
                            </td>
                            <td><?= $p['phone']?></td>
                            <td><?= $p['age']?></td>
                            <td>
                            <?php 
                              if($p['created_by'] && $_SESSION['userdata']['id'] ){
                                $creator = $mysqli->selector('user','name',$p['created_by']);
                                
                               echo $creator['selectdata'][0]['name'];
                                  
                              }                               
                              ?>
                              <br>
                              <?=$p['created_at']?>
                            </td>
                            <td>
                              <?php 
                              
                              $modifier = $mysqli->selector('user','name',$p['modified_by']);
                              if($p['modified_by'] && $_SESSION['userdata']['id'] ){
                                if($p['modified_by'] == $_SESSION['userdata']['id']){
                                  echo 'YOU';
                                }elseif($p['modified_by'] == $p['id']){
                                  echo 'OWN';
                                }else{
                                  echo $modifier['selectdata'][0]['name'];
                                }
                                
                                  
                              } 
                              ?>
                              <br>
                              <?= $p['modified_at']?>
                            </td>
                            <td>
                              <?php
                              if(!$p['status']== '0'){
                                echo "<label class='badge badge-gradient-info'>ACTIVE</label>";
                              }else{
                                echo "<label class='badge badge-gradient-danger'>DEACTIVED</label>";
                              }
                              
                              ?>
                            </td>
                            <td>
                              <a href="<?= $baseurl ?>/form/form/editpatient.php?id=<?= $p['id'] ?>" class="btn-sm btn-primary text-decoration-none m-1">
                              <i class="mdi mdi-border-color"></i>
                            </a>
                              <a href="<?= $baseurl ?>/form/deleteuser.php?id=<?= $p['id'] ?>" class="btn-sm btn-danger text-decoration-none" onclick="confirm('Are you sure?')">
                              <i class="mdi mdi-delete"></i>
                              </a>
                            </td>
                          </tr>
                          <?php }}else{ ?>
                          <tr>
                            <td colspan="8" class="text-center">No Patient Found</td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
         

          </div>

          <!-- content-wrapper ends -->
          <!-- partial:include/footer.php -->
          <?php require_once('../include/footer.php') ?>
 