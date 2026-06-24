<?php
@include("includes/db.php");
@include("includes/top_header.php");
@include("includes/header.php");
@include("includes/menu.php");
@include("classes/Settings.class.php");
@include("auth.php");
// Handle form submission
if(isset($_POST['school_user'])){
    $response = Settings::add_update_school_user($conn,$_POST);

    if($response){
        if(isset($_POST['id'])){
            echo "<script>
            alert('School User Updated Successfully');
            window.location.href='view_school_user.php';
            </script>";
        } else {
            echo "<script>alert('School User Added Successfully');</script>";
        }
    } else {
        echo "<script>alert('Error');</script>";
    }
}

$ID = NULL;
$schoolID = NULL;
$userID = NULL;
$ButtonValue = 'Submit';

// If editing
if(isset($_GET['id'])){
    $ObjSchoolUsers = Settings::get_school_users($conn,$_GET['id']);    

    if($ObjSchoolUsers){
        $ID       = $ObjSchoolUsers[0]->id;
        $schoolID = $ObjSchoolUsers[0]->school_id;
        $userID   = $ObjSchoolUsers[0]->user_id;
        $ButtonValue = 'Update';
    }
}

// Fetch dropdowns
$schools_result = mysqli_query($conn, "SELECT id, name FROM school");
$users_result   = mysqli_query($conn, "SELECT id, name FROM users");
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
            <i class="lni lni-building me-2"></i> Update School User
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

          <!-- User -->
          <div class="select-style-1">
            <label>User</label>
            <div class="select-position">
              <select name="user_id" required>
                <option value="">Select User</option>
                <?php while($user = mysqli_fetch_object($users_result)){ ?>
                  <option value="<?php echo $user->id; ?>" <?php echo ($userID == $user->id)?'selected':''; ?>>
                    <?php echo $user->name; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>

          <!-- Submit -->
          <div class="button-group mt-3 text-center">
            <button type="submit" name="school_user" class="main-btn primary-btn btn-hover">
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