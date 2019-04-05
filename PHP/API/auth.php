<?php
  /*        SESSION MANAGER

    Purpose: Handle session and login authentication

    PARAMS:
    'user' - the username of the current
    'session' - The current session ID
    'token' - Authorization token given back to front-end when a user successfully
              logs into their acct

  */

  include('../Controllers/ConnectionFactory.php');
  include('../Controllers/DBController.php');
  include('../Controllers/SodiumManager.php');
  include('../Controllers/TokenManager.php');
  include('../Controllers/TimestampManager.php');

  //Check API client key


//Get static database connection
  try {
      $DBConnect = ConnectionFactory::getFactory()->getConnection();
  } catch (Exception $e) {
      echo json_encode("Error in establishing database connection: " . $e);
  }

  //TODO: Check API client key



  /*    LOGIN AUTHENTICATION


    Param info:
   -------------
   u = username
   p = password


    Response info:
    ---------------
    status: success, fail, error
    data: contains data of api operation, null if error or fail
    auth_token: passing back an authentication token when login is verified

  */
  if(isset($_POST['login'])){
    if(isset($_POST['u']) && isset($_POST['p'])){
      $user = $_POST['u'];
      $pass = $_POST['p'];

      $cc = new DBController($DBConnect);
      $SQLString = "SELECT username, password FROM customer WHERE " .
                      "username='" . $user . "' LIMIT 1" ;
      $data = $cc->queryGetAssoc($SQLString)[0];
      //var_dump($data['password']);

      if($data !== null){
        $result = SodiumManager::compare($pass, $data['password']);
        if($result === true){
          //Create new token and log to DB
          $token = TokenManager::newToken()
          $_SESSION['auth_token'] = $token;
          $_SESSION['user'] = $user;
          $_SESSION['last_activity'] = Timestamp::now();
          $response = array('data'=>true,'auth_token'=> $token);
          echo json_encode($response);
        }else if($result === false){
          $response = array('data'=>false);
          echo json_encode($response);
        }

      }else if($data === null){
        $response = array('data'=>false);
        echo json_encode($response);
      }
    }
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
  if(isset($_GET['verify'])){
    if(isset($_GET['u']) && isset($_GET['s']) && isset($_GET['t'])){

      $user = $_GET['u'];
      $sess = $_GET['s'];
      $token = $_GET['t'];

      $cc = new DBController($DBConnect);
      $SQLString = "SELECT * FROM sessions WHERE " .
                      "username='" . $user . "' LIMIT 1" ;
      $data = $cc->queryGetAssoc($SQLString)[0];
      var_dump($data);

      if($data !== null){

        if($sess === $data['session_id'] && $token === $data['auth_token']){
          $response = array('status'=>'success','data'=>true);
          echo json_encode($response);
        }else{
          $response = array('status'=>'success','data'=>false);
          echo json_encode($response);
        }

      }else if($data === null){
        $response = array('status'=>'fail','data'=>null);
        echo json_encode($response);
      }

    }else{
      $response = array('status'=>'error','data'=>'Params missing from request');
      echo json_encode($response);
    }
  }

  if(isset($_GET['register'])){

  }
 ?>
