<?php
@include("includes/db.php");
@include("includes/top_header.php");
@include("includes/header.php");
@include("includes/menu.php");
@include("classes/Settings.class.php");
@include("auth.php");

// Default values
$ID = NULL;
$classID = NULL;
$sectionID = NULL;

// Handle update
if(isset($_POST['update_class_section'])){

    $response = Settings::update_class_section($conn, $_POST);

    if($response){
        echo "<script>
        alert('Class Section Updated Successfully');
        window.location.href='view_class_section.php';
        </script>";
    } else {
        echo "<script>alert('Error');</script>";
    }
}

// Fetch existing record
if(isset($_GET['id'])){
    $ObjData = Settings::get_class_section($conn, $_GET['id']);

    if($ObjData){
        $ID        = $ObjData[0]->id;
        $classID   = $ObjData[0]->class_id;
        $sectionID = $ObjData[0]->section_id;
    }
}

// Dropdowns
$classes_result  = mysqli_query($conn, "SELECT id, name FROM classes");
$sections_result = mysqli_query($conn, "SELECT id, name FROM section");
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
            <i class="lni lni-graduation me-2"></i> Update Class Section
          </h4>
        </div>

        <hr style="margin-top:0;">

        <form method="POST">

          <?php if($ID != NULL){ ?>
            <input type="hidden" name="id" value="<?php echo $ID; ?>">
          <?php } ?>

          <!-- Class -->
          <div class="select-style-1">
            <label>Class</label>
            <div class="select-position">
              <select name="class_id" required>
                <option value="">Select Class</option>
                <?php while($class = mysqli_fetch_object($classes_result)){ ?>
                  <option value="<?php echo $class->id; ?>" 
                    <?php echo ($classID == $class->id) ? 'selected' : ''; ?>>
                    <?php echo $class->name; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>

          <!-- Section -->
          <div class="select-style-1">
            <label>Section</label>
            <div class="select-position">
              <select name="section_id" required>
                <option value="">Select Section</option>
                <?php while($section = mysqli_fetch_object($sections_result)){ ?>
                  <option value="<?php echo $section->id; ?>"
                    <?php echo ($sectionID == $section->id) ? 'selected' : ''; ?>>
                    <?php echo $section->name; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>

          <!-- Submit -->
          <div class="button-group mt-3 text-center">
            <button type="submit" name="update_class_section" class="main-btn primary-btn btn-hover">
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