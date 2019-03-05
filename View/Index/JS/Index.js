$(document).ready(function() {
  $.loadHeader = function(){
    $('#header').load('header/header.html');
  }
});

function displayHeader(){
  $.loadHeader();
}
