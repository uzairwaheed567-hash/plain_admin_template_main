<?php
@include ("includes/db.php"); 
@include("classes/Settings.class.php");
@include ("includes/top_header.php");


$result = mysqli_query($conn, "SELECT s.id,s.school_id,s.branch_id,s.class_id,s.section_id,s.name,s.email,s.password,s.contact,s.address,s.created,s.is_active,
    (SELECT name FROM school WHERE id = s.school_id) AS school_name,(SELECT name FROM branch WHERE id = s.branch_id) AS branch_name,
    (SELECT name FROM classes WHERE id = s.class_id) AS class_name,(SELECT name FROM section WHERE id = s.section_id) AS section_name FROM student s");
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
                <h2>Students</h2>
            </div>
            </div>
            <div class="col-md-6">
            <div class="breadcrumb-wrapper">
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Students</li>
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
        <h6 class="mb-10">Students Table</h6>
        <p class="text-sm mb-20">
        List of all students with their details.
        </p>
        <div class="table-wrapper table-responsive">
        <table class="table">
        <thead>
        <tr>
                <th class="lead-email">
                    <h6>School</h6>
                </th>
                <th class="lead-phone">
                    <h6>Branch</h6>
                </th>
                <th class="lead-company">
                    <h6>Class</h6>
                </th>
                 <th class="lead-company">
                    <h6>Section</h6>
                </th>
                <th class="lead-company">
                    <h6>Name</h6>
                </th>
                <th class="lead-company">
                    <h6>Contact</h6>
                </th>
                <th class="lead-company">
                    <h6>Email</h6>
                </th>
                <th>
                    <h6>Action</h6>
                </th>
                </tr>
    </thead>
    <tbody>

                <tr>
                <?php
                while($student = mysqli_fetch_object($result)) {
                ?>
                <tr>
                <td><?php echo $student->school_name; ?></td>
                <td><?php echo $student->branch_name; ?></td>
                <td><?php echo $student->class_name; ?></td>
                <td><?php echo $student->section_name; ?></td>
                <td><?php echo $student->name; ?></td>
                <td><?php echo $student->contact; ?></td>
                <td><?php echo $student->email; ?></td>
                <td>
                    
                </td>
              <td>

                  <a href="update_student.php?id=<?php echo $student->id; ?>" 
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
