<?php
@include("includes/top_header.php");
@include("includes/db.php");
@include("classes/Settings.class.php");
@include("auth.php");
// HANDLE SUBMIT
if(isset($_POST['teacher_class_section'])){

    $response = Settings::update_teacher_class_section($conn, $_POST);

    if($response){
        echo "<script>alert('Teacher Class Section Added Successfully');</script>";
    } else {
        echo "<script>alert('Error');</script>";
    }
}

// DROPDOWNS 
$ObjTeachers_result = Settings::get_teachers($conn);
$ObjClasses  = Settings::get_classes($conn);
$ObjSections = Settings::get_sections($conn);
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
            Teacher Class Section
          </h4>
        </div>

        <hr style="margin-top:0;">

        <form method="POST">

          <!-- Teacher -->
          <div class="select-style-1">
            <label>Teacher</label>
            <div class="select-position">
              <select name="teacher_id" required>
                <option value="">Select Teacher</option>
                <?php if($ObjTeachers){ foreach($ObjTeachers as $t){ ?>
                  <option value="<?php echo $t->id; ?>">
                    <?php echo $t->name; ?>
                  </option>
                <?php }} ?>
              </select>
            </div>
          </div>

          <!-- Class -->
          <div class="select-style-1">
            <label>Class</label>
            <div class="select-position">
              <select name="class_id" required>
                <option value="">Select Class</option>
                <?php if($ObjClasses){ foreach($ObjClasses as $c){ ?>
                  <option value="<?php echo $c->id; ?>">
                    <?php echo $c->name; ?>
                  </option>
                <?php }} ?>
              </select>
            </div>
          </div>

          <!-- Section -->
          <div class="select-style-1">
            <label>Section</label>
            <div class="select-position">
              <select name="section_id" required>
                <option value="">Select Section</option>
                <?php if($ObjSections){ foreach($ObjSections as $s){ ?>
                  <option value="<?php echo $s->id; ?>">
                    <?php echo $s->name; ?>
                  </option>
                <?php }} ?>
              </select>
            </div>
          </div>

          <!-- Submit -->
          <div class="button-group mt-3 text-center">
            <button type="submit" name="teacher_class_section"
                    class="main-btn primary-btn btn-hover">
              Submit
            </button>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>

<?php @include("includes/footer.php"); ?>
</main>