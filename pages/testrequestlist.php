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



$testListData = $mysqli->find("SELECT ip.id,ip.test_id,ip.patient_id as patient_id,ip.payment_date,p.name,p.phone FROM `invoice_payment` ip JOIN patient p ON ip.patient_id=p.id");

$testList = $testListData["singledata"];
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
                      <h4 class="card-title">Test Request List</h4>
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
                            <th> Test Name </th>
                            <th> Date </th>
                            <th colspan="2"> Action </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          if($testListData['numrows'] > 0 ){
                          foreach ($testList as $t){
                            if($t["test_id"] != null){?>
                          <tr>
                            <td><?= sprintf('%05u', $t['id']) ?>
                            <input type="text" hidden value="<?= $t['id'] ?>" id="pid">
                          </td>
                            <td>
                                <a class="btn" title="View Profile" href="<?=$baseurl ?>/pages/profile.php?patientid=<?= $t['id'] ?>">
                                  <?= $t['name']?>
                                </a> 
                            </td>
                            <td><?= $t['phone']?></td>
                            <td><?php 
                               $test = json_decode($t['test_id']);
                               foreach($test as $tid){
                                $getTest = $mysqli->select_single("SELECT test_name FROM test WHERE id=$tid")['singledata']['test_name'];
                                echo $getTest."<br>";
                               }
                            ?></td>
                            <td>
                              <?= $t["payment_date"]?> <br><br>
                            </td>
                            <td >
                                <span class="d-flex justify-content-center">                                
                            
                            <!-- Check prescription -->
                            
                              <a title="Prescription" href="<?= $baseurl ?>/form/addreport.php?id=<?= $t['id'] ?>" class="btn-sm bg-info text-decoration-none text-white m-1" >
                              <i class="mdi mdi-note-plus"></i>
                              </a>
                            </span>
                            </td>
                          </tr>
                          <?php }}}else{?>
                            <tr>
                              <td colspan="6">No Data Found</td>
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