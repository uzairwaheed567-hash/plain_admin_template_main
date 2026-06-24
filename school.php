  <?php
@include("includes/top_header.php");
@include("includes/db.php");
@include("classes/Settings.class.php");
@include("auth.php");
// ----------------------- HANDLE SUBMIT -----------------------
if(isset($_POST['school'])){

    $response = Settings::add_update_school($conn,$_POST);

    if($response){
        if(isset($_POST['id'])){
            echo "<script>
            alert('School Updated Successfully');
            window.location.href='view_school.php';
            </script>";
        } else {
            echo "<script>alert('School Added Successfully');</script>";
        }
    } else {
        echo "<script>alert('Error');</script>";
    }
}

// ----------------------- DEFAULT VALUES -----------------------
$ID = NULL;
$name = NULL;
$address = NULL;
$contact = NULL;
$logo = NULL;
$ButtonValue = 'Submit';

// ----------------------- EDIT MODE -----------------------
if(isset($_GET['id'])){
    $ObjSchools = Settings::get_schools($conn,$_GET['id']);    

    if($ObjSchools){
        $ID = $ObjSchools[0]->id;
        $name = $ObjSchools[0]->name;
        $address = $ObjSchools[0]->address;
        $contact = $ObjSchools[0]->contact;
        $logo = $ObjSchools[0]->logo;
        $ButtonValue = 'Update';
    }
}
?>

<main class="main-wrapper">

<?php
@include("includes/header.php");
@include("includes/menu.php");
?>

<div class="form-elements-wrapper mt-5">
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">

      <div class="card-style mb-30">

        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-25 p-3" 
             style="background:#f5f7ff; border-radius:8px;">

          <h4 style="margin:0; font-weight:600;">
            <i class="lni lni-users me-2"></i> School
          </h4>

        </div>

        <hr style="margin-top:0;">

        <form method="POST">

          <?php if($ID != NULL){ ?>
            <input type="hidden" name="id" value="<?php echo $ID; ?>">
          <?php } ?>

          <!-- Name -->
          <div class="input-style-2">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Enter Name" required />
            <span class="icon"><i class="lni lni-user"></i></span>
          </div>

          <!-- Address -->
          <div class="input-style-2">
            <label>Address</label>
            <input type="text" name="address" value="<?php echo $address; ?>" placeholder="Enter Address" required />
            <span class="icon"><i class="lni lni-map-marker"></i></span>
          </div>

          <!-- Contact -->
          <div class="input-style-2">
            <label>Contact</label>
            <input type="text" name="contact" value="<?php echo $contact; ?>" placeholder="Enter Contact" />
            <span class="icon"><i class="lni lni-phone"></i></span>
          </div>
          <!-- Submit -->
          <div class="button-group mt-3 text-center">
            <button type="submit" name="school" class="main-btn primary-btn btn-hover">
              <?php echo $ButtonValue; ?>
            </button>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>

<?php @include("includes/footer.php"); ?>
</main>