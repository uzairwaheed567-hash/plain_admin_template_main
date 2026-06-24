<?php
@include("includes/top_header.php");
@include("includes/db.php");
@include("classes/Settings.class.php");
@include("auth.php");
// ----------------------- HANDLE SUBMIT -----------------------
if(isset($_POST['staff'])){

    $response = Settings::add_update_staff($conn,$_POST);

    if($response){
        if(isset($_POST['id'])){
            echo "<script>
            alert('Staff Updated Successfully');
            window.location.href='view_staff.php';
            </script>";
        } else {
            echo "<script>alert('Staff Added Successfully');</script>";
        }
    } else {
        echo "<script>alert('Error');</script>";
    }
}

// ----------------------- DEFAULT VALUES -----------------------
$ID = NULL;
$schoolID = NULL;
$branchID = NULL;
$typeID = NULL;
$title = NULL;
$name = NULL;
$email = NULL;
$contact = NULL;
$address = NULL;
$ButtonValue = 'Submit';

$isBranchAdmin = isset($_SESSION['SchoolLoggedIn']->user_type) && $_SESSION['SchoolLoggedIn']->user_type === 'Branch Admin';
$sessionSchoolID = $_SESSION['SchoolLoggedIn']->school_id ?? NULL;
$sessionBranchID = $_SESSION['SchoolLoggedIn']->branch_id ?? NULL;

if($isBranchAdmin){
    $schoolID = $sessionSchoolID;
    $branchID = $sessionBranchID;
}

// ----------------------- EDIT MODE -----------------------
if(isset($_GET['id'])){
    $ObjStaff = Settings::get_staff($conn,$_GET['id']);    

    if($ObjStaff){
        $ID = $ObjStaff[0]->id;
        $schoolID = $ObjStaff[0]->school_id;
        $branchID = $ObjStaff[0]->branch_id;
        $typeID = $ObjStaff[0]->type_id;
        $title = $ObjStaff[0]->title;
        $name = $ObjStaff[0]->name;
        $email = $ObjStaff[0]->email;
        $contact = $ObjStaff[0]->contact;
        $address = $ObjStaff[0]->address;
        $ButtonValue = 'Update';
    }
}

// -------- DROPDOWNS ------
$ObjSchools  = Settings::get_schools($conn);
$ObjBranches = Settings::get_branches($conn);
$ObjTypes    = Settings::get_types($conn);
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
            <i class="lni lni-user me-2"></i> Add Staff
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
              <?php if($isBranchAdmin){ ?>
                <select disabled>
                  <?php foreach($ObjSchools as $ObjSchool){ ?>
                    <?php if($schoolID == $ObjSchool->id){ ?>
                      <option selected><?php echo $ObjSchool->name; ?></option>
                    <?php } ?>
                  <?php } ?>
                </select>
                <input type="hidden" name="school_id" value="<?php echo $schoolID; ?>" />
              <?php } else { ?>
                <select name="school_id" required>
                  <option value="">Select School</option>
                  <?php foreach($ObjSchools as $ObjSchool){ ?>
                    <option value="<?php echo $ObjSchool->id; ?>" <?php echo ($schoolID == $ObjSchool->id)?'selected':''; ?>>
                      <?php echo $ObjSchool->name; ?>
                    </option>
                  <?php } ?>
                </select>
              <?php } ?>
            </div>
          </div>

          <!-- Branch -->
          <div class="select-style-1">
            <label>Branch</label>
            <div class="select-position">
              <?php if($isBranchAdmin){ ?>
                <select disabled>
                  <?php foreach($ObjBranches as $ObjBranch){ ?>
                    <?php if($branchID == $ObjBranch->id){ ?>
                      <option selected><?php echo $ObjBranch->name; ?></option>
                    <?php } ?>
                  <?php } ?>
                </select>
                <input type="hidden" name="branch_id" value="<?php echo $branchID; ?>" />
              <?php } else { ?>
                <select name="branch_id" required>
                  <option value="">Select Branch</option>
                  <?php foreach($ObjBranches as $ObjBranch){ ?>
                    <option value="<?php echo $ObjBranch->id; ?>" <?php echo ($branchID == $ObjBranch->id)?'selected':''; ?>>
                      <?php echo $ObjBranch->name; ?>
                    </option>
                  <?php } ?>
                </select>
              <?php } ?>
            </div>
          </div>

          <!-- Type -->
          <div class="select-style-1">
            <label>Staff Type</label>
            <div class="select-position">
              <select name="type_id" required>
                <option value="">Select Type</option>
                <?php foreach($ObjTypes as $ObjType){ ?>
                  <option value="<?php echo $ObjType->id; ?>" <?php echo ($typeID == $ObjType->id)?'selected':''; ?>>
                    <?php echo $ObjType->name; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>

           <!-- Title -->
          <div class="select-style-1">
            <label>Title</label>
            <div class="select-position">
              <select name="title">
                <option value="">Select Title</option>
                <option value="Mr" <?php echo ($title=='Mr')?'selected':''; ?>>Mr</option>
                <option value="Mrs" <?php echo ($title=='Mrs')?'selected':''; ?>>Mrs</option>
                <option value="Miss" <?php echo ($title=='Miss')?'selected':''; ?>>Miss</option>
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
            <button type="submit" name="staff" class="main-btn primary-btn btn-hover">
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