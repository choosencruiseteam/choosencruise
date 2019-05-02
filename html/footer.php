<!-- Footer -->
<footer class="page-footer font-small bg-dark pt-4 mt-4">
  <!-- Footer Links -->
  <div class="container-fluid text-center text-md-left">

    <!-- Grid row -->
    <div class="row">
      <!-- Grid column -->
      <div class="col-md-6 mt-md-0 mt-3 text-white">
        <!-- Content -->
        <div class="container">
          <img class="center-block" src="https://i.imgur.com/f4vds0H.png" style="width:150px;height:auto">
          <p>A <b>better</b> way to shop.</p>
        </div>
        <!-- Grid column -->
      </div>
      <hr class="clearfix w-100 d-md-none pb-3">

      <!-- Grid column -->
      <div class="col-md-3 mb-md-0 mb-3">

        <!-- Links -->
        <h5 class="text-uppercase text-white">About Us</h5>

        <ul class="list-unstyled">
          <li>
            <a id="terms_link" href="javascript:void(0);">Terms and Conditions</a>
          </li>
          <li>
            <a id="privacy_link" href="javascript:void(0);">Privacy Policy</a>
          </li>
          <li>
            <a href="#!">Link 3</a>
          </li>
          <li>
            <a href="#!">Link 4</a>
          </li>
        </ul>

        <script>
          function popupWindow(url, title) {
            var w = 500;
            var h = 500;
            // Fixes dual-screen position                         Most browsers      Firefox
            var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
            var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;

            var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
            var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

            var systemZoom = width / window.screen.availWidth;
            var left = (width - w) / 2 / systemZoom + dualScreenLeft
            var top = (height - h) / 2 / systemZoom + dualScreenTop
            var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w / systemZoom + ', height=' + h / systemZoom + ', top=' + top + ', left=' + left);

            // Puts focus on the newWindow
            if (window.focus) newWindow.focus();
          }

          $(document).ready(function() {
            $('#terms_link').click(function() {
              popupWindow("./terms.html", "Terms and Conditions");
            });

            $('#privacy_link').click(function() {
              popupWindow("./privacypolicy.html", "Privacy Policy");
            });

            $('#tandc_link').click(function() {
              popupWindow("/choosencruise/html/FinanceTandC.html", "Financing Terms and Condition");

            });
          });
        </script>

      </div>
      <!-- Grid column -->

      <!-- Grid column
          <div class="col-md-3 mb-md-0 mb-3">

             Links
            <h5 class="text-uppercase  text-white">Links</h5>

            <ul class="list-unstyled">
              <li>
                <a href="#!">Link 1</a>
              </li>
              <li>
                <a href="#!">Link 2</a>
</li>              <li>
                <a href="#!">Link 3</a>
              </li>
              <li>
                <a href="#!">Link 4</a>
              </li>
            </ul>

          </div>
          Grid column
         -->
    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3 text-white">© 2019 Copyright:
    <a href="localhost/ChooseNCruise/index.html"> ChooseNCruise.com</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
