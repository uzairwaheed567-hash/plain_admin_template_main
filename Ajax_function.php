<?php
@include("includes/db.php");
@include("classes/Settings.class.php");


if(isset($_POST['school_id']) && $_POST['school_id'] != '') {
    $school_id = $_POST['school_id'];
    $query = mysqli_query($conn, "SELECT id, name FROM branch WHERE school_id = '$school_id'");
    if(mysqli_num_rows($query) > 0) {
        while($row = mysqli_fetch_object($query)) {
            echo '<option value="'.$row->id.'">'.$row->name.'</option>';
        } 
    } else {
        echo '<option value="">No Branch Available</option>';

    }

}
 
    

if(isset($_POST['class_id']) && $_POST['class_id'] != ''){
    $class_id = $_POST['class_id'];
    $class_section = mysqli_query($conn,"SELECT section_id FROM class_section WHERE class_id = '$class_id'");
    if(mysqli_num_rows($class_section) > 0){
        while($cs = mysqli_fetch_object($class_section)){
            $section = mysqli_query($conn,
                "SELECT id, name FROM section WHERE id = '$cs->section_id'");
            while($row = mysqli_fetch_object($section)){
                echo '<option value="'.$row->id.'">'.$row->name.'</option>';

            }

        }

    } else {

        echo '<option value="">No Section Available</option>';

    }

}

?>