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
$shortstat .= shell_exec("git diff --shortstat");

if (empty($shortstat)) {
    $output .= date("d.m.Y H:i:s") . ' No files t be updated. Lets move on...' . _NL_;
}
else {
    $output .= '<pre>' . $shortstat . '</pre>' . _NL_;

    $output .= date("d.m.Y H:i:s") . ' Attempting to add files.' . _NL_;
    $git_add = shell_exec("git add --all .");
    $output .= date("d.m.Y H:i:s") . ' Modified files added.' . _NL_;

    $git_status = shell_exec("git status -s");
    dump($git_status, "Git Status");
    $output .= '<pre>' . $git_status . '</pre>' . _NL_;

    $output .= date("d.m.Y H:i:s") . ' Starting to commit files to branch: ' . $branch . '.' . _NL_;

    $output .= date("d.m.Y H:i:s") . ' Generating commit message.';
    $commit_message = 'Server side commit at ' . date("d.m.Y H:i:s") . _NL_;

    $output .= '<pre>' . $commit_message . '</pre>';

    $output .= date("d.m.Y H:i:s") . ' Attempting to commit.' . _NL_;
    $commit = shell_exec('git commit -m "' . $commit_message . '"');
    $output .= '<pre>' . $commit . '</pre>';

    $output .= date("d.m.Y H:i:s") . ' Updated Files committed to branch: ' . $branch . '.' . _NL_;
}






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
