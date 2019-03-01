<?php
  include("../Model/Car.php");

  class CarController
  {
      private $carTable;
      private $DBConnect;

      //Constructor - set car table name
      public function __construct($DBConnect)
      {
          $this->carTable = "cars";
          $this->DBConnect = $DBConnect;
          /*
          if($this->DBConnect == TRUE)
            echo "<p>Connected<p>";
          else if($this->DBConnect == FALSE)
            echo "<p>Not Connected<p>";
          else
            echo "<p>Error<p>";
            */
      }

      //Get all cars in the cars table
      public function getAll()
      {
          $SQLString = "SELECT * FROM $this->carTable";
          $QueryResult = mysqli_query($this->DBConnect, $SQLString);

          if ($QueryResult === false) {
              echo "<p>Unable to execute the query</p>".
                "<p>Error Code " . mysqli_errno($this->DBConnect) . ": " .
                mysqli_error($this->DBConnect) . "</p>";

              return null;
          } else {
              $carList = array();

              while ($Row = mysqli_fetch_row($QueryResult)) {
                  $newCar = new Car($Row);
                  array_push($carList, $newCar);
              }

              return $carList;
          }
      }


      //Returns a Array of Car Objects
      public function queryGetCarArray($SQLString)
      {

      //Example: $SQLString = "SELECT * FROM $this->carTable WHERE make=x";
          $QueryResult = mysqli_query($this->DBConnect, $SQLString);

          if ($QueryResult === false) {
              echo "<p>Unable to execute the query</p>".
        "<p>Error Code " . mysqli_errno($this->DBConnect) . ": " .
        mysqli_error($this->DBConnect) . "</p>";

              return null;
          } else {
              $carList = array();

              while ($Row = mysqli_fetch_row($QueryResult)) {
                  $newCar = new Car($Row);
                  array_push($carList, $newCar);
              }

              return $carList;
          }
      }

      //Return an Array of fields
      public function queryGetList($SQLString)
      {

      //Example: $SQLString = "SELECT distinct make FROM cars";
          $QueryResult = mysqli_query($this->DBConnect, $SQLString);

          if ($QueryResult === false) {
              echo "<p>Unable to execute the query</p>".
        "<p>Error Code " . mysqli_errno($this->DBConnect) . ": " .
        mysqli_error($this->DBConnect) . "</p>";

              return null;
          } else {
              $list = array();

              while ($Row = mysqli_fetch_row($QueryResult)) {
                  array_push($list, $Row);
              }

              return $list;
          }
      }


      //Converts array of car objects to array of associateive arrays of
      //car member variab;es
      public function toArray($data)
      {
          $newCarArray = array();

          foreach ($data as $car) {
              array_push($newCarArray, $car->toAssocObject());
          }

          return $newCarArray;
      }
  }
