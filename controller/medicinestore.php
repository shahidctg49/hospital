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
          <!-- Session Department -->
          <?php 
            if(isset($_SESSION['msg'])){
              echo  $_SESSION['msg'];
              unset ($_SESSION['msg']);
            }
          ?>
        <!-- Medicine Store -->

        <div class="col-md-12 grid-margin stretch-card" id="roomform">
            <div class="row card">            
              <div class="card-body">
                <h2 class="text-center ">Medicine Store</h2>
                <form class="pt-3 justify-content-center items-center row d-none" id="addroom" method="POST" action="<?=$baseurl?>/form/action.php">
                
                <div class="row mt-2 ">
                                <div class="col-2  mr-1">
                                    <select name="type" id="" class="form-select" required>
                                        <option value="">Type..</option>
                                        <option value="TAB">TAB</option>
                                        <option value="INJ">INJ</option>
                                    </select>
                                    <!-- <input type="text" placeholder="Type" name="type" class="form-control"> -->
                                </div>                               
                                <div class="col-3 p-0 mx-1">
                                <input type="text" class="form-control" name="name"  placeholder="Medicine Name">
                                </div>
                                <div class="col-1 p-0 mx-1">
                                    <input type="text" class="form-control" name="mg" placeholder="Mg/MI" id="mg">
                                    <small><p class="text-red"></p></small>
                                </div>
                                

                                <div class="col-1 p-0 mx-1">
                                    <input type="text" class="form-control" name="total_dose" placeholder="Total Tab">
                                </div>
                                <div class="col-1 p-0 mx-1">
                                    <input type="text" class="form-control" name="rate" placeholder="Rate">
                                </div>                                
                                <div class="col-1">
                                  <input type="submit" value="Add Medicine" class="btn bg-primary text-white mt-1" name="medicinestore" >
                                </div>
                            </div>
                </form>
                <!-- button -->
                <button class="float-end btn btn-sm btn-info" id="add" onclick="$(this).toggleClass('d-none');$('#addroom').toggleClass('d-none');$('#close').toggleClass('d-none');">Add</button>
                      <button class="float-end btn btn-sm btn-danger d-none" id="close"  onclick="$(this).toggleClass('d-none');$('#addroom').toggleClass('d-none');$('#add').toggleClass('d-none');">Cancel</button>
              </div>
              <div class="table-responsive mt-3 my-4">
                      <!-- ! *** TABLE FROM DATABASE *** -->
                      <table class="table table-hover table-bordered ">
                  <thead>
                    <tr>
                      <th> ID </th>
                      <th> Type</th>
                      <th> Name </th>
                      <th> Mg/MI</th>
                      <th> Total Tab</th>
                      <th> Rate </th>
                      <!-- <th> Created At </th> -->
                      <th colspan="2"> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      
                      $medicinestore=$mysqli->selector('medicinestore');
                      $medicine=$medicinestore['selectdata'];
                        if($medicinestore['numrows'] > 0){
                      foreach ($medicine as $m){
                        if($m['status']== 1){

                        
                    ?>
                    <tr>
                      <td><?= $m['id'] ?></td>
                      <td><?= $m['type']?></td>
                      <td><?= $m['name']?></td>
                      <td><?= $m['mg']?></td>
                      <td><?= $m['total_dose']?></td>
                      <td><?= $m['rate']?>tk</td>
                      <!-- <td>
                          
                      </td> -->
                      <td>
                        <a href="<?= $baseurl ?>/form/editcategories.php?mId=<?= $m['id'] ?>" class="btn-sm btn-primary text-decoration-none m-1">
                          <i class="mdi mdi-border-color"></i>
                        </a>
                        <a href="<?= $baseurl ?>/form/deleteuser.php?id=<?= $m['id'] ?>" class="btn-sm btn-danger text-decoration-none" onclick="confirm('Are you sure?')">
                          <i class="mdi mdi-delete"></i>
                        </a>
                      </td>
                    </tr>
                    <?php }}} ?>
                  </tbody>
                </table>
            </div>
            </div>
          </div>
          <!-- m end -->

        </div>
      </div>
    </div>
  </div>
</div>
          
<script>
    $(document).ready(function () {    

});
</script>
<!-- content-wrapper ends -->
<!-- partial:include/footer.php -->
<?php require_once('../include/footer.php'); ?>