<?php
@include("includes/top_header.php");
@include("includes/db.php");
@include("classes/Settings.class.php");
@include("auth.php");
// Handle form submission
if(isset($_POST['user'])){
$response = Settings::update_user($conn,$_POST);

    if($response){
        if(!empty($_POST['id'])){
            echo "<script>
            alert('User Updated Successfully');
            window.location.href='view_user.php';
            </script>";
            exit;
        } else {
            echo "<script>
            alert('User Added Successfully');
            window.location.href='view_user.php';
            </script>";
            exit;
        }
    } else {
        echo "<script>alert('Error');</script>";
    }
}
// ----------------------- DEFAULT VALUES -----------------------
$ID = NULL;
$schoolID = NULL;
$branchID = NULL;
$title = NULL;
$name = NULL;
$contact = NULL;
$address = NULL;
$email = NULL;
$password = NULL;
$typeID = NULL;
$ButtonValue = 'Submit';

// ----------------------- EDIT MODE -----------------------
if(isset($_GET['id'])){
    $ObjUser = Settings::get_users($conn, $_GET['id']);

    if($ObjUser){
        $ID        = $ObjUser[0]->id;
        $schoolID  = $ObjUser[0]->school_id;
        $branchID  = $ObjUser[0]->branch_id;
        $title     = $ObjUser[0]->title;
        $name      = $ObjUser[0]->name;
        $contact   = $ObjUser[0]->contact;
        $address   = $ObjUser[0]->address;
        $email     = $ObjUser[0]->email;
        $password  = $ObjUser[0]->password;
        $typeID    = $ObjUser[0]->type_id;
        $ButtonValue = 'Update';
    }
}

// ----------------------- DROPDOWNS -----------------------
$schools  = Settings::get_schools($conn);
$branches = Settings::get_branches($conn);
$types    = Settings::get_types($conn);
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
            <i class="lni lni-user me-2"></i> Users
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

          <!-- Type -->
          <div class="select-style-1">
            <label>Type</label>
            <div class="select-position">
              <select name="type_id" required>
                <option value="">Select Type</option>
                <?php foreach($types as $t){ ?>
                  <option value="<?php echo $t->id; ?>" <?php echo ($typeID==$t->id)?'selected':''; ?>>
                    <?php echo $t->name; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>

          <!-- Name -->
          <div class="input-style-3">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo $name; ?>" required />
          </div>

          <!-- Contact -->
          <div class="input-style-3">
            <label>Contact</label>
            <input type="text" name="contact" value="<?php echo $contact; ?>" />
          </div>

          <!-- Address -->
          <div class="input-style-3">
    <label>Address</label>
    <input type="text" name="address" value="<?php echo $address; ?>" />
</div>
          <!-- Email -->
          <div class="input-style-3">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>" required />
          </div>

          <?php if($ID == NULL){ ?>
          <!-- Password only for new user -->
          <div class="input-style-3">
            <label>Password</label>
            <input type="password" name="password" required />
          </div>
          <?php } ?>

          <!-- Submit -->
          <div class="button-group mt-3 text-center">
            <button type="submit" name="user" class="main-btn primary-btn btn-hover">
              <?php echo $ButtonValue; ?>
            </button>
          </div>

        </form>

      </div>
</div>

<?php @include("includes/footer.php"); ?>
</main>