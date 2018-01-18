$(document).ready(function(){ 
    loadContent("main");
})

function loadContent(content) {
    $('.main-content').load("pages/" + content + ".html");
}