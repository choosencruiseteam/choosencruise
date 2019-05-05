
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="http://localhost/choosencruise/mainpage.php"><img src="https://i.imgur.com/f4vds0H.png" style="width:100px;height:60px"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="http://localhost/choosencruise/mainpage.php">Home<span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="http://localhost/ChooseNCruise/carsearch.php">Search for a car</a> 
    </div>
    <div class="navbar-nav ml-auto">

      <?php
      session_start();
        if(isset($_SESSION['user_auth']) && $_SESSION['user_auth'] === true){

          $user = $_SESSION['user'];

          echo "<div class=\"dropdown\">
            <button class=\"btn btn-success dropdown-toggle border-dark\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
              Welcome back, ". $user . "!</button>
            <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
              <a class=\"dropdown-item\" href=\"http://localhost/choosencruise/myaccount.php\">My Account</a>
              <div class=\"dropdown-divider\"></div>
              <a class=\"dropdown-item\" href=\"http://localhost/choosencruise/html/signout.php\">Sign out</a>
            </div>
          </div>";
          /*
          <input type=\"hidden\" id=\"user_auth\" value=\"".$_SESSION['user_auth']."\">
          <input type=\"hidden\" id=\"username\" value=\"".$user."\">";
          */
        }else{
          echo "<a class=\"nav-item nav-link\" href=\"http://localhost/choosencruise/html/login.php\">Login</a>
                <a class=\"nav-item nav-link\" href=\"#\">Sign up</a>
                <input type=\"hidden\" id=\"user_auth\" value=\"0\">
                <input type=\"hidden\" id=\"user\" value=\"undefined\">";
        }
      ?>
    </div>
  </div>
</nav>

<!-- Warning banner -->
<div class="alert alert-warning mt-3 mx-auto rounded border-warning" role="alert">
  <div class="row">
    <h3>ATTENTION</h3>
    <img src="https://i.imgur.com/86GTaJ1.png" alt="http://www.publicdomainfiles.com/show_file.php?id=13928572813748" style="width:35px;height:35px;">
  </div>
  <div class="row">
    <p>
      This website is a school project created from students at San Antonio
      College. The purpose of this website is for demonstration purposes only, and all
      functions and services offered are not intended for consumer use.
    </p>
  </div>
</div>
<!-- Warning banner -->
