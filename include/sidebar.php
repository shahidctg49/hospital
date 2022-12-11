<?php

if($usr['roles'] === 'SUPERADMIN'){?>
<!-- !***@@MIN *** -->

<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="<?= $baseurl ?>/pages/profile.php?id=<?=$usr['id'] ?>" class="nav-link">
                <div class="nav-profile-image">
                <?php if($usr['avatar']!== null){ ?>
                <img src="../assets/images/avatar/<?= $usr['avatar'] ?>" alt="" width="100px"/>
                <?php }else{  ?>
                  <img src="../assets/images/faces-clipart/pic-4.png" alt="" width="100px"/>
                    <?php } ?>
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">
                    <?= $usr['name'];?>
                  </span>
                  <span class="text-secondary text-small">
                    <?= $usr['roles'];?>
                </span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>



            <li class="nav-item">
              <a class="nav-link" href="<?= $baseurl?>/dashboard/">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
  <!-- dashboard  -->
        <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">User</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-medical-bag menu-icon"></i>
              </a>
              <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">
                  <!-- <li class="nav-item"> 
                    <a class="nav-link" href="<?= $baseurl?>/dashboard/"> Overview                      
                    </a>
                  </li> -->
                  <li class="nav-item"> 
                    <a class="nav-link" href="<?= $baseurl?>/dashboard/user.php">
                    Users                      
                    </a>
                  </li>
                  <li class="nav-item"> 
                    <a class="nav-link" href="<?= $baseurl?>/dashboard/doctor.php">
                       Doctors
                    </a></li>
                  <!-- <li class="nav-item">
                    <a class="nav-link" href="<?= $baseurl?>/dashboard/emp.php"> 
                      Employees
                    </a>
                  </li> -->
                  <!-- <li class="nav-item">
                    <a class="nav-link" href="<?= $baseurl?>/dashboard/patient.php"> 
                      Patients
                    </a></li> -->
                </ul>
              </div>
            </li>
            <!-- user -->
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#user" aria-expanded="false" aria-controls="user">
                <span class="menu-title">Profile</span>
                <i class="menu-arrow"></i>
                <i class=" mdi mdi-account-circle menu-icon"></i>
              </a>
              <div class="collapse" id="user">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?=$baseurl?>/pages/profile.php?id=<?=$usr['id'] ?>"> Profile </a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?=$baseurl?>/form/updateuser.php?id"> Update Profile </a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?=$baseurl?>/pages/changepassword.php"> Change Password </a></li>
                </ul>
              </div>
            </li>
            <!-- Patien -->
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#patient" aria-expanded="false" aria-controls="patient">
                <span class="menu-title">Patient</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-medical-bag menu-icon"></i>
              </a>
              <div class="collapse" id="patient">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?=$baseurl ?>/pages/patient.php">Add Patient</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?=$baseurl ?>/pages/allpatient.php">Patient List</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?=$baseurl ?>/pages/admitedpatient.php">Admited Patient</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?=$baseurl ?>/pages/appointmented.php">Appointment List</a></li>
                </ul>
              </div>
            </li>
            <!-- Nurse -->
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#nurse" aria-expanded="false" aria-controls="nurse">
                <span class="menu-title">Nurse</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-medical-bag menu-icon"></i>
              </a>
              <div class="collapse" id="nurse">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?=$baseurl ?>/pages/patientcare.php">Patient Care</a></li>
                </ul>
              </div>
            </li>
            <!-- Report -->
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#report" aria-expanded="false" aria-controls="nurse">
                <span class="menu-title">Report</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-medical-bag menu-icon"></i>
              </a>
              <div class="collapse" id="report">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?=$baseurl ?>/form/addreport.php">Add Report</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?=$baseurl ?>/pages/testrequestlist.php">Test List</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?=$baseurl ?>/pages/reportlist.php">Report List</a></li>
                </ul>
              </div>
            </li>
            <!-- Categories -->
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic2">
                <span class="menu-title">Controller</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic2">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?= $baseurl ?>/controller/department.php">Department</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?= $baseurl ?>/controller/designation.php">Designation</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?= $baseurl ?>/controller/room.php">Cavin/Chamber</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?= $baseurl ?>/controller/rate.php">Rate</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?= $baseurl ?>/controller/service.php">Service</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?= $baseurl ?>/controller/test.php">Test</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?= $baseurl ?>/controller/medicinestore.php">Medicine Store</a></li>
                </ul>
              </div>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="pages/forms/basic_elements.html">
                <span class="menu-title">Forms</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
            </li> -->
            <!-- <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#general-pages1" aria-expanded="false" aria-controls="general-pages1">
                <span class="menu-title">Sample Pages</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-medical-bag menu-icon"></i>
              </a>
              <div class="collapse" id="general-pages1">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
                </ul>
              </div>
            </li> -->
    </ul>
</nav>

<!-- *** @@MIN *** -->
<?php }elseif($usr['roles'] === 'ADMIN'){ ?>
<!-- ! ***@MIN  *** -->

<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="<?= $baseurl ?>/pages/profile.php?id=<?=$usr['id'] ?>" class="nav-link">
                <div class="nav-profile-image">
                  <img src="../assets/images/faces/face1.jpg" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">
                    <?= $usr['name'];?>
                  </span>
                  <span class="text-secondary text-small">
                    <?= $usr['roles'];?>
                </span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= $baseurl?>/dashboard/">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <!-- users -->
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Users</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-circle menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?=$baseurl ?>/pages/user.php">All User</a></li>
                  <li class="nav-item">
                     <a class="nav-link" href="<?= $baseurl?>/dashboard/doctor.php">
                      Doctor
                    </a>
                    </li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Employye</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Patient</a></li>
                </ul>
              </div>
            </li>
            <!-- Patien -->
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Patients</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-circle menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic1">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?=$baseurl ?>/pages/patient.php">Patient</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Employee</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Patient</a></li>
                </ul>
              </div>
            </li>
            <!-- Categories -->
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Categories</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic2">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?=$baseurl ?>/pages/user.php">Department</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Designation</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Doctor</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Employye</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Patient</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/icons/mdi.html">
                <span class="menu-title">Icons</span>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/forms/basic_elements.html">
                <span class="menu-title">Forms</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/charts/chartjs.html">
                <span class="menu-title">Charts</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/tables/basic-table.html">
                <span class="menu-title">Tables</span>
                <i class="mdi mdi-table-large menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Sample Pages</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-medical-bag menu-icon"></i>
              </a>
              <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item sidebar-actions">
              <span class="nav-link">
                <div class="border-bottom">
                  <h6 class="font-weight-normal mb-3">Projects</h6>
                </div>
                <button class="btn btn-block btn-lg btn-gradient-primary mt-4">+ Add a project</button>
                <div class="mt-4">
                  <div class="border-bottom">
                    <p class="text-secondary">Categories</p>
                  </div>
                  <ul class="gradient-bullet-list mt-4">
                    <li>Free</li>
                    <li>Pro</li>
                  </ul>
            </div>
          </span>
        </li>
    </ul>
</nav>

<!-- *** @MIN *** -->

<?php }elseif($usr['roles'] === 'DOCTOR'){ ?>
<!-- *** DOCTOR *** -->

<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="<?= $baseurl ?>/pages/profile.php?id=<?=$usr['id'] ?>" class="nav-link">
                <div class="nav-profile-image">
                  <img src="../assets/images/faces/face1.jpg" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">
                    <?= $usr['name'];?>
                  </span>
                  <span class="text-secondary text-small">
                    <?= $usr['roles'];?>
                </span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= $baseurl?>/dashboard/">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <!-- users -->
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Users</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-circle menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?=$baseurl ?>/pages/user.php">All User</a></li>
                  <li class="nav-item">
                     <a class="nav-link" href="<?= $baseurl?>/dashboard/doctor.php">
                      Doctor
                    </a>
                    </li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Employye</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Patient</a></li>
                </ul>
              </div>
            </li>
            <!-- Patien -->
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Patients</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-circle menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic1">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?=$baseurl ?>/pages/patient.php">Patient</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Employee</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Patient</a></li>
                </ul>
              </div>
            </li>
            <!-- Categories -->
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Categories</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic2">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?=$baseurl ?>/pages/user.php">Department</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Designation</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Doctor</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Employye</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Patient</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/icons/mdi.html">
                <span class="menu-title">Icons</span>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/forms/basic_elements.html">
                <span class="menu-title">Forms</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/charts/chartjs.html">
                <span class="menu-title">Charts</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/tables/basic-table.html">
                <span class="menu-title">Tables</span>
                <i class="mdi mdi-table-large menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Sample Pages</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-medical-bag menu-icon"></i>
              </a>
              <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item sidebar-actions">
              <span class="nav-link">
                <div class="border-bottom">
                  <h6 class="font-weight-normal mb-3">Projects</h6>
                </div>
                <button class="btn btn-block btn-lg btn-gradient-primary mt-4">+ Add a project</button>
                <div class="mt-4">
                  <div class="border-bottom">
                    <p class="text-secondary">Categories</p>
                  </div>
                  <ul class="gradient-bullet-list mt-4">
                    <li>Free</li>
                    <li>Pro</li>
                  </ul>
            </div>
          </span>
        </li>
    </ul>
</nav>

<!-- ***@DOCTOR END*** -->
<?php }elseif($usr['roles'] === 'EMPLOYEE'){ ?>
<!-- *** EMPLOYEE *** -->



<!-- *** @EMPLOYEE *** -->



<?php } ?>
