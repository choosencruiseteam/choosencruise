<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Test Title</title>
  </head>
  <body>

      <!-- Includes -->
      <?php
        //Test Comment
        include('../Controller/DatabaseController.php');
      ?>
      <script src="../Controller/TestController.js"></script>

      <!-- Run DB Status check -->
      <script>
        checkDBStatus();
        <?php mysqli_close($DBConnect); ?>
      </script>
<!-- Test Comment Nate -->
      <p> Hello World </p>
  </body>
</html>
