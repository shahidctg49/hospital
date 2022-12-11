<div class="row mt-5 d-none" id="addPatientForm">
    <div class="col-12 ">
        <div class="card w-100 mx-auto">
                    <p class="cursor-pointer  closebtn" id="closebtn"> <i class="mdi mdi-close-circle-outline text-danger "> </i></p>
                    <div class="row justify-content-center  d-flex mx-auto">
                        <h2 class="text-bold text-muted mt-2">Add Patient</h2>
                          </div>
                          <div class="row card-body justify-content-center">
      <form class="pt-3 justify-content-center items-center" method="POST" action="<?=$baseurl?>/form/action.php">
        <div class="form-row d-flex">
          <div class="form-group col-md-4 mx-2">
          <label for="phone">Phone:</label>
            <input type="text" minlength="11" maxlength="11" name="phone" required class="form-control" id="phone" placeholder="phone">
          </div>
          <div class="form-group col-md-4 mx-2">
            <label for="name">Name:</label>
            <input type="text" name="name" required class="form-control" id="name" placeholder="Name">
          </div>
          <div class="form-group col-md-4 mx-2">
            <label for="age">Nid:</label>
            <input type="text" name="nid"  class="form-control" id="nid" placeholder="Nid No">            
          </div>
          
        </div>
        <div class="form-row d-flex">
          <div class="form-group col-md-4 mx-2">
            <label for="father_or_husband_name">Father/Husband's Name:</label>
            <input type="text" name="father_or_husband_name" required class="form-control" id="father_or_husband_name" placeholder="Father/Husband's Name">
          </div>
          <div class="form-group col-md-4 mx-2">
            <label for="mother_name">Mother's Name:</label>
            <input type="text"  name="mother_name"  class="form-control" id="mother_name" placeholder="Mother's Name">
          </div>
          <div class="form-group col-md-4 mx-2">
            <label for="phone">Marital Status</label><br>
            <div class="justify-item-center mt-2">
              <input type="radio"  name="marital_status" class="form-check-input mx-1" id="married" value="MARRIED"> <label for="married" class="form-check-label mt-1">Married</label>
              <input type="radio" name="marital_status" class="form-check-input mx-1" value="UNMARRIED" id="Unmarried" >
              <label for="Unmarried" class="form-check-label mt-1">Unmarried</label>
              <input type="radio"  name="marital_status" value="OTHERS" class="form-check-input mx-1" id="Others" >
              <label for="Others" class="form-check-label mt-1">Others:</label>
            </div>
          </div>
        </div>

        <div class="form-row d-flex">
        <div class="form-group col-md-4 mx-2">
            <label for="gender">Gender:</label>
            <select id="gender"  name="gender" class="form-select">
              <option selected>Gender...</option>
              <option value="male">Male</option>
              <option value="female">female</option>
              <option value="other">Other</option>
            </select>
          </div>
          <div class="form-group col-md-3 mx-2">
            <label for="age">Age:</label>
            <input type="text" name="age"  class="form-control" id="age" placeholder="eg 35">            
          </div>
          <div class="form-group col-md-3 mx-2">
            <label for="address">Blood Group:</label>
            <select name="blood_group" id="" class="form-select">
              <option value="">Select Group</option>
              <option value="A+">A+(ve)</option>
              <option value="A-">A-(ve)</option>
              <option value="B+">B+(ve)</option>
              <option value="B-">B-(ve)</option>
              <option value="AB-">AB+(ve)</option>
              <option value="AB-">AB-(ve)</option>
              <option value="O+">O+(ve)</option>
              <option value="O-">O-(ve)</option>
            </select>
          </div>
        </div>
        <div class="form-row d-flex">
        <div class="form-group col-md-5 mx-2">
            <label for="present_address">Present Address:</label>
            <textarea  name="present_address" class="form-control" id="present_address" ></textarea>
          </div>
          <div class="form-group col-md-5 mx-2">
            <label for="address">Permanent Address:</label>
            <textarea  name="permanent_address" class="form-control" id="permanent_address" ></textarea>
          </div>
        </div>

        <div class="d-flex justify-content-center">
          <button type="submit" class="btn btn-primary"  name="addPatient">Add Patient</button>
        </div>
      </form>
      </div>
      </div>
  </div>
</div>
