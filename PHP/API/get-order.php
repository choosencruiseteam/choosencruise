<?php
include('../Controllers/ConnectionFactory.php');
include('../Controllers/DBController.php');
include('../Controllers/Validation.php');
session_start();

//Get static database connection
try {
    $DBConnect = ConnectionFactory::getFactory()->getConnection();
} catch (Exception $e) {
    echo json_encode("Error in establishing database connection: " . $e);
}

if(isset($_GET['delivery'])){

  $validationResult = Validate::all($_POST);

  if($_GET['delivery'] == 'all'){}
    $cc = new DBController($DBConnect);
    $SQLString = 'SELECT distinct d.delivery_id,i.main_img_hash,d.final_price,
                                  d.order_date,d.req_date,d.expected_delivery_date,
				                          cl.name,cl.street,cl.state,cl.city,cl.zip,cl.phone,
                                  c.make,c.model,c.year,c.trim from delivery As d
                inner join cars as c on c.car_id = d.car_id
                inner join carlots AS cl on c.carlot_id=cl.carlot_id
                left join imgur_bank as i on i.car_id = d.car_id where cust_id='.$_SESSION['id'].' order by d.delivery_id desc';
    $result = $cc->queryGetAssoc($SQLString);

    if($result != null){
      $response = array('status'=>true,'result'=>$result);
      echo json_encode($response);
    }else{
      $response = array('status'=>false,'result'=>null);
      echo json_encode($response);
    }

  }


if(isset($_GET['appointment'])){
  $validationResult = Validate::all($_POST);

  if($_GET['appointment'] == 'all'){}
    $cc = new DBController($DBConnect);

    //order_id, car_img, (make,, model, year, trim), (carlot: name,street,city,state,zip,phone)
    //appt_date, time, note

    $SQLString = 'SELECT distinct a.appt_id,i.main_img_hash,c.make,c.model,c.trim,
                                  c.year,cl.name,cl.street,cl.state,cl.city,
                                  cl.zip,cl.phone,a.appointment_date,a.time
				        from appointment as a
                inner join cars as c on c.car_id = a.car_id
                inner join carlots AS cl on c.carlot_id=cl.carlot_id
                left join imgur_bank as i on i.car_id = a.car_id where cust_id='.$_SESSION['id'].' order by a.appt_id desc';
    $result = $cc->queryGetAssoc($SQLString);

    if($result != null){
      $response = array('status'=>true,'result'=>$result);
      echo json_encode($response);
    }else{
      $response = array('status'=>false,'result'=>null);
      echo json_encode($response);
    }
}
?>
