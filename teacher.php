  <?php
  @include("includes/db.php");
  @include("includes/top_header.php");
  @include("includes/header.php");
  @include("includes/menu.php");
  @include("classes/Settings.class.php");
@include("auth.php");
  // HANDLE FORM
if(isset($_POST['teacher'])){

    $response = Settings::add_update_teacher($conn,$_POST);

    if($response){
        if(!empty($_POST['id'])){
            echo "<script>
            alert('Teacher Updated Successfully');
            window.location.href='view_teacher.php';
            </script>";
            exit;
        } else {
            echo "<script>
            alert('Teacher Added Successfully');
            window.location.href='view_teacher.php';
            </script>";
            exit;
        }
    } else {
        echo "<script>alert('Error');</script>";
    }
}

  $ObjSchools = Settings::get_schools($conn);
  $ObjBranches = Settings::get_branches($conn);
  $ObjTypes = Settings::get_types($conn);


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

  $isBranchAdmin = isset($_SESSION['SchoolLoggedIn']->user_type) && $_SESSION['SchoolLoggedIn']->user_type === 'Branch Admin';
  $sessionSchoolID = $_SESSION['SchoolLoggedIn']->school_id ?? NULL;
  $sessionBranchID = $_SESSION['SchoolLoggedIn']->branch_id ?? NULL;

  if($isBranchAdmin){
      $schoolID = $sessionSchoolID;
      $branchID = $sessionBranchID;
  }

  // EDIT MODE
  if(isset($_GET['id'])){
      $ObjTeachers = Settings::get_teachers($conn,$_GET['id']);

      if($ObjTeachers){
          $ID = $ObjTeachers[0]->id;
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
  ?>

  <main class="main-wrapper">

  <div class="form-elements-wrapper mt-5">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8">

        <div class="card-style mb-30">

          <!-- HEADER -->
          <div class="d-flex align-items-center justify-content-between mb-25 p-3"
              style="background:#f5f7ff; border-radius:8px;">
            <h4 style="margin:0; font-weight:600;">
              Add Teacher
            </h4>
          </div>

          <hr style="margin-top:0;">

          <form method="POST">

            <?php if($ID != NULL){ ?>
              <input type="hidden" name="id" value="<?php echo $ID; ?>">
            <?php } ?>

            <!-- SCHOOL -->
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
                    <?php if($ObjSchools){ foreach($ObjSchools as $ObjSchool){ ?>
                      <option value="<?php echo $ObjSchool->id; ?>"
                        <?php echo ($schoolID == $ObjSchool->id)?'selected':''; ?>>
                        <?php echo $ObjSchool->name; ?>
                      </option>
                    <?php }} ?>
                  </select>
                <?php } ?>
              </div>
            </div>

            <!-- BRANCH -->
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
                    <?php if($ObjBranches){ foreach($ObjBranches as $ObjBranch){ ?>
                      <option value="<?php echo $ObjBranch->id; ?>"
                        <?php echo ($branchID == $ObjBranch->id)?'selected':''; ?>>
                        <?php echo $ObjBranch->name; ?>
                      </option>
                    <?php }} ?>
                  </select>
                <?php } ?>
              </div>
            </div>

            <!-- TYPE -->
            <div class="select-style-1">
              <label>Teacher Type</label>
              <div class="select-position">
                <select name="type_id" required>
                  <option value="">Select Type</option>
                  <?php if($ObjTypes){ foreach($ObjTypes as $ObjType){ ?>
                    <option value="<?php echo $ObjType->id; ?>"
                      <?php echo ($typeID == $ObjType->id)?'selected':''; ?>>
                      <?php echo $ObjType->name; ?>
                    </option>
                  <?php }} ?>
                </select>
              </div>
            </div>

            <!-- TITLE -->
            <div class="select-style-1">
              <label>Title</label>
              <div class="select-position">
                <select name="title" required>
                  <option value="">Select Title</option>
                  <option value="mr" <?= ($title=='mr')?'selected':'';?>>Mr</option>
                  <option value="mrs" <?= ($title=='mrs')?'selected':'';?>>Mrs</option>
                  <option value="miss" <?= ($title=='miss')?'selected':'';?>>Miss</option>
                </select>
              </div>
            </div>

            <!-- NAME -->
            <div class="input-style-2">
              <label>Name</label>
              <input type="text" name="name" value="<?php echo $name; ?>" required>
            </div>

            <!-- CONTACT -->
            <div class="input-style-2">
              <label>Contact</label>
              <input type="text" name="contact" value="<?php echo $contact; ?>" required>
            </div>

            <!-- ADDRESS -->
            <div class="input-style-2">
              <label>Address</label>
              <textarea name="address" required><?php echo $address; ?></textarea>
            </div>

            <?php if(!isset($_GET['id'])){ ?>

            <!-- EMAIL -->
            <div class="input-style-3">
              <label>Email</label>
              <input type="email" name="email" required>
            </div>

            <!-- PASSWORD -->
            <div class="input-style-3">
              <label>Password</label>
              <input type="password" name="password" required>
            </div>

            <?php } ?>

            <!-- SUBMIT -->
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