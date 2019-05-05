$(document).ready(function() {

  //Load head and footer data
  $('#header').load('./html/header.php');
  $('#footer').load('./html/footer.php');

  //load account info
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

  //Function to create delivery table items
  $.createDeliveryTable = function(data) {
    var tableData = "";

    Array.prototype.forEach.call(data, item => {
      if(item != undefined){
        var img;
        if(item.main_img_hash != null){
          img = "https://i.imgur.com/"+item.main_img_hash+".png";
        }else{
          img = "https://i.imgur.com/l5ysJiD.png";
        }
        var deliveryItem = "<tr>" +
          "<td>"+item.delivery_id+"</td>" + //order #
          "<td style=\"width:200px\">" +
          "<img src=\""+img+"\" alt=\"\" width=\"200\" height=\"auto\">" + //vehicle main thumbnail
          "</td>" +
          "<td style=\"min-width:200px\">" +
          "<div>" + item.year +" "+ item.make +" "+ item.model +" "+ item.trim +"</div>" + // Year, Make, Model, Year, Trim
          "<hr>" +
          "<div><b>Final Price: $"+item.final_price+"</b></div>" + // Final price
          "</td>" +
          "<td style=\"min-width:170px\">" +
          "<h5>"+item.name+"</h5>" + //carlot name
          "<div>"+item.street+"</div>" + //carlot street
          "<div>"+ item.city+", "+ item.state +" "+ item.zip+"</div>" + // carlot City, state, zip
          "<div>"+item.phone.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3')+"</div>" + //phone number
          "</td>" +
          "<td style=\"min-width:170px\">" +
          "<h3>Status: "+item.expected_delivery_date+"</h3>" + //status
          "<hr>" +
          "<div>Estimated Delivery: "+item.req_date+"</div>" + //estimated delivery
          "</td>" +
          "<td style=\"min-width:170px;max-height:250px\">" +
          "<div>This can be used for delivery or dealership notes</div>" +
          "</td>" +
          "</tr>";

        tableData += deliveryItem;
      }
    });
    return tableData;
  }
  //delivery info
  var reqURL = "/choosencruise/PHP/API/get-order.php?delivery=all";
  $.get(reqURL, function(data, status) {
    var response = JSON.parse(data);
    if (response.status == true) {
      var delTableData = $.createDeliveryTable(response.result);
      //console.log(delTableData);
      $('#delivery_table').append(delTableData);
    } else if (response.status == false) {
      var emptyRow = "<tr><td colspan=\'5\'><h3>No deliveries</h3><td></tr>";
      $('#delivery_table').append(emptyRow);
      console.log("No delivery data present");
    }
  });

  //Function to create appointment table items
  $.createApptTable = function(data) {
    var tableData = "";

    Array.prototype.forEach.call(data, item => {
      if(item != undefined){
        var img;
        if(item.main_img_hash != null){
          img = "https://i.imgur.com/"+item.main_img_hash+".png";
        }else{
          img = "https://i.imgur.com/l5ysJiD.png"; //no img found src
        }
        var deliveryItem = "<tr>" +
          "<td>"+item.appt_id+"</td>" + //order #
          "<td style=\"width:200px\">" +
          "<img src=\""+img+"\" alt=\"\" width=\"200\" height=\"auto\">" + //vehicle main thumbnail
          "</td>" +
          "<td style=\"min-width:200px\">" +
          "<div>" + item.year +" "+ item.make +" "+ item.model +" "+ item.trim +"</div>" + // Year, Make, Model, Year, Trim
          "</td>" +
          "<td style=\"min-width:170px\">" +
          "<h5>"+item.name+"</h5>" + //carlot name
          "<div>"+item.street+"</div>" + //carlot street
          "<div>"+ item.city+", "+ item.state +" "+ item.zip+"</div>" + // carlot City, state, zip
          "<div>"+item.phone.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3')+"</div>" + //phone number
          "</td>" +
          "<td style=\"min-width:170px\">" +
          "<h4>Appt Date: "+item.appointment_date+"</h4>" + //status
          "<hr>" +
          "<h5>time: "+item.time+"</h5>" + //estimated delivery
          "</td>" +
          "<td style=\"min-width:170px;max-height:250px\">" +
          "<div>This can be used for delivery or dealership notes</div>" +
          "</td>" +
          "</tr>";

        tableData += deliveryItem;
      }
    });
    return tableData;
  }

  //load appt info
  var reqURL = "/choosencruise/PHP/API/get-order.php?appointment=all";
  $.get(reqURL, function(data, status) {
    var response = JSON.parse(data);
    if (response.status == true) {
      var apptTableData = $.createApptTable(response.result);
      console.log(response);
      $('#appointment_table').append(apptTableData);
    } else if (response.status == false) {
      var emptyRow = "<tr><td colspan=\'5\'><h3>No appointments</h3><td></tr>";
      $('#appointment_table').append(emptyRow);
      console.log("No appointment data present");
    }
  });
});
