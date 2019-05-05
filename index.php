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

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="https://www.andersonhonda.com/blogs/1092/wp-content/uploads/2018/06/2019-honda-odyssey-palo-alto-ca.jpg" alt="Thriller" width="100%" height="100%">
            <div class="container">
              <div class="carousel-caption text-left">
                <h1>Reliable</h1>
                <p>'Cause this is thriller Thriller night And no one’s gonna save you From the beast about to strike You know it’s thriller Thriller night You’re fighting for your life Inside a killer thriller tonight, yeah Ahahahahahahahaha I'm gonna bring it tonight</p>
                <p><a class="btn btn-lg btn-primary" href="http://localhost/choosencruise/html/Signup.html" role="button">Sign up today</a></p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img src="https://static01.nyt.com/images/2018/02/19/well/family/well-family-driving/well-family-driving-jumbo.jpg?quality=90&auto=webp" alt="Thriller" width="100%" height="100%">
            <div class="container">
              <div class="carousel-caption">
                <h1>Safe</h1>
                <p>And all the roads that lead you there are winding And all the lights that light the way are blinding There are many things that I Would like to say to you but I don't know how I said maybe, you're gonna be the one that saves me And after all, you're my wonderwall I said maybe, you're gonna be the one that saves me And after all, you're my wonderwal</p>
                <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img src="http://www.clickheretesting.com/EverettCBGMorganton/trucks/images/img-split.jpg" alt="BR" width="100%" height="100%">
            <div class="container">
              <div class="carousel-caption text-right">
                <h1>Always on Time</h1>
                <p>I'm just a poor boy and nobody loves me He's just a poor boy from a poor family Spare him his life from this monstrosity
                  Easy come easy go will you let me go Bismillah, no we will not let you go, let him go Bismillah, we will not let you go, let him go Bismillah,
                  we will not let you go, let me go (Will not let you go) let me go (never, never let you go) let me go (never let me go)
                  Oh oh no, no, no, no, no, no, no Oh mama mia, mama mia, mama mia let me go Beelzebub has a devil put aside for me for me for me</p>
                <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
              </div>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>


      <!-- Marketing messaging and featurettes
      ================================================== -->
      <!-- Wrap the rest of the page in another container to center all the content. -->

      <div class="container marketing">

        <!-- Three columns of text below the carousel -->
        <div class="row">
          <div class="col-lg-4">
            <img src="https://images.unsplash.com/photo-1544723795-3fb6469f5b39?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1535&q=80" alt="KBB" width="140" height="140" class="rounded-circle">
            <h2>Reliable</h2>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img src="https://images.unsplash.com/photo-1491349174775-aaafddd81942?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80" alt="KBB" width="140" height="140" class="rounded-circle">
            <h2>Always On Time</h2>
            <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img src="https://images.unsplash.com/photo-1504455583697-3a9b04be6397?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80" alt="KBB" width="140" height="140" class="rounded-circle">
            <h2>Faster & Cheaper</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->


        <!-- START THE FEATURETTES -->

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">Delivery <span class="text-muted">It’ll blow your mind.</span></h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
          </div>
          <div class="col-md-5">
            <img src="https://hdwallsbox.com/wallpapers/m/44/trucks-18-wheeler-freightliner-m43541.jpg" alt="delivery" width="500" height="500">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading">Texs-Wide Database <span class="text-muted">See for yourself.</span></h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
          </div>
          <div class="col-md-5 order-md-1">
            <img src="https://thumbor.thedailymeal.com/PwyJHJwEjH5fmjecR0l9Mp2-M5s=//https://www.thedailymeal.com/sites/default/files/2018/05/10/Hero_21%20thigns%20texas_Slide_Edit.jpg" alt="Thriller" width="450" height="500">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">Kelly-Blue Book <span class="text-muted">Checkmate.</span></h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
          </div>
          <div class="col-md-5">
            <img src="https://image4.owler.com/logo/kelley-blue-book_owler_20170325_150525_original.png" alt="KBB" width="550" height="500">
          </div>
        </div>

        <hr class="featurette-divider">

      </div><!-- /END THE FEATURETTES -->
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
