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
  <link rel="stylesheet" type="text/css" href="./library/bootstrap-4.3.1-dist/css/bootstrap.min.css">
</head>

<body style="background-color:#f8f9fa!important">
  <!-- **Header div**  Loaded using: ../Javascript/carsearch.js  -->
  <div class="header" id="header"></div>

  <div class="main">

    <!-- Drop down menus to narrow car search -->
    <div class="container-fluid">
      <div class="row my-4">
        <div class="jumbotron jumbotron-fluid border border-primary shadow rounded p-2 mx-2">
          <div class="container-fluid">
            <div class="row">
              <div class="col mb-4">
                <h1 class="display-4">Find your vehicle</h1>
                <p class="lead">Everything we do is to make the car buying experience as easy as possible.</p>
                <hr class="my-4">
                <p>Did you know we offer delivery all across Texas?</p>
                <a class="btn btn-secondary btn-lg disabled" href="#" role="button" aria-disabled="true">Learn more</a> (Coming Soon)
              </div>
              <div class="col">
                <img src="https://i.imgur.com/S8LOEK4.png" alt="Photo by timothy muza on Unsplash" class="img-fluid" style="min-width:300px;max-width:520px;
                     width:100%;height:auto;">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-3" style="min-width:160px" border>
          <div class="border border-primary p-2  mx-1 mb-4 shadow bg-white rounded" style="background-color:#dee2e6!important">
            <h4>Narrow your options</h4>
            <hr>
            <form>
              <div class="form-group">
                <label class="sr-only" for="make_dropdown">Make:</label>
                <select placeholder="Make" class="form-control mb-3" name="make" id="make_dropdown">
                  <option value="loading">Loading...</option>
                </select>

                <label class="sr-only" for="model_dropdown">Model:</label>
                <select placeholder="Model" class="form-control mb-3" name="model" id="model_dropdown">
                  <option value="loading">Loading...</option>
                </select>

                <label class="sr-only" for="year_dropdown">Year:</label>
                <select placeholder="Year" class="form-control mb-3" name="year" id="year_dropdown">
                  <option value="loading">Loading...</option>
                </select>

                <h4>Location</h4>
                <hr>

                <label class="sr-only" for="zip_textbox">Zip:</label>
                <input type='text' class="form-control mb-3" placeholder="Enter zip.." id="zip_textbox">

                <label class="sr-only" for="distance_dropdown">Year:</label>
                <select placeholder="Distance" class="form-control mb-3" name="distance" id="distance_dropdown">
                  <option value=null>Distance..</option>
                  <option value=5>5 miles</option>
                  <option value=10>10 miles</option>
                  <option value=20>20 miles</option>
                  <option value=30>30 miles</option>
                  <option value=40>40 miles</option>
                  <option value=50>50 miles</option>
                </select>
                <div>
                  <img src="https://i.imgur.com/lm2DUmn.png" alt="Powered By Google" class="img-fluid float-right my-1" style="width:auto; height:auto;">
                </div>
                <input type="button" class="btn btn-primary mb-3" id="submitsearch" Value="Submit">
              </div>
            </form>
          </div>
        </div>

        <div class="col p-2 mx-1 border border-primary shadow bg-white rounded">
          <h4>Choose your car</h4>
          <hr>
          <div class="card-deck p-2" id="card_deck" style="width:auto;min-height:600px!important">
            <div class="px-1 mx-auto text-center">
              <h3>Start your search by narrowing your options!</h3>
            </div>
          </div>
        </div>
      </div> <!-- Car row end -->
    </div> <!-- Content container end -->
  </div> <!-- Main end -->

  <!-- **Footer div**
    Loaded using:  ../Javascript/carsearch.js
  -->
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
  <script src="./javascript/carsearch.js"></script>

  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGpA37QlMCtXJPUqDgR0RGxZm8bWvoqSk" type="text/javascript"></script>

</body>

</html>
