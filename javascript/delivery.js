$(document).ready(function() {

  /*
    Helper function to get URL parameters

    Solution found from:
    https://stackoverflow.com/questions/19491336/get-url-parameter-jquery-or-how-to-get-query-string-values-in-js

    Example:
      URL:
        http://www.site.com?var=true

      Function example:
        var = $.getUrlParameter('var')
        var == true
  */
  $.getUrlParameter = function(sParam) {
    //Get param from URL
    var sPageURL = window.location.search.substring(1);
    //explode params into array
    sURLVariables = sPageURL.split('&');
    var sParameterName, i;

    //Iterate through each name=var
    for (i = 0; i < sURLVariables.length; i++) {
      //explode each param into name and variable
      sParameterName = sURLVariables[i].split('=');

      //if request param name matches current index
      if (sParameterName[0] === sParam) {
        //if param variable is undefined, return null, else return value
        return sParameterName[1] === undefined ? null : decodeURIComponent(sParameterName[1]);
      }
    }
  };

  $.setErrors = function(data) {
    data.forEach(function(index) {
      $('#' + index.field).addClass('is-invalid');
      $('#err').append(index.msg + "<br>");
    });

    $('#err').removeClass('d-none');
  }

  $.resetFields = function() {
    $($('form').prop('elements')).each(function() {
      var $field = $(this);
      $field.removeClass('is-invalid');
    });
    $('#err').addClass('d-none');
    $('#err').html('<div>Please verify your contact information. If any information is incorrect, please update it:</div>');
  }

  //Load head and footer data
  $('#footer').load('./html/footer.php');
  $('#header').load('./html/header.php');

  $('#user').val($('#username_id').val());
  $('#car').val($.getUrlParameter('car'));

  //Load field data
  //load customer info module
  var reqURL = "/choosencruise/PHP/API/get-user.php";
  $.get(reqURL, function(data, status) {
    if (data != null && status == 'success') {
      var user_data = JSON.parse(data)[0];

      $('#username').val(user_data['username']);
      $('#fname').val(user_data['first_name']);
      $('#lname').val(user_data['last_name']);
      $('#street').val(user_data['street']);
      $('#city').val(user_data['city']);
      $('#state').val(user_data['state']);
      $('#zip').val(user_data['zip']);
      $('#phone').val(user_data['phone']);
    }
  });
  //load vehicle info
  //Load car data. If infomation is null or invalid redirect to 404.
  var reqURL = "/choosencruise/PHP/API/get-car.php?detail=" + $.getUrlParameter('car');
  $.get(reqURL, function(data, status) {
    if (status == "success" && data != "null") {
      var car = JSON.parse(data)[0];

      var hash = car.img;

      if (hash != null) {
        var settings = {
          "url": "https://api.imgur.com/3/image/" + hash,
          "method": "GET",
          "timeout": 0,
          "headers": {
            "Authorization": "Client-ID 24e7752611ea41f"
          },
        };

        $.ajax(settings).done(function(response) {
          var imgURL = response.data.link;
          $("#vehicle_img").attr('src',imgURL);

        });
      } else {
        //Assign 'no image available' to frame
        $("#vehicle_img").attr('src',"https://i.imgur.com/l5ysJiD.png");
      }
    }

    $('#vehicle_name').html(car.year + " " + car.make + "<br>" + car.model + " " + car.trim);
    $('#vehicle_engine').html("Engine: " + car.engine);
    $('#vehicle_transmission').html("Transmission: " + car.transmission);
    $('#vehicle_mileage').html("Mileage: " + car.mileage);

    $('#posted_price_breakdown').html(car.price);

    //US Currency Formatter
    const formatter = new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'USD',
      minimumFractionDigits: 2
    });

    var price = parseFloat(car.price);
    var tax = parseFloat(price * .0825);
    var del_charge = parseFloat(price * .025);
    var final_price = parseFloat(price + tax + del_charge);


    $('#taxes_breakdown').html(tax);
    $('#delivery_charge_breakdown').html(del_charge);
    $('#final_price_breakdown').html(final_price);
    $('#final_price').val(final_price);


    $('#delivery_charge').val(formatter.format(del_charge));

  });

  //Handle submission
  $('form').on("submit", function(event) {
    event.preventDefault();
    $.resetFields();

    var url = event.currentTarget.action;

    $('#submit-btn').removeClass("btn-primary").addClass("btn-secondary");
    $('#submit-btn').attr('disabled','disabled');
    $('#load_spinner').removeClass('invisible');

    $.ajax({
      url: url,
      type: 'post',
      data: $('#delivery_form').serialize(),
      success: function(data) {
        var response = JSON.parse(data);
        var status = response.status;

        if (status == true) {
            window.location.href = "http://localhost/choosencruise/confirmation?delivery"
        } else if (status == false) {
          //turn off loading spinner, turn on button
          $('#submit-btn').removeClass("btn-secondary").addClass("btn-primary");
          $('#submit-btn').removeAttr('disabled');
          $('#load_spinner').addClass('invisible');

          //display err msg
          $.setErrors(response.data);
        }
      },
      error: function(data){
        console.log("An error with the request has occured.")
      }
    });

  });
});
