<?php
@include("includes/db.php");
@include("includes/top_header.php");
@include("classes/Settings.class.php");

// Default values
$ID = NULL;
$teacherID = NULL;
$classID = NULL;
$sectionID = NULL;
$ButtonValue = 'Submit';

// Handle form submission
if(isset($_POST['update_teacher_class_section'])){

    $response = Settings::update_teacher_class_section($conn, $_POST);

    if($response){
        echo "<script>
        alert('Teacher Class Section Updated Successfully');
        window.location.href='view_teacher_class_section.php';
        </script>";
    } else {
        echo "<script>alert('Error');</script>";
    }
}

// If editing existing record
if(isset($_GET['id'])){
    $ObjData = Settings::get_teacher_class_section($conn, $_GET['id']);

    if($ObjData){
        $ID        = $ObjData[0]->id;
        $teacherID = $ObjData[0]->teacher_id;
        $classID   = $ObjData[0]->class_id;
        $sectionID = $ObjData[0]->section_id;
        $ButtonValue = 'Update';
    }
}

// Dropdowns
$teachers_result = mysqli_query($conn, "SELECT id, name FROM teacher");
$classes_result  = mysqli_query($conn, "SELECT id, name FROM classes");
$sections_result = mysqli_query($conn, "SELECT id, name FROM section");
?>

<main class="main-wrapper">

<?php @include("includes/header.php"); ?>
<?php @include("includes/menu.php"); ?>

<div class="form-elements-wrapper mt-5">
<div class="row justify-content-center">
<div class="col-lg-6 col-md-8">

<div class="card-style mb-30">

<!-- Header -->
<div class="d-flex align-items-center justify-content-between mb-25 p-3"
     style="background:#f5f7ff; border-radius:8px;">
  <h4 style="margin:0; font-weight:600;">
    <i class="lni lni-graduation me-2"></i> Update Teacher Class Section
  </h4>
</div>

<hr style="margin-top:0;">

<form method="POST">

<?php if($ID != NULL){ ?>
  <input type="hidden" name="id" value="<?php echo $ID; ?>">
<?php } ?>

<!-- Teacher -->
<div class="select-style-1">
  <label>Teacher</label>
  <div class="select-position">
    <select name="teacher_id" required>
      <option value="">Select Teacher</option>
      <?php while($t = mysqli_fetch_object($teachers_result)){ ?>
        <option value="<?php echo $t->id; ?>" <?php echo ($teacherID == $t->id)?'selected':''; ?>>
          <?php echo $t->name; ?>
        </option>
      <?php } ?>
    </select>
  </div>
</div>

<!-- Class -->
<div class="select-style-1">
  <label>Class</label>
  <div class="select-position">
    <select name="class_id" required>
      <option value="">Select Class</option>
      <?php while($c = mysqli_fetch_object($classes_result)){ ?>
        <option value="<?php echo $c->id; ?>" <?php echo ($classID == $c->id)?'selected':''; ?>>
          <?php echo $c->name; ?>
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
      <?php while($s = mysqli_fetch_object($sections_result)){ ?>
        <option value="<?php echo $s->id; ?>" <?php echo ($sectionID == $s->id)?'selected':''; ?>>
          <?php echo $s->name; ?>
        </option>
      <?php } ?>
    </select>
  </div>
</div>

<!-- Submit -->
<div class="button-group mt-3 text-center">
  <button type="submit" name="update_teacher_class_section" class="main-btn primary-btn btn-hover">
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