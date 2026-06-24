<?php
@include("includes/db.php");
@include("includes/top_header.php");
@include("includes/header.php");
@include("includes/menu.php");
@include("classes/Settings.class.php");
@include("auth.php");
// Default values
$ID = NULL;
$school = NULL;
$name = NULL;
$contact = NULL;
$address = NULL;
$ButtonValue = 'Update';

// Handle form submission
if(isset($_POST['update_branch'])){
    
    $response = Settings::add_update_branch($conn, $_POST);

    if($response){
        echo "<script>
        alert('Branch Updated Successfully');
        window.location.href='view_branch.php';
        </script>";
    } else {
        echo "<script>alert('Error');</script>";
    }
}

// Fetch data for edit
if(isset($_GET['id'])){
    $ObjBranch = Settings::get_branches($conn, $_GET['id']);

    if($ObjBranch){
        $ID       = $ObjBranch[0]->id;
        $School = $ObjBranch[0]->school_id;
        $name     = $ObjBranch[0]->name;
        $contact  = $ObjBranch[0]->contact;
        $address  = $ObjBranch[0]->address;
    }
}
?>

<main class="main-wrapper">

<div class="form-elements-wrapper mt-5">
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">

      <div class="card-style mb-30">

        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-25 p-3"
             style="background:#f5f7ff; border-radius:8px;">
          <h4 style="margin:0; font-weight:600;">
            <i class="lni lni-briefcase me-2"></i> Update Branch
          </h4>
        </div>

        <hr style="margin-top:0;">

        <form method="POST">

          <?php if($ID != NULL){ ?>
            <input type="hidden" name="id" value="<?php echo $ID; ?>">
          <?php } ?>

          <!-- School -->
          <div class="input-style-3">
            <label>School</label>
            <input type="text" name="school" value="<?php echo $school; ?>" placeholder="Enter School" required />
          </div>

          <!-- Branch Name -->
          <div class="input-style-3">
            <label>Branch Name</label>
            <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Enter Branch Name" required />
          </div>

          <!-- Contact -->
          <div class="input-style-3">
            <label>Contact</label>
            <input type="text" name="contact" value="<?php echo $contact; ?>" placeholder="Enter Contact" />
          </div>

          <!-- Address -->
          <div class="input-style-3">
            <label>Address</label>
            <textarea name="address" placeholder="Enter Address"><?php echo $address; ?></textarea>
          </div>

          <!-- Submit Button -->
          <div class="button-group mt-3 text-center">
            <button type="submit" name="update_branch" class="main-btn primary-btn btn-hover">
              Update
            </button>
          </div>

        </form>

      </div>

    </div>
  </div>
</div>

<?php @include("includes/footer.php"); ?>
</main>