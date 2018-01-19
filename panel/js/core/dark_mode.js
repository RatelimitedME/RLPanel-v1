function activateDark() {
    document.cookie = "dark=true";
    $("body").animate({"background-color": "#212121"}, 300);
    $(".card").animate({"background-color": "#161616"}, 300);
    $("p, h3, h4, span, label").animate({"color": "#fafafa"}, 300);
    $('#toggle').attr('onClick','activateLight()');
    
}

function activateLight() {
    document.cookie = "dark=false";
    $("body").removeAttr("style");
    $(".card").removeAttr("style")
    $("p, h3, h4, span, label").removeAttr("style")
    $('#toggle').attr('onClick','activateDark()');
}