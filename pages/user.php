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
                        <thead>
                          <tr>
                            <th> Id </th>
                            <th> Name</th>
                            <th> Email </th>
                            <th> Phone </th>
                            <th> Created By </th>
                            <th> Modified By </th>
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
                            </td>
                            <td>
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
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Recent Updates</h4>
                    <div class="d-flex">
                      <div class="d-flex align-items-center me-4 text-muted font-weight-light">
                        <i class="mdi mdi-account-outline icon-sm me-2"></i>
                        <span>jack Menqu</span>
                      </div>
                      <div class="d-flex align-items-center text-muted font-weight-light">
                        <i class="mdi mdi-clock icon-sm me-2"></i>
                        <span>October 3rd, 2018</span>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-6 pe-1">
                        <img src="../assets/images/dashboard/img_1.jpg" class="mb-2 mw-100 w-100 rounded" alt="image">
                        <img src="../assets/images/dashboard/img_4.jpg" class="mw-100 w-100 rounded" alt="image">
                      </div>
                      <div class="col-6 ps-1">
                        <img src="../assets/images/dashboard/img_2.jpg" class="mb-2 mw-100 w-100 rounded" alt="image">
                        <img src="../assets/images/dashboard/img_3.jpg" class="mw-100 w-100 rounded" alt="image">
                      </div>
                    </div>
                    <div class="d-flex mt-5 align-items-top">
                      <img src="../assets/images/faces/face3.jpg" class="img-sm rounded-circle me-3" alt="image">
                      <div class="mb-0 flex-grow">
                        <h5 class="me-2 mb-2">School Website - Authentication Module.</h5>
                        <p class="mb-0 font-weight-light">It is a long established fact that a reader will be distracted by the readable content of a page.</p>
                      </div>
                      <div class="ms-auto">
                        <i class="mdi mdi-heart-outline text-muted"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Project Status</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th> Name </th>
                            <th> Due Date </th>
                            <th> Progress </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> 1 </td>
                            <td> Herman Beck </td>
                            <td> May 15, 2015 </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td> 2 </td>
                            <td> Messsy Adam </td>
                            <td> Jul 01, 2015 </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td> 3 </td>
                            <td> John Richards </td>
                            <td> Apr 12, 2015 </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td> 4 </td>
                            <td> Peter Meggik </td>
                            <td> May 15, 2015 </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td> 5 </td>
                            <td> Edward </td>
                            <td> May 03, 2015 </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td> 5 </td>
                            <td> Ronald </td>
                            <td> Jun 05, 2015 </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-info" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-white">Todo</h4>
                    <div class="add-items d-flex">
                      <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?">
                      <button class="add btn btn-gradient-primary font-weight-bold todo-list-add-btn" id="add-task">Add</button>
                    </div>
                    <div class="list-wrapper">
                      <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                        <li>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox"> Meeting with Alisa </label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li class="completed">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox" checked> Call John </label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox"> Create invoice </label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox"> Print Statements </label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li class="completed">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox" checked> Prepare for presentation </label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox"> Pick up kids from school </label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:include/footer.php -->
          <?php require_once('../include/footer.php') ?>
 