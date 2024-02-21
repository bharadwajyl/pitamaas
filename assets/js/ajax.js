//Finalize data
function ajax(type, val){
    switch (type){
        case "job_form":
            if (verify_details('job_form') == "TRUE"){
                formData = new FormData($(".description form")[0]);
                formData.append("FormType",type);
                formData.append("code",'');
            }
        break;
        case "applicant_details":
            if (!val <= 0){
                formData.append("FormType",type);
                formData.append("id", val);
                error = 0;
                url = "../route/";
            }
        break;
        case "remark":
            formData = new FormData($(".description form")[0]);
            formData.append("FormType",type);
            formData.append("id", val);
            error = 0;
            url = "../route/";
        break;
        default:
            popup("error", "Invalid Ajax request");
        break;
    }
    
    //If no errors call ajax
    if (!error > 0){ ajax_request(type); }
}


//Ajax
function ajax_request(type){
     //send & retrieve data
    $.ajax({
        url:url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $("body").css("opacity","0.6");
            $(document).keypress(function(event){
                if (event.which == '13') { event.preventDefault(); }
            });
        },
        success: function(response){
            if (response.match(/error:/g)){
                popup("error", response.replace(/error:/g, ""));
            } else {
                if (type == "job_form" || type == "applicant_details") { 
                    appender(type, response);
                } else if (type == "remark"){
                    popup("success", response.replace(/success:/g, ""));
                } else {
                    popup("error", response.replace(/error:/g, ""));
                }
            }        
        },
        complete: function() {
            $("body").css("opacity","1");
         }
    });
}
