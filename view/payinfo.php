
<?php 
require_once('../lib/Crud.php'); 
require_once('../include/header.php');

// if(!$_SESSION["userdata"]){
//   echo "<script> location.replace('$baseurl/dashboard/')</script>";
// }

if($usr['roles'] !== 'SUPERADMIN' && $usr['roles'] !== 'ADMIN'){
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
          <div class="content-wrapper ">



<?php
$mysqli = new Crud();

if(isset($_GET['invoice']) && strlen($_GET['invoice']) > 0){
    $invoiceId = $_GET['invoice'];
    $invoice_data = $mysqli->select_single("SELECT ip.* ,p.id as pid ,p.* FROM  invoice_payment ip JOIN patient p on p.id=ip.patient_id  WHERE ip.id=$invoiceId");
    // $invoice = array_merge($invoice_data['singledata']);
    $invoice= $invoice_data['singledata'];

    if($invoice_data['numrows'] > 0){
?>


    <!-- Invoice Page -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

      
    <div class="row bg-info mx-4 py-4 d-grid justify-content-center d-none" style="position:absolute;z-index:1000;opacity:1;width:50%;margin:0 auto;top:10rem;" id="payment">
    <form class="pt-3 justify-content-center items-center"  method="POST" action="<?=$baseurl?>/form/action.php">
                  <div class="form-row">
                    <div class="form-group col-md-12 mx-2">
                        <input type="text"  readonly  name="id" hidden  value="<?= $invoiceId ?>" class="form-control bg-white" id="set_total" placeholder="Total">
                      <label for="name">Total:</label>
                      <input type="text"  readonly name="total" value="<?= $invoice["total"] ?>" class="form-control bg-white" id="set_total" placeholder="Total">
                    </div>
                    <div class="form-group col-md-12 mx-2">
                      <label for="name">Due:</label>
                      <input type="text"  readonly value="<?=$invoice["total"] - $invoice["payment"] ?>" class="form-control bg-white" id="set_due" placeholder="Total">
                    </div>
                    <div class="form-group col-md-12 mx-2">
                      <label for="rate">Payment:</label>
                      <input type="number" name="paid" required class="form-control" id="set_payment" placeholder="Payment">
                      <input type="number" name="payment" hidden value="<?=$invoice["payment"] ?>" class="form-control" id="set_payment" placeholder="Payment">
                    </div>
                  </div>
                  <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary mx-2"  name="update_invoice_payment">Payment</button>
                    <button type="submit" class="btn btn-danger mx-2" onclick="$('#payment').addClass('d-none');$('.page-content').removeClass('d-none')">Close</button>
                  </div>
                  </form>
    </div> 

<div  class="page-content container bg-white p-5" >
        <!-- Appointment card -->
   

    <div class="page-header text-blue-d2">
        <h1 class="page-title text-secondary-d1">
            Invoice
            <small class="page-info">
                <i class="fa fa-angle-double-right text-80"></i>
                ID: <?=sprintf('%05u', $invoiceId)?>
            </small>
        </h1>

        <div class="page-tools">
            <div class="action-buttons">
                <button id="printer" class="btn bg-white btn-light mx-1px text-95" href="#" data-title="Print">
                    <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                    Print
                </button>
                <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="PDF">
                    <i class="mr-1 fa fa-file-pdf-o text-danger-m1 text-120 w-2"></i>
                    Export
                </a>
            </div>
        </div>
    </div>

    


    <div class="container px-0" id="printPage">
        <!-- start for print -->
        <div style="margin-top: 1rem;">
            <div style="display:grid">
                <div style="display: flex;justify-content:center;text-align:center;">                    
                    <img src="../assets/images/hospital-sign.png" alt="img" width="40px" style="padding: .2rem;">
                    <h2 style="color:#dd4949;font-weight: 700;"><strong>HOSPITA<span>L</span></strong></h2>    
                    
                </div>
                <!-- .row -->

                <hr class="row brc-default-l1 mx-n1 mb-4" />

                <div style="display: grid;grid-template-columns: repeat(auto-fit,minmax(40%,1fr));margin-top:.5rem">
                    <div style="padding:.5rem;">
                        <div>
                            <span style="color:#615f5f;font-size:1.2rem;">Patient: </span>
                            <span style="color:#478fcc;font-wight:500;font-size:1.2rem;"><?= $invoice['name']?></span>
                        </div>
                        <div style="color:gray">
                            <div style="margin-top: .2rem;">
                                ipid: <?= $invoice['ipid']?>
                            </div>
                            <div ><label for="">Address:</label>
                            <?= $invoice['present_address']?>
                            </div>
                            <div class="my-1">
                                <label for="">Phone:</label>
                                <b class="text-600"><?= $invoice['phone']?></b></div>
                        </div>
                    </div>
                    <!-- /.col -->

                    <div style="display:flex;justify-content: end;">
                        <hr class="d-sm-none" />
                        <div class="text-grey-m2">
                            <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                Invoice
                            </div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID:</span> <?= sprintf('%05u', $invoice['id'])?></div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span> <?= $invoice['payment_date']?></div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Status:</span> <span class="badge badge-warning badge-pill px-25"><?= $invoice['remark']?></span></div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>

                <div class="mt-4">
                    
                    
                    <div class="row border-b-2 brc-default-l2"></div>

                    <!-- or use a table instead -->
        <?php if($invoice['test_id'] != null){   ?>
            <div class="table-responsive">
                <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                    <thead class="bg-none bgc-default-tp1">
                        <tr style="border-bottom: 1px solid #ddd;">
                            <th class="opacity-2">SL</th>
                            <th>Items</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th width="140">Amount</th>
                        </tr>
                    </thead>
                        
                    <tbody class="text-95 text-secondary-d3">
                        <tr></tr>
                        <?php 
                        
                        $test_info = json_decode( $invoice['test_id']); $sl=1;
                    $color = false;
                    foreach($test_info as $testID){
                        if($sl%2==0) $color = 'bgc-default-l4';
                        $test = $mysqli->select_single("SELECT test_name,description, rate FROM test WHERE id=$testID")['singledata']; ?>
                        <tr>
                            <td><?= $sl++ ?></td>
                            <td><?= $test['test_name']?></td>
                            <td><?= $test['description']?></td>
                            <td class="text-95"><?= $test['rate']?><b style="font-size:1rem;">৳</b></td>
                            <!-- <td class="text-secondary-d2">$20</td> -->
                        </tr> 
                        <?php  }

                        ?>
                    </tbody>
                </table>
            </div>
            <?php } ?>   
            
            <!-- *** APPOINTMENT *** -->
            <?php if($invoice['appointment_id'] != null){ 
                $appointmentId = $invoice['appointment_id'];                
                $data = $mysqli->find("SELECT u.name ,a.id,d.qualification,u.phone,a.date,a.time FROM user u JOIN doctor d on u.id=d.user_id JOIN appointment a on a.doctor_id=d.id WHERE a.id=$appointmentId");
                if($data["numrows"] > 0){
                ?>
                        <div class="row">
                        <div class="table-responsive col-md-9">
                            <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                                <thead class="bg-none bgc-default-tp1">
                                    <tr style="border-bottom: 1px solid #ddd;">
                                        <th>Doctor's Name</th>
                                        <th>Appointmetn id</th>
                                        <th>Consulant Fee</th>
                                        <th width="140">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?=$data["singledata"][0]["name"] ?></td>
                                        <td><?= $appointmentId ?></td>
                                        <td><?= $invoice['subtotal'] ?></td>
                                        <td><?= $invoice['total'] ?></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        </div>
                        <?php }  } ?>
            <!-- **************** -->

            <!-- Amidte Invoice start -->
            <?php if($invoice['admit_id'] != null){ 
                $admitId = $invoice['admit_id'];                
                $amitdata = $mysqli->find("SELECT a.room_id,r.room_type,r.rate,iv.subtotal,a.duration FROM invoice_payment iv JOIN  admit a on a.id=iv.admit_id JOIN room r ON a.room_id=r.id WHERE a.id=$admitId");
                if($amitdata["numrows"] > 0){
                ?>
                        <div class="row">
                        <div class="table-responsive col-md-9">
                            <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                                <thead class="bg-none bgc-default-tp1">
                                    <tr style="border-bottom: 1px solid #ddd;">
                                        <th>Medical Services</th>
                                        <th>Duration</th>
                                        <th>Rate</th>
                                        <th width="140">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?=["room_type"] ?></td>
                                        <td><?= $amitdata["singledata"][0]["duration"]?></td>
                                        <td><?= $amitdata["singledata"][0]['rate'] ?></td>
                                        <td><?= $invoice['subtotal'] ?></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        </div>
                        <?php }  } ?>
            <!-- Amidte Invoice End -->
                    <div class="row mt-3">
                        <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                            <?= $invoice['note']?>
                        </div>

                        <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                            <div class="row my-2">
                                <div class="col-7 text-right">
                                    SubTotal
                                </div>
                                <div class="col-5">
                                    <span class="text-120 text-secondary-d1">
                                        <?= $invoice['subtotal']?><b style="font-size:1rem;">৳</b>
                                    </span>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-7 text-right">
                                    Discount
                                </div>
                                <div class="col-5">
                                    <span class="text-120 text-secondary-d1"><?= $invoice['discount']?><b style="font-size:1rem;">৳</b></span>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-7 text-right">
                                    Tax (%)
                                </div>
                                <div class="col-5">
                                    <span class="text-110 text-secondary-d1"><?= $invoice['tax']?></span>
                                </div>
                            </div>
                            <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                <div class="col-7 text-right">
                                    Total
                                </div>
                                <div class="col-5">
                                    <span class="text-150 text-success-d3 opacity-2" id="get_total" data-tatal="<?= $invoice['total']?>"><?= $invoice['total']?><b style="font-size:1rem;">৳</b></span>
                                </div> 
                            </div>
                            <?php
                                if(isset($invoice['return']) && $invoice['return'] != 0 ){
                                ?>
                            <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                <div class="col-7 text-right">
                                    Return
                                </div>                                
                                <div class="col-5">
                                    <span class="text-150 text-success-d3 opacity-2"><?= $invoice['return']?><b style="font-size:1rem;">৳</b></span>
                                </div>
                            </div>
                            <?php } ?>
                            <hr>
                            <div class="row  align-items-center bgc-primary-l3 p-2">
                                <div class="col-7 text-right">
                                    Paid:
                                </div>
                                <div class="col-5">
                                    <span class="text-150 text-success-d3 opacity-2" style="background-color: #615f5f;color:#fff;padding:.3rem" data-payment="<?= $invoice['payment']?>" id="get_payment"><?= $invoice['payment']?><b style="font-size:1rem;">৳</b></span>
                                </div>
                            </div>
                            <?php
                                if($invoice['payment'] < $invoice['total'] ){
                                ?>
                            <div class="row align-items-center bgc-primary-l3 p-2" style="color:crimson;">
                                <div class="col-7 text-right">
                                    Due
                                </div>                                
                                <div class="col-5">
                                    <span class="text-150 text-success-d3 opacity-2" id="get_due" ><?= $invoice['total'] - $invoice['payment']?><b style="font-size:1rem;">৳</b></span>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                    <hr />

                    <div style="justify-content: space-between;display: flex;">
                        <span class="text-secondary-d1 text-105">Thank you for choicing this hospital</span>
                        <?php
                            if(isset($invoice['remark']) && $invoice['remark'] == 'DUE'){
                        ?>
                        <button href="#" class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0" onclick="$('#payment').removeClass('d-none');$('.page-content').addClass('d-none')">Pay Now</button>
                        <?php } ?>
                        <?php 
                        if($invoice['appointment_id'] != null && $invoice['remark'] == 'PAID'){
                            ?>
                            <button type="button" class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0" id="card">Get Appointment Card</button>

                        <?php  } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- *** APPOINTMENT CARD ***-->
    <div id="card-content" 
            style="width: 100%;
            height: 25rem;
            display: none;
            transform: translatey(50%);
            position: absolute;
            padding: 1rem;
            z-index: 1000;
            top: 0;
            margin-top: 6rem;
            justify-content: center;
            justify-items: center;
            margin: 0px auto;">
            <div id="appointmentCard" style="width: 30rem; height:100%;box-shadow: 1px 0px 10px 5px whitesmoke;border-radius:.2rem;">
                <div style="background:coral;border-radius:.2rem;text-align:center;">
                    <h3 style="color:whitesmoke;font-size:1.5rem;font-weight:600; padding:1rem;">APPOINTMENT CARD</h3>
                </div>
                <div style="text-align:center;">
                    <h5 style="color:#111"><?=$data["singledata"][0]["name"] ?> (<?=$data["singledata"][0]["qualification"] ?>)</h5>
                    <p>
                    <?=$data["singledata"][0]["phone"] ?>
                    </p>
                    <hr style="background-color: #ddd;">
                </div>
                <div style="justify-content:space-around;margin:1rem;border:1px dashed #ddd;padding:1rem; ">
                <span>
                    <label for="">Name:</label>
                    <input 
                    style="border:none;background:#ddd;padding:.4rem;border-radius:.2rem;" 
                    type="text" readonly value="<?= $invoice['name']?>">
                    <label for="">Appointment Id:</label>
                    <input style="width: 20%;border:none;background:#ddd;padding:.4rem;margin-top:.5rem;border-radius:.2rem;" type="text" readonly value="<?= $invoice['appointment_id']?>">
                </span>
                <br>
                <span >    
                    <label for="">Date:</label>
                    <input 
                    style="width: 45%;border:none;background:#ddd;padding:.4rem;margin-top:.3rem;border-radius:.2rem;" 
                    type="text" readonly value="<?= $data["singledata"][0]['date']?>">   
                    <label for="">Time:</label>
                    <input style="width: 30%;border:none;background:#ddd;padding:.4rem;margin-top:.5rem;margin-right:.5rem;border-radius:.2rem;" type="text" readonly value="<?= $data["singledata"][0]['time']?>">
                </span>
                <span style="display: flex;justify-content:space-around;margin-top:5rem;">
                    <label for="" style="border-top: 1px dashed;">Attentance</label>
                    <label for=""></label>
                    <label for="" style="border-top: 1px dashed;">Doctor's Approval</label>
                </span>
                </div>

                </div>           

        </div>
</div>

<?php  }else{

    echo 'NO data Found';
}
}else{
    echo "<script>location.replace('$baseurl/pages/error-404.html');</script>";
}
?>
   
        
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:include/footer.php -->
    <?php require_once('../include/footer.php') ?>



    <script>
    $(document).ready( () => {

        // let total = $('#get_total').text();
        // let payment = $('#get_payment').text();
        // let due = $('#get_due').text();
        // let setTotal = $('#set_total').val(total);
        // let setDue = $('#set_due').val(due);
        // let setPayment = $('#set_payment').val();


        $("#card").click(() => {
            $("#card-content").css({"display":"block"})
                    let printContents = $("#appointmentCard").html();
            let originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
            $("#card-content").css({"display":"none"})    
    });

            
$('#printer').click(() => {
            $("#card").css({"display":"none"});
            let printContent = $("#printPage").html();
            let payBill = document.body.innerHTML;

            document.body.innerHTML = printContent;

            window.print();

            document.body.innerHTML = payBill;
            
            $("#card").css({"display":"block"});

        })
    })

</script>      
