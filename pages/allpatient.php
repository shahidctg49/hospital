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
  case 'NURSE':
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



$allPatient = $mysqli->find("SELECT * FROM patient order by created_at DESC");
$patient = $allPatient["singledata"];
?>


<?php
// ! CONDITION END @:ADD PATIENT

  $id = $usr['id'];
// ! *** PATIENT ADDED BY THIS ADMIN ***


?>

    <div class="row mt-5" id="created_at">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <h4 class="card-title">Patient List</h4>
                      <div class="search d-flex">
                          <i class="mdi mdi-person-star"></i>
                          <input type="text" class="form-control" placeholder="Search by name">
                        </div>
                        <a href="<?=$baseurl ?>/pages/patient.php" class="btn btn-secondary text-white font-weight-bold text-decoration-none">
                          Add new patient
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
                            <th> Blood Group </th>
                            <th colspan="2"> Action </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          if($allPatient['numrows'] > 0 ){
                          foreach ($patient as $p){?>
                          <tr>
                            <td><?= $p['id'] ?></td>
                            <td>
                                <a class="btn" href="<?=$baseurl ?>/pages/profile.php?patientid=<?= $p['id'] ?>">
                                  <?= $p['name']?>
                                </a> 
                            </td>
                            <td><?= $p['phone']?></td>
                            <td><?= $p['age']?></td>
                            <td>
                              <?= $p['blood_group']?>
                            </td>
                            <td>
                              
                            <span class="d-flex justify-content-center">                                
                              <a title="Details" href="<?= $baseurl ?>/pages/profile.php?patientid=<?= $p['id'] ?>" class="btn-sm bg-primary text-white text-decoration-none m-1">
                              <i class=" mdi mdi-eye"></i>
                            </a>
                              <a title="Prescription" href="<?= $baseurl ?>/pages/prescription.php?presid=<?= $p['id'] ?>" class="btn-sm bg-info text-decoration-none text-white m-1" >
                              <i class=" mdi mdi-file-document-box "></i>
                              </a>
                              <a title="Prescription" href="<?= $baseurl ?>/pages/patient.php?phn=<?= $p['phone'] ?>" class="btn-sm bg-info text-decoration-none text-white m-1" >
                              <i class="mdi mdi-plus-circle-multiple-outline"></i>
                              </a>
                              <!-- <a title="Release Request" href="<?= $baseurl ?>/form/deleteuser.php?id=<?= $p['id'] ?>" class="btn-sm bg-warning text-decoration-none text-white m-1" onclick="confirm('Are you sure?')">
                              <i class=" mdi mdi-export"></i>
                              </a> -->
                            </span>
                            </td>
                          </tr>
                          <?php }}else{?>
                            <tr>
                              <td colspan="5">No Data Found</td>
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

?>  


<!-- *** END THIS p*** -->

          </div>

          <!-- content-wrapper ends -->
          <!-- partial:include/footer.php -->
          <?php require_once('../include/footer.php') ?>
