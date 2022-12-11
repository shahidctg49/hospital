<div class="row mt-1 d-none" id="admit">
    <div class="col-12 ">
        <div class="card w-100 mx-auto">
                    <p class="closebtn" id=""> <i class="mdi mdi-close-circle-outline cursor-pointer text-danger" 
                    onclick="$('#admit').toggleClass('d-none');
  admitBtn.toggleClass('btn-dark');"> </i></p>
                    <div class="row card-body justify-content-center">
        <form class=" justify-content-center items-center" method="POST" action="<?=$baseurl?>/form/action.php">
        <input type="number" name="patient_id" value="<?=$patientSingleData['singledata']['id'] ?>" hidden>
            <div class="form-row d-flex justify-content-center">
              <div class="form-group col-md-4 mx-2">
              <div ><label for="guardian_name">Gurdiant Name:</label><span class="float-end text-danger">*</span></div>
                <input type="text" name="guardian_name" required class="form-control" id="guardian_name" placeholder="Name">
              </div>
              <div class="form-group col-md-3 mx-2">
                <div ><label for="relationship">Relationship with Patient:</label><span class="float-end text-danger"></span></div>
                <input type="text" name="relationship_with_patient" class="form-control" id="relationship" placeholder="Gurdiant Name">
              </div>
              <div class="form-group col-md-3 mx-2">
                <div ><label for="refarecne">Refarecne By:</label><span class="float-end text-danger"></span></div>
                <input type="text" name="refarecne_by" class="form-control" id="refarecne" placeholder="Referance  Name">
              </div>
            </div>
            <div class="form-row d-flex justify-content-center">
              <div class="form-group col-md-4 mx-2">             
              <div ><label for="phone">Patient Of:</label><span class="float-end text-danger">*</span></div>
                <select name="patient_of" id="patient_of" required class="form-select" required>
                  <option value=""> select doctor</option>
                  <?php 
                $doctordata = $mysqli->custome_query("select doctor.id as doctor_id, user.name from doctor join user on user.id=doctor.user_id")["selectdata"];
                foreach($doctordata as $doc){?>
                  <option value="<?= $doc["doctor_id"]?>"> <?= $doc["name"]?></option>
                <?php }  ?>
                </select>
              </div>
              <div class="form-group col-md-3 mx-2">
              <div ><label for="room_id">Cabin Type:</label><span class="float-end text-danger">*</span></div>
                <select  id="room_id" class="form-select" required onchange="getRoomType(this.value)">
                  <option value=""> cabin type</option>
                  <option value="GENERAL-CABIN"> GENERAL-CABIN</option>
                  <option value="NON-AC-CABIN"> NON-AC-CABIN</option>
                  <option value="AC-CABIN"> AC-CABIN</option>
                  <option value="VIP-CABIN" > VIP-CABIN</option>
                  <option value="ICU"> ICU</option>
                  <option value="CCU"> CCU</option>
                </select>
              </div>
              <div class="form-group col-md-3 mx-2">
              <div >
                <label for="cavin_no">Cabin No:</label><span class="float-end text-danger">*</span></div>
                <select name="room_id" id="cavin_no" class="form-select">
                  <option value=""> cabin no</option>
                </select>
                <small class="text-muted pt-2" id="rate"></small>
              </div>
              
            </div>

            <div class="form-row d-flex justify-content-center">
              <div class="form-group col-md-4 mx-2">
              <div ><label for="phone">Date:</label><span class="float-end text-danger">*</span></div>
                <input type="date" name="entry_time" value="<?=date('Y-m-d')?>" minlength="<?=date('Y-m-d')?>" class="form-control" id="date" placeholder="eg 35">
              </div>
              <div class="form-group col-md-3 mx-2">
                <label for="condition">Condition:</label>
                <input type="text" name="patient_condition" class="form-control" id="condition" placeholder="Patient Condition">
              </div>
              <div class="form-group col-md-3 mx-2">
              <div ><label for="cavin_no">Emargency Contact:</label><span class="float-end text-danger">*</span></div>
                <input type="text" name="emargency_contact" class="form-control" minlength="10" maxlength="11" id="condition" placeholder="Patient Condition">
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <button type="submit" class="btn btn-primary"  name="admitPatient">Admit Patient</button>
            </div>
            </form>
          </div>
        </div>
      </div>
</div>


<script>
    function getRoomType(type){
    $.ajax({
      url:'../form/data.php?roomType='+type,
      type:'post',
      dataType:'json',
      contentType:'application/json',
      success:(data)=>{
        $('#cavin_no').html(JSON.stringify(data));
      },error:(xhr,status,error) => {

      }

    });

    $('#cavin_no').change(() =>{
      let d = $('#cavin_no').children('option:selected').data('rate');
      let rate = $('#rate').text(d+"tk Per Day");

    })
  }
</script>