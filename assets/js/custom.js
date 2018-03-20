$(document).ready(function () {
    "use strict";
        /*Menu-toggle*/
    $("#menu-toggle").click(function (e) {        
        e.preventDefault();
        $("#wrapper").toggleClass("active");
    });    
    /*sidebar*/
    
    $('.modal').modal();  

//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
    $(function () {
        
        var url = window.location;
        var element = $('ul.nav a').filter(function () {
            return this.href === url;
        }).addClass('active').parent().parent().addClass('in').parent();

        var element = $('ul.nav a').filter(function () {
            return this.href === url;
        }).addClass('active').parent();

        while (true) {
            if (element.is('li')) {
                element = element.parent().addClass('in').parent();
            } else {
                break;
            }
        }
        $('#side-menu').metisMenu();
        
    });
});

