<?php
@include ("includes/top_header.php");
@include ("includes/db.php");
@include("classes/Settings.class.php");
@include("auth.php");


if(isset($_POST['branch'])){
    $response = Settings::add_update_branch($conn,$_POST);
    if($response){
        if(isset($_POST['id'])){
            echo "<script>
            alert('Branch Updated Successfully');
            window.location.href='view_branch.php';
            </script>";
        } else {
            echo "<script>alert('Branch Added Successfully');</script>";
        }
    } else {
        echo "<script>alert('Error');</script>";
    }
}
$ID  =  NULL;
$schoolID = NULL;
$name = NULL;
$contact = NULL;
$address = NULL;
$ButtonValue = 'Submit';


if(isset($_GET['id'])){
    $ObjBranches = Settings::get_branches($conn,$_GET['id']);    
    if($ObjBranches){
        $ID = $ObjBranches[0]->id;
        $schoolID = $ObjBranches[0]->school_id;
        $name = $ObjBranches[0]->name;
        $contact = $ObjBranches[0]->contact;
        $address = $ObjBranches[0]->address;
        $ButtonValue = 'Update';
    }
}


$ObjSchools = Settings::get_schools($conn);
?>
<main class="main-wrapper">
<?php  
@include ("includes/header.php");
@include ("includes/menu.php");
?>

<div class="form-elements-wrapper mt-5">
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">

      <div class="card-style mb-30">
        <div class="d-flex align-items-center justify-content-between mb-25 p-3" 
             style="background:#f5f7ff; border-radius:8px;">
          <h4 style="margin:0; font-weight:600;">
            <i class="lni lni-map-marker me-2"></i> Add Branch
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

          <!-- Branch Name -->
          <div class="input-style-2">
            <label>Branch Name</label>
            <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Enter Branch Name" required />
            <span class="icon"><i class="lni lni-map-marker"></i></span>
          </div>

          <!-- Contact -->
          <div class="input-style-2">
            <label>Contact</label>
            <input type="text" name="contact" value="<?php echo $contact; ?>" placeholder="Enter Contact" required />
            <span class="icon"><i class="lni lni-phone"></i></span>
          </div>

          <!-- Address -->
          <div class="input-style-2">
            <label>Address</label>
            <textarea name="address" placeholder="Enter Address" required><?php echo $address; ?></textarea>
            <span class="icon"><i class="lni lni-map-marker"></i></span>
          </div>

          <!-- Submit Button -->
          <div class="button-group mt-3 text-center">
            <button type="submit" name="branch" class="main-btn primary-btn btn-hover"><?php echo $ButtonValue; ?></button>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>

<?php @include("includes/footer.php"); ?>
</main>