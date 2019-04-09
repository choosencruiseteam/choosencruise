<?php
include('C:\xampp\htdocs\ChooseNCruise\PHP\include.php');

//Get static database connection
try {
    $DBConnect = ConnectionFactory::getFactory()->getConnection();
} catch (Exception $e) {
    echo json_encode("Error in establishing database connection: " . $e);
}

$SESSION_TIMEOUT = 1; // 5 minute timeout

if (isset($_SESSION['user']) && isset($_SESSION['auth_token']) && isset($_SESSION['last_activity'])) {
    $verifyResult = false;
    $timestampResult = false;

    $response = Auth::verifyLogin($DBConnect,$_SESSION['user'], session_id(), $_SESSION['auth_token']);
    if ($response['status'] == 'success') {
        $verifyResult = $response["data"];
    } else {
        $verifyResult = false;
    }

    $lastActivityDiff = Timestamp::diffMinutes($_SESSION['last_activity']);
    if ($lastActivityDiff >= $SESSION_TIMEOUT) {
        $timestampResult = true;
    } else {
        $timestampResult = false;
    }

    if ($verifyResult != true || $timestampResult == true) {
        header("Location: http://localhost/choosencruise/html/signout.php?session_expired");
        die();
    } else {
        $_SESSION['user_auth'] = true;
        $_SESSION['last_activity'] = Timestamp::now();

    }
}
