<?php
  /*        SESSION MANAGER

    Purpose: Handle session and login authentication

    PARAMS:
    'user' - the username of the current
    'session' - The current session ID
    'token' - Authorization token given back to front-end when a user successfully
              logs into their acct

  */
  session_start();
  include('C:\xampp\htdocs\ChooseNCruise\PHP\include.php');


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
      $SQLString = "SELECT cust_id,username,password FROM customer WHERE " .
                      "username='" . $user . "' LIMIT 1" ;
      $data = $cc->queryGetAssoc($SQLString)[0];

      if($data !== null){
        $result = SodiumManager::compare($pass, $data['password']);
        if($result === true){

          //Create new token and log to DB
          $token = TokenManager::newToken();
          $timestamp = Timestamp::now();
          $cust_id = $data['cust_id'];
          $session_id = session_id();

          $_SESSION['auth_token'] = $token;
          $_SESSION['user'] = $user;
          $_SESSION['id'] = $cust_id;
          $_SESSION['last_activity'] = $timestamp;

          $SQLString = "INSERT INTO sessions VALUES('$user', $cust_id, '$session_id','$token')";
          $result = $cc->queryInsert($SQLString);
          if($result === true){
            $response = array('data'=>true,'auth_token'=> $token);
          }else{
            $response = array('data'=>'DB error');
          }

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

  if(isset($_GET['destroy'])){

    $dbDeleteStatus = null;

    //kill session in DB
    if (isset($_SESSION['user']) && isset($_SESSION['auth_token']) && isset($_SESSION['id'])) {


      $user = $_SESSION['user'];
      $token = $_SESSION['auth_token'];
      $cust_id = $_SESSION['id'];
      $session_id = session_id();


      $cc = new DBController($DBConnect);

      $SQLString = "DELETE FROM sessions WHERE (username='$user' OR cust_id=$cust_id) AND (auth_token='$token' OR session_id='$session_id')";
      $result = $cc->queryInsert($SQLString);

      if($result === true){
        $dbDeleteStatus = 'success';
      }else if($result === false){
        $dbDeleteStatus = 'fail';
      }else {
        $dbDeleteStatus = 'error';
      }
    }

    //Destroy all traces of session
    session_unset();
    $_SESSION = array();
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), "", time()-3600, "/");
    }
    session_destroy();

    $response = array('status'=>$dbDeleteStatus);
    echo json_encode($response);
  }
 ?>
