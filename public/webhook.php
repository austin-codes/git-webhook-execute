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
define('_NL_', '<br />');


$branch = shell_exec("git branch | grep \* | cut -d ' ' -f2");
$branch = preg_replace('/\s+/','',$branch);
dump($branch);

// $json = file_get_contents('php://input');
// $data = json_decode($json, true);
// dump($data);
// $log = $json;



/**
 * Check for token
 */
if (!isset($_GET['token'])) {
    $log .= 'Invalid Token: None Given' . PHP_EOL;
    $client_token = false;
}
else {
    $client_token = $_GET['token'];
}


if ($client_token && $client_token != $access_token) {
    $log .= "Invalid Token: $access_token" . PHP_EOL;
}
else {
    $log .= 'Valid Token: Access Granted' . PHP_EOL;
    $access = true;
}


/**
 * Optimize images
 */




/**
 * Commit Current Updates
 */
$output .= date("d.m.Y H:i:s") . ' Checking for updated files...' . _NL_;
$output .= shell_exec("git diff --shortstat") . _NL_;


$output .= date("d.m.Y H:i:s") . ' Updated Files committed to branch: ' . $branch . '.' . _NL_;



/**
 * Push the update
 */
$output .= date("d.m.Y H:i:s") . ' Starting push to branch: ' . $branch . '.';

$output .= date("d.m.Y H:i:s") . ' Completed push to branch: ' . $branch . '.';

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
    "Message: $log" . PHP_EOL . PHP_EOL ;

    fwrite($fs, $log);
    $fs and fclose($fs);
}


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <?php echo $output; ?>
    </body>
</html>
