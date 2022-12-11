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
          <?php  if(isset($_SESSION["msg"])){?>
                <div class="bg-light p-4">
                  <h4 class="text-info text-center">
                      <?= $_SESSION["msg"]; ?>
                    </h4>
                  </div>
                  <?php unset($_SESSION["msg"]); } ?>

             
          <!-- Designation form -->

          <div class="px-2 grid-margin stretch-card" id="designationform">


<div class="card">
  <div class="card-body">
    <h4 class="card-title">Designation Form</h4>
    <form class="pt-3 justify-content-center items-center  d-none" id="addDesi" method="POST" action="<?=$baseurl?>/form/action.php">
      <div class="form-row d-flex">
        <div class="form-group col-md-6 mx-2">
          <label for="designation_name">Designation Name: </label>
          <input type="text" name="designation_name" required class="form-control" id="designation_name" placeholder="Designation Name">
        </div>
        <div class="form-group col-md-6 mx-2">
          <label for="base_salary">Basic Salary: </label>
          <input type="text" name="base_salary" required class="form-control" id="base_salary" placeholder="Basic Salary">
        </div>
      </div>
      <div class="form-row d-flex">
        <div class="form-group col-md-6 mx-2">
          <label for="bounus_by_percent">Bonus: </label>
          <input type="text" name="bounus_by_percent" required class="form-control" id="bounus_by_percent" placeholder="Bonus in percent">
        </div>
        <div class="form-group col-md-6 mx-2">
          <label for="total_bounus">Total Bonus: </label>
          <input type="text" name="total_bounus" required class="form-control" id="total_bounus" placeholder="Total Bonus">
        </div>
      </div>
      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary"  name="add_degi">Add Designation</button>
      </div>
    </form>

      <!-- button -->
        <button class="float-end btn btn-sm btn-info" id="add" onclick="$(this).toggleClass('d-none');$('#addDesi').toggleClass('d-none');$('#close').toggleClass('d-none');">Add</button>
        <button class="float-end btn btn-sm btn-danger d-none" id="close"  onclick="$(this).toggleClass('d-none');$('#addDesi').toggleClass('d-none');$('#add').toggleClass('d-none');">Cancel</button>
                      
  </div>
  <div class="table-responsive">

    <!-- Designation Data -->

    <table class="table table-hover table-bordered table-striped">
      <thead>
        <tr>
          <th> ID </th>
          <th> Designation Name: </th>
          <th> Basic Salary</th>
          <th> Bonus By percent </th>
          <th> Total Bonus </th>
          <th> Created At </th>
          <th colspan="2"> Action </th>
        </tr>
      </thead>
      <tbody>
        <?php 
          
          $degi_data=$mysqli->selector('designation');
          $designation=$degi_data['selectdata'];
          if($degi_data['numrows']){
          foreach ($designation as $degi){
            if($degi['status'] ==1){
        ?>
        <tr>
          <td><?= $degi['id'] ?></td>
          <td><?= $degi['designation_name']?></td>
          <td><?= $degi['base_salary']?></td>
          <td><?= $degi['bounus_by_percent']?></td>
          <td><?= $degi['total_bounus']?></td>
          <td><?= $degi['created_at']?></td>
          <td>
            <a href="<?= $baseurl ?>/form/editcategories.php?desigId=<?= $degi['id'] ?>" class="btn-sm btn-primary text-decoration-none m-1">
            <i class="mdi mdi-border-color"></i>
          </a>
            <a href="<?= $baseurl ?>/form/deleteuser.php?id=<?= $degi['id'] ?>" class="btn-sm btn-danger text-decoration-none" onclick="confirm('Are you sure?')">
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

<!-- Designation end -->

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