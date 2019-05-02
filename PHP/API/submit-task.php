<?php
include('../Controllers/ConnectionFactory.php');
include('../Controllers/DBController.php');

//Get static database connection
try {
    $DBConnect = ConnectionFactory::getFactory()->getConnection();
} catch (Exception $e) {
    echo json_encode("Error in establishing database connection: " . $e);
}

if(isset($_GET['delivery'])){

}

if(isset($_GET['appointment'])){
  
}
?>
