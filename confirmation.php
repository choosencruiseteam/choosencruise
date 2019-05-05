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
  <link rel="stylesheet" type="text/css" href="./library/bootstrap-4.3.1-dist/css/bootstrap.css">
</head>

<body style="background-color:#f8f9fa!important">
  <!-- **Header div**  Loaded using: ../javascript/details.js  -->
  <div class="header" id="header"></div>


  <!-- Content Area ***********************************************************-->

  <div class="main" id="main">
    <?php
      if(isset($_GET['delivery']) || isset($_GET['appt'])){
        $type = "";
        if(isset($_GET['delivery']))
          $type = "delivery";
        else if(isset($_GET['appt']))
          $type = "appointment";

        echo "<div class=\"container p-4 border border-primary shadow rounded\" style=\" background-color:#FFFFFF!important\">";
        echo "<h1>Confirmation</h1>";
        echo "<h4>Your " . $type . " has been successfully scheduled. Please expect
              a call from the dealership within 24 hours for further information!</h4>";
        echo "<a href=\"http://localhost/choosencruise/carsearch\">Click here to go back to the homepage</a>";
        echo "</div>";
      }
    ?>
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

  <script>
    $(document).ready(function() {

      //Load head and footer data
      $('#footer').load('./html/footer.php');
      $('#header').load('./html/header.php');
    });
  </script>
</body>

</html>
