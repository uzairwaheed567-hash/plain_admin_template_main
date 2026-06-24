

<?php
class Settings {


    static function fetch_object($result){
        $data = [];
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }
        return $data;
    }

                //Schools
    static function get_schools($con, $ID = NULL){
    $sql = "SELECT * FROM school WHERE is_active = 1";
    if($ID != NULL){
        $sql .= " AND id = '".$ID."'";
    }
    $result = mysqli_query($con,$sql);
    if($result && mysqli_num_rows($result) > 0){
        return self::fetch_object($result);
    } else {
        return false;
    }
}
    static function add_update_school($con, $PostData){
        $name = $PostData['name'];
        $address = $PostData['address'];
        $contact = $PostData['contact'];
        if(isset($PostData['id'])){
            $id = $PostData['id'];
            $query = "UPDATE school SET name='".$name."',address='".$address."',contact='".$contact."' WHERE id='".$id."'";
        } else {
            $query = "INSERT INTO school (name,address,contact)
             VALUES ('".$name."','".$address."','".$contact."')";
        }

        $response = mysqli_query($con, $query);
        if($response){
            if(isset($PostData['id'])){
                $school_id = $PostData['id'];
            }else{
                $school_id = mysqli_insert_id($con);   
            }

            return true;
        }else{
            return false;
        }

    }

                //  Branch 
    static function get_branches($con, $ID = NULL){
        $sql = "SELECT * FROM branch WHERE is_active = 1 ";
        if($ID != NULL){
            $sql .= "AND id = '".$ID."'";
        }

        $result = mysqli_query($con,$sql);

        if($result && mysqli_num_rows($result) > 0){
            return self::fetch_object($result);
        }else{
            return false;
        }
    }

    static function add_update_branch($con, $PostData){
        $school_id = $PostData['school_id'];
        $name = $PostData['name'];
        $contact = $PostData['contact'];
        $address = $PostData['address'];

        if(isset($PostData['id'])){
            $id = $PostData['id'];
            $query = "UPDATE branch SET school_id='".$school_id."',name='".$name."',contact='".$contact."',address='".$address."' WHERE id='".$id."'";
        } else {
            $query = "INSERT INTO branch (school_id,name,contact,address) VALUES ('".$school_id."','".$name."','".$contact."','".$address."')";
        }

        return mysqli_query($con, $query);
    }

             //  Types 
    static function get_types($con, $ID = NULL){
        $sql = "SELECT * FROM type WHERE is_active = 1 ";
        if($ID != NULL){
            $sql .= "AND id = '".$ID."'";
        }

        $result = mysqli_query($con,$sql);

        if($result && mysqli_num_rows($result) > 0){
            return self::fetch_object($result);
        }else{
            return false;
        }
    }

    static function add_update_type($con, $PostData){
        $name = $PostData['name'];

        if(isset($PostData['id'])){
            $id = $PostData['id'];
            $query = "UPDATE type SET name='".$name."' WHERE id='".$id."'";
        } else {
            $query = "INSERT INTO type (name) VALUES ('".$name."')";
        }

        return mysqli_query($con, $query);
    }

         // Teachers 
    static function get_teachers($con, $ID = NULL){
        $sql = "SELECT * FROM teacher WHERE is_active = 1 ";
        if($ID != NULL){
            $sql .= " AND id = '".$ID."'";
        }
        $result = mysqli_query($con,$sql);
        if($result && mysqli_num_rows($result) > 0){
            return self::fetch_object($result);
        }else{
            return false;
        }
    }
        static function add_update_teacher($con, $PostData){
            $school_id = $PostData['school_id'];
            $branch_id = $PostData['branch_id'];
            $type_id = $PostData['type_id'];
            $title = $PostData['title'];
            $name = $PostData['name'];
            $email = $PostData['email'];
            $contact = $PostData['contact'];
            $address = $PostData['address'];

            if(isset($PostData['id'])){
                $id = $PostData['id'];
                $password_sql = "";

                if(!empty($PostData['password'])){
                    $password_hash = password_hash($PostData['password'], PASSWORD_DEFAULT);
                    $password_sql = ", password='".$password_hash."'";
                }

                $query = "UPDATE teacher SET school_id='".$school_id."',branch_id='".$branch_id."',type_id='".$type_id."',title='".$title."',name='".$name."',email='".$email."',contact='".$contact."',address='".$address."'".$password_sql." WHERE id='".$id."'";
            } else {
                $password_hash = password_hash($PostData['password'], PASSWORD_DEFAULT);

                $query = "INSERT INTO teacher (school_id,branch_id,type_id,title,name,email,password,contact,address)
                VALUES ('".$school_id."','".$branch_id."','".$type_id."','".$title."','".$name."','".$email."','".$password_hash."','".$contact."','".$address."')";
            }

    $result = mysqli_query($con,$query);

if(!$result){
    die(mysqli_error($con));
}

return $result;

}

                  // Students 
               static function get_students($con, $ID = NULL){
               $sql = "SELECT * FROM student WHERE is_active = 1 ";
            if($ID != NULL){
            $sql .= " AND id = '".$ID."'";
            }
            $result = mysqli_query($con,$sql);
            if($result && mysqli_num_rows($result) > 0){
                return self::fetch_object($result);
            }else{
                return false;
            }
        }

        static function add_update_students($con, $PostData){
            $school_id = $PostData['school_id'];
            $branch_id = $PostData['branch_id'];
            $class_id = $PostData['class_id'];
            $section_id = $PostData['section_id'];
            $name = $PostData['name'];
            $email = $PostData['email'];
            $contact = $PostData['contact'];
            $address = $PostData['address'];

            if(isset($PostData['id'])){
                $id = $PostData['id'];
                $password_sql = "";

                if(!empty($PostData['password'])){
                    $password_hash = password_hash($PostData['password'], PASSWORD_DEFAULT);
                    $password_sql = ", password='".$password_hash."'";
                }

                $query = "UPDATE student SET school_id='".$school_id."',branch_id='".$branch_id."',class_id='".$class_id."',section_id='".$section_id."',name='".$name."',email='".$email."',contact='".$contact."',address='".$address."'".$password_sql." WHERE id='".$id."'";
            } else {
                $password_hash = password_hash($PostData['password'], PASSWORD_DEFAULT);

                $query = "INSERT INTO student (school_id,branch_id,class_id,section_id,name,email,password,contact,address)
                VALUES ('".$school_id."','".$branch_id."','".$class_id."','".$section_id."','".$name."','".$email."','".$password_hash."','".$contact."','".$address."')";
            }

            return mysqli_query($con, $query);
        }


       //  Users 
    static function get_users($con, $ID = NULL){
    $sql = "SELECT * FROM users WHERE 1=1";
    if($ID != NULL){
        $sql .= " AND id='".$ID."'";
    }
    $result = mysqli_query($con, $sql);
    if(!$result){
        die("Get Users Error: " . mysqli_error($con));
    }
    if(mysqli_num_rows($result) > 0){
        return self::fetch_object($result);
    } else {
        return false;
    }}

static function get_user($con, $ID){

    $sql = "SELECT * FROM users WHERE id='".$ID."'";

    $result = mysqli_query($con, $sql);

    if($result && mysqli_num_rows($result) > 0){
        return self::fetch_object($result);
    }

    return false;
}

static function update_user($con, $PostData){

    $id         = $PostData['id'];
    $school_id  = $PostData['school_id'];
    $branch_id  = $PostData['branch_id'];
    $title      = $PostData['title'];
    $name       = $PostData['name'];
    $contact    = $PostData['contact'];
    $email      = $PostData['email'];
    $type_id    = $PostData['type_id'];

    $query = "UPDATE users SET
        school_id='".$school_id."',branch_id='".$branch_id."',title='".$title."',name='".$name."',contact='".$contact."',email='".$email."',type_id='".$type_id."'";
 
        if(!empty($PostData['password'])){
        $password_hash = password_hash($PostData['password'], PASSWORD_DEFAULT);
        $query .= ", password='".$password_hash."'";
    }

    $query .= " WHERE id='".$id."'";

    $result = mysqli_query($con, $query);

    if(!$result){
        die(mysqli_error($con));
    }

    return true;
}

         //  Class Section

    static function get_class_section($con, $ID = NULL){
    $sql = "SELECT * FROM class_section WHERE 1=1";

    if($ID != NULL){
        $sql .= " AND id='".$ID."'";
    }

    $result = mysqli_query($con, $sql);

    if($result && mysqli_num_rows($result) > 0){

        return self::fetch_object($result);

    } else {

        return false;

    }

}
    static function add_class_section($con, $PostData){
    $class_id   = $PostData['class_id'];
    $section_id = $PostData['section_id'];
    $added_by   = $PostData['added_by'];
    
    if(isset($PostData['id']) && !empty($PostData['id'])){
        $id = $PostData['id'];
        $query = "UPDATE class_section SET
       class_id='".$class_id."',section_id='".$section_id."',added_by='".$added_by."' WHERE id='".$id."'";
    }

    
    else {
        $query = "INSERT INTO class_section
        (class_id, section_id, added_by)
        VALUES('".$class_id."', '".$section_id."', '".$added_by."')";
    }
    $result = mysqli_query($con, $query);
    if(!$result){
        die(
            "SQL ERROR : ".mysqli_error($con).
            "<br><br>QUERY : ".$query
        );
    }

    return true;
}
        //  Class 
        static function get_classes($con, $ID = NULL){

    $sql = "SELECT * FROM classes WHERE 1=1";

    if($ID != NULL){
        $sql .= " AND id='".$ID."'";
    }

    $result = mysqli_query($con, $sql);

    if($result && mysqli_num_rows($result) > 0){

        return self::fetch_object($result);

    } else {

        return false;

    }

}

static function update_classes($con, $PostData){

    $school_id = $PostData['school_id'] ?? '';
    $branch_id = $PostData['branch_id'] ?? '';
    $name      = $PostData['name'] ?? '';
    $added_by  = $PostData['added_by'] ?? '';

    
    if(isset($PostData['id']) && !empty($PostData['id'])){
        $id = $PostData['id'];
        $query = "UPDATE classes SET
        school_id='".$school_id."',branch_id='".$branch_id."',name='".$name."',added_by='".$added_by."' WHERE id='".$id."'";
    }
    
    else {
        $query = "INSERT INTO classes
        (school_id, branch_id, name, added_by)
        VALUES
        ('".$school_id."', '".$branch_id."', '".$name."', '".$added_by."')";
    }
    $result = mysqli_query($con, $query);

    if(!$result){

        die(
            "SQL ERROR : ".mysqli_error($con).
            "<br><br>QUERY : ".$query
        );
    }

    return true;
}
         // Sections 
static function get_sections($con, $ID = NULL){
    $sql = "SELECT * FROM section WHERE is_active = 1";
    if($ID != NULL){
        $sql .= " AND id='".$ID."'";
    }
    $result = mysqli_query($con, $sql);
    if($result && mysqli_num_rows($result) > 0){
        return self::fetch_object($result);
    } else {
        return false;
    }
}

static function update_sections($con, $PostData){
    $school_id = $PostData['school_id'] ?? '';
    $branch_id = $PostData['branch_id'] ?? '';
    $name      = $PostData['name'] ?? '';
    $added_by  = $PostData['added_by'] ?? '';
   
    if(isset($PostData['id']) && !empty($PostData['id'])){
        $id = $PostData['id'];
      $query = "UPDATE section SET
     school_id='".$school_id."',branch_id='".$branch_id."',name='".$name."',added_by='".$added_by." 'WHERE id='".$id."'";
    }
   
    else {
        $query = "INSERT INTO section(school_id,branch_id,name,added_by)
        VALUES('".$school_id."','".$branch_id."','".$name."','".$added_by."')";
    }
    $result = mysqli_query($con, $query);
    if(!$result){
        die(
            "SQL ERROR : ".mysqli_error($con).
            "<br><br>QUERY : ".$query
        );
    }
    return true;
}

      //  Subjects

static function get_subjects($con, $ID = NULL){
    $sql = "SELECT * FROM subject WHERE is_active = 1";
    if($ID != NULL){
        $sql .= " AND id='".$ID."'";
    }
    $result = mysqli_query($con, $sql);
    if($result && mysqli_num_rows($result) > 0){
        return self::fetch_object($result);
    } else {
        return false;
    }
}
static function update_subjects($con, $PostData){
    $school_id = $PostData['school_id'] ?? '';
    $branch_id = $PostData['branch_id'] ?? '';
    $name      = $PostData['name'] ?? '';
    $added_by  = $PostData['added_by'] ?? '';
    
    if(isset($PostData['id']) && !empty($PostData['id'])){
        $id = $PostData['id'];
        $query = "UPDATE subject SET
        school_id='".$school_id."',branch_id='".$branch_id."',name='".$name."',added_by='".$added_by."' WHERE id='".$id."'";

    }
    
    else {
        $query = "INSERT INTO subject
        (school_id,branch_id,name,added_by)
        VALUES ('".$school_id."','".$branch_id."','".$name."','".$added_by."')";
    }
    $result = mysqli_query($con, $query);
    if(!$result){

        die(
            "SQL ERROR : ".mysqli_error($con).
            "<br><br>QUERY : ".$query
        );
    }

    return true;
}
    //  Class Subject 
   static function get_class_subjects($con, $ID = NULL){

    $sql = "SELECT * FROM class_subject WHERE is_active = 1";

    if($ID != NULL){
        $sql .= " AND id='".$ID."'";
    }

    $result = mysqli_query($con, $sql);

    if($result && mysqli_num_rows($result) > 0){

        return self::fetch_object($result);

    } else {

        return false;

    }

}
    static function update_class_subject($con, $PostData){
    $class_id   = $PostData['class_id'];
    $subject_id = $PostData['subject_id'];

    if(isset($PostData['id']) && !empty($PostData['id'])){
        $id = $PostData['id'];
        $query = "UPDATE class_subject SET
        class_id='".$class_id."',subject_id='".$subject_id."' WHERE id='".$id."'";
    }

    else {
        $query = "INSERT INTO class_subject (class_id, subject_id)VALUES('".$class_id."', '".$subject_id."')";
    }
    $result = mysqli_query($con, $query);
    if(!$result){
        die(
            "SQL ERROR : ".mysqli_error($con).
            "<br><br>QUERY : ".$query
        );
    }
    return true;
}
    // Teacher Class Section 
   static function get_teacher_class_section($con, $ID = NULL){

    $sql = "SELECT * FROM teacher_class_section WHERE is_active = 1";

    if($ID != NULL){
        $sql .= " AND id='".$ID."'";
    }

    $result = mysqli_query($con, $sql);

    if($result && mysqli_num_rows($result) > 0){

        return self::fetch_object($result);

    } else {

        return false;

    }

}
    static function update_teacher_class_section($con, $PostData){

    $teacher_id = $PostData['teacher_id'];
    $class_id   = $PostData['class_id'];
    $section_id = $PostData['section_id'];
  
    if(isset($PostData['id']) && !empty($PostData['id'])){
        $id = $PostData['id'];
        $query = "UPDATE teacher_class_section SET teacher_id='".$teacher_id."',class_id='".$class_id."',section_id='".$section_id."' WHERE id='".$id."'";
    }
  
    else {
        $query = "INSERT INTO teacher_class_section
        (teacher_id, class_id, section_id)
         VALUES('".$teacher_id."','".$class_id."', '".$section_id."')";
    }
    $result = mysqli_query($con, $query);
    if(!$result){
        die(
            "SQL ERROR : ".mysqli_error($con).
            "<br><br>QUERY : ".$query
        );
    }
    return true;
}
    //  Student Parent 
   static function get_student_parent($con, $ID = NULL){

    $sql = "SELECT * FROM student_parent WHERE is_active = 1";

    if($ID != NULL){
        $sql .= " AND id='".$ID."'";
    }

    $result = mysqli_query($con, $sql);

    if($result && mysqli_num_rows($result) > 0){

        return self::fetch_object($result);

    } else {

        return false;

    }

}
 
static function update_student_parent($con, $PostData){
    $student_id = $PostData['student_id'];
    $parent_id  = $PostData['parent_id'];
    $added_by   = $PostData['added_by'];
    if(isset($PostData['id'])){
        $id = $PostData['id'];
        $query = "UPDATE student_parent 
                  SET student_id='".$student_id."',parent_id='".$parent_id."',added_by='".$added_by."'WHERE id='".$id."'";
                  return mysqli_query($con, $query);
    }

    return false;
}
    //  Staff 
static function get_staff($con, $ID = NULL){
    $sql = "SELECT * FROM staff WHERE is_active = 1";
    if($ID != NULL){
        $sql .= " AND id='".$ID."'";
    }
    $result = mysqli_query($con, $sql);
    if(!$result){
        die(
            "SQL ERROR : ".mysqli_error($con).
            "<br><br>QUERY : ".$sql
        );
    }
    if(mysqli_num_rows($result) > 0){
        return self::fetch_object($result);
    } else {
        return false;
    }
}

static function add_update_staff($con, $PostData){
    $school_id = $PostData['school_id'];
    $branch_id = $PostData['branch_id'];
    $type_id   = $PostData['type_id'];
    $title     = $PostData['title'];
    $name      = $PostData['name'];
    $email     = $PostData['email'];
    $contact   = $PostData['contact'];
    $address   = $PostData['address'];
    
    if(isset($PostData['id']) && !empty($PostData['id'])){
        $id = $PostData['id'];
        $query = "UPDATE staff SET
        school_id='".$school_id."',branch_id='".$branch_id."',type_id='".$type_id."',title='".$title."',name='".$name."', email='".$email."',contact='".$contact."',address='".$address."'";
    
        if(!empty($PostData['password'])){
            $password_hash = password_hash($PostData['password'], PASSWORD_DEFAULT);
            $query .= ", password='".$password_hash."'";
        }
        $query .= " WHERE id='".$id."'";
    }
    
    else {
        $password_hash = password_hash($PostData['password'], PASSWORD_DEFAULT);
        $query = "INSERT INTO staff
        (school_id,branch_id,type_id,title,name,email,password,contact,address)
        VALUES('".$school_id."','".$branch_id."','".$type_id."','".$title."','".$name."','".$email."','".$password_hash."','".$contact."', '".$address."')";
    }
    $result = mysqli_query($con, $query);
    if(!$result){

        die(
            "SQL ERROR : ".mysqli_error($con).
            "<br><br>QUERY : ".$query
        );
    }

    return true;
}

   //  GET PARENTS
static function get_parent($con, $ID = NULL){
    $sql = "SELECT * FROM parent WHERE is_active = 1";
    if($ID != NULL){
        $sql .= " AND id='".$ID."'";
    }
    $result = mysqli_query($con, $sql);
    if(!$result){
        die(
            "SQL ERROR : ".mysqli_error($con).
            "<br><br>QUERY : ".$sql
        );
    }
    if(mysqli_num_rows($result) > 0){
        return self::fetch_object($result);
    } else {
        return false;
    }
}
static function add_update_parent($con, $PostData){
    $name    = $PostData['name'];
    $contact = $PostData['contact'];
    if(isset($PostData['id']) && !empty($PostData['id'])){

        $id = $PostData['id'];
        $query = "UPDATE parent SET name = '".$name."',contact = '".$contact."'WHERE id = '".$id."'";
        return mysqli_query($con, $query);
    }
    else{
        $email    = $PostData['email'];
        $password = $PostData['password'];
        $query = "INSERT INTO parent
                  (name, email,password,contact,is_active)
                  VALUES
                  ('".$name."', '".$email."','".$password."','".$contact."','1')";
       return mysqli_query($con, $query);
    }
}
}
?>