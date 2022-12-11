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
        <?php  if(isset($_SESSION["msg"])){?>
                <div class="bg-light p-4">
                  <h4 class="text-info text-center">
                      <?= $_SESSION["msg"]; ?>
                    </h4>
                  </div>
                  <?php unset($_SESSION["msg"]); } ?>

          <!-- Department form -->
                
          <div class="col-md-8 grid-margin stretch-card" id="departmentform">
            <div class="card">
               <?php
                $dept_data=$mysqli->selector('department');
                $deptartment=$dept_data['selectdata'];
              
              
              ?>
              <!-- Department Data -->
              <h2 class=" text-dark text-center h2 mt-4">Department</h2>
              <div class="row ">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                 
                      <!-- add form -->
                      <form class="justify-content-center items-center d-none" id="addDeptform" method="POST" action="<?= $baseurl ?>/form/action.php" >
                        <div class="form-row col-md-12 d-flex">  
                                        
                          <div class="form-group col-md-6 mx-2">
                            <input type="text" name="name" required class="form-control" id="name" placeholder="Add Department">
                          </div>
                          <div class="form-group col-md-6 mx-2">                  
                            <input  minlength="11" type="submit" maxlength="11" name="dept_form" class="form-control" value="Add" >
                          </div>                    
                        </div>
                      </form> 
                         <!-- button -->
                         <button class="float-end btn btn-sm btn-info mb-4" id="add" onclick="$(this).toggleClass('d-none');$('#addDeptform').toggleClass('d-none');$('#close').toggleClass('d-none');">Add</button>
                      <button class="float-end btn btn-sm btn-danger mb-4 d-none" id="close"  onclick="$(this).toggleClass('d-none');$('#addDeptform').toggleClass('d-none');$('#add').toggleClass('d-none');">Cancel</button>
                       <br>
                    <div class="list-wrapper mt-4">
                      <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                        <?php
                          $class_name=false;
                          if($dept_data['numrows'] > 0){
                          foreach($deptartment as $dpt){
                            if($dpt['status'] == 0){
                            $class_name ='completed';
                            }else{
                              $class_name= "";
                            }

                            ?>
                            
                      
                            <li class="<?= $class_name ?>">
                        <a class="text-decoration-none text-white" href="<?= $baseurl ?>/form/editcategories.php?deptId=<?= $dpt['id'] ?>"> 
                        <button class=" btn btn-sm text-white btn-success mx-2">
                              <i class="mdi mdi-border-color" ></i> </a>
                            </button>
                            <label class="form-check-label">
                          <?=  $dpt['name']; ?> 
                          </label>
                          <a style="display: contents;" class="float-end" href="<?= $baseurl?>/form/deleteuser.php?deptId=<?=$dpt['id'] ?>">
                          <?php 
                          if($dpt['status'] == 1){?>
                          <i class="remove mdi mdi-close-circle-outline"></i> 
                          <?php } else{?>
                            <i class="remove  mdi mdi-plus-circle"></i> 
                            <?php } ?>
                      </a>
                          
                        </li>
                        <?php  }}
                        ?>
                      </ul>
                      <script>
                          let $edit_dept = $('#edit_dept');

                          $edit_dept.click(function(){
                            $('#editdeptform').toggleClass('d-none');
                            //  $('#addPatientForm').removeClass('d-none');
                          });

                      </script>
                    </div>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>

          <!-- department end -->

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