<?php
@include("includes/db.php");
@include("includes/top_header.php");
@include("includes/header.php");
@include("includes/menu.php");
@include("Settings.class.php");

// Default values
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

// Handle form submission
if(isset($_POST['update_student'])){

    $response = Settings::add_update_student($conn, $_POST);

    if($response){
        echo "<script>
        alert('Student Updated Successfully');
        window.location.href='view_student.php';
        </script>";
    } else {
        echo "<script>alert('Error');</script>";
    }
}

// If editing an existing student
if(isset($_GET['id'])){
    $ObjData = Settings::add_students($conn, $_GET['id']);

    if($ObjData){
        $ID         = $ObjData[0]->id;
        $schoolID   = $ObjData[0]->school_id;
        $branchID   = $ObjData[0]->branch_id;
        $classID    = $ObjData[0]->class_id;
        $sectionID  = $ObjData[0]->section_id;
        $name       = $ObjData[0]->name;
        $email      = $ObjData[0]->email;
        $contact    = $ObjData[0]->contact;
        $address    = $ObjData[0]->address;
        $ButtonValue = 'Update';
    }
}

$schools_result  = mysqli_query($conn, "SELECT id, name FROM school");
$branches_result = mysqli_query($conn, "SELECT id, name FROM branch");
$classes_result  = mysqli_query($conn, "SELECT id, name FROM classes");
$sections_result = mysqli_query($conn, "SELECT id, name FROM sections");
?>

<main class="main-wrapper">
<div class="form-elements-wrapper mt-5">
  <div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">

      <div class="card-style mb-30">
        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-25 p-3"
             style="background:#f5f7ff; border-radius:8px;">
          <h4 style="margin:0; font-weight:600;">
            <i class="lni lni-graduation me-2"></i> Update Student
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

          <!-- Class Dropdown -->
          <div class="select-style-1">
            <label>Class</label>
            <div class="select-position">
              <select name="class_id" required>
                <option value="">Select Class</option>
                <?php while($class = mysqli_fetch_object($classes_result)){ ?>
                  <option value="<?php echo $class->id; ?>" <?php echo ($classID == $class->id)?'selected':''; ?>>
                    <?php echo $class->name; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>

          <!-- Section Dropdown -->
          <div class="select-style-1">
            <label>Section</label>
            <div class="select-position">
              <select name="section_id" required>
                <option value="">Select Section</option>
                <?php while($section = mysqli_fetch_object($sections_result)){ ?>
                  <option value="<?php echo $section->id; ?>" <?php echo ($sectionID == $section->id)?'selected':''; ?>>
                    <?php echo $section->name; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>

          <!-- Name -->
          <div class="input-style-2">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Enter Name" required />
            <span class="icon"><i class="lni lni-user"></i></span>
          </div>

          <!-- Email -->
          <div class="input-style-3">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Enter Email" required />
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
            <button type="submit" name="update_student" class="main-btn primary-btn btn-hover">
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
