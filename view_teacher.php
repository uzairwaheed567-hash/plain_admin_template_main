    <?php
        @include ("includes/db.php"); 
        @include ("includes/top_header.php");
        @include("classes/Settings.class.php");
        $result = mysqli_query($conn, "SELECT t.id,t.school_id,t.branch_id,t.type_id,t.title,t.name,t.email,t.password,t.contact,t.address,t.created,t.is_active,
                                (SELECT name FROM school WHERE id = t.school_id) AS school_name,
                                (SELECT name FROM branch WHERE id = t.branch_id) AS branch_name FROM teacher t");
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
                    <h2>Teacher</h2>
                </div>
                </div>
                <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Teacher</li>
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
                            <h6 class="mb-10">Teacher Table</h6>
                            <p class="text-sm mb-20">
                            List of all users with their details.
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
                                                <h6>Type</h6>
                                            </th>
                                            <th class="lead-company">
                                                <h6>Title</h6>
                                            </th>
                                            <th class="lead-company">
                                                <h6>Name</h6>
                                            </th>
                                            <th class="lead-company">
                                                <h6>Email</h6>
                                            </th>
                                            <th class="lead-company">
                                                <h6>Password</h6>
                                            </th>
                                            <th class="lead-company">
                                                <h6>Contact</h6>
                                            </th>
                                            <th class="lead-company">
                                                <h6>Address</h6>
                                            </th>
                                            <th>
                                                <h6>Action</h6>
                                            </th>
                                            </tr>
                                </thead>
                                <tbody>
                                   
<?php
while($teacher = mysqli_fetch_object($result)) {
?>

<tr>
    <td><?php echo $teacher->school_name; ?></td>
    <td><?php echo $teacher->branch_name; ?></td>
    <td><?php echo $teacher->type_id; ?></td>
    <td><?php echo $teacher->title; ?></td>
    <td><?php echo $teacher->name; ?></td>
    <td><?php echo $teacher->email; ?></td>
    <td><?php echo $teacher->password; ?></td>
    <td><?php echo $teacher->contact; ?></td>
    <td><?php echo $teacher->address; ?></td>

    <td>
        <a href="teacher.php?id=<?php echo $teacher->id; ?>" 
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
