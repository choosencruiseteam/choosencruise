$(document).ready(function() {
  /*****************************************************************************
                              VARIABLES
  *****************************************************************************/
  //Search list generated on page load for drop down menus (3D Array)
  var searchListJson = {};

  /*****************************************************************************
                              HELPER FUNCTIONS
  *****************************************************************************/
  /*
  Made by: Chris
  Date: 3/9/2019
  Version: 1.0

  Helper function to switch the state of a button on and off.

  Example:
  $('#submitbutton').changeState(true); - Turn on button
  $('#submitbutton').changeState(false); - Turn off button
  */
  $.fn.changeState = function(state) {

    var active = "btn-primary";
    var disabled = "btn-secondary";

    if (state === true) { //Turn on button
      //Change color from blue to gray
      this.removeClass(disabled).addClass(active);
      //Turn disabled state on
      this.removeAttr('disabled');
    } else if (state === false) { //Turn off button
      //Change color from blue to gray
      this.removeClass(active).addClass(disabled);
      //Turn disabled state off
      this.attr('disabled', 'disabled');
    }

  };

  /*
  Made by: Chris
  Date: 3/9/2019
  Version: 1.0

  Helper function to convert a JSON object to a custom JS Object
  for the dropdown menu search terms
  */
  $.createSearchList = function(data) {
    for (var i = 0; i < data.length; ++i) {
      //Check 'make' array terms
      if (!searchListJson[data[i][0]]) {
        searchListJson[data[i][0]] = {};
      }

      //Check 'model' array
      if (!searchListJson[data[i][0]][data[i][1]]) {
        searchListJson[data[i][0]][data[i][1]] = [];
      }

      //Check 'year' arrays
      if (!(data[i][1] in searchListJson[data[i][0]][data[i][1]])) {
        searchListJson[data[i][0]][data[i][1]].push(data[i][2]);
      }
    }
  };

  /*
  Made by: Chris
  Date: 3/9/2019
  Version: 1.0

  Helper function to create a null <option> element
  */
  $.newNullDropdownItem = function(value){
    return "<option value=\"null\" class=\"dropdown-header text-dark\">"+value+"</option>";
  }

  /*
  Made by: Chris
  Date: 3/9/2019
  Version: 1.0

  Helper function to create a new <option> element. The parameter is used
  as the value and text
  */
  $.newDropdownItem = function(value){
    return "<option value=\""+value+"\" class=\"dropdown-header text-dark\">"+value+"</option>";
  }

  /*****************************************************************************
                              ON PAGE LOADERS
  *****************************************************************************/

  //Load head and footer data
  $('#header').load('../html/header.html');
  $('#footer').load('../html/footer.html');

  /*
    #make_dropdown - inflate make_dropdown with list of makes
  */
  //Turn off button while list is Loaded
  $('#submitsearch').changeState(false);
  $.get("/choosencruise/PHP/API/get-car.php?search=false", function(data, status) {
    //Parse incoming data into manipulatable array
    var jsonData = JSON.parse(data);

    //Populate searchListJson list fro DB
    $.createSearchList(jsonData);

    //Get make list
    var makeList = Object.keys(searchListJson);

    //Build option list for <select> element
    var list = $.newNullDropdownItem("Make...");
    //add returned data to option list
    for (index = 0; index < makeList.length; ++index) {
      list += $.newDropdownItem(makeList[index]);
      console.log();
    }
    //Assign list to #make_dropdown
    $('#make_dropdown').html(list);

    //Null #model_dropdown and #year_dropdown
    var nullOption = "<option value=\"null\">-</option>";
    $('#model_dropdown').html(nullOption);
    $('#year_dropdown').html(nullOption);

    //Activate submit button after list is loaded
    $('#submitsearch').changeState(true);

    console.log(JSON.stringify(makeList));
  });

  /*****************************************************************************
                                  ON CHANGE LISTENERS
  *****************************************************************************/
  //#make_dropdown onChange() listener
  $('#make_dropdown').change(function() {

    //disable submit button
    $('#submitsearch').changeState(false);

    //Get make_dropdown value
    var makeVal = $("#make_dropdown").val();

    if (makeVal != "null") {
      //Goto 'model' index on searchListJson
      var makeList = Object.keys(searchListJson[makeVal]);

      //Set loading status to model make_dropdown
      var loadingStatus = "<option value=\"null\">Loading...</option>";
      $('#model_dropdown').html(loadingStatus);
      $('#year_dropdown').html(loadingStatus);

      //build option list for <select> element
      var list = "<option value=\"null\">Make...</option>";
      //add data returned from query
      for (index = 0; index < makeList.length; ++index) {
        list += "<option value=\"" + makeList[index] + "\">" + makeList[index] + "</option>";
      }
      //assign option list to dropdown
      $('#model_dropdown').html(list);

      //clear year_dropdown
      var nullOption = "<option value=\"null\">-</option>";
      $('#year_dropdown').html(nullOption);


      //Activate button
      $('#submitsearch').changeState(true);

    } else {
      //Null #model_dropdown and #year_dropdown
      var nullOption = "<option value=\"null\">-</option>";
      $('#model_dropdown').html(nullOption);
      $('#year_dropdown').html(nullOption);

      //Activate button
      $('#submitsearch').changeState(true);
    }



  });

  /**************************************
    ON CHANGE LISTENER | #model_dropdown
  ***************************************/
  $('#model_dropdown').change(function() {

    //Disable button while function is running
    $('#submitsearch').changeState(false);

    //Get make_dropdown value
    var modelVal = $("#model_dropdown").val();

    if (modelVal != "null") {
      var makeVal = $("#make_dropdown").val();

      //Goto 'model' index on searchListJson
      var yearList = searchListJson[makeVal][modelVal];

      //Set loading status to model make_dropdown
      var loadingStatus = "<option value=\"null\">Loading...</option>";
      $('#year_dropdown').html(loadingStatus);


      //build option list for <select> element
      var list = "<option value=\"null\">Year...</option>";
      //add data returned from query
      for (index = 0; index < yearList.length; ++index) {
        list += "<option value=\"" + yearList[index] + "\">" + yearList[index] + "</option>";
      }

      //assign option list to dropdown
      $('#year_dropdown').html(list);

      //Activate button
      $('#submitsearch').changeState(true);

    } else {
      //Null #model_dropdown and #year_dropdown
      var nullOption = "<option value=\"null\">-</option>";
      $('#year_dropdown').html(nullOption);

      //Activate button
      $('#submitsearch').changeState(true);
    }
  });

  /*****************************************************************************
                                      ON CLICK LISTENER
  *****************************************************************************/


  //Submit button click listener
  var times = 0.0;
  var totalTime = 0.0;
  //Submit button listener
  $('#submitsearch').click(function() {
    var t0 = performance.now();

    //Disable button
    $('#submitsearch').changeState(false);

    //Set loading Status
    $("#card_deck").html("<div class=\"spinner-border text-primary mt-3 mx-auto\"" +
      "role=\"status\"><span class =\"sr-only\">Loading...</span></div>");

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
      var jsonData = JSON.parse(data);

      //US Currency Formatter
      const formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2
      });

      var deck = "";
      for (var i = 0; i < jsonData.length; ++i) {
        deck += "<div class=\"card mx-auto mb-3 border-secondary\"" +
          "style=\"min-width:260px;max-width:260px\">" +
          "<img src=\"../assets/placeholder_img_v2.png\" height=\"180\" width=\"260\" class=\"card-img-top\" alt=\"...\">" +
          "<div class=\"card-body\">" +
          "<h5 class=\"card-title\">" + jsonData[i].year + " " + jsonData[i].make + "<br>" + jsonData[i].model + " " + jsonData[i].trim + "</h5>" +
          "<p class=\"card-title\"><u>" + jsonData[i].name + "</u><br>" + jsonData[i].street + "<br>" + jsonData[i].city + " " + jsonData[i].zip + "</p>" +
          "<hr>" +
          "<h5 class=\"card-text\">Posted Price:<br>" + formatter.format(jsonData[i].price) + "</h5>" +
          "<h5 class=\"card-text\">KBB Price:<br> $19,650</h5>" +
          "<p class=\"card-text\"><small class=\"text-muted\">Last Update: " + jsonData[i].date + "</small></p>" +
          "<input type=\"hidden\" id=\"car_id\" name=\"car_id\" value=" + jsonData[i].car_id + ">" +
          "</div>" +
          "</div>";
      }

      $("#card_deck").html(deck);
      var t1 = performance.now();

      totalTime += (t1 - t0);
      times++;

      //Activate button
      $('#submitsearch').changeState(true);
      console.log("Clicks: " + times + "\nAvg: " + (totalTime / times) + "ms");
    });

  });

});
