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
$superadmin = $mysqli->counter("user","roles='SUPERADMIN'");
$admin = $mysqli->counter("user","roles='ADMIN'");
$doctor = $mysqli->counter("user","roles='DOCTOR'");
$employee = $mysqli->counter("user","roles='EMPLOYEE'");
// $admin = $mysqli->selector("user","COUNT(roles='ADMIN')");

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
            <!-- All User -->
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <h4 class="card-title">ALL USER</h4>
                      <div class="search d-flex">
                          <i class="mdi mdi-person-star"></i>
                          <input type="text" class="form-control" placeholder="Search by name">
                        </div>
                        <a href="<?=$baseurl ?>/form/adduser.php" class="btn btn-secondary text-white font-weight-bold text-decoration-none">
                          Add User
                        </a>
                    </div>
                    <div class="table-responsive mt-3">
                      <!-- ! *** TABLE FROM DATABASE *** -->
                      <table class="table table-hover table-bordered table-striped">
                        <thead class="table-dark">
                          <tr>
                            <th> Id </th>
                            <th> Name</th>
                            <th> Email </th>
                            <th> Phone </th>
                            <th> Creation || Modification</th>
                            <th> Roles </th>
                            <th> Status </th>
                            <th colspan="2"> Action </th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                        foreach ($user as $u){?>
                                                <tr>
                            <td><?= $u['id']?></td>
                            <td>
                                <img src="../assets/images/faces/face3.jpg" class="me-2" alt="image">
                                <a class="btn" href="<?=$baseurl ?>/pages/profile.php?id=<?= $u['id'] ?>">
                                  <?= $u['name']?>
                                </a> 
                            </td>
                            <td><?= $u['email']?></td>
                            <td><?= $u['phone']?></td>
                            <td>
                            <?php 
                              if($u['created_by'] && $_SESSION['userdata']['id'] ){
                                $creator = $mysqli->selector('user','name',$u['created_by']);
                                
                               echo $creator['selectdata'][0]['name'];
                                  
                              }                               
                              ?>
                              <br>
                              <?=$u['created_at']?>
                            <br>
                              <?php 
                              
                              $modifier = $mysqli->selector('user','name',$u['modified_by']);
                              if($u['modified_by'] && $_SESSION['userdata']['id'] ){
                                if($u['modified_by'] == $_SESSION['userdata']['id']){
                                  echo 'YOU';
                                }elseif($u['modified_by'] == $u['id']){
                                  echo 'OWN';
                                }else{
                                  echo $modifier['selectdata'][0]['name'];
                                }
                                
                                  
                              } 
                              ?>
                              <br>
                              <?= $u['modified_at']?>
                            </td>
                            <td><?= $u['roles']?></td>
                            <td>
                              <?php
                              if(!$u['status']== '0'){
                                echo "<label class='badge badge-gradient-info'>ACTIVE</label>";
                              }else{
                                echo "<label class='badge badge-gradient-danger'>DEACTIVED</label>";
                              }
                              
                              ?>
                            </td>
                            <td>
                              <a href="<?= $baseurl ?>/form/updateuser.php?id=<?= $u['id'] ?>" class="btn-sm btn-primary text-decoration-none m-1">
                              <i class="mdi mdi-border-color"></i>
                            </a>
                              <a href="<?= $baseurl ?>/form/deleteuser.php?id=<?= $u['id'] ?>" class="btn-sm btn-danger text-decoration-none" onclick="confirm('Are you sure?')">
                              <i class="mdi mdi-delete"></i>
                              <!-- <i class=" mdi mdi-chevron-down pointer" style="cursor:pointer" onclick="$('#extra').toggleClass('d-none');"></i> -->
                              </a>
                            </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- content-wrapper ends -->
          <!-- partial:include/footer.php -->
          <?php require_once('../include/footer.php') ?>
 