<?php
@include("includes/db.php");
@include("includes/top_header.php");
@include("includes/header.php");
@include("includes/menu.php");
@include("classes/Settings.class.php");

// Default values
$ID = NULL;
$schoolID = NULL;
$branchID = NULL;
$subject_name = NULL;
$ButtonValue = 'Submit';

// Handle form submission
if(isset($_POST['update_subject'])){

    $response = Settings::add_update_subject($conn, $_POST);

    if($response){
        echo "<script>
        alert('Subject Updated Successfully');
        window.location.href='view_subject.php';
        </script>";
    } else {
        echo "<script>alert('Error');</script>";
    }
}

// If editing an existing subject
if(isset($_GET['id'])){
    $ObjData = Settings::get_subjects($conn, $_GET['id']);

    if($ObjData){
        $ID            = $ObjData[0]->id;
        $schoolID      = $ObjData[0]->school_id;
        $branchID      = $ObjData[0]->branch_id;
        $subject_name  = $ObjData[0]->name;
        $ButtonValue = 'Update';
    }
}

// Dropdowns
$schools_result  = mysqli_query($conn, "SELECT id, name FROM school");
$branches_result = mysqli_query($conn, "SELECT id, name FROM branch");
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
            <i class="lni lni-graduation me-2"></i> Update Subject
          </h4>
        </div>

        <hr style="margin-top:0;">

        <form method="POST">
          <?php if($ID != NULL){ ?>
            <input type="hidden" name="id" value="<?php echo $ID; ?>">
          <?php } ?>

          <!-- School Dropdown -->
          <div class="select-style-1">
            <label>School</label>
            <div class="select-position">
              <select name="school_id" required>
                <option value="">Select School</option>
                <?php while($school = mysqli_fetch_object($schools_result)){ ?>
                  <option value="<?php echo $school->id; ?>" <?php echo ($schoolID == $school->id)?'selected':''; ?>>
                    <?php echo $school->name; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>

          <!-- Branch Dropdown -->
          <div class="select-style-1">
            <label>Branch</label>
            <div class="select-position">
              <select name="branch_id" required>
                <option value="">Select Branch</option>
                <?php while($branch = mysqli_fetch_object($branches_result)){ ?>
                  <option value="<?php echo $branch->id; ?>" <?php echo ($branchID == $branch->id)?'selected':''; ?>>
                    <?php echo $branch->name; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>

          <!-- Subject Name -->
          <div class="input-style-3">
            <label>Subject Name</label>
            <input type="text" name="subject_name" value="<?php echo $subject_name; ?>" placeholder="Enter Subject Name" required />
          </div>

          <!-- Submit Button -->
          <div class="button-group mt-3 text-center">
            <button type="submit" name="update_subject" class="main-btn primary-btn btn-hover">
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
