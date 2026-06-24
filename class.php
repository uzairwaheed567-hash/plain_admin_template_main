<?php
@include("includes/top_header.php");
@include("includes/db.php");
@include("classes/Settings.class.php");
@include("auth.php");
// ----------------------- HANDLE SUBMIT -----------------------
    if(isset($_POST['class'])){

    $response = Settings::update_classes($conn,$_POST);

    if($response){
        if(isset($_POST['id'])){
            echo "<script>
            alert('Class Updated Successfully');
            window.location.href='view_class.php';
            </script>";
        } else {
            echo "<script>alert('Class Added Successfully');</script>";
        }
    } else {
        echo "<script>alert('Error');</script>";
    }
}
    
// ----------------------- DEFAULT VALUES -----------------------
$ID = NULL;
$schoolID = NULL;
$branchID = NULL;
$name = NULL;
$added_by = NULL;
$ButtonValue = 'Submit';

// ----------------------- EDIT MODE -----------------------
if(isset($_GET['id'])){
    $ObjClasses = Settings::get_classes($conn,$_GET['id']);    

    if($ObjClasses){
        $ID        = $ObjClasses[0]->id;
        $schoolID  = $ObjClasses[0]->school_id;
        $branchID  = $ObjClasses[0]->branch_id;
        $name      = $ObjClasses[0]->name;
        $added_by  = $ObjClasses[0]->added_by;
        $ButtonValue = 'Update';
    }
}
// ----------------------- DROPDOWNS -----------------------
$schools  = Settings::get_schools($conn);
$branches = Settings::get_branches($conn);
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
            <i class="lni lni-graduation me-2"></i> Add Class
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
                <?php if($schools){ foreach($schools as $s){ ?>
                  <option value="<?php echo $s->id; ?>" <?php echo ($schoolID==$s->id)?'selected':''; ?>>
                    <?php echo $s->name; ?>
                  </option>
                <?php }} ?>
              </select>
            </div>
          </div>

          <!-- Branch -->
          <div class="select-style-1">
            <label>Branch</label>
            <div class="select-position">
              <select name="branch_id" required>
                <option value="">Select Branch</option>
                <?php foreach($branches as $b){ ?>
                  <option value="<?php echo $b->id; ?>" <?php echo ($branchID==$b->id)?'selected':''; ?>>
                    <?php echo $b->name; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>


          <!-- Class Name -->
          <div class="input-style-2">
            <label>Class Name</label>
            <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Enter Class Name" required />
            <span class="icon"><i class="lni lni-graduation"></i></span>
          </div>

           <!-- Added_BY -->
          <div class="input-style-2">
            <label>Added By</label>
           <input type="text" name="added_by" value="<?php echo $added_by; ?>" placeholder="Enter Added Name" required />
            <span class="icon"><i class="lni lni-graduation"></i></span>
          </div>


          <!-- Submit -->
          <div class="button-group mt-3 text-center">
            <button type="submit" name="class" class="main-btn primary-btn btn-hover">
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