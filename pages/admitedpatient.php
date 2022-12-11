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



$allPatient = $mysqli->find("SELECT p.*, a.id as admit_id,a.*,r.room_no,r.rate,r.floor  FROM  patient p JOIN admit a on p.id=a.patient_id join room r ON r.id=a.room_id WHERE a.roles ='ADMITTED' ORDER by a.created_at DESC");

$patient = $allPatient["singledata"];
?>
                  <?php  if(isset($_SESSION["msg"])){?>
                <div class="bg-light p-4">
                  <h4 class="text-info text-center">
                      <?= $_SESSION["msg"]; ?>
                    </h4>
                  </div>
                  <?php unset($_SESSION["msg"]); } ?>
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
                      <h4 class="card-title">Admitted Patient List</h4>
                      <div class="search d-flex">
                          <i class="mdi mdi-person-star"></i>
                          <input type="text" class="form-control" placeholder="Search by name">
                        </div>
                        <a href="<?=$baseurl ?>/dashboard/patient.php" class="btn btn-secondary text-white font-weight-bold text-decoration-none">
                          Patient List
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
                            <th> Gender </th>
                            <th> Cavin No </th>
                            <th colspan="2"> Action </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          if($allPatient['numrows'] > 0){
                          foreach ($patient as $p){?>
                          <tr>
                            <td><?= $p['id'] ?>
                            <input type="text" hidden value="<?= $p['id'] ?>" id="pid">
                          </td>
                            <td>
                                <a class="btn" title="View Profile" href="<?=$baseurl ?>/pages/profile.php?patientid=<?= $p['id'] ?>">
                                  <?= $p['name']?>
                                </a> 
                            </td>
                            <td><?= $p['phone']?></td>
                            <td><?= $p['gender']?></td>
                            <td>
                              <?= $p["floor"]." - ".$p['room_no'] ?>
                            </td>
                            <td >
                             
                                <span class="d-flex justify-content-center">                                
                              <a title="Details" href="<?= $baseurl ?>/view/details.php?admitid=<?= $p['admit_id'] ?>" class="btn-sm bg-primary text-white text-decoration-none m-1">
                              <i class=" mdi mdi-eye"></i>
                            </a>
                            <?php $checkAdmit = $mysqli->select_single("SELECT * from prescription WHERE admit_id=".$p["admit_id"]);
                              if($checkAdmit["numrows"] > 0){
                                ?>
                                <a title="Prescription" href="<?= $baseurl ?>/view/viewprescriotion.php?presid=<?= $checkAdmit['singledata']['id'] ?>" class="btn-sm bg-info text-decoration-none text-white m-1" >
                              <i class=" mdi mdi-file-document-box "></i>
                              </a>
                                 <?php } ?>
                              <a title="Prescription" href="<?= $baseurl ?>/pages/prescription.php?admitted_id=<?= $p['id'] ?>" class="btn-sm bg-info text-decoration-none text-white m-1" >
                              <i class="mdi mdi-note-plus"></i>
                              </a>
                              <a title="Test/release" href="<?= $baseurl ?>/pages/patient.php?phn=<?= $p['phone'] ?>" class="btn-sm bg-info text-decoration-none text-white m-1" >
                              <i class="mdi mdi-plus-circle-multiple-outline"></i>
                              </a>
                              <a title="Release Request" href="<?= $baseurl ?>/pages/invoice.php?admitid=<?= $p["admit_id"]?>"  class=" btn btn-sm bg-warning text-decoration-none text-white m-1" id="released">
                              <i class=" mdi mdi-export"></i>
                              </a>
                            </span>
                            </td>
                          </tr>
                          <tr class="d-none">
                            <td colspan="7"></td>
                          </tr>
                          <?php }}else{?>
                            <tr>
                              <td colspan="7">No Data Found</td>
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


<!-- *** END THIS ADMIN*** -->

          </div>

          <!-- content-wrapper ends -->
          <!-- partial:include/footer.php -->
          <?php require_once('../include/footer.php') ?>


          <script>

            $('#released').click(()=>{
              let pid = $("#pid").val();
              location.replace("./invoice.php?patientid="+pid);
              
            })
          </script>