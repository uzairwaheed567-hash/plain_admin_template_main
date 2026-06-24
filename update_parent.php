<?php
@include("includes/db.php");
@include("includes/top_header.php");
@include("includes/header.php");
@include("includes/menu.php");
@include("classes/Settings.class.php");
@include("auth.php");
// Handle form submission
if(isset($_POST['parent'])){
    $response = Settings::add_update_parent_master($conn,$_POST);

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

$ID = NULL;
$studentID = NULL;
$name = NULL;
$email = NULL;
$contact = NULL;
$address = NULL;
$ButtonValue = 'Submit';

// If editing
if(isset($_GET['id'])){
    $ObjParents = Settings::get_parents($conn,$_GET['id']);    

    if($ObjParents){
        $ID        = $ObjParents[0]->id;
        $studentID = $ObjParents[0]->student_id;
        $name      = $ObjParents[0]->name;
        $email     = $ObjParents[0]->email;
        $contact   = $ObjParents[0]->contact;
        $address   = $ObjParents[0]->address;
        $ButtonValue = 'Update';
    }
}

// Fetch students
$students_result = mysqli_query($conn, "SELECT id, name FROM student");
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
            <i class="lni lni-user me-2"></i> Update Parent
          </h4>
        </div>

        <hr style="margin-top:0;">

        <form method="POST">
          <?php if($ID != NULL){ ?>
            <input type="hidden" name="id" value="<?php echo $ID; ?>">
          <?php } ?>

          <!-- Student -->
          <div class="select-style-1">
            <label>Student</label>
            <div class="select-position">
              <select name="student_id" required>
                <option value="">Select Student</option>
                <?php while($student = mysqli_fetch_object($students_result)){ ?>
                  <option value="<?php echo $student->id; ?>" <?php echo ($studentID == $student->id)?'selected':''; ?>>
                    <?php echo $student->name; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>

          <!-- Name -->
          <div class="input-style-2">
            <label>Parent Name</label>
            <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Enter Parent Name" required />
            <span class="icon"><i class="lni lni-user"></i></span>
          </div>

          <!-- Contact -->
          <div class="input-style-2">
            <label>Contact</label>
            <input type="text" name="contact" value="<?php echo $contact; ?>" placeholder="Enter Contact" />
            <span class="icon"><i class="lni lni-phone"></i></span>
          </div>

          <!-- Email -->
          <div class="input-style-3">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Enter Email" required />
          </div>

          <!-- Address -->
          <div class="input-style-2">
            <label>Address</label>
            <textarea name="address" placeholder="Enter Address"><?php echo $address; ?></textarea>
            <span class="icon"><i class="lni lni-map-marker"></i></span>
          </div>

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