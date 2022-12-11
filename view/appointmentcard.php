<?php 

require_once('../include/header.php');
require_once('../lib/Crud.php');


$mysqli = new Crud(); ?>
<?php if(isset($_GET['aid']) && strlen($_GET["aid"]) > 0){ 
                $appointmentId = $_GET['aid'];
                
                $data = $mysqli->select_single("SELECT p.name as ptient_name,p.id,p.blood_group,p.gender,p.age,p.present_address, u.name as doctor_name ,a.id as appointment_id,d.qualification,u.phone,a.date,a.time ,ip.id , ip.ipid FROM user u JOIN doctor d on u.id=d.user_id JOIN appointment a on a.doctor_id=d.id JOIN patient p ON p.id=a.patient_id JOIN invoice_payment ip ON ip.appointment_id=a.id WHERE a.id=$appointmentId");
                if($data["numrows"] > 0){
                ?>
    <!-- *** APPOINTMENT CARD ***-->
    <button id="card" type="button" class="btn btn-sm btn-outline-dark float-end m-4" style="position: absolute;right: 0;bottom:0;">Print</button>
    
    <div id="card-content" 
            style="width: 100%;
            height: 25rem;display: flex;
            padding: 1rem;
            z-index: 1000;
            top: 0;
            justify-content: center;
            justify-items: center;
            margin: 0px auto;">
            <div id="appointmentCard" style="width: 40rem; height:100%;box-shadow: 1px 0px 10px 5px whitesmoke;border-radius:.2rem;">
                <div style="background:coral;border-radius:.2rem;text-align:center;">
                    <h3 style="color:whitesmoke;font-size:1.5rem;font-weight:600; padding:1rem;">APPOINTMENT CARD</h3>
                </div>
                <div style="text-align:center;">
                    <h5 style="color:#111"><?=$data["singledata"]["doctor_name"] ?> (<?=$data["singledata"]["qualification"] ?>)</h5>
                    <p>
                    <?=$data["singledata"]["phone"] ?>
                    </p>
                    <hr style="background-color: #ddd;">
                    <p>IPID: <?= $data["singledata"]['ipid']?></p>
                </div>
                <div style="justify-content:space-around;margin:1rem;border:1px dashed #ddd;padding:1rem; ">
                <span>
                    <label for="">Name:</label>
                    <input 
                    style="border:none;background:#ddd;padding:.4rem;border-radius:.2rem;" 
                    type="text" readonly value="<?= $data["singledata"]['ptient_name']?>">
                    <label for="">Appointment Id:</label>
                    <input style="width: 20%;border:none;background:#ddd;padding:.4rem;margin-top:.5rem;border-radius:.2rem;" type="text" readonly value="<?= $data["singledata"]['appointment_id']?>">
                </span>
                <br>
                <span >    
                    <label for="">Date:</label>
                    <input 
                    style="width: 45%;border:none;background:#ddd;padding:.4rem;margin-top:.3rem;border-radius:.2rem;" 
                    type="text" readonly value="<?= $data["singledata"]['date']?>">   
                    <label for="">Time:</label>
                    <input style="width: 30%;border:none;background:#ddd;padding:.4rem;margin-top:.5rem;margin-right:.5rem;border-radius:.2rem;" type="text" readonly value="<?= $data["singledata"]['time']?>">
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


<script>
    $(document).ready( () => {
        $("#card").click(() => {
                    let printContents = $("#appointmentCard").html();
            let originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;  
    });

});
</script>