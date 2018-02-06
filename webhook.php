<?php


/**
 * Set up the core
 */
$access_token = 'passwordIDontWantToMakeASuperSecretPasswordForThis';
$access = false;
$incoming_ip = $_SERVER['REMOTE_ADDR'];
$message = '';
$log = '';
$output = '';


$json = file_get_contents('php://input');
$data = json_decode($json, true);
dump($data);



/**
 * Check for token
 */
if (!isset($_GET['token'])) {
    $log = 'Invalid Token: None Given' . PHP_EOL;
    $client_token = false;
}
else {
    $client_token = $_GET['token'];
}


if ($client_token && $client_token != $access_token) {
    $log = "Invalid Token: $access_token" . PHP_EOL;
}
else {
    $access = true;
}


/**
 * Optimize images
 */




/**
 * Commit Current Updates
 */


/**
 * Push the update
 */


/**
 * Pull the update
 */



/**
 * Check $log and write to log file
 */
if (!empty($log)) {
    $fs = fopen('./webhook.log', 'a');
    $log = 'Requested on [' . date("Y-m-d H:i:s") . '] ' .
    'by [' . $incoming_ip . ']' . PHP_EOL .
    "Message: $log" . PHP_EOL . PHP_EOL;

    fwrite($fs, $log);
    $fs and fclose($fs);
}
