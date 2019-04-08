<?php

  class DBController
  {
      private $DBConnect;

      //Constructor - set car table name
      public function __construct($DBConnect)
      {
          $this->DBConnect = $DBConnect;
      }

      //Return an 2D array of result set
      public function queryGetArray($SQLString)
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

              if(count($list) < 1){
                return null;
              }else{
                return $list;
              }
          }
      }

      //returns SELECT values as a associative array
      public function queryGetAssoc($SQLString)
      {
        //Example: $SQLString = "SELECT distinct make FROM cars";
            $QueryResult = mysqli_query($this->DBConnect, $SQLString);

            if ($QueryResult === false) {
                echo "<p>Unable to execute the query</p>".
          "<p>Error Code " . mysqli_errno($this->DBConnect) . ": " .
          mysqli_error($this->DBConnect) . "</p>";

                return null;
            } else {
                $list = [];

                while ($Row = mysqli_fetch_assoc($QueryResult)) {
                    array_push($list, $Row);
                }

                if(count($list) < 1){
                  return null;
                }else{
                  return $list;
                }

            }
      }

      //Insert query that returns results of insert
      public function queryInsert($SQLString){
        //Example: $SQLString = "SELECT distinct make FROM cars";
            $QueryResult = mysqli_query($this->DBConnect, $SQLString);

            if ($QueryResult === false) {
                echo "<p>Unable to execute the query</p>".
          "<p>Error Code " . mysqli_errno($this->DBConnect) . ": " .
          mysqli_error($this->DBConnect) . "</p>";

                return null;
            } else {
              return $QueryResult;
            }
      }
  }
