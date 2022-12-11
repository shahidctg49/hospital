<?php 
require_once('../lib/Crud.php'); 
require_once('../include/header.php');
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
<!-- ***************************************************************** -->
            <!-- page header start -->
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Patient 
             
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
                <!-- Step start -->
                        <div class="col-md-9 text-center p-0 mt-3 mb-2">
                            <div class="px-0 pt-4 pb-0 mt-3 mb-3">
                                <form id="form">
                                    <ul id="progressbar">
                                        <li class="active" id="step1">
                                            <strong>Step 1</strong>
                                        </li>
                                        <li id="step2"><strong>Step 2</strong></li>
                                        <li id="step3"><strong>Step 3</strong></li>
                                        <li id="step4"><strong>Step 4</strong></li>
                                    </ul>
                                    <div class="progress">
                                        <div class="progress-bar"></div>
                                    </div> <br>
                                    <fieldset>
                                        <h2>Welcome To GFG Step 1</h2>
                                        <input type="button" name="next-step"
                                            class="next-step" value="Next Step" />
                                    </fieldset>
                                    <fieldset>
                                        <h2>Welcome To GFG Step 2</h2>
                                      <!-- Test -->


                                        <input type="button" name="next-step"
                                            class="next-step" value="Next Step" />
                                        <input type="button" name="previous-step"
                                            class="previous-step"
                                            value="Previous Step" />
                                    </fieldset>
                                    <fieldset>
                                        <h2>Welcome To GFG Step 3</h2>
                                        <input type="button" name="next-step"
                                            class="next-step" value="Final Step" />
                                        <input type="button" name="previous-step"
                                            class="previous-step"
                                            value="Previous Step" />
                                    </fieldset>
                                    <fieldset>
                                        <div class="finish">
                                            <h2 class="text text-center">
                                                <strong>FINISHED</strong>
                                            </h2>
                                        </div>
                                        <input type="button" name="previous-step"
                                            class="previous-step"
                                            value="Previous Step" />
                                    </fieldset>
                                </form>
                            </div>
                        </div>

            </div>
            </div>
<!-- *** END THIS ADMIN*** -->
          </div>
      </div>
    </div>

          <!-- content-wrapper ends -->
          <!-- partial:include/footer.php -->
          <?php require_once('../include/footer.php') ?>
 