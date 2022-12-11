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



$allPatient = $mysqli->find("SELECT a.*,p.id as patient_id,p.name,p.gender,p.age,u.name as doctor_name FROM appointment a JOIN doctor d ON a.doctor_id=d.id JOIN patient p ON a.patient_id=p.id JOIN user u ON u.id=d.user_id ORDER BY a.date DESC
");

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
                            <th> Doctor Name </th>
                            <th> Time </th>
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
                              <?= $p["doctor_name"]?>
                            </td>
                            <td>
                              <?= $p["time"]?> <br><br>
                              <?php $d = explode("-",$p["date"]); echo $d[2]."/".$d[1]."/".$d[0]; ?>
                            </td>
                            <td >
                                <span class="d-flex justify-content-center">                                
                            
                            <!-- Check prescription -->
                            <?php 
                              $checkApp = $mysqli->select_single("SELECT * from prescription WHERE appointment_id=".$p["id"]);
                              if($checkApp["numrows"] > 0){
                                 ?>
                              <a title="View Prescriotion" href="<?= $baseurl ?>/view/viewprescriotion.php?presid=<?=$checkApp["singledata"]["id"]?>" class="btn-sm bg-success text-decoration-none text-white m-1">
                              <i class="mdi mdi-file-document-box"></i>
                              </a>
                            <?php }else{ ?>  
                              <a title="Appointment Card" target="_blank" href="<?= $baseurl ?>/view/appointmentcard.php?aid=<?= $p['id'] ?>" class="btn-sm bg-primary text-white text-decoration-none m-1">
                              <i class="mdi mdi-account-card-details"></i>
                            </a>
                              <a title="Prescription" href="<?= $baseurl ?>/pages/prescription.php?appointmentid=<?= $p['id'] ?>" class="btn-sm bg-info text-decoration-none text-white m-1" >
                              <i class="mdi mdi-note-plus"></i>
                              </a>
                           <?php }  ?>
                              <a title="Test/release" href="<?= $baseurl ?>/pages/patient.php?phn=<?= $p['phone'] ?>" class="btn-sm bg-info text-decoration-none text-white m-1" >
                              <i class="mdi mdi-plus-circle-multiple-outline"></i>
                              </a>
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