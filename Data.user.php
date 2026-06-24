<?php
class Data {

    static function login($con, $PostData) {

        $email = mysqli_real_escape_string($con, $PostData['email']);
        $password = trim(md5($PostData['password']));

        $stmt = mysqli_prepare($con, "SELECT * FROM users WHERE email = ?");

        if(!$stmt){
            die("Query Error: " . mysqli_error($con));
        }

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if($result && mysqli_num_rows($result) > 0){

            $ObjUser = mysqli_fetch_object($result);
            if($ObjUser){
                // Plain text password check
                if($password == $ObjUser->password){
                    
                    $getType = mysqli_query($con,"SELECT `name` FROM `type` WHERE id = '".$ObjUser->type_id."'");
                    if(@mysqli_num_rows($getType) > 0){
                        $ObjUser->user_type = mysqli_fetch_object($getType)->name;
                    }
                    $_SESSION['SchoolLoggedIn'] = $ObjUser;

                    return true;
                }
            }
            
        }

        return false;
    }

    static function fetch_object($result){

        $data = [];

        while($row = mysqli_fetch_object($result)){
            $data[] = $row;
        }

        return $data;
    }
}
?>