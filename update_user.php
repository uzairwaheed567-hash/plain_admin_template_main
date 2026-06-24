<?php
@include("includes/db.php");
@include("includes/top_header.php");
@include("includes/header.php");
@include("includes/menu.php");
@include("classes/Settings.class.php");

// ---------------- DEFAULT VALUES ----------------
$ID = NULL;
$school_id = NULL;
$branch_id = NULL;
$title = NULL;
$name = NULL;
$contact = NULL;
$email = NULL;
$type_id = NULL;

$ButtonValue = "Update";

// ---------------- UPDATE USER ----------------
if(isset($_POST['update_user'])){

    $response = Settings::update_user($conn, $_POST);

    if($response){

        echo "<script>
        alert('User Updated Successfully');
        window.location.href='view_user.php';
        </script>";
        exit;

    } else {

        echo "<script>alert('Error');</script>";
    }
}

// ---------------- GET USER DATA ----------------
if(isset($_GET['id'])){

    $ObjData = Settings::get_user($conn, $_GET['id']);

    if($ObjData){

        $ID         = $ObjData[0]->id;
        $school_id  = $ObjData[0]->school_id;
        $branch_id  = $ObjData[0]->branch_id;
        $title      = $ObjData[0]->title;
        $name       = $ObjData[0]->name;
        $contact    = $ObjData[0]->contact;
        $email      = $ObjData[0]->email;
        $type_id    = $ObjData[0]->type_id;
    }
}
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
<i class="lni lni-user me-2"></i> Update User
</h4>

</div>

<hr style="margin-top:0;">

<form method="POST">

<?php if($ID != NULL){ ?>
<input type="hidden" name="id" value="<?php echo $ID; ?>">
<?php } ?>

<!-- School ID -->
<div class="input-style-3">
<label>School ID</label>
<input type="text" name="school_id"
value="<?php echo $school_id; ?>" required>
</div>

<!-- Branch ID -->
<div class="input-style-3">
<label>Branch ID</label>
<input type="text" name="branch_id"
value="<?php echo $branch_id; ?>" required>
</div>

<!-- Title -->
<div class="select-style-1">
<label>Title</label>

<div class="select-position">

<select name="title" required>

<option value="">Select Title</option>

<option value="Mr"
<?php echo ($title=='Mr')?'selected':''; ?>>
Mr
</option>

<option value="Mrs"
<?php echo ($title=='Mrs')?'selected':''; ?>>
Mrs
</option>

<option value="Miss"
<?php echo ($title=='Miss')?'selected':''; ?>>
Miss
</option>

</select>

</div>
</div>

<!-- Name -->
<div class="input-style-3">
<label>Name</label>

<input type="text"
name="name"
value="<?php echo $name; ?>"
required>
</div>

<!-- Contact -->
<div class="input-style-3">
<label>Contact</label>

<input type="text"
name="contact"
value="<?php echo $contact; ?>">
</div>

<!-- Email -->
<div class="input-style-3">
<label>Email</label>

<input type="email"
name="email"
value="<?php echo $email; ?>"
required>
</div>

<!-- Password -->
<div class="input-style-3">
<label>Password</label>

<input type="password"
name="password"
placeholder="Leave blank to keep old password">
</div>

<!-- Type ID -->
<div class="input-style-3">
<label>Type ID</label>

<input type="text"
name="type_id"
value="<?php echo $type_id; ?>"
required>
</div>

<!-- Submit -->
<div class="button-group mt-3 text-center">

<button type="submit"
name="update_user"
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