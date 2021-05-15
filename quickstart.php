<?php
require_once('./conection/init.php');
require __DIR__ . '/vendor/autoload.php';





// if (php_sapi_name() != 'cli') {
//     throw new Exception('This application must be run on the command line.');
// }

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('MarryMe');
    $client->setScopes(Google_Service_Calendar::CALENDAR);
    $client->setAuthConfig('credentials.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');


    //we are saving the token in session
    if ($_SESSION['access_token']) {
        $client->setAccessToken($_SESSION['access_token']);
    }
    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            if ($_GET['code']) {
                $authCode = $_GET['code'];

                // Exchange authorization code for an access token.
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                $_SESSION['access_token'] = $accessToken;
                $client->setAccessToken($_SESSION['access_token']);

                // Check to see if there was an error.
                if (array_key_exists('error', $_SESSION['access_token'])) {
                    throw new Exception(join(', ', $_SESSION['access_token']));
                }
            } else {
                // Request authorization from the user.
                $authUrl = $client->createAuthUrl();
                header("Location:" . $authUrl);
                die();
            }
        }

        $_SESSION['access_token'] = $client->getAccessToken();
    }
    return $client;
}


// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Calendar($client);

// Print the next 10 events on the user's calendar.
$calendarId = 'primary';
$optParams = array(
    'maxResults' => 10,
    'orderBy' => 'startTime',
    'singleEvents' => true,
    'timeMin' => date('c'),
);
$results = $service->events->listEvents($calendarId, $optParams);
$events = $results->getItems();


//insert event
$event = new Google_Service_Calendar_Event(array(
    'summary' =>  $_SESSION['name'],
    'location' => ' ',
    'description' => $_SESSION['description'],
    'start' => array(
        'dateTime' => $_SESSION['start_date'],
        'timeZone' => '',
    ),
    'end' => array(
        'dateTime' => $_SESSION['due_date'],
        'timeZone' => '',
    ),

    'reminders' => array(
        'useDefault' => FALSE,
        'overrides' => array(
            array('method' => 'email', 'minutes' => 24 * 60),
            array('method' => 'popup', 'minutes' => 10),
        ),
    ),
));

$calendarId = 'primary';
$event = $service->events->insert($calendarId, $event);

header("location:./includes/tasksProcess/tasks.php");