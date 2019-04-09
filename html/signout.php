<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Signing you out...</title>
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

    <div class="jumbotron jumbotron-fluid border border-primary shadow rounded p-5 mx-auto" style="max-width:800px;">
      <div class="container-fluid">
        <div class="row">
          <?php
            if (isset($_GET['session_expired'])) {
                echo "<h1>Your session has expired</h1>";
            } else {
                echo "<h1>Signing you out</h1>";
            }
           ?>
        </div>
        <div class="row my-4">
          <h5>Returning you back to the homepage</h5>
        </div>
        <div class="clearfix">
          <div class="spinner-grow text-primary float-right" role="status"
               style="width: 6rem; height: 6rem;">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- **Footer div**
    Loaded using:  ../Javascript/carsearch.js
  -->
  <div class="footer" id="footer"></div>

  <script src="../library/jquery-3.3.1.min.js"></script>
  <script src="../library/bootstrap-4.3.1-dist/popper.min.js"></script>
  <script src="../library/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
  <script>
    //Script to handle 404.html operations
    $(document).ready(function() {
      //Load head and footer layouts
      $('#header').load('../html/header.php');
      $('#footer').load('../html/footer.php');

      $.get("http://localhost/choosencruise/PHP/API/auth.php?destroy",function(data){
        console.log("Destroy session status: " + JSON.stringify(data));
        window.setTimeout(function() {
          window.location.href = 'http://localhost/choosencruise/carsearch.php';
        }, 2000);
      });
    });
  </script>

</body>

</html>
