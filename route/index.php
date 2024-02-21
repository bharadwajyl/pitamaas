<?php
switch ($_POST["FormType"]){
    case "job_form":
        Create(''.$_POST['FormType'].'', ''.$_FILES['image']['name'].'', ''.$_POST['fname'].'', ''.$_POST['dob'].'', ''.$_POST['mob'].'', ''.$_POST['email'].'', ''.$_POST['role'].'');
    break;
    case "applicant_details":
        Read(''.$_POST['FormType'].'', ''.$_POST['id'].'');
        break;
    case "remark":
        Update(''.$_POST['FormType'].'', ''.$_POST['id'].'', ''.$_POST['remark'].'');
    break;
    default:
        die("error: Not allowed");
    break;
}

function Create($formtype, $image, $fname, $dob, $mob, $email, $role){
    try {
        if (!file_exists("db.php") || !file_exists("create.php")) {
            throw new Exception ('error: The page your are looking may not exist');
        } else {
        
            //Global Variables
            $error = 0;
        
            //Custom date & time
            date_default_timezone_set("Asia/Kolkata");
            $date = date("d-m-Y");
            $time = date("H:i a");
            
            //Include files
            @require("db.php");
            @include("create.php");
            
        }
    } catch(Exception $e) {
        print_r('error: ' .$e->getMessage());
    }
}

function Read($formtype, $id){
    try {
        if (!file_exists("db.php") || !file_exists("read.php")) {
            throw new Exception ('error: The page your are looking may not exist');
        } else {
        
            //Custom date & time
            date_default_timezone_set("Asia/Kolkata");
            $date = date("d-m-Y");
            $time = date("H:i a");
        
            //Include files
            @require("db.php");
            @include("read.php");
            
        }
    } catch(Exception $e) {
        print_r('error: ' .$e->getMessage());
    }
}

function Update($formtype, $id, $remark){
    try {
        if (!file_exists("db.php") || !file_exists("update.php")) {
            throw new Exception ('error: The page your are looking may not exist');
        } else {
        
            //Include files
            @require("db.php");
            @include("update.php");
            
        }
    } catch(Exception $e) {
        print_r('error: ' .$e->getMessage());
    }
}

function Errors($mssg){
    print_r("error: $mssg");
    exit;
}
?>
