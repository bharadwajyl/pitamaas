<?php
switch($formtype){
    case "remark":
        
        //Update remark status
        if ($conn->query("UPDATE pitamaas set remark = '$remark' WHERE id = $id")){
            print_r("success: Remarks updated");
        } else {
            Errors("error: ".$conn->error);
        }
        
    break;
    default:
        die("error: Not allowed");
    break;
}
?>
