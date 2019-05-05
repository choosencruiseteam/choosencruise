<?php
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

  <!-- Start Main Class -->
  <div class="main">

    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link" id="nav-account-tab" data-toggle="tab" href="#nav-account" role="tab" aria-controls="nav-account" aria-selected="true">Account</a>
        <a class="nav-item nav-link active" id="nav-delivery-tab" data-toggle="tab" href="#nav-delivery" role="tab" aria-controls="nav-delivery" aria-selected="false">Delivery</a>
        <a class="nav-item nav-link" id="nav-appointment-tab" data-toggle="tab" href="#nav-appointment" role="tab" aria-controls="nav-appointment" aria-selected="false">Appointments</a>
      </div>
    </nav>
    <div class="tab-content pt-3" id="nav-tabContent" style="background-color:#FFFFFF!important">
      <div class="tab-pane fade" id="nav-account" role="tabpanel" aria-labelledby="nav-account-tab">

        <form class="needs-validation p-4" method="post" action="..." novalidate>
          <!-- start account content -->
          <div class="form-row">
            <div class="col-md-4 mb-3">
              <label for="validationCustomUsername">Username</label>
              <div class="input-group">
                <input type="text" class="form-control" id="username" placeholder="Username" disabled>
                <div class="invalid-feedback">
                  Please choose a username.
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="validationCustom01">First name</label>
              <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" required>
              <div class="valid-feedback">
                Looks good!
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="validationCustom02">Last name</label>
              <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" required>
              <div class="valid-feedback">
                Looks good!
              </div>
            </div>

          </div>
          <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="validationCustom03">Street</label>
              <input type="text" class="form-control" id="street" name="street" placeholder="Street" required>
              <div class="invalid-feedback">
                Please provide a valid street.
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="validationCustom04">City</label>
              <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
              <div class="invalid-feedback">
                Please provide a valid city.
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="validationCustom05">State</label>
              <input type="text" class="form-control" id="state" name="state" placeholder="State" required>
              <div class="invalid-feedback">
                Please provide a valid state.
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="validationCustom06">Zip</label>
              <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip" required>
              <div class="invalid-feedback">
                Please provide a valid zip.
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="validationCustom07">Phone Number</label>
              <input type="tel" class="form-control" pattern="[0-9]{10}" id="phone" name="phone" placeholder="Phone Number" required>
              <div class="invalid-feedback">
                Please provide a valid telephone number
              </div>
            </div>
          </div>
          <button class="btn btn-primary" type="submit">Make Changes</button>
        </form> <!-- finish account content -->

      </div>
      <div class="tab-pane fade show active" id="nav-delivery" role="tabpanel" aria-labelledby="nav-delivery-tab">

        <div class="table-responsive">
          <table class="table table-bordered" id="delivery_table">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th colspan="2">Vehicle</th>
                <th>Dealership</th>
                <th>Status</th>
                <th>Notes</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
      <div class="tab-pane fade" id="nav-appointment" role="tabpanel" aria-labelledby="nav-appointment-tab">
        <div class="table-responsive">
          <table class="table table-bordered" id="appointment_table">
            <thead class="thead-light">
              <tr>
                <th>#</th>
                <th colspan="2">Vehicle</th>
                <th>Dealership</th>
                <th>Status</th>
                <th>Notes</th>
              </tr>
            </thead>

          </table>
        </div>
      </div>

    </div>

  </div> <!-- Main end -->

  <!-- **Footer div** Loaded using:  ../Javascript/carsearch.js -->
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
  <script src="./javascript/myaccount.js"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGpA37QlMCtXJPUqDgR0RGxZm8bWvoqSk" type="text/javascript"></script>

</body>

</html>
