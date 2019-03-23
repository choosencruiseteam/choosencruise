$(document).ready(function() {

  //Helper function to get URL parameters
  $.getUrlParameter = function(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),sParameterName,i;

    for (i = 0; i < sURLVariables.length; i++) {
      sParameterName = sURLVariables[i].split('=');

      if (sParameterName[0] === sParam) {
        return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
      }
    }
  };

  //helper function to format phone NumberFormat
  $.telFormat = function(tel){
    return tel.replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, '($1)-$2-$3');
  }

  /*****************************************************************************
                              ON PAGE LOADERS
  *****************************************************************************/

  //Load head and footer layouts
  $('#header').load('../html/header.html');
  $('#footer').load('../html/footer.html');

  //Load car data, if infomation is null or invalid, redirect to 404
  var reqURL = "/choosencruise/PHP/API/get-car.php?detail=" + $.getUrlParameter('car');
  $.get(reqURL, function(data, status){
      console.log("Status: " + status + "\nData: " + data);
      if(status == "success"){
        if(data != "null"){

          const formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: 2
          });

          var car = JSON.parse(data)[0];

          $('#car_name').html(car.make + " " + car.model + " " + car.trim + " " + car.year );
          $('#car_price').html("Posted Price: " + formatter.format(car.price));
          $('#car_engine').html("Engine: " + car.engine);
          $('#car_transmission').html("Transmission: " + car.transmission);
          $('#car_miles').html("Mileage: "+car.mileage+"mi");

          $('#carlot_name').html(car.carlot_name);
          $('#carlot_address').html(car.street);
          $('#carlot_city_state_zip').html(car.city +", "+ car.state+", "+car.zip);
          $('#carlot_tel').html($.telFormat(car.phone));

        }else{
          window.location.replace("/choosencruise/html/404.html");
        }
      }
  });

});
