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

    <form id="delivery_form" class="p-4" method="post" action="http://localhost/choosencruise/PHP/API/submit-task.php?delivery">
      <input type="hidden" name="sch_type" value="delivery">
      <div class="row m-0">
        <div class="col-sm-8">
          <!-- Left column -->
          <div class="alert alert-danger d-none" id="err">
            <strong>Please fix the following below:</strong><br>
          </div>
          <div class="border m-3 p-3 rounded shadow" style="background-color:#FFFFFF!important">
            <!-- User module -->
            <h3><u>Your information</u></h3>
            <div>Please verify your contact information. If any information is incorrect, please update it:</div>
            <hr>
            <!-- start account content -->
            <div class="form-row">
              <div class="col-md-4 mb-3">
                <label for="username">Username</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="username" placeholder="Username" disabled>
                  <div class="invalid-feedback">
                    Please choose a username.
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="fname">First name</label>
                <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" required>
                <div class="invalid-feedback">
                  Please provide a valid first name.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="lname">Last name</label>
                <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" required>
                <div class="invalid-feedback">
                  Please provide a valid last name.
                </div>
              </div>

            </div>
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="street">Street</label>
                <input type="text" class="form-control" id="street" name="street" placeholder="Street" required>
                <div class="invalid-feedback">
                  Please provide a valid street.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
                <div class="invalid-feedback">
                  Please provide a valid city.
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="state">State</label>
                <input type="text" class="form-control" id="state" name="state" placeholder="State" required>
                <div class="invalid-feedback">
                  Please provide a valid state.
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip" pattern="[0-9]{5}" required>
                <div class="invalid-feedback">
                  Please provide a valid zip.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="phone">Phone Number</label>
                <input type="tel" class="form-control" name="phone" id="phone" placeholder="1112223333" pattern="[0-9]{10}" required>
                <div class="invalid-feedback">
                  Please provide a valid telephone number
                </div>
              </div>
            </div>
          </div><!-- END user module -->

          <div class="border m-3 p-3 rounded shadow" style="background-color:#FFFFFF!important">
            <!-- Payment module -->
            <h3><u>Payment info</u></h3>
            <div>Here are your payment options:</div>

            <div class="form-check">
              <input class="form-check-input" type="radio" value="onetime" id="onetimeCheck" name="payment">
              <label class="form-check-label" for="onetimeCheck">
                One-Time Payment:
              </label>
            </div>

            <div class="row">

              <div class="form-check form-inline my-1">
                <label class="form-check-label" for="card_cvv">
                  Type:&nbsp;
                </label>
                <input type="text" id="card_type" class="form-control" value="Mastercard" disabled>
              </div>

              <div class="form-check form-inline my-1">
                <label class="form-check-label" for="card_id">
                  Card:&nbsp;
                </label>
                <input type="text" id="card_id" class="form-control" value="1111111111111111" disabled>
              </div>

              <div class="form-check form-inline my-1">
                <label class="form-check-label" for="card_exp">
                  EXP:&nbsp;
                </label>
                <input type="text" id="card_exp" class="form-control" value="1/21" disabled>
              </div>

              <div class="form-check form-inline my-1">
                <label class="form-check-label" for="card_cvv">
                  CVV:&nbsp;
                </label>
                <input type="text" id="card_cvv" class="form-control" value="121" disabled>
              </div>

            </div>

            <hr>

            <div class="form-check">
              <input class="form-check-input" type="radio" value="finance" id="financeCheck" name="payment" required>
              <label class="form-check-label" for="financeCheck">
                Finance:
              </label>
            </div>

            <div class="row">

              <div class="form-check form-inline my-1">
                <label class="form-check-label" for="card_cvv">
                  Type:&nbsp;
                </label>
                <input type="text" id="finance_type" class="form-control" value="Tien's Top Financing" disabled>
              </div>

              <div class="form-check form-inline my-1">
                <label class="form-check-label" for="card_cvv">
                  Terms:&nbsp;
                </label>
                <input type="text" id="finance_terms" class="form-control" value="60 Months" disabled>
              </div>

              <div class="form-check form-inline my-1">
                <label class="form-check-label" for="card_cvv">
                  Rate:&nbsp;
                </label>
                <input type="text" id="finance_rate" class="form-control" value="0.8% Interest" disabled>
              </div>

              <a class="p-2 ml-3" id="tandc_link" href="javascript:void(0);">Terms and conditions</a>
            </div>
          </div> <!-- END Payment module -->

          <div class="border m-3 p-3 rounded shadow" style="background-color:#FFFFFF!important">
            <!-- Delivery module -->
            <h3><u>Delivery Info</u></h3>
            <div>Please go over the delivery information below, you may request a date for your delivery:</div>
            <hr>
            <div class="form-check form-inline my-1">
              <label class="sr" for="delivery_dropdown">Request a delivery time frame:&nbsp;</label>
              <select class="form-control" id="delivery_date" name="req_date" form="delivery_form">
                <option value="ASAP">ASAP (1 to 2 days)</option>
                <option value="1 week">Within 7 days</option>
                <option value="2 weeks">Within 7 to 14 days</option>
                <option value="3 weeks">Within 14 to 21 days</option>
                <option value="4 weeks">Within 21 to 28 days</option>
              </select>
            </div>
            <div class="form-check form-inline my-1">
              <label class="form-check-label" for="card_cvv">
                Delivery Charge:&nbsp;
              </label>
              <input type="text" id="delivery_charge" class="form-control" value="$378.00" disabled>
            </div>
          </div> <!-- END Delivery module -->

        </div> <!-- END left column -->

        <div class="col-sm-4">
          <!-- right column -->

          <div class="border m-3 p-3 rounded shadow" style="background-color:#FFFFFF!important;width:220px;" id="vehicle_win">
            <!-- Vehicle module -->
            <h3><u>Your vehicle</u></h3>

            <img id="vehicle_img" src="" class="p-1 img-fluid" alt="Vehicle Picture">
            <h5 id="vehicle_name" class="card-title"></h5>
            <div id="vehicle_engine"></div>
            <div id="vehicle_transmission"></div>
            <div id="vehicle_mileage"></div>

            <hr>

            <h4><u>Price breakdown</u></h4>

            <div class="col">
              <div class="row">
                <div>$</div>
                <div id="posted_price_breakdown"></div>
                <div>&nbsp;- Vehicle Price</div>
              </div>
              <div class="row">
                <div>$</div>
                <div id="taxes_breakdown"></div>
                <div>&nbsp;- Taxes</div>
              </div>
              <div class="row">
                <div>$</div>
                <div id="delivery_charge_breakdown"></div>
                <div>&nbsp;- Delivery Charge</div>
              </div>
              <div class="row border border-dark rounded p-1 px-2">
                <div>$</div>
                <div id="final_price_breakdown" name="final_price"></div>
                <div>&nbsp;- Final Price</div>
              </div>
              <input type="hidden" name="final_price" id="final_price" value=0>
            </div>
            <hr>

            <input type="hidden" id="user" name="user">
            <input type="hidden" id="car" name="car">
            <input type="submit" id="submit-btn" class="btn btn-primary btn-lg mx-auto my-1 shadow" style="width:170px;" value="Checkout">
            <div class="d-flex justify-content-center">
              <div id="load_spinner" class="spinner-border text-primary my-1 mx-auto invisible" role="status">
              </div>
            </div> <!-- END vehicle module -->

          </div>
          <!--END right column -->
        </div>
    </form>
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
  <script src="./javascript/delivery.js"></script>
</body>

</html>
