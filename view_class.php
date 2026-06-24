<?php
@include ("includes/db.php"); 
@include("classes/Settings.class.php");
@include ("includes/top_header.php");


$result = mysqli_query($conn, "SELECT c.id,c.school_id,c.branch_id,c.name,c.added_by,c.created,c.is_active,
    (SELECT name FROM school WHERE id = c.school_id) AS school_name,
    (SELECT name FROM branch WHERE id = c.branch_id) AS branch_name FROM classes c");
?>
 <main class="main-wrapper">
        <?php
        @include ("includes/header.php");        
        @include ("includes/menu.php");
        ?>

<section class="table-components">
<div class="container-fluid">

<!-- Title -->
<div class="title-wrapper pt-30">
<div class="row align-items-center">
    <div class="col-md-6">
    <div class="title">
        <h2>Class</h2>
    </div>
    </div>
    <div class="col-md-6">
    <div class="breadcrumb-wrapper">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Class</li>
        </ol>
        </nav>
    </div>
    </div>
</div>
</div>

<!-- Table -->
<div class="tables-wrapper">
<div class="row">
<div class="col-lg-12">
<div class="card-style mb-30">
<h6 class="mb-10">Class Table</h6>
<p class="text-sm mb-20">
List of all users with their details.
</p>
<div class="table-wrapper table-responsive">
<table class="table">
<thead>
<tr>
        <th class="lead-school">
            <h6>School</h6>
        </th>
        <th class="lead-branch">
            <h6>Branch</h6>
        </th>
        <th class="lead-class">
            <h6>Class</h6>
        </th>
         <th class="lead-added_by">
            <h6>Added_by</h6>
        </th>
        <th>
            <h6>Action</h6>
        </th>
        </tr>
</thead>
<tbody>

            <?php
                while($class = mysqli_fetch_object($result)) {
                ?>

                    <tr>
                        <td><?php echo $class->school_name; ?></td>
                        <td><?php echo $class->branch_name; ?></td>
                        <td><?php echo $class->name; ?></td>
                        <td><?php echo $class->added_by; ?></td>

                        <td>
                            <a href="update_class.php?id=<?php echo $class->id; ?>" 
                            class="btn btn-primary btn-sm">
                            Update
                            </a>
                        </td>
                    </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div> <!-- table-wrapper -->
        </div> <!-- card-style -->
        </div> <!-- col-lg-12 -->
        </div> <!-- row -->
</div> <!-- tables-wrapper -->

</div> <!-- container-fluid -->
</section>

<?php @include ("includes/footer.php"); ?>
</main>
