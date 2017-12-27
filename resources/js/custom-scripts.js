var sidebarOpen = false;
var projectsOpen = false;

$(document).ready(function() {
  $("#sidebar-toggle").on("click", function() {
    if (sidebarOpen == false) {
      $("#sidebar").animate({
        right: "0px"
      }, 300);
      
      var hamburgerBars = document.getElementsByClassName("hamburger-bar");
      
      for (var i = 0; i < hamburgerBars.length; ++i)
        $(hamburgerBars[i]).hide(300);
      
      $(".positive-slope-line").show(300);
      $(".negative-slope-line").show(300);
      
      sidebarOpen = true;
    } else {
      $("#sidebar").animate({
        right: "-250px"
      }, 300);
      
      var hamburgerBars = document.getElementsByClassName("hamburger-bar");
      
      for (var i = 0; i < hamburgerBars.length; ++i)
        $(hamburgerBars[i]).show(300);
      
      $(".positive-slope-line").hide(300);
      $(".negative-slope-line").hide(300);
      
      sidebarOpen = false;
    }
  });
  
  $("#projects-toggle").on("click", function() {
    $("#projects-submenu").animate({
      display: "inline-block"
    }, 300);
  });
});