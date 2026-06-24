<?php
@include("includes/top_header.php");
@include("includes/db.php");
@include("classes/Settings.class.php");
@include("auth.php");  
// ----------------------- HANDLE SUBMIT -----------------------
if(isset($_POST['student'])){

    $response = Settings::add_update_students($conn,$_POST);

    if($response){
        if(isset($_POST['id'])){
            echo "<script>
            alert('Student Updated Successfully');
            window.location.href='view_student.php';
            </script>";
        } else {
            echo "<script>alert('Student Added Successfully');</script>";
        }
    } else {
        echo "<script>alert('Error');</script>";
    }
}

// ----------------------- DEFAULT VALUES -----------------------
$ID = NULL;
$schoolID = NULL;
$branchID = NULL;
$classID = NULL;
$sectionID = NULL;
$name = NULL;
$email = NULL;
$contact = NULL;
$address = NULL;
$ButtonValue = 'Submit';

// ----------------------- EDIT MODE -----------------------
if(isset($_GET['id'])){
    $ObjStudents = Settings::get_students($conn,$_GET['id']);

    if($ObjStudents){
        $ID = $ObjStudents[0]->id;
        $schoolID = $ObjStudents[0]->school_id;
        $branchID = $ObjStudents[0]->branch_id;
        $classID = $ObjStudents[0]->class_id;
        $sectionID = $ObjStudents[0]->section_id;
        $name = $ObjStudents[0]->name;
        $email = $ObjStudents[0]->email;
        $contact = $ObjStudents[0]->contact;
        $address = $ObjStudents[0]->address;
        $ButtonValue = 'Update';
    }
}

// ----------------------- DROPDOWNS -----------------------
$ObjSchools  = Settings::get_schools($conn);
$ObjBranches = Settings::get_branches($conn);
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
    <div class="col-lg-8 col-md-10">

      <div class="card-style mb-30">

        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-25 p-3"
             style="background:#f5f7ff; border-radius:8px;">
          <h4 style="margin:0; font-weight:600;">
            <i class="lni lni-graduation me-2"></i> Add Student
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
              <select name="school_id" id="school_id" onchange="getBranch(this.value)" required>
                <option value="">Select School</option>
                <?php foreach($ObjSchools as $ObjSchool){ ?>
                  <option value="<?php echo $ObjSchool->id; ?>" <?php echo ($schoolID == $ObjSchool->id)?'selected':''; ?>>
                    <?php echo $ObjSchool->name; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>

          <!-- Branch -->
          <div class="select-style-1">
            <label>Branch</label>
            <div class="select-position">
              <select name="branch_id" id="branch_id" required>
                <option value="">Select Branch</option>
                <?php foreach($ObjBranches as $ObjBranch){ ?>
                  <option value="<?php echo $ObjBranch->id; ?>" <?php echo ($branchID == $ObjBranch->id)?'selected':''; ?>>
                    <?php echo $ObjBranch->name; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>

          <!-- Class -->
          <div class="select-style-1">
            <label>Class</label>
            <div class="select-position">
              <select name="class_id" id="class_id" onchange="getSection(this.value)" required>
                <option value="">Select Class</option>
                <?php foreach($ObjClasses as $ObjClass){ ?>
                  <option value="<?php echo $ObjClass->id; ?>" <?php echo ($classID == $ObjClass->id)?'selected':''; ?>>
                    <?php echo $ObjClass->name; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>

          <!-- Section -->
          <div class="select-style-1">
            <label>Section</label>
            <div class="select-position">
              <select name="section_id" id="section_id" required>
                <option value="">Select Section</option>
                <?php foreach($ObjSections as $ObjSection){ ?>
                  <option value="<?php echo $ObjSection->id; ?>" <?php echo ($sectionID == $ObjSection->id)?'selected':''; ?>>
                    <?php echo $ObjSection->name; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>

          <!-- Name -->
          <div class="input-style-2">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo $name; ?>" required />
          </div>

          <!-- Contact -->
          <div class="input-style-2">
            <label>Contact</label>
            <input type="text" name="contact" value="<?php echo $contact; ?>" required />
          </div>

          <!-- Address -->
          <div class="input-style-2">
            <label>Address</label>
            <textarea name="address" required><?php echo $address; ?></textarea>
          </div>

          <?php if(!isset($_GET['id'])){ ?>

          <!-- Email -->
          <div class="input-style-3">
            <label>Email</label>
            <input type="email" name="email" required />
          </div>

          <!-- Password -->
          <div class="input-style-3">
            <label>Password</label>
            <input type="password" name="password" required />
          </div>

          <?php } ?>

          <!-- Submit -->
          <div class="button-group mt-3 text-center">
            <button type="submit" name="student" class="main-btn primary-btn btn-hover">
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
</main>