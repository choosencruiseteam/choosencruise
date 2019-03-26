$(document).ready(function() {
  /*****************************************************************************
                          REFERENCE MATERIAL
  *****************************************************************************/
  /*
    CAROUSEL COMPONENT FORMATS

  *** Carousel indicators***
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>

  ***Carousel items***
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="../assets/placeholder_img_v2.png" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="../assets/placeholder_img_v2.png" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="../assets/placeholder_img_v2.png" alt="Third slide">
    </div>
  </div> 
  */

  /*******************************************************************************
                          HELPER FUNCTIONS
  *******************************************************************************/

  /*
    Helper function to get URL parameters

    Example:
      URL:
        http://www.site.com?var=true

      Function example:
        var = $.getUrlParameter('var')
        var == true
  */
  $.getUrlParameter = function(sParam) {
    var sPageURL = window.location.search.substring(1),
      sURLVariables = sPageURL.split('&'),
      sParameterName, i;

    for (i = 0; i < sURLVariables.length; i++) {
      sParameterName = sURLVariables[i].split('=');

      if (sParameterName[0] === sParam) {
        return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
      }
    }
  };

  /*
    helper function to format phone

    Example:
    var ph = 1002003000;
    var newPh = $.phoneFormat(ph);
    newPh == (100)-200-3000
  */
  $.phoneFormat = function(phone) {
    return phone.replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, '($1)-$2-$3');
  }

  /*****************************************************************************
                              ON PAGE LOADERS
  *****************************************************************************/

  //Load head and footer layouts
  $('#header').load('../html/header.html');
  $('#footer').load('../html/footer.html');

  //Load car data. If infomation is null or invalid redirect to 404.
  var reqURL = "/choosencruise/PHP/API/get-car.php?detail=" + $.getUrlParameter('car');
  $.get(reqURL, function(data, status) {
    console.log("Status: " + status + "\nData: " + data);
    if (status == "success") {
      //only display details if car data exists, otherwise redirect to 404
      if (data != "null") {

        //Currency formatter
        const formatter = new Intl.NumberFormat('en-US', {
          style: 'currency',
          currency: 'USD',
          minimumFractionDigits: 2
        });

        //Parse response from server
        var car = JSON.parse(data)[0];

        //Insert data into elements
        $('#car_name').html(car.make + " " + car.model + " " + car.trim + " " + car.year);
        $('#car_price').html("Posted Price: " + formatter.format(car.price));
        $('#car_engine').html("Engine: " + car.engine);
        $('#car_transmission').html("Transmission: " + car.transmission);
        $('#car_miles').html("Mileage: " + car.mileage + "mi");

        $('#carlot_name').html(car.name);
        $('#carlot_address').html(car.street);
        $('#carlot_city_state_zip').html(car.city + ", " + car.state + ", " + car.zip);
        $('#carlot_phone').html($.phoneFormat(car.phone));

        //If img album exsists for the car, request links from imgur and insert
        $('#carousel_loading_state').remove();
        if (car.album != null) {

          //Setting params for imgur API request
          var settings = {
            "url": "https://api.imgur.com/3/album/" + car.album + "/images",
            "method": "GET",
            "timeout": 0,
            "headers": {
              "Authorization": "Client-ID 24e7752611ea41f"
            },
          };

          //AJAX request to imgur API
          $.ajax(settings).done(function(response) {
            var numOfImgs = response.data.length;

            // If no imgs are returned or api failure occurs use 'No img avail'
            // image
            if (numOfImgs < 1 || response.success == false) {
              var noImgAvail = "<div class=\"carousel-inner\">" +
                "<div class=\"carousel-item active\">" +
                "<img class=\"d-block w-100\" src=\"../assets/placeholder_img_v2.png\" alt=\"First slide\">" +
                "</div>"
              "</div>";

              $('#car_carousel').html(noImgAvail);
            } else {

              // If images exist carousel will be activated, and images will
              // be inserted into carousel.
              $('#carousel-indicators').removeClass("invisible");
              $('#carousel-inner').removeClass("invisible");
              $('#carousel-control-prev').removeClass("invisible");
              $('#carousel-control-next').removeClass("invisible");

              // Iterate through each response index, then create one carousel item
              // and indicator per image.
              for (var i = 0; i < numOfImgs; ++i) {

                var imgURL = response.data[i].link;
                //Inserting image URL into carousel item template
                var imgItem = "<div class=\"carousel-item \" id=\"item-" + i + "\">" +
                  "<img class=\"d-block w-100\" src=\"" + imgURL + "\" alt=\"Slide " + (i + 1) + "\">" +
                  "</div>";
                //Create matching indicator per img
                var indicator = "<li id=\"indic-" + i + "\" data-target=\"#car_carousel\" data-slide-to=\"" + i + "\"></li>";

                //append item and indicator into carousel
                $('#carousel-inner').append(imgItem);
                $('#carousel-indicators').append(indicator);

                //Set first image inserted to active status
                if (i == 0) {
                  $('#item-0').addClass("active");
                  $('#indic-0').addClass("active");
                }

              }
            }

          });
        } else {
          // If no images are available from server, a "No image available" image
          // will be inserted into carousel.
          var noImgAvail = "<div class=\"carousel-inner\">" +
            "<div class=\"carousel-item active\">" +
            "<img class=\"d-block w-100\" src=\"../assets/placeholder_img_v2.png\" alt=\"First slide\">" +
            "</div>"
          "</div>";

          $('#car_carousel').html(noImgAvail);
        }
      } else {
        window.location.replace("/choosencruise/html/404.html");
      }
    }
  });

});
