<?php
@include("includes/db.php");
@include("includes/top_header.php");
@include("includes/header.php");
@include("includes/menu.php");
@include("classes/Settings.class.php");
@include("auth.php");
// Default values
$ID = NULL;
$name = NULL;
$ButtonValue = 'Submit';

// Handle update
if(isset($_POST['update_class'])){

    $response = Settings::update_class($conn, $_POST);

    if($response){
        echo "<script>
        alert('Class Updated Successfully');
        window.location.href='view_class.php';
        </script>";
    } else {
        echo "<script>alert('Error');</script>";
    }
}

// Fetch record
if(isset($_GET['id'])){
    $ObjData = Settings::get_class($conn, $_GET['id']);

    if($ObjData){
        $ID        = $ObjData[0]->id;
        $name      = $ObjData[0]->name;
        $ButtonValue = 'Update';
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
            <i class="lni lni-graduation me-2"></i> Update Class
          </h4>
        </div>

        <hr style="margin-top:0;">

        <form method="POST">

          <?php if($ID != NULL){ ?>
            <input type="hidden" name="id" value="<?php echo $ID; ?>">
          <?php } ?>

          <!-- Class Name -->
          <div class="input-style-2">
            <label>Class Name</label>
            <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Enter Class Name" required />
            <span class="icon"><i class="lni lni-graduation"></i></span>
          </div>

          <!-- Submit -->
          <div class="button-group mt-3 text-center">
            <button type="submit" name="update_class" class="main-btn primary-btn btn-hover">
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