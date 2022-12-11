<?php 
require('../lib/Crud.php');
require_once('../include/header.php');
if((!$usr['roles']== 'SUPERADMIN') || (!$usr['roles']== 'ADMIN')){
  header("location:$baseurl/dashboard/");
}

$mysqli = new Crud();

if(!$usr){
  header("location:$baseurl/pages/login.php");
}


$mysqli = new Crud();

// SELECT s.name as Student, c.name as Course 
// FROM student s
//     INNER JOIN bridge b ON s.id = b.sid
//     INNER JOIN course c ON b.cid  = c.id 
// ORDER BY s.name

$data = $mysqli->custome_query("SELECT d.* , u.name as name, u.id as userId ,dep.name as dep_name,dep.id  as department_id FROM  doctor d JOIN user u on u.id=d.user_id JOIN  department dep on d.department_id = dep.id");

if($data['numrows'] > 0){
  $doctors =$data['selectdata'];
}

if($data['error']){
  $_SESSION['msg']=$data['msg'];
  echo "error";
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

            <!-- header contant -->
            <!-- <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Weekly Sales <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">$ 15,0000</h2>
                    <h6 class="card-text">Increased by 60%</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Weekly Orders <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">45,6334</h2>
                    <h6 class="card-text">Decreased by 10%</h6>
                  </div>
                </div>
              </div>
              
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Visitors Online <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">95,5741</h2>
                    <h6 class="card-text">Increased by 5%</h6>
                  </div>
                </div>
              </div>
            </div> -->
 <!-- header contant -->
            <!-- *** Doctors Tables *** -->
          <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <h4 class="card-title">All Doctor</h4>
                      <div class="search d-flex">
                          <i class="mdi mdi-person-star"></i>
                          <input type="text" class="form-control" placeholder="Search by name">
                        </div>
                        <a href="<?=$baseurl ?>/form/adddoctor.php" class="btn btn-secondary text-white font-weight-bold text-decoration-none">
                          Add New Doctor
                        </a>
                    </div>
                    <div class="table-responsive mt-3">
                      <table class="table table-success table-hover table-bordered table-striped">
                        <thead>
                          <tr>
                            <th> Id </th>
                            <th> Name</th>
                            <th> Gender </th>
                            <th> Shift </th>
                            <th> Department </th>
                            <th> Visit Fess </th>
                            <th> Creation </th>
                            <th> Modification</th>
                            <th> Status </th>
                            <th colspan="2"> Action </th>
                          </tr>
                        </thead>
                        <tbody>
                <?php 
                if($data['numrows'] > 0){
                  $doctors =$data['selectdata'];
                foreach ($doctors as $d){?>
                          <tr>
                            <td><?= $d['id']?></td>
                            <td>
                                <img src="../assets/images/faces/face3.jpg" class="me-2" alt="image">
                                <a class="btn" href="<?=$baseurl ?>/pages/profile.php?id=<?= $d['userId'] ?>">
                                  <?= $d['name']?>
                                </a> 
                            </td>
                            <td><?= $d['gender']?></td>
                            <td><?= $d['shift']?></td>
                            <td><?= $d['dep_name']?></td>
                            <td><?= $d['visit_fee']?>BDT</td>
                            <td>
                            <?php 
                              if($d['created_by'] && $_SESSION['userdata']['id'] ){
                                $creator = $mysqli->selector('user','name',$d['created_by']);
                                
                               echo $creator['selectdata'][0]['name'];
                                  
                              }                               
                              ?>
                              <br>
                              <?=$d['created_at']?>
                            </td>
                            <td>
                              <br>
                              <?= $d['modified_at']?>
                            </td>
                            <td>
                              <?php
                              if(!$d['status']== '0'){
                                echo "<label class='badge badge-gradient-info'>ACTIVE</label>";
                              }else{
                                echo "<label class='badge badge-gradient-danger'>DEACTIVED</label>";
                              }
                              
                              ?>
                            </td>
                            <td>
                              <a href="<?= $baseurl ?>/form/updatedoctor.php?doctorid=<?= $d['id'] ?>" class="btn-sm btn-primary text-decoration-none m-1">
                              <i class="mdi mdi-border-color"></i>
                            </a>
                              <a href="<?= $baseurl ?>/form/deleteuser.php?doctorid=<?= $d['id'] ?>" class="btn-sm btn-danger text-decoration-none" onclick="confirm('Are you sure?')">
                              <i class="mdi mdi-delete"></i>
                              </a>
                            </td>
                          </tr>
                          <?php }}else{ ?>
                           <tr>
                            <td colspan="10" class="text-center">No Data Found</td>
                           </tr>
                           <?php }?>
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
 