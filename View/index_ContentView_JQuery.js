$(document).ready(function(){

  $.get("../Controller/get-all-cars.php",function(data,status){
    $JSON = JSON.parse(data);
    document.getElementById("clicktest").innerHTML = JSON.stringify($JSON);

    console.debug("Status:" + status + " " + JSON.stringify($JSON));
  });

});
