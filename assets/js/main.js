//Global variables
var icon, timer;

//PopUp
function popup(type, value){
    if ($(".popup").length > 0) { clearTimeout(timer); $(".popup").remove(); }
    $("body").append('<aside class="popup fixed_flex"><a href="javascript:void(0)" class="close medium" onclick="closer(\'popup\')"><iconify-icon icon="line-md:close-small"></iconify-icon></a><iconify-icon icon="tdesign:shield-error" class="icon icon-'+type+' big"></iconify-icon><article><h2 class="title small">'+type+'!</h2><p>'+value+'</p></article></aside>');
    setTimeout(function(){ $(".popup").remove(); }, 8000);
}


//Close
function closer(type){
    $("."+type).remove();
    clearTimeout(timer);
}
