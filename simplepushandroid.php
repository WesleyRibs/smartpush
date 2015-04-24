<?php
// API access key from Google API's Console
define( 'API_ACCESS_KEY', 'AIzaSyB5Lx8jMnC3W_szJM2YlFw9m51xby9fOfE' );


$registrationIds = array( 'APA91bEO9okUXJ_8fUFythdE4ssEtn4HTuyTJmlGNAS16xj9x1TTQmCjfy8zZ4TzAVZKTZM4hUwEcNwAOsRpcRj6krYjMH3WCAXOo2iTabVkuo1E-nA-b8IYI6FA6VxVkOpsLFoq2iG1f7TZp_WUFd7FxrU8lJMqTg' );

// prep the bundle
$msg = array
(
	'message' 	=> 'Eu te amo \o/',
	'title'		=> 'AMOR ME CHAMA NO TALK.....',
	'subtitle'	=> 'me Chamaaaaaaaaaa.......',
	'tickerText'=> 'Ticker text here...Ticker text here...Ticker text here',
	'vibrate'	=> 1,
	'sound'		=> 1,
	'largeIcon'	=> 'large_icon',
	'smallIcon'	=> 'small_icon'
);

$fields = array
(
	'registration_ids' 	=> $registrationIds,
	'data'			=> $msg
);
 
$headers = array
(
	'Authorization: key=' . API_ACCESS_KEY,
	'Content-Type: application/json'
);
 
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );

echo $result;