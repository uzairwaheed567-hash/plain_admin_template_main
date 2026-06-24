<?php
@include("includes/top_header.php");
@include("includes/db.php");
@include("classes/Settings.class.php");
@include("auth.php");
// ----------------------- HANDLE SUBMIT -----------------------
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $response = Settings::add_update_type($conn, $_POST);

    if($response){
        header("Location: view_type.php");
        exit;
    } else {
        echo mysqli_error($conn);
        exit;
    }
}

// ----------------------- DEFAULT VALUES -----------------------
$ID = NULL;
$name = NULL;
$ButtonValue = 'Submit';

// ----------------------- EDIT MODE -----------------------
if(isset($_GET['id'])){
    $ObjTypes = Settings::get_types($conn, $_GET['id']);

    if($ObjTypes){
        $ID = $ObjTypes[0]->id;
        $name = $ObjTypes[0]->name;
        $ButtonValue = 'Update';
    }
}
?>

<main class="main-wrapper">

<?php
include("includes/header.php");
include("includes/menu.php");
?>

<div class="form-elements-wrapper mt-5">
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">

      <div class="card-style mb-30">

        <!-- HEADER -->
        <div class="d-flex align-items-center justify-content-between mb-25 p-3"
             style="background:#f5f7ff; border-radius:8px;">
          <h4 style="margin:0; font-weight:600;">
            Add Type
          </h4>
        </div>

        <hr style="margin-top:0;">

        <form method="POST">

          <?php if($ID != NULL){ ?>
            <input type="hidden" name="id" value="<?php echo $ID; ?>">
          <?php } ?>

          <!-- TYPE NAME -->
          <div class="input-style-2">
            <label>Type Name</label>
            <input type="text" name="name"
                   value="<?php echo $name; ?>"
                   placeholder="Enter Type Name"
                   required />
            <span class="icon"><i class="lni lni-briefcase"></i></span>
          </div>

          <!-- SUBMIT -->
          <div class="button-group mt-3 text-center">
            <button type="submit" name="type"
                    class="main-btn primary-btn btn-hover">
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