<?php 
require_once('../lib/Crud.php'); 

$mysqli = new Crud();

if(isset($_SESSION) && !($_SESSION['userdata']['roles']== 'SUPERADMIN') ){
    echo "<script> location.replace('$baseurl/dashboard/')</script>";
}

require_once('../include/header.php'); 
?>

<div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">

      <div class="container-fluid">
    
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

        <div class="d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-12 mx-auto">
              <div class="auth-form-light text-left p-5">
              <h3>ADD USER</h3>
              


<?php 
                  if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                  }
                ?>
<form class="pt-3 justify-content-center items-center" method="POST" action="<?= $baseurl?>/form/action.php">
                
  <div class="form-row d-flex">
    <div class="form-group col-md-6 mx-2">
      <label for="name">Name</label>
      <input type="text" name="name" class="form-control" id="name" placeholder="Name">
    </div>
    <div class="form-group col-md-6 mx-2">
      <label for="email">Email</label>
      <input type="email" name="email" class="form-control" id="email" placeholder="email">
    </div>
  </div>
  <div class="form-row d-flex">
    <div class="form-group col-md-6 mx-2">
      <label for="password">Password</label>
      <input type="password" name="password" class="form-control" id="password" placeholder="Name">
    </div>
    <div class="form-group col-md-6 mx-2">
    <label for="inputState">Roles</label>
      <select name="roles" id="inputroles" class="form-control">
        <option value="ADMI" selected>ADMIN</option>
        <option value="SUPERADMIN">SUPERADMIN</option>
        <option value="DOCTOR">Doctor</option>
        <option value="EMPLOYEE">Employee</option>
      </select>
    </div>
  </div>
  <div class="form-row d-flex">
    <div class="form-group col-md-6 mx-2">
        <label for="phone">Phone</label>
        <input type="text" name="phone" minlength="10" maxlength="11" class="form-control" id="phone" placeholder="Phone">
      </div>
    <div class="form-group col-md-6 mx-2">
      <label for="inputAddress">Address</label>
      <input type="text" name="address" class="form-control" id="inputAddress" placeholder="1234 Main St">
    </div>
  </div>
  <div class="form-group">
    <div class="form-check mx-5 mt-5">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div>
  <div class="d-flex justify-content-center">
    <button type="submit" name="reg" class="btn btn-primary">Add New User</button>
  </div>
</form>
</div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->


      </div>
      <!-- page-body-wrapper ends -->
    <?php require_once("../include/footer.php"); ?>