<?php 
require_once('../include/header.php'); 
require_once('../lib/Crud.php'); 

$mysqli = new Crud();

if(isset($_SESSION['userdata'])){
  if($_SESSION['userdata']['roles']== 'SUPERADMIN'){
    echo "<script> location.replace('$baseurl/dashboard/admin.php')</script>";
  }elseif ($_SESSION['userdata']['roles']== 'ADMIN'){
    echo "<script> location.replace('$baseurl/dashboard/patient.php')</script>";
  }elseif ($_SESSION['userdata']['roles']== 'DOCTOR'){
    echo "<script> location.replace('$baseurl/dashboard/doctor.php')</script>";
  }elseif ($_SESSION['userdata']['roles']== 'EMPLOYEE'){
    echo "<script> location.replace('$baseurl/dashboard/emp.php')</script>";
  }
}
?>


    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <a href="<?= $baseurl ?>/">
                    <img src="../assets/images/logo.svg">
                  </a>
                </div>
                <h4>New here?</h4>
                <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>


<?php 
                  if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                  }
                ?>
                <form class="pt-3" method="POST" action="<?= $baseurl?>/form/action.php">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" required id=""  name="name" placeholder="Full Name">
                  </div>
                  <div class="form-group">
                    <input type="email" name="email" required class="form-control form-control-lg" id="" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <input type="text" name="phone" required class="form-control form-control-lg" id="" placeholder="Phone" minlength="10" maxlength="11" > 
                  </div>
                
                  
                  <div class="form-group">
                    <input type="password" name="password" required class="form-control form-control-lg" id="password" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <input type="password" name="cpassword" required  class="form-control form-control-lg" id="cpassword" placeholder="Confirm Password" onchange="mathedPassword()">
                    <small id="passErr" class="form-text text-danger"></small>
 
                  </div>
                  <div class="mb-4">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input"> I agree to all Terms & Conditions </label>
                    </div>
                  </div>
                  <div class="mt-3">
                    <button name="reg" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" type="submit" >SIGN UP</button>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Already have an account? <a href="login.php" class="text-primary">Login</a>
                  </div>
                </form>
                <script>
  function mathedPassword(){

    let password = document.getElementById('password').value;
    let cpassword = document.getElementById('cpassword').value;
    if(password!== cpassword){
      document.getElementById('passErr').innerText="Password is not mathed";
    }
    
  }
</script>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->


      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <!-- endinject -->
  </body>
</html>