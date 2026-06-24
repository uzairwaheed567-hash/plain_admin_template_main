<?php
    @include("includes/top_header.php");
    @include("includes/db.php");
    @include("classes/Settings.class.php");
@include("auth.php");
    // ----------------------- HANDLE SUBMIT -----------------------
    if(isset($_POST['student_parent'])){

    $response = Settings::update_student_parent($conn,$_POST);

    if($response){
        if(isset($_POST['id'])){
            echo "<script>
            alert('Student Parent Updated Successfully');
            window.location.href='view_student_parent.php';
            </script>";
        } else {
            echo "<script>alert('Student Added Successfully');</script>";
        }
    } else {
        echo "<script>alert('Error');</script>";
    }
}

        // ----------------------- DATA FROM SETTINGS -----------------------
        $ObjStudents = Settings::get_students($conn);
        $ObjParent  = Settings::get_parent($conn);
        $ObjUsers    = Settings::get_users($conn);
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
        Student Parent
        </h4>
        </div>

        <hr style="margin-top:0;">

        <form method="POST">

        <!-- Student -->
        <div class="select-style-1">
        <label>Student</label>
        <div class="select-position">
        <select name="student_id" required>
        <option value="">Select Student</option>

        <?php foreach($ObjStudents as $student){ ?>
        <option value="<?php echo $student->id; ?>">
        <?php echo $student->name; ?>
        </option>
        <?php } ?>

        </select>
        </div>
        </div>

        <!-- Parent -->
        <div class="select-style-1">
        <label>Parent</label>
        <div class="select-position">
        <select name="parent_id" required>
        <option value="">Select Parent</option>

        <?php foreach($ObjParents as $parent){ ?>
        <option value="<?php echo $parent->id; ?>">
        <?php echo $parent->name; ?>
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

        <?php foreach($ObjUsers as $user){ ?>
        <option value="<?php echo $user->id; ?>">
        <?php echo $user->name; ?>
        </option>
        <?php } ?>

        </select>
        </div>
        </div>

        <!-- Submit -->
        <div class="button-group mt-3 text-center">
        <button type="submit" name="student_parent" class="main-btn primary-btn btn-hover">
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