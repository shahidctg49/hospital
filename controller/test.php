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
        <!-- Test start -->
        <div class="col-md-10 grid-margin stretch-card" id="test_form">
            <div class="card">
            
              <div class="row card-body">
                <h4 class="text-center h2">Test Status</h4>
                <form class="pt-3 justify-content-center items-center d-none" id="addtest" method="POST" action="<?=$baseurl?>/form/action.php">
                  <div class="form-row d-flex">
                    <div class="form-group col-md-4 mx-2">
                      <label for="test_name"></label>
                      <input type="text" name="test_name" required class="form-control" id="test_name" placeholder="Test Name">
                    </div>
                    <div class="form-group col-md-4 mx-2">
                      <label for="rate"></label>
                      <input type="number" name="rate" required class="form-control" id="rate" placeholder="Rate">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="description"> </label>
                      <input type="text" name="description" class="form-control" id="description" placeholder="Description">
                    </div>
                  </div>
                  <div class="d-flex justify-content-center mb-2">
                    <button type="submit" class="btn btn-primary"  name="add_test_rate">Add Test</button>
                  </div>
                </form>
                <!-- button -->
                <button
                  style="width: 8rem;justify-self: end;text-align: center;align-items: end;position: absolute;right: 0;top: 0;margin: 1rem 10px;" 
                  class="float-end btn btn-sm btn-success mb-2" 
                  id="add" 
                  onclick="$(this).toggleClass('d-none');$('#addtest').toggleClass('d-none');$('#close').toggleClass('d-none');">
                  Add
                </button>
                  <button
                   style="width: 8rem;justify-self: end;text-align: center;align-items: end;position: absolute;right: 0;top: 0;" 
                   class="float-end btn btn-sm  mb-2 d-none"
                    id="close" 
                    onclick="$(this).toggleClass('d-none');$('#addtest').toggleClass('d-none');$('#add').toggleClass('d-none');">
                    <i class="mdi mdi-close-circle-outline cursor-pointer text-danger"> </i>
                  </button>
                  <div class="col-10">                    
                    <table class="table table-hover table-bordered table-striped">
                      <thead>
                        <tr>
                          <th> ID </th>
                          <th> Test Name: </th>
                          <th> Rate </th>
                          <th> Details </th>
                          <th> Created At </th>
                          <th colspan="2"> Action </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          
                          $test_data=$mysqli->selector('test');
                          $test=$test_data['selectdata'];
                          if($test_data['numrows'] > 1){
                          foreach ($test as $ts){
                            if($ts['status'] == 1){
                        ?>
                        <tr>
                          <td><?= $ts['id'] ?></td>
                          <td><?= $ts['test_name'] ?></td>
                          <td><?= $ts['rate'] ?>BDT</td>
                          <td><?= $ts['description'] ?></td>
                          <td><?= $ts['created_at'] ?></td>
                          <td>
                            <a href="<?= $baseurl ?>/form/editcategories.php?testId=<?= $ts['id'] ?>" class="btn-sm btn-primary text-decoration-none m-1">
                              <i class="mdi mdi-border-color"></i>
                            </a>
                            <a href="<?= $baseurl ?>/form/deleteuser.php?testId=<?= $ts['id'] ?>" class="btn-sm btn-danger text-decoration-none" onclick="confirm('Are you sure?')">
                              <i class="mdi mdi-delete"></i>
                            </a>
                          </td>
                        </tr>
                        <?php } } } ?>
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
          </div>

          <!-- Test end -->

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