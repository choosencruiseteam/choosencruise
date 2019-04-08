<?php
include('C:\xampp\htdocs\ChooseNCruise\PHP\include.php');

class Auth{


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
    public static function verifyLogin($DBConnect,$u, $s, $t){

      $user = $u;
      $sess = $s;
      $token = $t;

      $cc = new DBController($DBConnect);
      $SQLString = "SELECT * FROM sessions WHERE " .
                      "username='$user' LIMIT 1" ;
      $data = $cc->queryGetAssoc($SQLString)[0];

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
