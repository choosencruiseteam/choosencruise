<?php
  include('../Controller/DBConnect.php');
  include('../Controller/CarController.php');

  //Get distinct make
  //Get distinct model from make
  //Get distinct years from make and model

  //SELECT distinct make FROM `cars`;
  //SELECT distinct model FROM `cars` WHERE make='$make';
  //SELECT distinct year FROM `cars` WHERE make='$make' AND model='$model';

  if(isset($_GET['make'])){
    echo json_encode($_GET['make']);
  }else if(isset($_GET['model'])){
    echo json_encode($_GET['model']);
  }else if(isset($_GET['year'])){
    echo json_encode($_GET['year']);
  }


  mysqli_close($DBConnect);
?>
