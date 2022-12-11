<?php 
require_once('../lib/Crud.php'); 

$mysqli = new Crud();

if(isset($_SESSION) && !($_SESSION['userdata']['roles']== 'SUPERADMIN') ){
    echo "<script> location.replace('$baseurl/dashboard/')</script>";
}

$user_Id = $_GET['id'];

$selectUser = $mysqli->select_single("SELECT * FROM user Where id=$user_Id");




require_once('../include/header.php'); 
?>

<div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">

      <div class="container-fluid">
    
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

        <div class="d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-12 mx-auto">

<!-- ADD Profile name -->

<div class="wrapper bg-white py-5">

<div class="row  mx-5">
    <div class="col-md-6">
        <h4 for="text-muted">Update Profiles</h4>
    </div>
    <div class="col-md-6 pt-md-0 pt-3 d-flex justify-content-end">
        <a class="btn btn-gradient-primar"  
        href="<?= $baseurl ?>/pages/profile.php?id=<?= $selectUser['singledata']['id']?>">Back to Profile</a>
    </div>
</div>

<!-- edit -->
<div class="d-flex align-items-start py-3 border-bottom justify-content-start">
<img src="../assets/images/faces/face1.jpg"
    class="img rounded-circle mx-5" alt="" width="100px">

    <div>
        <h4><?=$selectUser['singledata']['name'] ?></h4>
        <p class="text-muted"><?=$selectUser['singledata']['address']?></p>
        <button class="btn btn-sm btn-outline-dark" id="changeProfile">
            Change Profile Picture
        </button>
        <button class="btn btn-sm btn-outline-dark d-none" id="closeFileUp">
            Chancel
        </button>
        <div class="mt-4 d-none" id="fileUp">
        <form class="pl-sm-4 pl-2" method="POST" action="<?= $baseurl ?>/form/action.php" enctype="multipart/form-data" id="img-section">
            <input type="file" name="avatar" class="btn-sm button border">
            <button type="submit" name="images_upload" class="btn button border">
                Upload
            </button>
        </form>
        </div>
    </div>
<script>
let $changeProfile = $("#changeProfile");
let $closeFileUp = $("#closeFileUp");
let $fileUp = $("#fileUp");

$changeProfile.click(function(){
$closeFileUp.toggleClass('d-none');
$changeProfile.toggleClass('d-none');
$fileUp.toggleClass('d-none');
});
$closeFileUp.click(function(){
$closeFileUp.toggleClass('d-none');
$changeProfile.toggleClass('d-none');
$fileUp.toggleClass('d-none');
});



</script>


</div>
</div>


<!-- profile end -->

              <div class="auth-form-light text-left p-5">
              

<?php 
   if(isset($_SESSION['msg'])){
   echo $_SESSION['msg'];
  unset($_SESSION['msg']);
  }
  ?>




<form class=" justify-content-center items-center" method="POST" action="<?= $baseurl?>/form/action.php?id=<?=$user_Id?>">
  <div class="form-row d-flex">
    <input type="text" name="id" value="<?=$user_Id?>" hidden>
    <div class="form-group col-md-6 mx-2">
      <label for="name">Name</label>
      <input type="text" name="name" value="<?=$selectUser['singledata']['name'] ?>" class="form-control" id="name" placeholder="Name">
    </div>
    <div class="form-group col-md-6 mx-2">
      <label for="email">Email</label>
      <input type="email" name="email" value="<?=$selectUser['singledata']['email'] ?>" class="form-control" id="email" placeholder="email">
    </div>
  </div>

  <div class="form-row d-flex">
    <div class="form-group col-md-6 mx-2">
        <label for="phone">Father's Name:</label>
        <input type="text" name="father" value="<?=$selectUser['singledata']['father'] ?>" class="form-control" id="phone" placeholder="Phone">
      </div>
    <div class="form-group col-md-6 mx-2">
      <label for="inputAddress">Mother's Name:</label>
      <input type="text" name="mother" value="<?=$selectUser['singledata']['mother']?>" class="form-control" id="inputAddress" placeholder="1234 Main St">
    </div>
  </div>

  <div class="form-row d-flex">
    <div class="form-group col-md-6 mx-2">
        <label for="phone">Phone</label>
        <input type="text" name="phone" value="<?=$selectUser['singledata']['phone'] ?>" class="form-control" id="phone" placeholder="Phone">
      </div>
    <div class="form-group col-md-6 mx-2">
      <label for="inputAddress">Address</label>
      <input type="text" name="address" value="<?=$selectUser['singledata']['address']?>" class="form-control" id="inputAddress" placeholder="1234 Main St">
    </div>
  </div>
  <div class="form-row d-flex">
    <div class="form-group col-md-6 mx-2">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-4 mx-2">
      <label for="inputState">State</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>
    
  </div>
  <div class="form-group d-flex">
    <div class="form-group col-md-2 mx-2">
      <label for="inputZip">Zip</label>
      <input type="text" class="form-control" id="inputZip">
    </div>
  </div>
  <div class="d-flex justify-content-center">
    <button type="submit" class="btn btn-primary"  name="updateData">Update</button>
  </div>
</form>

<script>
  function mathedPassword(){

    let password = document.getElementById('password').value;
    let cpassword = document.getElementById('cpassword').value;
    if(password!== cpassword){
      document.getElementById('passErr').innerText="Password is not mathed";
    }
    
  }
</script>
</div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->


      </div>
      <!-- page-body-wrapper ends -->
    <?php require_once("../include/footer.php"); ?>