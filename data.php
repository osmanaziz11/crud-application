<?php
    // header('Location:'.$hostname.'Login.php');


function fetchAdminRecord($userName)  //  To Fetch ADMIN Record From db 
{
    include 'db-config.php'; //Database Configuration File Included
    try {
        $sql = $conn->prepare("SELECT * FROM admin_record where username=?");

        $sql->execute([$userName]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        if (count($result) > 0) {
            return $result;
        } else {
            return null;
        }
    } catch (PDOException $exc) {
        $exc->getMessage();
    }
}

function isMatch($userPass, $encryptPass)  // To Verify Password
{
    if (sha1($userPass) == $encryptPass) {   //Check Encrypted Password 

        return true;
    } else {
        return false;
    }
}
function load_indexData($val1,$val2,$val3){
    include("db-config.php");
     try {
        $sql = $conn->prepare("SELECT * FROM degree where degree = ?");
        $sql->execute([$val1]);
        $result=NULL;
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        if ($result != NULL) {
            return $result;
        } else {
            return null;
        }
    } catch (PDOException $exc) {
        $exc->getMessage();
    }
}
function get_course($val){
    include("db-config.php");
     try {
        $sql = $conn->prepare("SELECT * FROM course where course_code=?");
        $sql->execute([$val]);
        $result=NULL;
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        if ($result != NULL) {
            return $result;
        } else {
            return null;
        }
    } catch (PDOException $exc) {
        $exc->getMessage();
    }
}
function get_student($val){
    include("db-config.php");
     try {
        $sql = $conn->prepare("SELECT * FROM student where id=?");
        $sql->execute([$val]);
        $result=NULL;
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        if ($result != NULL) {
            return $result;
        } else {
            return null;
        }
    } catch (PDOException $exc) {
        $exc->getMessage();
    }
}
function get_degree($val){
    include("db-config.php");
     try {
        $sql = $conn->prepare("SELECT * FROM degree where id=?");
        $sql->execute([$val]);
        $result=NULL;
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        if ($result != NULL) {
            return $result;
        } else {
            return null;
        }
    } catch (PDOException $exc) {
        $exc->getMessage();
    }
}
function delete_degree($val){
    include("db-config.php");
     try {
        $sql = $conn->prepare("DELETE FROM degree WHERE id =?");
        $sql->execute([$val]);
    return 1;
    } catch (PDOException $exc) {
        $exc->getMessage();
        return 0;
    }
}
function delete_student($val){
    include("db-config.php");
     try {
        $sql = $conn->prepare("DELETE FROM student WHERE id =?");
        $sql->execute([$val]);
    return 1;
    } catch (PDOException $exc) {
        $exc->getMessage();
        return 0;
    }
}
function delete_course($val){
    include("db-config.php");
     try {
        $sql = $conn->prepare("DELETE FROM course WHERE course_code =?");
        $sql->execute([$val]);
    return 1;
    } catch (PDOException $exc) {
        $exc->getMessage();
        return 0;
    }
}
function add_admin($val1,$val2,$val3){
    include 'db-config.php';
try {
        $sql = $conn->prepare("INSERT INTO admin_record (username, password, name) VALUES (?, ?, ?)");
         $sql->execute([$val1,sha1($val2),$val3]);
       return 1;
    } catch (PDOException $exc) {
        $exc->getMessage();
        return 0;
    }
}
function add_course($val1,$val2,$val3){
    include 'db-config.php';
try {
        $sql = $conn->prepare("INSERT INTO course (course_code, course_title, credit_hour) VALUES (?, ?, ?)");
         $sql->execute([$val1,$val2,$val3]);
       return 1;
    } catch (PDOException $exc) {
        $exc->getMessage();
        return 0;
    }
}
function add_degree($val1,$val2,$val3){
    include 'db-config.php';
try {
        $sql = $conn->prepare("INSERT INTO degree (degree_name, fees, course_name) VALUES (?, ?, ?)");
         $sql->execute([$val1,$val2,$val3]);
       return 1;
    } catch (PDOException $exc) {
        $exc->getMessage();
        return 0;
    }
}
function add_student($val2,$val3){
    include 'db-config.php';
try {
        $sql = $conn->prepare("INSERT INTO student (name, degree) VALUES (?, ?)");
         $sql->execute([$val2,$val3]);
       return 1;
    } catch (PDOException $exc) {
        $exc->getMessage();
        return 0;
    }
}
function update_student($val1,$val2,$val3){
    include 'db-config.php';
try {
        $sql = $conn->prepare("UPDATE student SET name = ?, degree = ? WHERE id = ?");
         $sql->execute([$val2,$val3,$val1]);
       return 1;
    } catch (PDOException $exc) {
        $exc->getMessage();
        return 0;
    }
}
function update_degree($val1,$val2,$val3,$val4){
    include 'db-config.php';
try {
        $sql = $conn->prepare("UPDATE degree SET degree_name = ?, fees = ?, course_name = ? WHERE id = ?");
         $sql->execute([$val1,$val2,$val3,$val4]);
       return 1;
    } catch (PDOException $exc) {
        $exc->getMessage();
        return 0;
    }
}
function update_course($val1,$val2,$val3){
    include 'db-config.php';
try {
        $sql = $conn->prepare("UPDATE course SET course_code = ?, course_title = ?, credit_hour = ? WHERE course_code = ?;");
         $sql->execute([$val1,$val2,$val3,$val1]);
       return 1;
    } catch (PDOException $exc) {
        $exc->getMessage();
        return 0;
    }
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $result = fetchAdminRecord($_POST['username']);   //Fetching Record Into  Array '$Result'
    if (!$result == null) {
        if (isMatch($_POST['password'],$result['password'])) {
            //    password verified
            session_start();
            $_SESSION['verify_username'] = $result['username'];
            $_SESSION['verify_password'] = $_POST['password'];
            $_SESSION['verify_name'] = $result['name'];
        
            echo 1;
        } else {
            echo 0; // verification Failed
        }
    } else {
        // verification Failed
        echo 0;
    }
}

if(isset($_POST['course_code']) && isset($_POST['course_title'])){
 echo add_course($_POST['course_code'],$_POST['course_title'],$_POST['credit_hour']);
}
if(isset($_POST['student_name']) && isset($_POST['student_degree'])){
 echo add_student($_POST['student_name'],$_POST['student_degree']);
}
if(isset($_POST['degree_name']) && isset($_POST['degree_fees'])){
 echo add_degree($_POST['degree_name'],$_POST['degree_fees'],$_POST['degree_courses']);
}
if(isset($_POST['update_student_name']) && isset($_POST['update_student_degree'])){
 echo update_student($_POST['update_student_id'],$_POST['update_student_name'],$_POST['update_student_degree']);
}
if(isset($_POST['update_course_code']) && isset($_POST['update_course_title'])){
 echo update_course($_POST['update_course_code'],$_POST['update_course_title'],$_POST['update_credit_hour']);
}
if(isset($_POST['update_degree_name']) && isset($_POST['update_fees'])){
 echo update_degree($_POST['update_degree_name'],$_POST['update_fees'],$_POST['update_degree_course'],$_POST['update_degree_id']);
}

if(isset($_POST['student-edit-id'])!=''){
 echo json_encode(get_student($_POST['student-edit-id']));
}

if(isset($_POST['degree-edit-id'])!=''){
 echo json_encode(get_degree($_POST['degree-edit-id']));
}
if(isset($_POST['student-del-id'])){
 echo delete_student($_POST['student-del-id']);

}
if(isset($_POST['degree-del-id'])){
 echo delete_degree($_POST['degree-del-id']);

}
if(isset($_POST['edit-id'])!=''){
 echo json_encode(get_course($_POST['edit-id']));
}
if(isset($_POST['del-id'])){
 echo delete_course($_POST['del-id']);

}

if(isset($_POST['index_degree']) && isset($_POST['index_fees']) && isset($_POST['index_course'])){
    $resp=json_encode(load_indexData($_POST['index_degree'],$_POST['index_fees'],$_POST['index_course']));
    
}
if(isset($_POST['new_username']) && isset($_POST['new_password'])){
    echo add_admin($_POST['new_username'],$_POST['new_password'],$_POST['new_name']);
    
}


?>