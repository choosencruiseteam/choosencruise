<?php
  //include('../Controller/DBConnect.php');
  include('../Controllers/ConnectionFactory.php');
  include('../Controllers/DBController.php');



/**********************    get-car.php      *****************************
By: Chris Torres
Version: 1.0
Date: 3/4/2019

Purpose:
Fufill server side requests for data in the car table use GET
method via URL.

Description:
This file fufills AJAX requests from the front end JQuery routines. Using Get
values passed in the URL, the file will respond with a array of the query
result

Variables:
$DBConnect - Database connection used for queries.

Need to know:
where GET variable name is used to determine if WHERE clause is used
where=true (yes)
where=false (no)

****** Example URLS: *********

get-car.php?where=false
-Get all columns and all cars from database.

get-car.php?where=true&make="Toyota"&model="Camry"&year="2018"
-Get a car filtered in WHERE clause via make,model,year

*********************************************************************/

//Get static database connection
try {
    $DBConnect = ConnectionFactory::getFactory()->getConnection();
} catch (Exception $e) {
    echo json_encode("Error in establishing database connection: " . $e);
}

  /*****************************************
      Get search terms for dropdown menu
  *****************************************/
  if (isset($_GET['search'])) {
      if (isset($_GET['make']) && isset($_GET['model']) && isset($_GET['year'])) {
          //get * from car where make, model, year
      } elseif (isset($_GET['make']) && isset($_GET['model'])) {
          //get years with make and model
          $cc = new DBController($DBConnect);
          $make = $_GET['make'];
          $model = $_GET['model'];
          $SQLString = "SELECT distinct year FROM cars WHERE make=". $make .
      "AND model=" . $model;
          $list = $cc->queryGetArray($SQLString);
          echo json_encode($list);
      } elseif (isset($_GET['make'])) {
          //get models with make filter
          $cc = new DBController($DBConnect);
          $make = $_GET['make'];
          $SQLString = "SELECT distinct model FROM cars WHERE make=". $make;
          $list = $cc->queryGetArray($SQLString);
          echo json_encode($list);
      } else {
          $cc = new DBController($DBConnect);
          $list = $cc->queryGetArray("SELECT distinct make FROM cars");
          echo json_encode($list);
      }
  }

/**********************************
      Get car record from DB
**********************************/
  if (isset($_GET['where'])) {
      //if WHERE clause is not requested, get all cars
      if ($_GET['where'] === "false") {
          $cc = new DBController($DBConnect);

          /*
          $SQLString = 'SELECT vin,carlot_id,carlot_posted_price,
                    carlot_price_last_updated,make,model,trim,
                    year,engine,transmission FROM cars';
          */

          $SQLString = 'SELECT c.car_id, c.carlot_posted_price AS price, DATE_FORMAT(c.carlot_price_last_updated,"%m-%d-%Y") AS date,
                               c.make,c.model,c.trim,c.year, cl.name,cl.street,
                               cl.state,cl.city,cl.zip
                        FROM cars AS c
                        INNER JOIN carlots AS cl ON
                        c.carlot_id=cl.carlot_id';

          $list = $cc->queryGetAssoc($SQLString);
          echo json_encode($list);
      //if WHERE clause is requested, get all filter terms
      } elseif ($_GET['where'] === "true") {
          $cc = new DBController($DBConnect);
          $filterList = array();

          /*
          $SQLString = "SELECT carlot_id,carlot_posted_price,
                    carlot_price_last_updated,make,model,trim,
                    year,engine,transmission FROM cars";
          */
          
          $SQLString = 'SELECT c.car_id, c.carlot_posted_price AS price, DATE_FORMAT(c.carlot_price_last_updated,"%m-%d-%Y") AS date,
                               c.make,c.model,c.trim,c.year, cl.name,cl.street,
                               cl.state,cl.city,cl.zip
                        FROM cars AS c
                        INNER JOIN carlots AS cl ON
                        c.carlot_id=cl.carlot_id';

          if (isset($_GET['make']) && $_GET['make'] !== null) {
              $filter = " make=" . $_GET['make'] . " ";
              array_push($filterList, $filter);
          }
          if (isset($_GET['model']) && $_GET['model'] !== null) {
              $filter = " model=" . $_GET['model'] . " ";
              array_push($filterList, $filter);
          }
          if (isset($_GET['year']) && $_GET['year'] !== null) {
              $filter = " year=" . $_GET['year'] . " ";
              array_push($filterList, $filter);
          }

          //Add WHERE clause to SQL query, if filter terms retrieved
          if (count($filterList) > 0) {
              $SQLString .= " WHERE";
          }

          //If filter terms exists, append to SQL Query
          for ($i = 0; $i < count($filterList); ++$i) {
              $SQLString .= $filterList[$i];

              if (($i+2) <= count($filterList)) {
                  $SQLString .= "AND";
              }
          }


          $list = $cc->queryGetAssoc($SQLString);

          echo json_encode($list);
      }
  }
