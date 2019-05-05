<?php

session_start();
include('../Controllers/ConnectionFactory.php');
include('../Controllers/DBController.php');
include('../Controllers/AuthLib.php');

//Get static database connection
try {
    $DBConnect = ConnectionFactory::getFactory()->getConnection();
} catch (Exception $e) {
    echo json_encode("Error in establishing database connection: " . $e);
}

if (isset($_SESSION['user']) && isset($_SESSION['auth_token']) && isset($_SESSION['last_activity'])) {

 $response = Auth::verifyLogin($DBConnect,$_SESSION['user'], session_id(), $_SESSION['auth_token']);

 if ($response['status'] == 'success') {
   $SQLString = 'SELECT username,first_name,last_name,street,city,state,zip,phone
                 FROM customer
                 WHERE cust_id='.$_SESSION['id'];

   $cc = new DBController($DBConnect);
   $result = $cc->queryGetAssoc($SQLString);
   echo json_encode($result);
 } else {
   echo json_encode(null);
 }
}else{
  echo json_encode(null);
}

?>
