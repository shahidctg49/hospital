<?php 
  require_once('../lib/Crud.php'); 
  require_once('../include/header.php'); 

  $mysqli = new Crud();

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
    <?php require_once('../include/sidebar.php'); ?>
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <?php
          $mysqli = new Crud();
          $data = $mysqli->selector('user','*');
          $patient = $mysqli->counter("user","roles='PETANT'");
          $doctor = $mysqli->counter("user","roles='DOCTOR'");
          $employee = $mysqli->counter("user","roles='EMPLOYEE'");
          // $SUPERADMIN = $mysqli->selector("user","COUNT(roles='SUPERADMIN')");

          $user = $data['selectdata'];
          if($data['error']){
            $_SESSION['msg']=$data['msg'];
            echo "error";
          }
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

        <div class="row justify-content-center">
          <!-- Session Department -->
          <?php 
            if(isset($_SESSION['msg'])){
              echo  $_SESSION['msg'];
              unset ($_SESSION['msg']);
            }
          ?>
        <!-- Room form -->

        <div class="col-md-12 grid-margin stretch-card" id="roomform">
            <div class="row card">            
              <div class="card-body">
                <h2 class="text-center ">Room Status</h2>
                <form class="pt-3 justify-content-center items-center row d-none" id="addroom" method="POST" action="<?=$baseurl?>/form/action.php">
                <div class="col-8">
                  <div class="form-row d-flex">
                    <div class="form-group col-md-6 mx-2">
                      <label for="floor">Floor: </label>
                      <input type="text" name="floor" required class="form-control" id="floor" placeholder="Floor Name">
                    </div>
                    <div class="form-group col-md-6 mx-2">
                      <label for="room_no">Room No: </label>
                      <input type="text" minlength="3" maxlength="11" name="room_no" required class="form-control" id="room_no" placeholder="Room No">
                    </div>
                  </div>
                  <div class="form-row d-flex">
                    <div class="form-group col-md-6 mx-2">
                        <label for="gender">Room Type:</label>
                        <select id="gender"  name="room_type" class="form-select">
                          <option selected>Room Type...</option>
                          <option value="CHAMBER">CHAMBER</option>
                          <option value="GENERAL-CABIN">GENERAL-CABIN</option>
                          <option value="NON-AC-CABIN">NON-AC-CABIN</option>
                          <option value="AC-CABIN">AC-CABIN</option>
                          <option value="VIP-CABIN">VIP-CABIN</option>
                          <option value="WAITING-ROOM">WAITING-ROOM</option>
                          <option value="ICU">ICU</option>
                          <option value="CCU">CCU</option>
                          <option value="OT">OT</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6 mx-2">
                        <label for="details">Capacity: </label>
                        <input type="number" name="capacity" class="form-control" id="capacity" placeholder="capacity">
                      </div>
                    </div>
                    <div class="form-row d-flex">
                    <div class="form-group col-md-6 mx-2">
                      <label for="floor">Rate: </label>
                      <input type="number" name="rate" required class="form-control" id="rate" placeholder="Rate Per day">
                    </div>
                  </div>
                  </div>
                  <div class="col-3 form-group offset-1">
                      <label for="details">Facilities: </label>
                    <div class="">
                      <div class="form-check">
                        <input class="form-check-input" name="facilities[]" type="checkbox" value="Tv" id="tv">
                        <label class="form-check-label" for="tv">
                        TV
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" name="facilities[]" type="checkbox" value="AC" id="ac">
                        <label class="form-check-label" for="ac">
                        AC
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" name="facilities[]" type="checkbox" value="Refrigerator" id="Refrigerator">
                        <label class="form-check-label" for="Refrigerator">
                        Refrigerator
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" name="facilities[]" type="checkbox" value="OVEN" id="OVEN">
                        <label class="form-check-label" for="OVEN">
                        Oven
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" name="facilities[]" type="checkbox" value="Locker" id="Locker">
                        <label class="form-check-label" for="Locker">
                        locker
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" name="facilities[]" type="checkbox" value="Wifi" id="Wifi">
                        <label class="form-check-label" for="Wifi">
                        Wifi
                        </label>
                      </div>
                      </div>
                    </div>
                    
                  <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary" name="add_room">Add Room</button>
                  </div>
                </form>
                <!-- button -->
                <button class="float-end btn btn-sm btn-info" id="add" onclick="$(this).toggleClass('d-none');$('#addroom').toggleClass('d-none');$('#close').toggleClass('d-none');">Add</button>
                      <button class="float-end btn btn-sm btn-danger d-none" id="close"  onclick="$(this).toggleClass('d-none');$('#addroom').toggleClass('d-none');$('#add').toggleClass('d-none');">Cancel</button>
              </div>
              <div class="table-responsive mt-3">
                      <!-- ! *** TABLE FROM DATABASE *** -->
                      <table class="table table-hover table-bordered table-striped">
                  <thead>
                    <tr>
                      <th> ID </th>
                      <th> Floor Name: </th>
                      <th> Room Number</th>
                      <th> Rate (day)</th>
                      <th> Details </th>
                      <th> Room Type </th>
                      <th> Capacity </th>
                      <!-- <th> Created At </th> -->
                      <th colspan="2"> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      
                      $room_data=$mysqli->selector('room');
                      $rm=$room_data['selectdata'];
                        if($room_data['numrows'] > 0){
                      foreach ($rm as $room){
                        if($room['status']== 1){

                        
                    ?>
                    <tr>
                      <td><?= $room['id'] ?></td>
                      <td><?= $room['floor']?></td>
                      <td><?= $room['room_no']?></td>
                      <td><?= $room['rate']?>tk</td>
                      <td><?php
                          $details = json_decode($room['details']); $fc=false;
                          if($details){ foreach($details as $d){
                            $fc .=  "$d + ";
                          }
                            echo rtrim($fc,"+ ");
                          }
                      ?></td>
                      <td><?= $room['room_type']?></td>
                      <td><?= $room['capacity']?></td>
                      <!-- <td>
                          
                      </td> -->
                      <td>
                        <a href="<?= $baseurl ?>/form/editcategories.php?roomId=<?= $room['id'] ?>" class="btn-sm btn-primary text-decoration-none m-1">
                          <i class="mdi mdi-border-color"></i>
                        </a>
                        <a href="<?= $baseurl ?>/form/deleteuser.php?id=<?= $room['id'] ?>" class="btn-sm btn-danger text-decoration-none" onclick="confirm('Are you sure?')">
                          <i class="mdi mdi-delete"></i>
                        </a>
                      </td>
                    </tr>
                    <?php }}} ?>
                  </tbody>
                </table>
            </div>
            </div>
          </div>
          <!-- room end -->

        </div>
      </div>
    </div>
  </div>
</div>
          
<script>
    $(document).ready(function () {    

});
</script>
<!-- content-wrapper ends -->
<!-- partial:include/footer.php -->
<?php require_once('../include/footer.php'); ?>