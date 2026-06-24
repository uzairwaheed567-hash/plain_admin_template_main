<?php
@include("includes/top_header.php");
@include("includes/db.php");
@include("classes/Settings.class.php");
@include("auth.php");

// ----------------------- SUBMIT -----------------------
if(isset($_POST['submit_class_subject'])){

    $response = Settings::update_class_subject($conn, $_POST);

    if($response){
        echo "<script>
            alert('Class Subject Added Successfully');
            window.location.href = window.location.href;
        </script>";
        exit;
    } else {
        echo "<script>alert('Error');</script>";
    }
}

// ----------------------- DROPDOWNS -----------------------
$classes_result = Settings::get_classes($conn);
$subjects_result = Settings::get_subjects($conn);
$users_result    = Settings::get_users($conn);
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
            Add Class Subject
          </h4>
        </div>

        <hr style="margin-top:0;">

        <form method="POST">

          <!-- Class -->
          <div class="select-style-1">
            <label>Class</label>
            <div class="select-position">
              <select name="class_id" required>
                <option value="">Select Class</option>
                <?php foreach($classes_result as $class){ ?>
                    <option value="<?php echo $class->id; ?>">
                        <?php echo $class->name; ?>
                    </option>
                <?php } ?>
              </select>
            </div>
          </div>

          <!-- Subject -->
          <div class="select-style-1">
            <label>Subject</label>
            <div class="select-position">
              <select name="subject_id" required>
                <option value="">Select Subject</option>
                <?php foreach($subjects_result as $subject){ ?>
                    <option value="<?php echo $subject->id; ?>">
                        <?php echo $subject->name; ?>
                    </option>
                <?php } ?>
              </select>
            </div>
          </div>

          <!-- Added By -->
          <div class="select-style-1">
            <label>Added By</label>
            <div class="select-position">
              <select name="added_by" required>
                <option value="">Select User</option>
                <?php foreach($users_result as $user){ ?>
                    <option value="<?php echo $user->id; ?>">
                        <?php echo $user->name; ?>
                    </option>
                <?php } ?>
              </select>
            </div>
          </div>

          <!-- Submit -->
          <div class="button-group mt-3 text-center">
            <button type="submit" name="submit_class_subject" class="main-btn primary-btn btn-hover">
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