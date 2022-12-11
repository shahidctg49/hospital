<?php

?>


   <form  action="form/actionnoneuser.php" method="POST"  class="php-email-form" data-aos="fade-up" data-aos-delay="100" id=apptform >
   <div class="row">
            <div class="col-md-4 form-group">
              <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
            </div>
          
            <div class="col-md-4 form-group mt-3 mt-md-0">
              <input type="text" class="form-control" name="phone" id="phone" placeholder="Your Phone" required min="10" max="11">
            </div>
            <div class="col-md-4 form-group mt-3 mt-md-0">
                 <input type="date" name="date" class="form-control datepicker" id="date" placeholder="Appointment Date" required>
            </div>

          </div>
          <!-- <div class="row">
            
            <div class="col-md-4 form-group mt-3">
              <select  id="department" class="form-select">
                <option value="">Select Department</option>
                <option value="Department 1">Department 1</option>
                <option value="Department 2">Department 2</option>
                <option value="Department 3">Department 3</option>
              </select>
            </div>
            <div class="col-md-4 form-group mt-3">
              <select id="doctor" class="form-select">
                <option value="">Select Doctor</option>
                <option value="Doctor 1">Doctor 1</option>
                <option value="Doctor 2">Doctor 2</option>
                <option value="Doctor 3">Doctor 3</option>
              </select>
            </div>
          </div> -->

          <div class="form-group mt-3">
            <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)"></textarea>
          </div>
          <div class="my-3">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your appointment request has been sent successfully. Thank you!</div>
          </div>
          <div class="text-center">
            <input type="submit" value="Make an Appointment" class="btn appointment-btn" name="appt" onclick="alert('function clicked');" />
          </div> 
  </form>
