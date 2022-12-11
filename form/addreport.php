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
if(isset($_GET["id"])){
    $invoiceid = $_GET["id"];
    $reportData = $mysqli->select_single("SELECT ip.patient_id as pid,p.name,p.age,p.gender,ip.* FROM invoice_payment ip  JOIN patient p ON p.id=ip.patient_id WHERE ip.id=$invoiceid")["singledata"];
    $pid = $reportData["patient_id"];
    
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
                    <h2 style="font-size:1.6rem;" class="card-title text-dark  mx-4 text-bold">Add Report <hr style="width: 7rem;"></h2>
            </div>
            <div class="row mx-5 d-flex">
                    <?php if(isset($_GET["id"]) && strlen($_GET["id"]) > 0){ ?> 
                  <ul class="list-group mx-5 col-5 row mt-4">
                  
                          <li  class="list-group-item  itemList">
                              <label for="">Patientid:</label>
                              &nbsp;  <strong><?=$pid?></strong>
                          </li>
                          <li class="list-group-item  itemList">
                              <label for="">Name:</label>
                              &nbsp; <strong><?= $reportData['name']?></strong>
                          </li>
                          
                          <li  class="list-group-item  itemList">
                              <label for="">Age:</label>
                              &nbsp; <strong><?= $reportData['age']?></strong>
                          </li>
                          <li  class="list-group-item  itemList">
                              <label for="">Gender:</label>
                              &nbsp;  <strong><?= $reportData['gender']?></strong>
                          </li>                   
                  </ul> 
                  <?php } ?>
                  <div class="col-5">
                    <img src="../assets/images/svg/test.svg" width="100%" height="200px" alt="">                     
                  </div>
                </div>
            <form  action="<?= $baseurl?>/form/action.php"method="POST" >
                    <div class="card-body invoice mt-0" >
                    <div class="form-group border p-4">
                    <!-- prescribe medicine -->
                    <div class="col-12 my-4">
                        <label class="text-muted">Test</label>
                        <select name="test_id" id="" class="form-select" required>
                            <option value="">Select Test</option>
                            <?php 
                            $test = json_decode($reportData["test_id"]);
                            foreach($test as $t){
                                $testName = $mysqli->select_single("SELECT test_name FROM test WHERE id=$t")["singledata"];
                                $checkTest = $mysqli->select_single("SELECT test_id FROM report WHERE test_id=$t")["singledata"]["test_id"];
                                if($checkTest == null){ ?>
                                    <option value="<?= $t?>"> <?= $testName["test_name"]?></option>
                
                            <?php } } ?>
                        </select>
                    </div>
                    <input type="text" placeholder="Test Name" hidden name="patient_id" value="<?=$pid ?>" class="form-control">
                    <input type="text" placeholder="Test Name" hidden name="invoice_id" value="<?=$reportData["id"] ?>" class="form-control">
                    <!-- outer repeater -->
                    <div class="repeater">
                        <div class="d-flex justify-content-end">
                            <button class="btn text-info bg-outline-dark  btn-sm" data-repeater-create type="button">
                                <i class="mdi mdi-plus-circle"></i> Add
                            </button>
                        </div>
                        <div data-repeater-list="outer-list">
                            <div  data-repeater-item class="row mt-2 ">
                                <div class="col-4 ">
                                    <input type="text" placeholder="Test Name" required name="test" class="form-control">
                                </div>                               
                                <div class="col-3 p-0 mx-1">
                                    <input type="text" class="form-control" required name="result"  placeholder="Result">
                                </div>
                                <div class="col-3 p-0 mx-1">
                                    <input type="text" class="form-control" name="normal_values" placeholder="Normal Values" id="bp">
                                    <small><p class="text-red"></p></small>
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
                <div class="row my-4 justify-ccontent-between d-flex border m-0 py-4">
                    <div class="col-5">

                        <label class="text-muted">Method</label>
                        <input type="text" placeholder="Test Method" name="method" class="form-control">
                    </div>
                    <div class="col-5">
                    <label class="text-muted">Material</label>

                        <input type="text" placeholder="Test Method" name="material" class="form-control">

                    </div>
                    <div class="col-10 my-3">
                                <textarea class="form-control py-2" name="note" placeholder="Note:" id="" cols="30" rows="5"></textarea>
                    </div>
                    </div>
                <div class="form-group">
                    <div class="row justify-content-end">
                    <div class="col-md-2  mt-4 ">
                        <input type="submit" class="btn btn-success" value="Add Report" name="addreport" id="prescription">
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