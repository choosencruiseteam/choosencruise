<?php

class Auth{

  include('../Controllers/ConnectionFactory.php');
  include('../Controllers/DBController.php');
  include('../Controllers/SodiumManager.php');
  include('../Controllers/TokenManager.php');

  //Check API client key

//Get static database connection
  try {
      $DBConnect = ConnectionFactory::getFactory()->getConnection();
  } catch (Exception $e) {
      echo json_encode("Error in establishing database connection: " . $e);
  }

  /*    SESSION AND LOGIN VERIFICATION


    Param info:
   -------------
   u = username
   s = session_id
   t = auth_token

    Response info:
    ---------------
    status: success, fail, error
    data: contains data of api operation, null if error or fail

  */
    public static function verifyLogin($u, $s, $t){

      $user = $u;
      $sess = $s;
      $token = $t;

      $cc = new DBController($DBConnect);
      $SQLString = "SELECT * FROM sessions WHERE " .
                      "username='" . $user . "' LIMIT 1" ;
      $data = $cc->queryGetAssoc($SQLString)[0];
      var_dump($data);

      if($data !== null){

        if($sess === $data['session_id'] && $token === $data['auth_token']){
          $response = array('status'=>'success','data'=>true);
          return $response;
        }else{
          $response = array('status'=>'success','data'=>false);
          return $response;
        }

      }else if($data === null){
        $response = array('status'=>'fail','data'=>null);
        return $response;
      }
    }

  }
 ?>
