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
$typeID = NULL;
$title = NULL;
$name = NULL;
$email = NULL;
$password = NULL;
$contact = NULL;
$address = NULL;
$ButtonValue = 'Submit';

// Handle form submission
if(isset($_POST['teacher'])){
    $response = Settings::add_update_teacher($conn,$_POST);
    if($response){
        if(isset($_POST['id'])){
            echo "<script>
            alert('Teacher Updated Successfully');
            window.location.href='view_teacher.php';
            </script>";
        } else {
            echo "<script>alert('Teacher Added Successfully');</script>";
        }
    } else {
        echo "<script>alert('Error');</script>";
    }
}

// If editing an existing teacher
if(isset($_GET['id'])){
    $ObjTeachers = Settings::get_teachers($conn,$_GET['id']);    
    if($ObjTeachers){
        $ID       = $ObjTeachers[0]->id;
        $schoolID = $ObjTeachers[0]->school_id;
        $branchID = $ObjTeachers[0]->branch_id;
        $typeID   = $ObjTeachers[0]->type_id;        
        $title    = $ObjTeachers[0]->title;
        $name     = $ObjTeachers[0]->name;
        $email    = $ObjTeachers[0]->email;
        $password = $ObjTeachers[0]->password;
        $contact  = $ObjTeachers[0]->contact;
        $address  = $ObjTeachers[0]->address;
        $ButtonValue = 'Update';
    }
}

$schools_query = "SELECT id, name FROM school";
$ObjSchools = mysqli_fetch_all(mysqli_query($conn, $schools_query), MYSQLI_OBJ);

$branches_query = "SELECT id, name FROM branch";
$ObjBranches = mysqli_fetch_all(mysqli_query($conn, $branches_query), MYSQLI_OBJ);

$types_query = "SELECT id, name FROM company_type";
$ObjTypes = mysqli_fetch_all(mysqli_query($conn, $types_query), MYSQLI_OBJ);
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
            <i class="lni lni-users me-2"></i> Update Teacher
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
                <?php if($ObjSchools){ ?>
                  <?php foreach($ObjSchools as $ObjSchool){ ?>
                    <option value="<?php echo $ObjSchool->id; ?>" <?php echo ($schoolID == $ObjSchool->id)?'selected':''; ?>>
                      <?php echo $ObjSchool->name; ?>
                    </option>
                  <?php } ?>
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
                <?php if($ObjBranches){ ?>
                  <?php foreach($ObjBranches as $ObjBranch){ ?>
                    <option value="<?php echo $ObjBranch->id; ?>" <?php echo ($branchID == $ObjBranch->id)?'selected':''; ?>>
                      <?php echo $ObjBranch->name; ?>
                    </option>
                  <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>

          <!-- Type Dropdown -->
          <div class="select-style-1">
            <label>Teacher Type</label>
            <div class="select-position">
              <select name="type_id" required>
                <option value="">Select Type</option>
                <?php if($ObjTypes){ ?>
                  <?php foreach($ObjTypes as $ObjType){ ?>
                    <option value="<?php echo $ObjType->id; ?>" <?php echo ($typeID == $ObjType->id)?'selected':''; ?>>
                      <?php echo $ObjType->name; ?>
                    </option>
                  <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>

          <!-- Title Dropdown -->
          <div class="select-style-1">
            <label>Title</label>
            <div class="select-position">
              <select name="title" required>
                <option value="">Select Title</option>
                <option value="mr" <?= ($title=='mr')?'selected':'';?> >Mr</option>
                <option value="mrs" <?= ($title=='mrs')?'selected':'';?> >Mrs</option>
                <option value="miss" <?= ($title=='miss')?'selected':'';?> >Miss</option>
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
            <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Enter Email" />
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
            <button type="submit" name="teacher" class="main-btn primary-btn btn-hover">
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
