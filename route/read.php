<?php
switch ($formtype){
    case "applicant_details":
    
        $roles = array("sd_0" => "Angular Developer", "sd_1" => "UI/UX Designer", "sd_2" => "PHP Developer", "sd_3" => "Application Developer", "sd_5" => "SDE III", "sd_5" => "React/ReactNative");
        
        //Fetch from DB
        $fetch = $conn->query("SELECT * FROM pitamaas WHERE id = $id");  
        if ($fetch->num_rows > 0){
            while($rows = $fetch->fetch_assoc()){
                $content ='<form><label class="profile_pic"><figure><img src="assets/images/applicants/'.$rows["image"].'" alt="applicant" id="preview" /><figcaption class="text_caption">'.$rows["status"].'</figcaption></figure></label><fieldset><label><b>Applicant: </b>'.$rows["fname"].'</label></fieldset><fieldset><label><b>Role: </b>'.$roles[$rows["role"]].'</label></fieldset><fieldset><label><b>DOB: </b>'.$rows["dob"].'</label></fieldset><fieldset><label><b>Mobile: </b>'.$rows["mobile"].'</label></fieldset><fieldset><label><b>Email: </b>'.$rows["email"].'</label></fieldset><fieldset><textarea name="remark" maxlength="250">'.$rows["remark"].'</textarea></fieldset><fieldset><button class="btn btn_2" onclick="ajax(\'remark\', \''.$id.'\')">Remark</button></fieldset></form>';
            }
        }
        print_r($content);
        
        //Update application status
        $conn->query("UPDATE pitamaas set status = 'Viewed on $date' WHERE id = $id");
    break;
    default:
        print_r("error: Notified our developers $formtype");
    break;
}
?>
