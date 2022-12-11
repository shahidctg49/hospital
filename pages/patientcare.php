<?php 
require_once('../lib/Crud.php'); 
require_once('../include/header.php');

// if(!$_SESSION["userdata"]){
//   echo "<script> location.replace('$baseurl/dashboard/')</script>";
// }

if($usr['roles'] !== 'SUPERADMIN' && $usr['roles'] !== 'DOCTOR'){
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
        <?php require_once('../include/sidebar.php') ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">


<?php
$mysqli = new Crud();
$appointmentid = $addmittedid = 0;
if(isset($_GET["appointmentid"])){
    $appointmentid = $_GET["appointmentid"];
    $appointment = $mysqli->select_single("SELECT patient_id from appointment where id=$appointmentid")["singledata"];
    $pid = $appointment["patient_id"];
    
}elseif(isset($_GET["admitted_id"])){
    $addmittedid = $_GET["admitted_id"];
    $admit = $mysqli->select_single("SELECT patient_id from admit where id=$addmittedid")["singledata"];
    $pid = $admit["patient_id"];

}else{
    // echo "<script>location.replace('$baseurl/pages/patient.php')</script>";

}
?>


          
            <!-- invoicce content -->
   <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-12">
            
            <!-- general form elements -->
            <div class="card p-4">
              <div class="">
                    <h2 style="font-size:1.6rem;" class="card-title text-dark  mx-4 text-bold">Patient Care <hr style="width: 7rem;"></h2>
            </div>
            
            <form  action="<?= $baseurl?>/form/action.php"method="POST" >
                <input type="number" hidden name="patient_id" value="<?= $pid ?>">
                <?php if(isset($_GET["admitted_id"])){?> 
                    <input type="number" hidden name="admit_id" value="<?= $addmittedid ?>">
                <?php }elseif(isset($_GET["appointmentid"])){ ?> 
                    <input type="number" hidden name="appointment_id" value="<?= $appointmentid ?>">
                    <?php } ?>
                <?php  
                if(isset($usr["roles"]["DOCTOR"])){
                    $doctor = $mysqli-> select_single("SELECT u.id, d.id as doctopr_id FROM user u JOIN doctor d ON u.id=d.user_id WHERE u.id=".$usr["id"])["singledata"]; ?>
                <input type="text" hidden name="doctor_id" value="<?= $doctor["doctopr_id"] ?>">
                <?php }  ?>
                    <div class="card-body invoice mt-0" >
                    <div class="form-group border p-4">
                    <!-- prescribe medicine -->
                    <!-- outer repeater -->
                    <div class="repeater">
                        <div class="d-flex justify-content-between">
                            <h4 class="text-muted">General Checkup</h4>
                            <button class="btn text-info bg-outline-dark  btn-sm" data-repeater-create type="button">
                                <i class="mdi mdi-plus-circle"></i> Add
                            </button>
                        </div>
                        <div data-repeater-list="outer-list">
                            <div  data-repeater-item class="row mt-2 ">
                                <div class="col-2  mr-1">
                                    <input type="text" placeholder="Presure" name="presure" class="form-control">
                                </div>                               
                                <div class="col-3 p-0 mx-1">
                                <input type="text" class="form-control" name="temperature"  placeholder="temperature">
                                </div>
                                <div class="col-2 p-0 mx-1">
                                    <input type="text" class="form-control" name="bp" placeholder="BP" id="bp">
                                    <small><p class="text-red"></p></small>
                                </div>                             
                                <div class="col-3 p-0 mx-1">
                                    <input type="text" class="form-control" name="saturation" placeholder="Oxygen Saturation Level">
                                </div>
                                <div class="col-1">
                                    <button class="btn btn-sm bg-danger text-white mt-1" data-repeater-delete type="button">
                                        <i class=" mdi mdi-delete "></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- Prescribe test -->
                <div class="row form-group border m-1 p-2 ">
                    <!-- outer repeater -->
                    <div class="repeater_test col-12 my-2">
                        <div class="d-flex justify-content-between ">
                            <h4 class="text-muted">Service</h4>
                            <button class="btn text-info bg-outline-dark  btn-sm" data-repeater-create type="button">
                                <i class="mdi mdi-plus-circle"></i> Add
                            </button>
                        </div>
                        <div data-repeater-list="inner-list">
                            <div  data-repeater-item class="row mt-2 inner-repeater">
                                <div class="col-4  mr-1">
                                        <input type="text" placeholder="Service Name" name="service_name" class="form-control">
                                </div>                               
                                <div class="col-3 p-0 mx-1">
                                    <input type="text" class="form-control" name="description" placeholder="Description">
                                </div>
                                <div class="col-3 p-0 mx-1 d-flex">
                                        <input type="text"  class="form-control" name="duration" placeholder="Duration" required>
                                        <select name="" id="" class="form-select">
                                            <option value="hours">Hours</option>
                                            <option value="minute">Minute</option>
                                        </select>
                                </div>

                                <div class="col-1">
                                    <button class="btn btn-sm bg-danger text-white mt-1" data-repeater-delete type="button">
                                        <i class=" mdi mdi-delete "></i>
                                    </button>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="row form-group border m-1 p-2 ">
                    <!-- outer repeater -->
                    <div class="repeater_medicine col-12 my-2">
                        <div class="d-flex justify-content-between ">
                            <h4 class="text-muted">Medicine Service</h4>
                            <button class="btn text-info bg-outline-dark  btn-sm" data-repeater-create type="button">
                                <i class="mdi mdi-plus-circle"></i> Add
                            </button>
                        </div>
                        <div data-repeater-list="inner-list">
                            <div  data-repeater-item class="row mt-2 inner-repeater">
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
                                    <button class="btn btn-sm bg-danger text-white mt-1" data-repeater-delete type="button">
                                        <i class=" mdi mdi-delete "></i>
                                    </button>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="form-group">
                    <div class="row justify-content-end">
                    <div class="col-md-2  mt-4 ">
                        <input type="submit" class="btn btn-success" value="Update" name="patientcare" id="prescription">
                    </div>
                    </div>
                </div>
                </div>
                <!-- /.card-body -->
            </form>
            
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
           
        </div>
          <!-- content-wrapper ends -->
          <!-- partial:include/footer.php -->
          <?php require_once('../include/footer.php') ?>


<script src="../assets/js/jquery.repeater.min.js"></script>

<script>
    $(document).ready(function () {

        $('.repeater').repeater({
            // (Required if there is a nested repeater)
            // Specify the configuration of the nested repeaters.
            // Nested configuration follows the same format as the base configuration,
            // supporting options "defaultValues", "show", "hide", etc.
            // Nested repeaters additionally require a "selector" field.
            repeaters: [{
                // (Required)
                // Specify the jQuery selector for this nested repeater
                selector: '.inner-repeater'
            }]
        });
        $('.repeater_test').repeater({
            // (Required if there is a nested repeater)
            // Specify the configuration of the nested repeaters.
            // Nested configuration follows the same format as the base configuration,
            // supporting options "defaultValues", "show", "hide", etc.
            // Nested repeaters additionally require a "selector" field.
            repeaters: [{
                // (Required)
                // Specify the jQuery selector for this nested repeater
                selector: '.inner-repeater'
            }]
        });
        $('.repeater_medicine').repeater({
            // (Required if there is a nested repeater)
            // Specify the configuration of the nested repeaters.
            // Nested configuration follows the same format as the base configuration,
            // supporting options "defaultValues", "show", "hide", etc.
            // Nested repeaters additionally require a "selector" field.
            repeaters: [{
                // (Required)
                // Specify the jQuery selector for this nested repeater
                selector: '.inner-repeater'
            }]
        });
    });
</script>