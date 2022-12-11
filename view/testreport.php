<?php
if(isset($_GET['report']) && strlen($_GET['report']) > 0){
  $reportid =$_GET['report'];
}


?>


<?php 
require_once('../lib/Crud.php'); 
require_once('../include/header.php');

// if(!$_SESSION["userdata"]){
//   echo "<script> location.replace('$baseurl/dashboard/')</script>";
// }

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
        <?php require_once('../include/sidebar.php') ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">


<?php
$mysqli = new Crud();
$data = $mysqli->selector('user','*');

$user = $data['selectdata'];
if($data['error']){
  $_SESSION['msg']=$data['msg'];
  echo "error";
}

$reportData = $mysqli->select_single("SELECT r.*,p.*,ip.remark,ip,id as invoice_id,t.test_name FROM report r  JOIN invoice_payment ip ON ip.id=r.invoice_id JOIN patient p ON p.id=r.patient_id JOIN test t ON t.id=r.test_id WHERE r.id=$reportid");

$report = $reportData["singledata"];

if($report["remark"] == 'DUE'){
    echo "<script> location.replace('$baseurl/pages/invoice.php?id=".$report["invoice_id"]."')</script>";

}

?>


            <?php 
            if($reportData["numrows"] > 0){ ?>
            <div style="padding: 1rem;justify-content:center;background-color:#fff;" id="printContent">
            <style>
                .itemList{
                background-color: #fff !important;
                border: 1px solid rgba(0, 0, 0, 0.125) !important;
                position: relative;
                display: block;
                padding: 0.5rem 1rem;
                color: #212529;
                text-decoration: none;
                }
            </style>  
                <div style="display: grid;grid-template-columns:repeat(auto-fit,minmax(40%,1fr));padding:2rem;">                
                    <div 
                        style="width: 100%; margin: 0 auto;margin-top:1rem;justify-content: center;justify-items: center;display: grid;">
                        <div style="display: flex;text-align:center;">
                        <img src="../assets/images/hospital-sign.png" alt="logo"  width="50px"  style="width: 35px;margin:.5rem;height:30px"/>
                        <h1 class="pt-2" style="font-weight:bolder;font-size:1.6rem; color:#e01111;">HOSPITAL</h1>
                    </div>
                    <p>2 No gate, Chittgong. <br>Phone: 031456789</p>
                    </div>
                    </div>
                    <div style="margin-left: 5%;margin-right:5%;">
                        <span >
                            <h5 style="color:#b1b2a9;padding-left:1rem;">Patient Informations</h5>
                        </span>
                        <div>
                        <ul style="border-top-left-radius: inherit;border-top-right-radius: inherit;">
                            <div style="display: grid;grid-template-columns:repeat(auto-fit,minmax(40%,1fr));justify-content:space-evenly">
                                <li class="itemList name">
                                    <label for="">Name:</label>
                                    &nbsp;  <strong><?= $report["name"] ?></strong>
                                </li>
                                <li  class="itemList">
                                    <label for="">Age:</label>
                                    &nbsp; <strong><?= $report["age"] ?> Years Old</strong>
                                </li>
                                
                                
                                
                                <li  class="itemList">
                                    <label for="">Gender:</label>
                                    &nbsp; <strong><?= $report["gender"] ?></strong>
                                </li>
                                
                                <li  class="itemList">
                                    <label for="">Address:</label>
                                    &nbsp; <strong><?= $report["present_address"] ?></strong>
                                </li>

                                
                            </div>
                        </ul>  
                        </div>
                        <hr>
                        <div class="d-flex justify-content-center">
                            <h3 class="test-center"><?= $report["test_name"]?>
                        </div>
                        </h3>
                        <hr>
                        <div style="display: grid;margin:0 .5rem;">
                            <table class="table">
                                <thead>
                                <th>TEST</th>
                                <th>RESULT</th>
                                <th>NORMAL VALUES</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $testData = json_decode($report["test_data"]);
                                    foreach($testData as $k ){?>                           
                                        <tr>
                                        <td><?= $k->test?></td>
                                        <td><?= $k->result?></td>
                                        <td><?= $k->normal_values?></td>
                                    </tr>
                                    <?php }
                                    if($report["method"] != ''){?> 
                                        <tr>
                                    <td><label for="">METHOD:</label></td>
                                    <td><?= $report["material"]?></td>
                                    <td></td>
                                    </tr>
                                    <?php }
                                    if($report["material"] != ''){ ?>
                                    <tr>
                                        <td><label>MATERIAL:</label></td>
                                        <td><?= $report["material"]?></td>
                                        <td></td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="3" style="text-align: center;">
                                            ------- &nbsp; end report &nbsp;--------
                                        </td>
                                    </tr>
                                <tr>
                                    <td colspan="3" style="text-align: center;"><?= $report["note"]?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div style="margin:1rem 5% 1rem 5%;">
                        <div>
                        <div style="display:flex;justify-content:space-around;margin-top: 6rem;">                          
                            <div >
                            <span ><h6 style="border-top: 1px solid;">Lab Technician</h6></span>
                            </div>
                            <div>
                            <span><h6 style="border-top: 1px solid;">Doctor's Signiture</h6></span>
                            </div>
                            <!-- <div>
                            <span><h6 style="border-top: 1px solid;">Manager's Signiture</h6></span>
                            </div>  -->
                        </div>
                        </div>
                    </div>
                    <div class="float-end mt-5">
                            <button class="btn btn-sm btn-danger text-end" id="print">Print</button>
                            <!-- <button class="btn btn-sm btn-info text-end">Confirm?</button> -->
                        </div>
                </div>  
                
                <?php  } ?>
        </div>
            <!-- content-wrapper ends -->
            <!-- partial:include/footer.php -->
            <?php require_once('../include/footer.php') ?>

            <!-- Main content -->

<script>
    $(document).ready( () =>{
    $('#print').click(() => {
            // $("#card").css({"display":"none"});
            let printContent = $("#printContent").html();
            let payBill = document.body.innerHTML;

            document.body.innerHTML = printContent;

            window.print();

            document.body.innerHTML = payBill;
            
            // $("#card").css({"display":"block"});

        });
    });
</script>