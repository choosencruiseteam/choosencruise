<?php
/*
start_session;

if(user is logged in){

  authenticate_user(); Use USER ID and AUTH Token stored in session data
                       and session ID to authenticate user

  if(user_auth == false){
    unset(session_user[])
    destroy_session();
    redirect to index.html;
  }else if(user_auth == true){
    check if login has expired;

    if(login has expired){
      unset(session_user[])
      destroy_session();
      redirect to index.html;
    }
  }
}

*/

include('./PHP/Controllers/AuthLib.php');
include('./PHP/Controllers/Timestamp.php');
$SESSION_TIMEOUT = 5; // 5 minute timeout

if(isset($_SESSION['user']) && isset($_SESSION['auth_token']) && isset($_SESSION['last_activity'])){

  $verifyResult;
  $timestampResult;

  $response = Auth::verifyLogin($_SESSION['user'], session_id(), $_SESSION['auth_token']);
  if($response['status'] == 'success'){
      $verifyResult = $response['data'];
  }else{
      $verifyResult = null;
  }

  $lastActivityDiff = Timestamp::diffMinutes($_SESSION['last_activity']);
  if( $lastActivityDiff >= $SESSION_TIMEOUT){
    $timestampResult = true;
  }else{
    $timestampResult = false;
  }

  if($verifyResult != true || $timestampResult == true){
    //redirect
  }else{
    //update last_activity
    $_SESSION['last_activity'] = Timestamp::now();
  }

?>
