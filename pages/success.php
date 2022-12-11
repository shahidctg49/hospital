<?php 
require_once('../lib/Crud.php');
require_once("../include/header.php");


?>

    <div class="container-scroller">
    
      <!-- partial:./navbar.php -->
     
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:include/sidebar.php -->
      
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">


<?php
$mysqli = new Crud();

if(isset($_GET['phn']) && strlen($_GET['phn']) > 0){
     $phone = $_GET['phn'];

$data = $mysqli->select_single("SELECT * FROM appointment WHERE phone='$phone'");

$appointment = $data['singledata'];
if($data['error']){
  $_SESSION['msg']=$data['msg'];
  echo "error";
}

$departmentId = $appointment['department_id'];
$departmentData = $mysqli->select_single('SELECT * FROM doctor WHERE id=$departmentId');
$department = $departmentData['singledata'];

$docotorsId = $appointment['doctor_id'];
$docotorData = $mysqli->select_single('SELECT * FROM doctor WHERE id=$docotorsId');
$docotor = $docotorData['singledata'];


}
?>


            <!-- page header start -->
            <div class="page-header d-flex justify-content-center">
              <h3 class="page-title text-center">
                <span class=" text-white me-2">
                  <!-- <i class="mdi mdi-home"></i> -->
                </span> Appointment Submited
              </h3>
              <!-- <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav> -->
            </div>
            <!-- header contant -->
           
 <!-- header contant -->

<h2>
    <?php
    if(isset($_SESSION['msg'])){
        $_SESSION['msg'];
        unset($_SESSION['msg']);

    }

   
    ?>
</h2>

            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Recent Activities</h4>
                    <div class="table-responsive">
                      <!-- ! *** TABLE FROM DATABASE *** -->
                      <table class="table">
                        <thead>
                          <tr>
                            <th> #SL </th>
                            <th> Name </th>
                            <th> Phone </th>
                            <th> Department </th>
                            <th> Doctor Name </th>
                            <th>Message</th>                            
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(isset($_GET['phn']) && $data['numrows'] > 0){
                            
                            ?>
                         
                          <tr>
                            <td><?= $appointment['id']?></td>
                            <td>
                              <?= $appointment['name']?>
                            </td>
                            <td><?= $appointment['phone']?></td>
                            <td>
                            <?= $docotor?>
                            </td>
                            <td>
                              <?= $department?>
                            </td>
                            
                            <td><?= $appointment['message']?></td>
                            <td>
                             
                            </td>                           
                          </tr>
                          <?php }else{ ?>
                            <p>Data not found</p>
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
 