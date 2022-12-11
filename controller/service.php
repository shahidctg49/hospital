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
        
        <!-- service form -->

        <div class="col-md-10 grid-margin stretch-card" id="service_form">
            <div class="card">
              <div class="row card-body">
                <h4 class="text-center h2">Service Status</h4>
                <form class="pt-3 justify-content-center items-center d-none" id="addserv" method="POST" action="<?=$baseurl?>/form/action.php">
                  <div class="form-row d-flex">
                    <div class="form-group col-md-6 mx-2">
                      <label for="name"></label>
                      <input type="text" name="service_name" required class="form-control" id="name" placeholder="Service Name">
                    </div>
                    <div class="form-group col-md-6 mx-2">
                      <label for="rate"></label>
                      <input type="number" name="rate" required class="form-control" id="rate" placeholder="Rate">
                    </div>
                  </div>
                  <div class="form-row d-flex">
                    <div class="form-group col-md-4 mx-2">
                      <label for="address"> </label>
                      <input type="text" name="condition_on" class="form-control" id="address" placeholder="Condition On">
                    </div>
                    <div class="form-group col-md-4 mx-2">
                      <label for="age"> </label>
                      <input type="text" name="description"  class="form-control" id="age" placeholder="Description">
                    </div>
                    <div class="form-group col-md-4 mx-2">
                      <label for="address"></label>
                      <input type="text" name="duration" class="form-control" id="address" placeholder="Duration">
                    </div>
                  </div>

                  <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary"  name="add_service">Add Service</button>
                  </div>
                  </form>
                  <!-- button -->
                <button 
                  style="width: 8rem;justify-self: end;text-align: center;align-items: end;position: absolute;right: 0;top: 0;margin: 1rem 10px;"  class="float-end btn btn-sm btn-success mb-2" id="add" onclick="$(this).toggleClass('d-none');$('#addserv').toggleClass('d-none');$('#close').toggleClass('d-none');">Add</button>
                      <button 
                   style="width: 8rem;justify-self: end;text-align: center;align-items: end;position: absolute;right: 0;top: 0;" 
                   class="float-end btn btn-sm  mb-2 d-none" id="close"  onclick="$(this).toggleClass('d-none');$('#addserv').toggleClass('d-none');$('#add').toggleClass('d-none');">
                    <i class="mdi mdi-close-circle-outline cursor-pointer text-danger"> </i></button>
                  <table class="mt-4 table table-hover table-bordered table-striped">
                  <thead>
                    <tr>
                      <th> ID </th>
                      <th> Service Name: </th>
                      <th> Rate </th>
                      <th> Condition On </th>
                      <th> Description </th>
                      <th> Created At </th>
                      <th colspan="2"> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      
                      $service_data=$mysqli->selector('service');
                      $service=$service_data['selectdata'];
                        if($service_data['numrows'] > 0){                        
                      foreach ($service as $serv){
                        if($serv['status'] == 1){
                    ?>
                    <tr>
                      <td><?= $serv['id'] ?></td>
                      <td><?= $serv['service_name']?></td>
                      <td><?= $serv['rate']?></td>
                      <td><?= $serv['condition_on']?></td>
                      <td><?= $serv['description']?></td>
                      <td><?= $serv['created_at']?></td>
                      <td>
                        <a href="<?= $baseurl ?>/form/editcategories.php?serviceId=<?= $serv['id'] ?>" class="btn-sm btn-primary text-decoration-none m-1">
                          <i class="mdi mdi-border-color"></i>
                        </a>
                        <a href="<?= $baseurl ?>/form/deleteuser.php?id=<?= $serv['id'] ?>" class="btn-sm btn-danger text-decoration-none" onclick="confirm('Are you sure?')">
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

          <!-- service end -->

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