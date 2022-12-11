
<div class="row mt-1 d-none" id="test">
    <div class="col-12 ">
        <div class="card w-100 mx-auto">
          <p class="closebtn"> <i class="mdi mdi-close-circle-outline cursor-pointer text-danger" 
                    onclick="$('#test').toggleClass('d-none');$testBtn.toggleClass('btn-dark');"> </i></p>
           <div class="row card-body justify-content-center">
              <!-- ***** -->
      <?php
          $rateData =$mysqli->selector('rate','*');
          $rate = $rateData['selectdata'];
          if($rateData['error']){
            $_SESSION['msg']=$rate['msg'];
          }
          
      ?>

      <!-- **** -->
           
           <form class=" justify-content-center items-center text-center" method="POST" action="<?=$baseurl?>/form/action.php">
            <input type="number" name="patient_id" value="<?= $patientSingleData['singledata']['id'] ?>" hidden>
                <div class="form-row d-flex justify-content-center">
                  <div class="form-group col-md-2 mx-2">
                    <label for="name">Test Name:</label>
                    <select id="test_name" onchange="get_rate(this.value);" name="test_name" class="form-select">
                      <option selected>Select test...</option>
                      <?php
                      foreach($rate as $r){ ?>
                      <option value="<?=$r['id'] ?>"><?=$r['service_name']?> : <?=$r['rate']?>tk</option>
                      <?php } ?>
                </select>
              </div>
            
            <!-- by admin and lebretary -->
                <div class="form-group col-md-2 mx-2">
                  <label for="gender">Price:</label>
                  <input type="text" class="form-control" name="delivary"/>
                </div>            
                <div class="form-group col-md-2 mx-2">
                  <label for="address">Reference_By:</label>
                  <input type="text" name="reference_by" class="form-control" id="address" placeholder="name...">
                </div>
                <div class="form-group col-md-2 mx-2">
                  <button class="btn form-control  mt-4" type="button">
                  <i class="mdi mdi-delete"></i>
                  </button>
                </div>
              </div>
              <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary"  name="addTest">Add Test</button>
              </div>
            </form>
            </div>
            <!-- action="<?=$baseurl?>/form/action.php" -->

        </div>
    </div>
</div>
