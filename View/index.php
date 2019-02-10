<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Test Title</title>
  </head>
  <body>

      <?php
        include('../Controller/DatabaseController.php');
      ?>
      <script src="../Controller/TestController.js"></script>

      <script>
        checkDBStatus();
      </script>

      <p> Hello world! <p>
      <?php
        mysqli_close($DBConnect);
      ?>
  </body>
</html>
