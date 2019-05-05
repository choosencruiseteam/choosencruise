<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Search For a Car</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="manifest" href="manifest.json" />
  <meta name="theme-color" content="#007bff">
  <link rel=icon href="../assets/favicon.ico">

  <!-- Bootstrap CSS (Internet req)
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  -->
  <link rel="stylesheet" type="text/css" href="../library/bootstrap-4.3.1-dist/css/bootstrap.min.css">
</head>

<body style="background-color:#DCE3E9!important">

  <!-- **Header div**  Loaded using: ../Javascript/carsearch.js  -->
  <div class="header" id="header"></div>

  <div class="main">

    <form id='loginform' method="post" action="../PHP/API/auth.php" class="container border border-primary rounded p-4 shadow" style="background-color:#f8f9fa!important;max-width:400px;">
      <h2>Welcome back!</h2>
      <div class="form-group my-4 mt-5">
        <label for="username" class="sr-only">Username</label>
        <input type="text" class="form-control" name="u" id="username" aria-describedby="usernameHelp" placeholder="Enter username" required>
      </div>
      <div class="form-group my-4">
        <label for="password" class="sr-only">Password</label>
        <input type="password" class="form-control" name="p" id="password" placeholder="Password" required>
      </div>

      <div class="alert alert-warning mt-4 invisible" id="alert">Username or password is incorrect!</div>

      <!--
      <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="remember_check">
        <label class="form-check-label" for="remember_check">Remember me?</label>
      </div>
      -->

      <input type="hidden" name="login" value="true">
      <button type="submit" class="btn btn-primary" id="submit-btn">Submit</button>
      <button type="reset" class="btn btn-warning" id="clear-btn">Clear</button>
    </form>

    <!-- **Footer div**
    Loaded using:  ../Javascript/carsearch.js
    -->
    <div class="footer" id="footer"></div>

  </div>

  <script src="../library/jquery-3.3.1.min.js"></script>
  <script src="../library/bootstrap-4.3.1-dist/popper.min.js"></script>
  <script src="../library/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>

  <!-- Script to handle form -->
  <script>
    $(document).ready(function() {
      //Load head and footer layouts
      $('#header').load('../html/header.php');
      $('#footer').load('../html/footer.php');

      $('form').on("submit", function(event) {
        event.preventDefault();
        var url = event.currentTarget.action;

        $('#submit-btn').removeClass("btn-primary").addClass("btn-secondary");
        $('#submit-btn').attr('disabled','disabled');

        $.ajax({
          url: url,
          type: 'post',
          data: $('#loginform').serialize(),
          success: function(data) {
            var loginStatus = JSON.parse(data).data;
            //handle success login
            if(loginStatus == true){
              $('#username').removeClass("is-invalid").addClass("is-valid");
              $('#password').removeClass("is-invalid").addClass("is-valid");;
              $('#alert').addClass("invisible");
              window.location.href = document.referrer;
            }else if(loginStatus == false){
              //handle fail login
              $('#username').addClass("is-invalid");
              $('#password').addClass("is-invalid");
              $('#alert').removeClass("invisible");

              //reactivate button
              $('#submit-btn').removeClass("btn-secondary").addClass("btn-primary");
              $('#submit-btn').removeAttr('disabled');

            }
          },
          error: function(data){
            //handle error case
          }
        });

      });

    });
  </script>

</body>

</html>
