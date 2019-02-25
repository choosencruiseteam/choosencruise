<?php
  include("../Model/car.php");

  class CarController{

    private $carTable;
    private $DBConnect;

    //Constructor - set car table name
    public function __construct($DBConnect){
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
    public function getAll(){

      $SQLString = "SELECT * FROM $this->carTable";
      $QueryResult = mysqli_query($this->DBConnect,$SQLString);

      if($QueryResult === FALSE)
			{
				echo "<p>Unable to execute the query</p>".
				"<p>Error Code " . mysqli_errno($this->DBConnect) . ": " .
				mysqli_error($this->DBConnect) . "</p>";

				return null;
			}else{

        $carList = array();

				while($Row = mysqli_fetch_row($QueryResult))
				{
					$newCar = new Car($Row);
					array_push($carList,$newCar);
				}

				return $carList;
			}
    }

    //Get all cars in the cars table
    public function getAllAsArray(){

      $SQLString = "SELECT * FROM $this->carTable";
      $QueryResult = mysqli_query($this->DBConnect,$SQLString);

      if($QueryResult === FALSE)
			{
				echo "<p>Unable to execute the query</p>".
				"<p>Error Code " . mysqli_errno($this->DBConnect) . ": " .
				mysqli_error($this->DBConnect) . "</p>";

				return null;
			}else{

        $carListArray = array();

				while($Row = mysqli_fetch_row($QueryResult))
				{

          $rowData = array();
          foreach ($Row as $key => $value) {
            array_push($rowData,$value);
          }

					array_push($carListArray,$rowData);
				}
				return $carListArray;
			}
    }

    /*
    NOT FUNCTIONAL- DEVELOPEMENT IN PROCESS (CHRIS)
    public function getSearchTerms(){

      $SQLString = "SELECT distinct make FROM $this->carTable";
      $QueryResult = mysqli_query($this->DBConnect,$SQLString);

      if($QueryResult === FALSE)
      {
        echo "<p>Unable to execute the query</p>".
        "<p>Error Code " . mysqli_errno($this->DBConnect) . ": " .
        mysqli_error($this->DBConnect) . "</p>";

        return null;
      }else{

      }
    }
    */

    //Converts array of car objects to array of associateive arrays of
    //car member variab;es
    public function toArray($data){
      $newCarArray = array();

      foreach ($data as $car) {
        array_push($newCarArray,$car->toAssocObject());
      }

      return $newCarArray;
    }

  }
 ?>
