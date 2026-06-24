<?php
@include("includes/db.php");
@include("includes/top_header.php");
@include("includes/header.php");
@include("includes/menu.php");
@include("classes/Settings.class.php");
@include("auth.php");
// Handle form submission
if(isset($_POST['section'])){
    $response = Settings::add_update_section($conn,$_POST);

    if($response){
        if(isset($_POST['id'])){
            echo "<script>
            alert('Section Updated Successfully');
            window.location.href='view_section.php';
            </script>";
        } else {
            echo "<script>alert('Section Added Successfully');</script>";
        }
    } else {
        echo "<script>alert('Error');</script>";
    }
}

$ID = NULL;
$schoolID = NULL;
$branchID = NULL;
$name = NULL;
$ButtonValue = 'Submit';

// If editing
if(isset($_GET['id'])){
    $ObjSections = Settings::get_sections($conn,$_GET['id']);

    if($ObjSections){
        $ID       = $ObjSections[0]->id;
        $schoolID = $ObjSections[0]->school_id;
        $branchID = $ObjSections[0]->branch_id;
        $name     = $ObjSections[0]->name;
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
            <i class="lni lni-graduation me-2"></i> Update Section
          </h4>
        </div>

        <hr style="margin-top:0;">

        <form method="POST">
          <?php if($ID != NULL){ ?>
            <input type="hidden" name="id" value="<?php echo $ID; ?>">
          <?php } ?>

          <!-- School -->
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

          <!-- Branch -->
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

          <!-- Name -->
          <div class="input-style-2">
            <label>Section Name</label>
            <input type="text" name="name" value="<?php echo $name; ?>" required />
            <span class="icon"><i class="lni lni-graduation"></i></span>
          </div>

          <!-- Submit -->
          <div class="button-group mt-3 text-center">
            <button type="submit" name="section" class="main-btn primary-btn btn-hover">
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