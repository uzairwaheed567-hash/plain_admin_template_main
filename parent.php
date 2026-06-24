<?php
@include("includes/top_header.php");
@include("includes/db.php");
@include("classes/Settings.class.php");
@include("auth.php");

// ----------------------- HANDLE SUBMIT -----------------------
if(isset($_POST['parent'])){
    $response = Settings::add_update_parent($conn,$_POST);

    if($response){
        if(isset($_POST['id'])){
            echo "<script>
            alert('Parent Updated Successfully');
            window.location.href='view_parent.php';
            </script>";
        } else {
            echo "<script>alert('Parent Added Successfully');</script>";
        }
    } else {
        echo "<script>alert('Error');</script>";
    }
}

// ----------------------- DEFAULT VALUES -----------------------
$ID = NULL;
$name = NULL;
$email = NULL;
$password = NULL;
$contact = NULL;
$ButtonValue = 'Submit';

// ----------------------- EDIT MODE -----------------------
if(isset($_GET['id'])){
    $ObjParents = Settings::get_parents($conn,$_GET['id']);    

    if($ObjParents){
        $ID = $ObjParents[0]->id;
        $name = $ObjParents[0]->name;
        $email = $ObjParents[0]->email;
        $password = $ObjParents[0]->password;
        $contact = $ObjParents[0]->contact;
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
            <i class="lni lni-user me-2"></i> Add Parent
          </h4>
        </div>

        <hr style="margin-top:0;">

        <form method="POST">

          <?php if($ID != NULL){ ?>
            <input type="hidden" name="id" value="<?php echo $ID; ?>">
          <?php } ?>

          <!-- Parent Name -->
          <div class="input-style-2">
            <label>Parent Name</label>
            <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Enter Parent Name" required />
            <span class="icon"><i class="lni lni-user"></i></span>
          </div>

          <!-- Contact -->
          <div class="input-style-2">
            <label>Contact</label>
            <input type="text" name="contact" value="<?php echo $contact; ?>" placeholder="Enter Contact" required />
            <span class="icon"><i class="lni lni-phone"></i></span>
          </div>

          <!-- Email + Password (only insert mode) -->
          <?php if(!isset($_GET['id'])){ ?>

          <div class="input-style-3">
            <label>Email</label>
            <input type="email" name="email" placeholder="Enter Email" required />
          </div>

          <div class="input-style-3">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter Password" required />
          </div>

          <?php } ?>

          <!-- Submit -->
          <div class="button-group mt-3 text-center">
            <button type="submit" name="parent" class="main-btn primary-btn btn-hover">
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