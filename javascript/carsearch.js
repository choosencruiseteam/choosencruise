$(document).ready(function() {
  /*------------------------- CARSEARCH.JS ------------------------------------

  By: Christopher Torres
  Version: 1.0
  Date: 3/18/2019
  Libraries used: JQuery, Javascript

  Purpose:
  This file handles all javascript operations for the car search page.

  Section Index:
  -VARIABLES: Hold global variables
  -HELPER FUNCTIONS: Implementations of helper functions used in file
  -ON PAGE LOADERS: Functions that run when the page is loaded
  -ON CHANGE LISTENERS: Functions that run when an element changes
  -ON CLICK LISTENERS: Functions that run when a element is clicked

   ---------------------------------------------------------------------------*/

  /*****************************************************************************
                              VARIABLES
  *****************************************************************************/
  /*
    Search list generated on page load for drop down menus

    Structure: {
                  'make':{ 'model':['1992','1993'], 'model':['2000','2001']  },
                  'make':{ 'model':['1992','1993'], 'model':['2000','2001']  }
                }
  */
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

  }

  /*
  Made by: Chris
  Date: 3/9/2019
  Version: 1.0

  Helper function to convert a JSON object to a custom JS Object
  for the dropdown menu search terms.

  Pre-format: 3 column mySql table
  =======================
  | make | model | year |
  -----------------------
  | Data | Data | Data |
  | Data | Data | Data |
  | Data | Data | Data |
  ======================

   Post-Format: 3D JSON Object
   {
      'make':{'model':['2000',2001],'model':['year','year']} ,
      'Toyota':{'Corolla':['2000',2001],'model':['year','year']}
   }

  */
  $.createSearchList = function(data) {
    for (var i = 0; i < data.length; ++i) {
      //'make' index operation
      if (!searchListJson[data[i][0]]) {
        searchListJson[data[i][0]] = {};
      }

      //'model' index operation
      if (!searchListJson[data[i][0]][data[i][1]]) {
        searchListJson[data[i][0]][data[i][1]] = [];
      }

      //'year' index operation
      if (!(data[i][1] in searchListJson[data[i][0]][data[i][1]])) {
        searchListJson[data[i][0]][data[i][1]].push(data[i][2]);
      }
    }
  }

  /*
  Made by: Chris
  Date: 3/13/2019
  Version: 1.0

  Creates a GET request value string with the passed parameters

  Output:
  " make='Toyota'&model='Corolla'&year='2018'&zip=78109,78258  "
  */

  $.getRequestValues = function(make, model, year, location) {
    console.log("GetValues recieved: \n" + make + "\n" + model + "\n" + year + "\n" + location);
    if ((make == "null") && (model == "null") && (year == "null") && (location == null)) {
      console.log("GetValues Returning: NULL");
      return null;
    } else {
      //If where=true, the query will be filtered by the search terms
      var searchTerms = [];
      var values = "";

      //make='Toyota'
      if (make !== "null") {
        searchTerms.push("make=\"" + make + "\"");
      }
      //model='Corolla'
      if (model !== "null") {
        searchTerms.push("model=\"" + model + "\"");
      }
      //year='2017'
      if (year !== "null") {
        searchTerms.push("year=\"" + year + "\"");
      }
      //zip=78258,78109
      if (location !== null) {
        //Add zips to car GET request string
        var getString = "zip=";
        for (var i = 0; i < location.length; ++i) {

          getString += location[i];

          if ((i + 1) != location.length)
            getString += ",";
        }

        searchTerms.push(getString);
      }

      for (var i = 0; i < searchTerms.length; ++i) {
        values += "&"
        values += searchTerms[i];
      }
      console.log("GetValues Returning: " + values);
      return values;
    }
  }

  /*
  Made by: Chris
  Date: 3/18/2019
  Version: 1.0

  This function accepts a get-car.php/where?params call to get cars from the DB.
  If cars are found, the data is inserted into card HTML elements and pushed to the
  card deck. If no results are found, a message is displayed saying nothing was
  found.

  Returns: Nothing
  */
  $.setCardDeck = function(getString) {

    $.get(getString, function(data, status) {

      var jsonData = JSON.parse(data);

      if (jsonData != null) {
        //US Currency Formatter
        const formatter = new Intl.NumberFormat('en-US', {
          style: 'currency',
          currency: 'USD',
          minimumFractionDigits: 2
        });

        //Clear table before appending cards
        $("#card_deck").html("");

        var card = "";
        for (var i = 0; i < jsonData.length; ++i) {
          var hash = jsonData[i].img;

          if (hash != null) {
            var settings = {
              "url": "https://api.imgur.com/3/image/" + hash,
              "method": "GET",
              "timeout": 0,
              "jsonData": jsonData[i],
              "headers": {
                "Authorization": "Client-ID 24e7752611ea41f"
              },
            };

            $.ajax(settings).done(function(response) {
              var imgURL = response.data.link;

              card = "<div class=\"card mx-auto mb-3 border-secondary\" id=\"card\"" +
                "style=\"min-width:300px;max-width:300px;min-height:475px;\">" +
                "<a href=\"./details?car=" + this.jsonData.car_id + "\" style=\"height:200px;\">" +
                "<img src=\""+imgURL+"\" height=\"auto\" width=\"300\" class=\"card-img-top p-1\" alt=\"...\">" +
                "</a>" +
                "<div class=\"card-body\"><hr>" +
                "<h5 class=\"card-title\">" + this.jsonData.year + " " + this.jsonData.make + "<br>" + this.jsonData.model + " " + this.jsonData.trim + "</h5>" +
                "<p class=\"card-title\"><u>" + this.jsonData.name + "</u><br>" + this.jsonData.street + "<br>" + this.jsonData.city + " " + this.jsonData.zip + "</p>" +
                "<hr>" +
                "<h5 class=\"card-text\">Posted Price:<br>" + formatter.format(this.jsonData.price) + "</h5>" +
                //"<h5 class=\"card-text\">KBB Price:<br> $19,650</h5>" +
                "<p class=\"card-text\"><small class=\"text-muted\">Last Update: " + this.jsonData.date + "</small></p>" +
                "</div>" +
                "</div>";

              $("#card_deck").append(card);
            });
          } else {
            card = "<div class=\"card mx-auto mb-3 border-secondary\" id=\"card\"" +
              "style=\"min-width:300px;max-width:300px;min-height:475px;\">" +
              "<a href=\"./details?car=" + jsonData[i].car_id + "\" style=\"height:200px;\">" +
              "<img src=\"https://i.imgur.com/l5ysJiD.png\" height=\"auto\" width=\"300\" class=\"card-img-top p-1\" alt=\"...\">" +
              "</a>" +
              "<div class=\"card-body\"><hr>" +
              "<h5 class=\"card-title\">" + jsonData[i].year + " " + jsonData[i].make + "<br>" + jsonData[i].model + " " + jsonData[i].trim + "</h5>" +
              "<p class=\"card-title\"><u>" + jsonData[i].name + "</u><br>" + jsonData[i].street + "<br>" + jsonData[i].city + " " + jsonData[i].zip + "</p>" +
              "<hr>" +
              "<h5 class=\"card-text\">Posted Price:<br>" + formatter.format(jsonData[i].price) + "</h5>" +
              //"<h5 class=\"card-text\">KBB Price:<br> $19,650</h5>" +
              "<p class=\"card-text\"><small class=\"text-muted\">Last Update: " + jsonData[i].date + "</small></p>" +
              "</div>" +
              "</div>";

            $("#card_deck").append(card);
          }

        }

      } else {
        var noResult = "<div class=\"card px-1\"><h3>No results found...</h3></div>"
        $("#card_deck").html(noResult);
      }

    });
  }

  /*
  Made by: Chris
  Date: 3/18/2019
  Version: 1.0

  This function flattens a JSON object to a 1d array.

  WARNING: The elements of the array are casted into strings for use in
            the Google distance matrix API.

  Example Input: [['78109'],['78258'],['78249']]
  Example output: ["78109","78258","78249"]

  */
  $.flattenArray = function(OldArr) {
    var newArr = [];

    for (var i = 0; i < OldArr.length; ++i) {
      newArr.push(String(OldArr[i]));
    }

    return newArr;
  }

  /*
  Made by: Chris
  Date: 3/9/2019
  Version: 1.0

  Helper function to create a null <option> element
  */
  $.newNullDropdownItem = function(value) {
    return "<option value=null class=\"dropdown-header text-dark\">" + value + "</option>";
  }

  /*
  Made by: Chris
  Date: 3/9/2019
  Version: 1.0

  Helper function to create a new <option> element. The parameter is used
  as the value and text
  */
  $.newDropdownItem = function(value) {
    return "<option value=\"" + value + "\" class=\"dropdown-header text-dark\">" + value + "</option>";
  }

  /*****************************************************************************
                              ON PAGE LOADERS
  *****************************************************************************/

  //Load head and footer data
  $('#header').load('./html/header.php');
  $('#footer').load('./html/footer.php');

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
    }
    //Assign list to #make_dropdown
    $('#make_dropdown').html(list);

    //Null #model_dropdown and #year_dropdown
    var nullOption = $.newNullDropdownItem("-");
    $('#model_dropdown').html(nullOption);
    $('#year_dropdown').html(nullOption);

    //Activate submit button after list is loaded
    $('#submitsearch').changeState(true);
  });

  /*****************************************************************************
                                  ON CHANGE LISTENERS
  *****************************************************************************/
  /*
    #make_dropdown onChange() listener

    This event listener waits for a change in the make_dropdown menu, then
    waterfalls the correct search terms to the dropdowns below it.
  */
  $('#make_dropdown').change(function() {

    //disable submit button
    $('#submitsearch').changeState(false);

    //Get make_dropdown value
    var makeVal = $("#make_dropdown").val();

    if (makeVal != "null") {
      // Goto 'model' index on searchListJson - see searchListJson format
      // in VARIABLES (top of the page) section
      var makeList = Object.keys(searchListJson[makeVal]);

      //Set loading status to model make_dropdown
      var loadingStatus = $.newNullDropdownItem("Loading...");
      $('#model_dropdown').html(loadingStatus);
      $('#year_dropdown').html(loadingStatus);

      //build option list for <select> element
      var list = $.newNullDropdownItem("Make...");

      //add data returned from query
      for (index = 0; index < makeList.length; ++index) {
        list += $.newDropdownItem(makeList[index]);
      }
      //assign option list to dropdown
      $('#model_dropdown').html(list);

      //clear year_dropdown
      var nullOption = $.newNullDropdownItem("-");
      $('#year_dropdown').html(nullOption);


      //Activate button
      $('#submitsearch').changeState(true);

    } else {
      //Null #model_dropdown and #year_dropdown
      var nullOption = $.newNullDropdownItem("-");
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
      var loadingStatus = $.newNullDropdownItem("Loading...");
      $('#year_dropdown').html(loadingStatus);


      //build option list for <select> element
      var list = $.newNullDropdownItem("Year...");
      //add data returned from query
      for (index = 0; index < yearList.length; ++index) {
        list += $.newDropdownItem(yearList[index])
      }

      //assign option list to dropdown
      $('#year_dropdown').html(list);

      //Activate button
      $('#submitsearch').changeState(true);

    } else {
      //Null #model_dropdown and #year_dropdown
      var nullOption = $.newNullDropdownItem("-");
      $('#year_dropdown').html(nullOption);

      //Activate button
      $('#submitsearch').changeState(true);
    }
  });

  /*****************************************************************************
                            ON CLICK LISTENER
  *****************************************************************************/


  //Variables for performance testing
  var times = 0.0;
  var totalTime = 0.0;

  /*
    -Submit button listener
    By: Christopher
    Updated: 3/22/2019

    This on click listner waits for the submit button to be activated. When
    clicked, cars from the database will be requested and inserted into the
    results table.

    if(location is requested){
      -Get list of zip codes (zip codes only) from DB filtered by dropdown menu
          search terms
      -Request distance of origin VS destinations from Google Distance Matrix
        API
      -Determine which zipcodes are within the distance of the origin
      -GET request to DB for cars using search terms and valid zipcodes within
        distance of origin
    }else{
      -GET request to DB for cars using search terms
     }

  */
  $('#submitsearch').click(function() {
    console.log("Submit button pressed");
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
    var distance = $('#distance_dropdown').val();
    //Regular expression literal to test the format of the input
    var zipRegex = /^(\d{5})$/;

    /*******
      If distance and location are set, location filter will be calculated,
      otherwise all location calulations will be skipped
    ******/
    if (zipRegex.test(zip) && distance !== 'null') { //Executed if Location
      // is detected
      console.log("Location detected");

      //location array initiation. Used to hold results of location calulations
      var location = null;

      /*
        Get request filter values for zip code query
        -See $.getRequestValues() implementation in helper function section
         for details of how to use function.
      */
      var requestString = $.getRequestValues(make, model, year, null);

      //API URL used to get list of distinct zip codes
      var getZipString = "/choosencruise/PHP/API/get-car.php?zipsearch";
      //if request filter values were returned, append to end of URL
      if (requestString != null) {
        getZipString += requestString;
      }

      /*****
        GET request is used to get the list of zip codes associated with
        the cars requested. The JSON data is immediately flattened to a 1d
        array for easy insertion to the Google Service Distance matrix
        request. See $.flattenArray() implementation in HELPER FUNCTION
        section for details

        returns data: a single column table with distinct zip codes.

      *****/
      $.get(getZipString, function(data, status) {
        if (status == 'success') {

          var jsonData = $.parseJSON(data);
          var list = $.flattenArray(jsonData);
          var zipsInArea = [];

          console.table(list);

          /*
          Google Distance matrix response format
          {
           "rows":[
             {"elements":[
                 {"distance":{"text":"21.1 mi","value":33962},"duration":{"text":"30 mins","value":1825},"status":"OK"},
                  {"distance":{"text":"24.6 mi","value":39647},"duration":{"text":"35 mins","value":2082},"status":"OK"}
                        }],
                  "originAddresses":["Converse, TX 78109, USA"],
             "destinationAddresses":["San Antonio, TX 78221, USA","San Antonio, TX 78258, USA","San Antonio, TX 78233, USA"]
          }

          *********************************************************************

          The zip code data passed from the parent GET request is passed into
          Google distance matrix API. If an OK status is passed, the results are
          processed. If the car's zip codes are within the distance of the
          origin, an array of the valid zipcodes are created, otherwise, the
          array will contain a 0.

          */

          var service = new google.maps.DistanceMatrixService();
          service.getDistanceMatrix({
            origins: [zip],
            destinations: list,
            travelMode: 'DRIVING',
            unitSystem: google.maps.UnitSystem.IMPERIAL,
          }, function(data, status) {

            if (status == "OK") {
              zipsInArea = [];
              var origins = data.originAddresses;

              //Iterate thru each row, and compare the distance to the user
              //input distance.
              for (var i = 0; i < origins.length; i++) {
                var results = data.rows[i].elements;
                for (var j = 0; j < results.length; j++) {
                  var element = results[j]
                  var elementDistance = element.distance.text;

                  //                                    index:      1   2
                  // The distance value is a string with format: "26.1 mi". In
                  // order to compare each row distance to the user-input
                  // distance, the string is exploded with a whitespace and
                  // the first index is parsed into a float
                  var elementMiles = parseFloat(elementDistance.split(" ", 1));

                  if (elementMiles <= distance) {
                    zipsInArea.push(list[j]);
                  }
                }
              }

              //If no zip codes were aquired, push 0 into array
              if (zipsInArea.length < 1) {
                zipsInArea.push(0);
              }

              //Save results into location variable
              location = zipsInArea;

              /*
                Use $.getRequestValues to create the GET request car search
                filter values.

                Return example:

                make="Toyota"&model="Camry"&year="2017"&zip=78219,78249;
              */
              var requestValues = $.getRequestValues(make, model, year, location);

              //If request value is null, no search terms were fetched
              var getString = "/choosencruise/PHP/API/get-car.php?";
              if (requestValues === null) {
                getString += "where=false";
              } else {
                getString += "where=true" + requestValues;
              }

              // GET request to server for cars that will build car
              // deck data.
              $.setCardDeck(getString);


              //Activate button
              $('#submitsearch').changeState(true);

              //performance testing
              var t1 = performance.now();
              totalTime += (t1 - t0);
              times++;
              console.log("Clicks: " + times + "\nAvg: " + (totalTime / times) + "ms");

            } else {
              console.error("Google Distance matrix has failed");
            }
          });

        }
      });


    } else {
      console.log("Location not detected");

      /*
        Use $.getRequestValues to create the GET request car search
        filter values.

        Return example:

        make="Toyota"&model="Camry"&year="2017"&zip=78219,78249;
      */

      var requestValues = $.getRequestValues(make, model, year, null);

      var getString = "/choosencruise/PHP/API/get-car.php?";
      if (requestValues === null) {
        getString += "where=false";
      } else {
        getString += "where=true" + requestValues;
      }


      // GET request to server for cars that will build car
      // table data.
      $.setCardDeck(getString);


      //Activate button
      $('#submitsearch').changeState(true);

      var t1 = performance.now();

      totalTime += (t1 - t0);
      times++;

      console.log("Clicks: " + times + "\nAvg: " + (totalTime / times) + "ms");
    }
  });
});
