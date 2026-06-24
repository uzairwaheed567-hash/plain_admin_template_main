<?php
@include ("includes/db.php"); 
@include("classes/Settings.class.php");
@include ("includes/top_header.php");


$result = mysqli_query($conn, "SELECT * FROM teacher_class_section");
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
                <h2>Teacher Class Section</h2>
            </div>
            </div>
            <div class="col-md-6">
            <div class="breadcrumb-wrapper">
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Teacher Class Section</li>
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
        <h6 class="mb-10">Teacher Class Section Table</h6>
        <p class="text-sm mb-20">
        List of all teacher class sections with their details.
        </p>
        <div class="table-wrapper table-responsive">
        <table class="table">
        <thead>
        <tr>
                <th class="lead-email">
                    <h6>Teacher</h6>
                </th>
                <th class="lead-phone">
                    <h6>Class</h6>
                </th>
                <th class="lead-company">
                    <h6>Section</h6>
                </th>
                <th>
                    <h6>Action</h6>
                </th>
                </tr>
    </thead>
    <tbody>

                <?php
                while($teacher_class_section = mysqli_fetch_object($result)) {
                ?>
                <tr>
                <td><?php echo $teacher_class_section->teacher_id; ?></td>
                <td><?php echo $teacher_class_section->class_id; ?></td>
                <td><?php echo $teacher_class_section->section_id; ?></td>
                <td>
                    
                </td>
              <td>

                  <a href="update_teacher_class_section.php?id=<?php echo $teacher_class_section->id; ?>" 
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
