<?PHP
  session_start();
  include('./PHP/Controllers/SessionVerify.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Search For a Car</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="manifest" href="./html/manifest.json" />
  <meta name="theme-color" content="#007bff">
  <link rel=icon href="https://i.imgur.com/Su6GVUs.png">

  <!-- Bootstrap CSS (Internet req)
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  -->
  <link rel="stylesheet" type="text/css" href="./library/bootstrap-4.3.1-dist/css/bootstrap.css">
</head>

<body style="background-color:#f8f9fa!important">
  <!-- **Header div**  Loaded using: ../javascript/details.js  -->
  <div class="header" id="header"></div>


  <!-- Content Area ***********************************************************-->

  <div class="main" id="main">
    <div class="container-fluid">
      <div class="row my-4">
        <div class="col-sm-7" style="min-width:160px" border>

          <div id="car_carousel" class="carousel slide shadow my-3" data-ride="carousel" style="max-width:700px;min-height:220px">

            <div id="carousel_loading_state" style="width:auto;height:400px;padding-top:150px;">
              <div class="spinner-border text-primary mt-3 mx-auto d-block" role="status"><span class="sr-only">Loading...</span></div>
            </div>

            <ol id="carousel-indicators" class="carousel-indicators invisible">
            </ol>

            <!-- img size must be 800x500 -->
            <div id="carousel-inner" class="carousel-inner invisible" style="height:100%">
            </div>

            <a id="carousel-control-prev" class="carousel-control-prev invisible" href="#car_carousel" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a id="carousel-control-next" class="carousel-control-next invisible" href="#car_carousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>

          </div>
        </div>

        <div class="col-sm-4" style="min-width:160px">
          <!-- Car Information module -->
          <div class="container border p-3 shadow">
            <h3 id="car_name">Loading...</h3>
            <div id="car_price"></div>
            <div id="car_engine"></div>
            <div id="car_transmission"></div>
            <div id="car_miles"></div>
            <hr>
            <!-- Carlot Information module -->
            <h3 id="carlot_header">Located At:</h3>
            <u>
              <h4 id="carlot_name">Loading...</h4>
            </u>
            <div id="carlot_address"></div>
            <div id="carlot_city_state_zip"></div>
            <div id="carlot_phone"></div>
          </div>

          <!-- Button Container -->
          <div class="row my-3">
            <input type="button" id="delivery-btn" class="btn btn-primary btn-lg mx-auto my-1 shadow" style="width:170px;" value="Delivery">
            <input type="button" id="appointment-btn" class="btn btn-warning btn-lg mx-auto my-1 shadow" style="width:170px;" value="Appointment">
          </div>

          <!-- Info pane -->
          <div class="container border p-3 shadow">
            <h3>Options</h3>
            <hr>
            <p><b>Appointment: </b> Schedule an appointment with the dealer to
              test drive the vehicle, talk to a sales associate, or look at the
              vehicle in person.
            </p>
            <p><b>Delivery: </b> Skip the dealership! Take advantage of our Texas-wide
              delivery service. Test drive the vehicle at your convenience. If
              your not happy with the vehicle, schedule a return within 5 days!
            </p>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- **Footer div** Loaded using: ../javascript/details.js -->
  <div class="footer" id="footer"></div>

  <!-- Optional JavaScript INTERNET REQUIRED
  jQuery first, then Popper.js, then Bootstrap JS
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  -->


  <script src="./library/jquery-3.3.1.min.js"></script>
  <script src="./library/bootstrap-4.3.1-dist/popper.min.js"></script>
  <script src="./library/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
  <script src="./javascript/details.js"></script>
</body>

</html>
