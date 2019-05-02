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
    <div class="tab-content" id="nav-tabContent" style="background-color:#FFFFFF!important">
      <div class="tab-pane fade" id="nav-account" role="tabpanel" aria-labelledby="nav-account-tab">

        <form class="needs-validation p-4" method="post" action="..." novalidate>
          <!-- start account content -->
          <div class="form-row">
            <div class="col-md-4 mb-3">
              <label for="validationCustomUsername">Username</label>
              <div class="input-group">
                <input type="text" class="form-control" id="validationCustomUsername" placeholder="Username" disabled>
                <div class="invalid-feedback">
                  Please choose a username.
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="validationCustom01">First name</label>
              <input type="text" class="form-control" id="validationCustom01" placeholder="First name" value="Mark" required>
              <div class="valid-feedback">
                Looks good!
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="validationCustom02">Last name</label>
              <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" value="Otto" required>
              <div class="valid-feedback">
                Looks good!
              </div>
            </div>

          </div>
          <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="validationCustom03">Street</label>
              <input type="text" class="form-control" id="validationCustom03" placeholder="Street" required>
              <div class="invalid-feedback">
                Please provide a valid street.
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="validationCustom04">City</label>
              <input type="text" class="form-control" id="validationCustom04" placeholder="City" required>
              <div class="invalid-feedback">
                Please provide a valid city.
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="validationCustom05">State</label>
              <input type="text" class="form-control" id="validationCustom05" placeholder="State" required>
              <div class="invalid-feedback">
                Please provide a valid state.
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="validationCustom06">Zip</label>
              <input type="text" class="form-control" id="validationCustom06" placeholder="Zip" required>
              <div class="invalid-feedback">
                Please provide a valid zip.
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="validationCustom07">Phone Number</label>
              <input type="tel" class="form-control" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" id="validationCustom07" placeholder="Phone Number" required>
              <div class="invalid-feedback">
                Please provide a valid telephone number
              </div>
            </div>
          </div>
          <button class="btn btn-primary" type="submit">Make Changes</button>
        </form> <!-- finish account content -->

        <script>
          // Example starter JavaScript for disabling form submissions if there are invalid fields
          (function() {
            'use strict';

            window.addEventListener('load', function() {
              // Fetch all the forms we want to apply custom Bootstrap validation styles to
              var forms = document.getElementsByClassName('needs-validation');
              // Loop over them and prevent submission
              var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                  event.preventDefault();
                  if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                  }
                  form.classList.add('was-validated');
                }, false);
              });
            }, false);
          })();
        </script>

      </div>
      <div class="tab-pane fade show active" id="nav-delivery" role="tabpanel" aria-labelledby="nav-delivery-tab">

        <div class="table-responsive">
          <table class="table table-bordered">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th colspan="2">Vehicle</th>
                <th>Dealership</th>
                <th>Status</th>
                <th>Notes</th>
              </tr>
            </thead>
            <tr>
              <td>893743789</td>
              <td style="width:200px">
                <img src="https://i.imgur.com/PUbEIhu.jpg" alt="" width="200" height="auto">
              </td>
              <td style="min-width:200px">
                <div>2018 Toyota Camry R</div>
                <hr>
                <div><b>Final Price: $32,082</b></div>
              </td>
              <td style="min-width:170px">
                <h5>Cruisin' Toyota</h5>
                <div>123 address Street</div>
                <div>San Antonio, TX 78109</div>
                <div>(210)-124-9782</div>
              </td>
              <td style="min-width:170px">
                <h3>Status: Pending</h3>
                <hr>
                <div>Estimated Delivery: 5 - 7 days</div>
              </td>
              <td style="min-width:170px;max-height:250px">
                <div>This can be used for delivery or dealership notes</div>
              </td>
            </tr>
          </table>
        </div>

      </div>
      <div class="tab-pane fade" id="nav-appointment" role="tabpanel" aria-labelledby="nav-appointment-tab">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead class="thead-light">
              <tr>
                <th>#</th>
                <th colspan="2">Vehicle</th>
                <th>Dealership</th>
                <th>Status</th>
                <th>Notes</th>
              </tr>
            </thead>
            <tr>
              <td>290872</td>
              <td style="width:200px">
                <img src="https://i.imgur.com/PUbEIhu.jpg" alt="" width="200" height="auto">
              </td>
              <td style="min-width:200px">
                <div>2018 Toyota Camry R</div>
              </td>
              <td style="min-width:170px">
                <h5>Cruisin' Toyota</h5>
                <div>123 address Street</div>
                <div>San Antonio, TX 78109</div>
                <div>(210)-124-9782</div>
              </td>
              <td style="min-width:170px">
                <h5>Appt Date: 4/14/2019</h5>
                <hr>
                <h5>Time: pending</h5>
              </td>
              <td style="min-width:170px">
                <div>The dealership will follow up with you soon.</div>
              </td>
            </tr>
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
