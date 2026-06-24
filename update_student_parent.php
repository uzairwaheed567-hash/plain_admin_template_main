<?php
@include("includes/db.php");
@include("includes/top_header.php");
@include("includes/header.php");
@include("includes/menu.php");
@include("classes/Settings.class.php");

// Handle form
if(isset($_POST['student_parent'])){
    $response = Settings::add_update_student_parent($conn,$_POST);

    if($response){
        if(isset($_POST['id'])){
            echo "<script>
            alert('Student Parent Updated Successfully');
            window.location.href='view_student_parent.php';
            </script>";
        } else {
            echo "<script>
            alert('Student Parent Added Successfully');
            window.location.href='view_student_parent.php';
            </script>";
        }
    } else {
        echo "<script>alert('Error Occurred');</script>";
    }
}

// Default values
$ID = NULL;
$studentID = NULL;
$parentID = NULL;
$ButtonValue = "Submit";

// Edit mode
if(isset($_GET['id'])){
    $Obj = Settings::get_student_parent($conn,$_GET['id']);

    if($Obj){
        $ID        = $Obj[0]->id;
        $studentID = $Obj[0]->student_id;
        $parentID  = $Obj[0]->parent_id;
        $ButtonValue = "Update";
    }
}

// dropdowns
$students = mysqli_query($conn,"SELECT id,name FROM student");
$parents  = mysqli_query($conn,"SELECT id,name FROM parent");
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
Student Parent
</h4>
</div>

<hr>

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
<?php while($s = mysqli_fetch_object($students)){ ?>
<option value="<?php echo $s->id; ?>" <?= ($studentID==$s->id)?'selected':'' ?>>
<?php echo $s->name; ?>
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
<?php while($p = mysqli_fetch_object($parents)){ ?>
<option value="<?php echo $p->id; ?>" <?= ($parentID==$p->id)?'selected':'' ?>>
<?php echo $p->name; ?>
</option>
<?php } ?>
</select>
</div>
</div>

<!-- Button -->
<div class="button-group mt-3 text-center">
<button type="submit" name="student_parent" class="main-btn primary-btn btn-hover">
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