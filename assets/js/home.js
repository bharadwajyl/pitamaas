//Global variables
var role, description, skills, experience, qualification, class_names = 0, data, url = "route/", formData = new FormData(), error = 0;

//Pre-set array values
role = ["Angular Devloper",
         "UI/UX Designer",
         "PHP Developer",
         "Application Developer",
         "SDE III",
         "ReactJS/Native"];
description = ["Design, build and configure applications to meet business process and application requirements.",
               "Design, build and configure applications to meet business process and application requirements.",
               "Design, build and configure applications to meet business process and application requirements.",
               "Design, build and configure applications to meet business process and application requirements.",
               "Design, build and configure applications to meet business process and application requirements.",
               "Design, build and configure applications to meet business process and application requirements."];
skills = ["Angular, Typescript, SQL, Docker",
          "Adobe, Illustrator, Figma. Good to have basic knowledge on HTML, CSS",
          "PHP, Laravel/Codeigniter, Mysql",
          "React/Angular/Vue or Python",
          "C/C++/C# or Rust or Python",
          "Hands-on experience using React and ReactNative"];
experience = ["2+ Years of experience prefferred",
              "Fresher or Good to have 1+ year of experience",
              "5+ Years of hands-on experience",
              "Good knowledge on React will be prefferred or 2+ years on experience working on Python",
              "1 - 5 of hands-on experience",
              "Fresher/1+ year of experience"];
qualification = ["Bachelor's or Equivalent",
                 "Bachelor's or Equivalent",
                 "Bachelor's or Equivalent",
                 "Bachelor's/Master's or Equivalent",
                 "Bachelor's or Equivalent",
                 "Bachelor's or Equivalent"];
                 
                 
//Cards onclick
$(".card").on("click", function(){
    if (!$(".right_content .description").length > 0){ 
        $(".right_content").addClass(" right_content_active");
        $(".right_content").append('<article class="description padding_2x"></article>');
    }
    class_names = $(this).attr("class").split(" ");
    if ($(this).hasClass("table-card")){
        content('applicant_details', '');
    } else {
        if ($(".card").hasClass("active")) { $(".card").removeClass("active"); }
        $(this).addClass(" active");
        content('desc', '');
    }
});

//Content
function content(type, val){
    switch (type){
        case "job_form":
            return appender(type, '<form><label class="profile_pic"><figure><img src="assets/images/profile.png" alt="applicant" id="preview" /><figcaption><iconify-icon icon="ph:user-focus-fill"></iconify-icon></figcaption></figure><input type="file" name="image" accept=".png,.jpg,.jpeg,.PNG,.JPG,.JPEG" oninput="document.getElementById(\'preview\').src=window.URL.createObjectURL(this.files[0])" /></label><fieldset><select name="role"><option value="sd_'+val+'">'+role[val]+'</option></select><label><a href="javascript:void(0)" onclick="job_description()">Job Description</a></label></fieldset><fieldset><label>Full name</label><input type="text" name="fname" input-mode="text" maxlength="60" /></fieldset><fieldset><label>DOB</label><input type="date" name="dob" input-mode="date" /></fieldset><fieldset><label>Mobile number</label><input type="tel" name="mob" input-mode="number" maxlength="10" /></fieldset><fieldset><label>Email address</label><input type="email" name="email" input-mode="email" maxlength="60" /></fieldset><fieldset><button class="btn btn_2" onclick="ajax(\'job_form\', \'\')">Submit my application</button></fieldset></form>');
        break;
        case "desc":
            let content_val = (class_names[(class_names.length)-1].replace(/sd_/g, ""))-1;
            let job_role = role[content_val].replace(/'/g, "\'");
            let job_desc = description[content_val].replace(/'/g, "\'");
            let job_skills = skills[content_val].replace(/'/g, "\'");
            let job_exp = experience[content_val].replace(/'/g, "\'");
            let job_qual = qualification[content_val].replace(/'/g, "\'");
            return  appender(type, '<h1 class="title medium">Job Description</h1><ul><li><strong>Project Role:</strong>'+job_role+'</li><li><strong>Role Description:</strong>'+job_desc+'</li><li><strong>Skills:</strong>'+job_skills+'</li><li><strong>Experience:</strong>'+job_exp+'</li><li><strong>Qualification:</strong>'+job_qual+'</li><li><a href="javascript:void(0)" onclick="content(\'job_form\', '+content_val+')" class="btn btn_2">Apply Now</a></li></ul>');
        break;
        case "applicant_details":
            appender(type, ajax("applicant_details", class_names[(class_names.length)-1].replace(/sd_/g, "")));
        break;
        default:
            popup('error', 'Content unfound');
        break;
    }
}

//Append anything
function appender(type, val){
    switch(type){
        case "job_form": case "desc": case "applicant_details":
            $(".description").html(val);
        break;
        default:
            popup("error", "Application type unfound");
        break;
    }
}

//On form submit do nothing
$(document).on("submit", 'form', function(e){
    error = 0;
    e.preventDefault();
});


//verify details
function verify_details(type){
    switch (type){
        case "job_form":
            $('.description form input').each(function() {
                if ($(this).val() == '') { error++; }
            });
            if (error > 0) { popup("error", "All fields are mandatory"); } else { return "TRUE"; }
        break;
    }
}
