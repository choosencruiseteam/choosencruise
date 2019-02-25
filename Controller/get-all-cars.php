<?php
  include('../Controller/DBConnect.php');
  include('../Controller/CarController.php');

  $cci = new CarController($DBConnect);
  $carListArray = $cci->getAll();
  $assoArray = $cci->toArray($carListArray);

  //var_dump($assoArray);
  echo json_encode($assoArray);

  mysqli_close($DBConnect);
 ?>
