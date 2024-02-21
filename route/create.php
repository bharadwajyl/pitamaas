<?php
switch ($formtype){
    case "job_form":
        
        //Check for null inputs
        if (empty($fname) || empty($mob) || empty($email) || !isset($image)){
            Errors("error: All fields are mandatory");
        }
        
        //Validate name
        if (!preg_match ("/^[a-zA-Z\s]+$/", $fname)){
            Errors("error: Applicant name is Invalid");
        }
        
        //Validate mobile number
        if (!preg_match('/^[0-9]{10}+$/', $mob)){
            Errors("error: Invalid mobile number");
        }
        
        //Calculate age from DOB
        $age = date_diff(date_create($date), date_create($dob));
        if ($age->format('%y') < 18){
            Errors("error: Applicant should be atleast 18 old");
        }
        
        //Validate email address
        $domains = array('gmail.com', 'outlook.com', 'yahoo.in', 'yahoo.com', 'hotmail.com');
        $pattern = "/^[a-z0-9._%+-]+@[a-z0-9.-]*(" . implode('|', $domains) . ")$/i";
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Errors("Invalid email address");
        } else if (!preg_match($pattern, $email)) {
            Errors("error: Please use gmail, yahoo, outlook, hotmail");
        } else {
            $email = mysqli_real_escape_string($conn, $email);
        }
        
        //Generate refno
        $refno = rand().date("Hi");
        
        //Save user image
        $file_type = array("jpg", "jpeg", "png");
        $location = "../admin/assets/images/applicants/";
        $filesize = $_FILES['image']['size'];
        $target_file = $location . basename($_FILES['image']['name']);
        $ext = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $newname = rand().date("Hi").'.'. pathinfo($_FILES['image']['name'] ,PATHINFO_EXTENSION);
        if (!is_dir($location)) {
            mkdir($location);
        } 
        if(!in_array($ext, $file_type)){
            Errors("error: Only jpg, jpeg, png image types are allowed");
        } else if($filesize > 500000){
            Errors("error: Image size restricted to 500kb");
        } else if(move_uploaded_file($_FILES['image']['tmp_name'], $location .$newname)){
             $url = $newname;
        } else {
            Errors("error: Please try after sometime");
        }
        
        //Success message
        $message = '<section class="t_center success_mssg"><iconify-icon icon="line-md:check-all" class="icon icon-success big"></iconify-icon><h1 class="title medium">Applied Successfully</h1><p>Dear '.$fname.', Your application with Referrence number: '.$refno.' has been successfully submitted. Keep track on your application.</p></section>';
        
        //Insert Into db
        $conn->query("INSERT INTO pitamaas (role, image, fname, dob, mobile, email, date, time, refno, remark, status) VALUES ('$role', '$url', '$fname', '$dob', '$mob', '$email', '$date', '$time', '$refno', '', 'Application sent')") === TRUE ? print_r($message) : Errors("error: ".$conn->error);
        
    break;
    default:
        print_r("error: Notified our developers");
    break;
}
?>
