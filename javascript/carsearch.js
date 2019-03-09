//Helper function to create a new card
function newCard(cardData) {

  var template = "<div class=\"card mx-auto mb-3 \" style=\"min-width:260px;max-width:260px\">" +
    "<img src=\"../assets/placeholder_img_v2.png\" height=\"180\" width=\"260\" class=\"card-img-top\" alt=\"...\">" +
    "<div class=\"card-body\">" +
    "<h5 class=\"card-title\">2019 Toyota <br>Corolla S</h5>" +
    "<p class=\"card-title\"><u>Torres Toyota</u><br>1234 Fake St.<br>San, antonio TX 78264</p>" +
    "<hr>" +
    "<h5 class=\"card-text\">Posted Price:<br> $19,800</h5>" +
    "<h5 class=\"card-text\">KBB Price:<br> $19,650</h5>" +
    "<p class=\"card-text\"><small class=\"text-muted\">Last Update: 12/21/2049</small></p>" +
    "</div>" +
    "</div>";
}

$(document).ready(function() {

  /*******************************************
                ON PAGE LOADERS
  ********************************************/

  //Load head and footer data
  $('#header').load('../html/header.html');
  $('#footer').load('../html/footer.html');

  /*
    #make_dropdown - inflate make_dropdown with list of makes
  */
  $.get("/choosencruise/PHP/API/get-car.php?search=true", function(data, status) {

    //Parse incoming data into manipulatable array
    var jsonData = JSON.parse(data);
    //Build option list for <select> element
    var list = "<option value=\"null\" class=\"dropdown-header\">Make...</option>";
    //add returned data to option list
    for (index = 0; index < jsonData.length; ++index) {
      list += "<option value=\"" + jsonData[index] + "\">" + jsonData[index] + "</option>";
    }
    //Assign list to #make_dropdown
    document.getElementById("make_dropdown").innerHTML = list;

    //Null #model_dropdown and #year_dropdown
    var nullOption = "<option value=\"null\" class=\"dropdown-header\">-</option>";
    document.getElementById("model_dropdown").innerHTML = nullOption;
    document.getElementById("year_dropdown").innerHTML = nullOption;

  });

  /*
    #cartable - Initialize cartable
  */
  var headerRow = "<tr><th>VIN</th><th>Carlot ID</th><th>Posted Price</th>" +
    "<th>Price updated</th><th>Make</th><th>Model</th>" +
    "<th>Trim</th><th>Year</th><th>Engine</th>" +
    "<th>Transmission</th></tr>";
  var emptyRow = "<tr><td colspan=11 style=\"text-align:center\" >Please search for an item...</td></tr>";
  $("#cartable").html(headerRow + emptyRow);

  /**************************************
            ON CHANGE LISTENERS
  ***************************************/
  //#make_dropdown onChange() listener
  $("#make_dropdown").change(function() {
    //Get make_dropdown value
    var make = $("#make_dropdown").val();

    if (make != "null") {
      //Set loading status to model make_dropdown
      var loadingStatus = "<option value=\"null\">Loading...</option>";
      document.getElementById("model_dropdown").innerHTML = loadingStatus;
      document.getElementById("year_dropdown").innerHTML = loadingStatus;

      //GET request for years WHERE make=make.val()
      $.get("/choosencruise/PHP/API/get-car.php?search=true&make=\"" + make + "\"", function(data, status) {
        //Parse incoming data
        var jsonData = JSON.parse(data);
        //build option list for <select> element
        var list = "<option value=\"null\">Make...</option>";
        //add data returned from query
        for (index = 0; index < jsonData.length; ++index) {
          list += "<option value=\"" + jsonData[index] + "\">" + jsonData[index] + "</option>";
        }
        //assign option list to dropdown
        document.getElementById("model_dropdown").innerHTML = list;

        //clear year_dropdown
        var nullOption = "<option value=\"null\">-</option>";
        document.getElementById("year_dropdown").innerHTML = nullOption;

      });
    } else {
      //Null #model_dropdown and #year_dropdown
      var nullOption = "<option value=\"null\">-</option>";
      document.getElementById("model_dropdown").innerHTML = nullOption;
      document.getElementById("year_dropdown").innerHTML = nullOption;
    }



  });

  /**************************************
    ON CHANGE LISTENER | #model_dropdown
  ***************************************/
  $("#model_dropdown").change(function() {

    //Get make_dropdown value
    var model = $("#model_dropdown").val();

    if (model != "null") {
      var make = $("#make_dropdown").val();

      //Set loading status to model make_dropdown
      var loadingStatus = "<option value=\"null\">Loading...</option>";
      document.getElementById("year_dropdown").innerHTML = loadingStatus;

      //GET request for years
      var getString = "/choosencruise/PHP/API/get-car.php?search=true"
      getString += "&make=\"" + make + "\"";
      getString += "&model=\"" + model + "\"";

      $.get(getString, function(data, status) {
        //Parse incoming data
        var jsonData = JSON.parse(data);
        //build option list for <select> element
        var list = "<option value=\"null\">Year...</option>";
        //add data returned from query
        for (index = 0; index < jsonData.length; ++index) {
          list += "<option value=\"" + jsonData[index] + "\">" + jsonData[index] + "</option>";
        }

        //assign option list to dropdown
        document.getElementById("year_dropdown").innerHTML = list;

      });


    } else {
      //Null #model_dropdown and #year_dropdown
      var nullOption = "<option value=\"null\">-</option>";
      document.getElementById("year_dropdown").innerHTML = nullOption;
    }
  });

  /*******************************************
  ON CLICK LISTENER | search submit button
  *******************************************/
  var times = 0.0;
  var totalTime = 0.0;
  //Submit button listener
  $("#submitsearch").click(function() {
    var t0 = performance.now();
    //Get search terms
    var make = $("#make_dropdown").val();
    var model = $("#model_dropdown").val();
    var year = $("#year_dropdown").val();
    var zip = String($("#zip_textbox").val());
    var zipRegex = /^(\d{5})$/;

    /*
      WORK IN PROGRESS -(Chris)
      TODO:
      -Implement regex check (done)
      -Check input to list of Texas postal codes

    console.log("\"" + zip + "\" " + zipRegex.test(zip));
    if(zipRegex.test(zip)){
      var dest = '78258';
      var service = new google.maps.DistanceMatrixService();
      service.getDistanceMatrix({
        origins: [zip],
        destinations: [dest],
        travelMode: 'DRIVING',
        unitSystem: google.maps.UnitSystem.IMPERIAL,
      }, function(data, status) {
          alert("Status: " + status + " Data: " + JSON.stringify(data));
      });
    }

    var loadRow = "<tr><td colspan=11 style=\"text-align:center\ >Loading...Please wait</td></tr>";
    $("#cartable").html(headerRow + loadRow);
    */
    /*
      If all search terms (all dropdowns) are null, the search will default to
      getting all the cars in the database. Otherwise a search will
      be done with any of the provided search terms.
    */
    if (make === "null" && model === "null" && year === "null") {
      //If where=false, all cars will be requested from DB
      var getString = "/choosencruise/PHP/API/get-car.php?where=false";
    } else {
      //If where=true, the query will be filtered by the search terms
      var getString = "/choosencruise/PHP/API/get-car.php?where=true";
      var searchTerms = [];

      if (make !== "null") {
        searchTerms.push("make=\"" + make + "\"");
      }
      if (model !== "null") {
        searchTerms.push("model=\"" + model + "\"");
      }
      if (year !== "null") {
        searchTerms.push(term1 = "year=\"" + year + "\"");
      }

      for (var i = 0; i < searchTerms.length; ++i) {
        getString += "&"
        getString += searchTerms[i];
      }
    }


    // GET request to server for cars that will build car
    // table data.
    $.get(getString, function(data, status) {
      var jsonData = JSON.parse(data)

      //US Currency Formatter
      const formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2
      })

      var deck = "";
      for (var i = 0; i < jsonData.length; ++i) {
        deck += "<div class=\"card mx-auto mb-3 \" style=\"min-width:260px;max-width:260px\">" +
          "<img src=\"../assets/placeholder_img_v2.png\" height=\"180\" width=\"260\" class=\"card-img-top\" alt=\"...\">" +
          "<div class=\"card-body\">" +
          "<h5 class=\"card-title\">"+jsonData[i].year+" "+jsonData[i].make+"<br>"+jsonData[i].model+" "+jsonData[i].trim+"</h5>" +
          "<p class=\"card-title\"><u>"+jsonData[i].name+"</u><br>"+jsonData[i].street+"<br>"+jsonData[i].city+" "+jsonData[i].zip+"</p>" +
          "<hr>" +
          "<h5 class=\"card-text\">Posted Price:<br>"+formatter.format(jsonData[i].price)+"</h5>" +
          "<h5 class=\"card-text\">KBB Price:<br> $19,650</h5>" +
          "<p class=\"card-text\"><small class=\"text-muted\">Last Update: "+jsonData[i].date+"</small></p>" +
          "<input type=\"hidden\" id=\"car_id\" name=\"car_id\" value="+jsonData[i].car_id+">"+
          "</div>" +
          "</div>";
      }

      $("#card_deck").html(deck);
      var t1 = performance.now();

      totalTime += (t1 - t0);
      times++;

      console.log("Clicks: " + times + "\nAvg: " + (totalTime / times) + "ms");
    });

  });

});
