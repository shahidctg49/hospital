<?php
if(isset($_GET['admitid']) && strlen($_GET['admitid']) > 0){
  $admitid = $_GET['admitid'];
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

$admitedData = $mysqli->select_single("SELECT p.*, a.* , a.id as admitid, d.id, d.user_id, u.name as doctor_name ,r.room_no, r.floor FROM patient p JOIN admit a on p.id=a.patient_id JOIN doctor d on d.id=a.patient_of JOIN user u on d.user_id=u.id JOIN room r on r.id=a.room_id WHERE a.id=$admitid");

$patientInfo = $admitedData["singledata"];
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
            <?php 
            if($admitedData["numrows"] > 0){ ?>
            <div style="padding: 1rem;justify-content:center;background-color:#fcffd6;" id="printContent">
            <style>
              .itemList{
                background-color: #fffcf8 !important;
                border: 1px solid rgba(0, 0, 0, 0.125) !important;
                position: relative;
                display: block;
                padding: 0.5rem 1rem;
                color: #212529;
                text-decoration: none;
              }
            </style>        
          

            <div 
                style="width: 100%; margin: 0 auto;margin-top:1rem;justify-content: center;justify-items: center;display: grid;">
                    <div style="display: flex;text-align:center;">
                        <img src="../assets/images/hospital-sign.png" alt="logo"  width="50px"  style="width: 35px;margin:.5rem;height:30px"/>
                        <h1 class="pt-2" style="font-weight:bolder;font-size:1.6rem; color:#e01111;">HOSPITAL</h1>
                      </div>
                      <p>2 No gate, Chittgong. Phone: 031456789</p>
                    </div>
                    <div style="width:100%;text-align:center">
                      <h3 >Patient Portal</h3>                        
                    </div>
                    <div style="margin-left: 5%;margin-right:5%;">
                        <span >
                            <h5 style="color:#b1b2a9;padding-left:1rem;">Patient Informations</h5>
                        </span>
                        <div>
                          <div style="display: flex; justify-content:space-between;margin-top:1rem;margin-bottom:1rem;">
                          <li style="list-style-type:none;margin-left:1rem;">
                                    <label for="">Registration id:</label>
                                    &nbsp;  <strong><?= $patientInfo["admitid"] ?></strong>
                                </li>
                                <li  style="list-style-type:none">
                                    <label for="">Entry Time:</label>
                                    &nbsp; <strong><?= $patientInfo["entry_time"] ?>
                                      
                                    </strong>
                                </li>
                          </div>
                        <ul style="border-top-left-radius: inherit;border-top-right-radius: inherit;">
                            <div style="display: grid;grid-template-columns:repeat(auto-fit,minmax(40%,1fr));justify-content:space-evenly">
                                <li class="itemList name">
                                    <label for="">Name:</label>
                                    &nbsp;  <strong><?= $patientInfo["name"] ?></strong>
                                </li>
                                <li  class="itemList">
                                    <label for="">Age:</label>
                                    &nbsp; <strong><?= $patientInfo["age"] ?> Years Old</strong>
                                </li>
                                
                                
                                
                                <li  class="itemList">
                                    <label for="">Gender:</label>
                                    &nbsp; <strong><?= $patientInfo["gender"] ?></strong>
                                </li>
                                
                                <li  class="itemList">
                                    <label for="">Nationality:</label>
                                    &nbsp; <strong><?= $patientInfo["nationality"] ?></strong>
                                </li>

                                <li  class="itemList">
                                    <label for="">Marital Status:</label>
                                    &nbsp; <strong><?= $patientInfo["marital_status"] ?></strong>
                                </li>

                                <li  class="itemList">
                                    <label for="">Religious:</label>
                                    &nbsp; <strong><?= $patientInfo["religious"] ?></strong>
                                </li>
                                <li class="itemList">
                                    <label for="">Father's/Husband's Name:</label>
                                    &nbsp;  <strong><?= $patientInfo["father_or_husband_name"] ?></strong>
                                </li>
                                <li  class="itemList">
                                    <label for="">Mother's Name:</label>
                                    &nbsp; <strong><?= $patientInfo["mother_name"] ?></strong>
                                </li>
                                
                                <li  class="itemList">
                                    <label for="">Gurdient Name:</label>
                                    &nbsp; <strong><?= $patientInfo["guardian_name"] ?></strong>
                                </li>
                                <li  class="itemList">
                                    <label for="">Gurdient's Relationship:</label>
                                    &nbsp; <strong><?= $patientInfo["relationship_with_patient"] ?></strong>
                                </li>
                                
                                <li  class="itemList">
                                    <label for="">Contact:</label>
                                    &nbsp; <strong><?= $patientInfo["phone"] ?></strong>
                                </li>
                                
                                <li  class="itemList">
                                    <label for="">Emargency Contact:</label>
                                    &nbsp; <strong><?= $patientInfo["emargency_contact"] ?></strong>
                                </li>
                                <li class="itemList">
                                    <label for="">Present Address:</label>
                                    &nbsp;  <strong><?= $patientInfo["present_address"] ?></strong>
                                </li>
                                <li class="itemList">
                                    <label for="">Permanent Address:</label>
                                    &nbsp;  <strong><?= $patientInfo["permanent_address"] ?></strong>
                                </li>
                            </div>
                        </ul>  
                        </div>
                    </div>
                    <div style="margin:1rem 5% 1rem 5%;">
                        <span>
                            <h5 style="color:#b1b2a9;padding-left:1rem;">Medical History:</h5>
                        </span>
                        <ul style="border-top-left-radius: inherit;border-top-right-radius: inherit;">
                            <div style="display: grid;grid-template-columns:repeat(auto-fit,minmax(30%,1fr));justify-content:space-evenly">
                                <li class="itemList">
                                    <label for="">Doctor's Name:</label>
                                    &nbsp;  <strong><?= $patientInfo["doctor_name"] ?></strong>
                                </li>
                                <li  class="itemList">
                                    <label for="">Health Issues:</label>
                                    &nbsp; <strong><?= $patientInfo["relationship_with_patient"] ?></strong>
                                </li>
                                
                                <li  class="itemList">
                                    <label for="">Other Issues:</label>
                                    &nbsp; <strong><?= $patientInfo["relationship_with_patient"] ?></strong>
                                </li>
                                <li class="itemList">
                                    <label for="">Patient Condition:</label>
                                    &nbsp;  <strong><?= $patientInfo["patient_condition"] ?></strong>
                                </li>
                                <li  class="itemList">
                                    <label for="">Blood Group:</label>
                                    &nbsp; <strong><?= $patientInfo["relationship_with_patient"] ?></strong>
                                </li>
                                
                                <li  class="itemList">
                                    <label for="">Otistick:</label>
                                    &nbsp; <strong>No</strong>
                                </li>
                            </div>
                        </ul>  
                    </div>
                    <div style="margin:1rem 5% 1rem 5%;">
                        <span >
                            <h5 style="color:#b1b2a9;padding-left:1rem;">Hospiatl's Information:</h5>
                        </span>
                        <div>
                        <ul style="border-top-left-radius: inherit;border-top-right-radius: inherit;">
                            <div  style="display: grid;grid-template-columns:repeat(auto-fit,minmax(30%,1fr));justify-content:space-evenly">
                                <li class="itemList">
                                    <label for="">Paiten Id:</label>
                                    &nbsp;  <strong><?= $patientInfo["id"] ?></strong>
                                </li>
                                <li  class="itemList">
                                    <label for="">Room No:</label>
                                    &nbsp; <strong><?= $patientInfo["room_no"] ?></strong>
                                </li>
                                
                                <li  class="itemList">
                                    <label for="">Floor:</label>
                                    &nbsp; <strong><?= $patientInfo["floor"] ?></strong>
                                </li>
                                <li class="itemList">
                                    <label for="">Entry Time:</label>
                                    &nbsp;  <strong><?= $patientInfo["entry_time"] ?></strong>
                                </li>
                                <li  class="itemList">
                                    <label for="">Released At:</label>
                                    &nbsp; <strong></strong>
                                </li>
                                
                                <li  class="itemList">
                                    <label for="">Other:</label>
                                    &nbsp; <strong></strong>
                                </li>
                            </div>
                        </ul> 
                        <div style="display:flex;justify-content:space-around;margin-top: 6rem;">                          
                          <div >
                            <span ><h6 style="border-top: 1px solid;">Gurdiant's Signiture</h6></span>
                          </div>
                          <div>
                            <span><h6 style="border-top: 1px solid;">Doctor's Signiture</h6></span>
                          </div>
                          <div>
                            <span><h6 style="border-top: 1px solid;">Manager's Signiture</h6></span>
                          </div> 
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