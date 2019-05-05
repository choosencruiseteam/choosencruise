<?php
include('../Controllers/ConnectionFactory.php');
include('../Controllers/DBController.php');
include('../Controllers/Validation.php');


//Get static database connection
try {
    $DBConnect = ConnectionFactory::getFactory()->getConnection();
} catch (Exception $e) {
    echo json_encode("Error in establishing database connection: " . $e);
}

if(isset($_GET['delivery'])){
  $validationResult = Validate::all($_POST);
  if($validationResult['status'] == true){
    //insert in DB
    $cust_id = $_POST['user'];
    $req_date = $_POST['req_date'];
    $car_id = $_POST['car'];
    $final_price = $_POST['final_price'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $phone = $_POST['phone'];

    //Insert new delivery order
    $cc = new DBController($DBConnect);
    $SQLString = "INSERT INTO delivery (cust_id,order_date,req_date,expected_delivery_date,car_id,final_price, first_name, last_name, street, city, state,zip, phone)
      VALUES('$cust_id',now(),'$req_date','pending','$car_id','$final_price','$fname','$lname','$street','$city','$state','$zip','$phone' )";

    $result = $cc->queryInsert($SQLString);

    //make car unavailable
    $SQLString = "UPDATE cars SET avail=0 WHERE cars.car_id =". $car_id;
    $cc->queryInsert($SQLString);

    $response = array('status'=>true,'result'=>$result);
    echo json_encode($response);

  }else if($validationResult['status'] == false){
    //return error data from validation
    echo json_encode($validationResult);
  }else{
    echo json_encode(array('status'=>null));
  }
}

if(isset($_GET['appointment'])){
  $validationResult = Validate::all($_POST);

  if($validationResult['status'] == true){
    //insert in DB
    $user_id = $_POST['user'];
    $phone = $_POST['phone'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $car_id = $_POST['car'];

    $appt_date = date("Y-m-d",strtotime($_POST['req_date']));

    $cc = new DBController($DBConnect);
    $SQLString = "INSERT INTO appointment (cust_id,car_id,date_created, appointment_date, phone, first_name, last_name)
      VALUES('$user_id','$car_id',now(),STR_TO_DATE('$appt_date','%Y-%m-%d'),'$phone','$fname','$lname')";

    $result = $cc->queryInsert($SQLString);
    $response = array('status'=>true,'result'=>$result);
    echo json_encode($response);
  }else if($validationResult['status'] == false){
    //return error data from validation
    echo json_encode($validationResult);
  }else{
    echo json_encode(array('status'=>null));
  }
}

if(isset($_GET['update_user'])){

  $validationResult = Validate::all($_POST);

  if($validationResult['status'] == true){

    //insert in DB
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $phone = $_POST['phone'];

    //Insert new delivery order
    $cc = new DBController($DBConnect);
    $SQLString = "UPDATE customer
                  SET first_name='$fname', last_name='$lname', street='$street',
                      city='$city', state='$state',zip='$zip', phone='$phone'
                  WHERE cust_id=". $_SESSION['id'];


    $result = $cc->queryInsert($SQLString);

    $response = array('status'=>true,'result'=>$result);
    echo json_encode($response);

  }else if($validationResult['status'] == false){

    echo json_encode($validationResult);
  }else{
    echo json_encode(array('status'=>null));
  }
}
?>
