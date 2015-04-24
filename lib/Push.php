<?php


Class Push {

	public $url = [
			'IOS' 	  => 'ssl://gateway.sandbox.push.apple.com:2195', 
			'ANDROID' => 'https://android.googleapis.com/gcm/send'
		];

	public $key = [
			'IOS' 		=> 'Wesinline1',
			'ANDROID'	=> 'AIzaSyB5Lx8jMnC3W_szJM2YlFw9m51xby9fOfE'
		];


	/**
	* sendPushIos - method which send 
	* a push notification for Google.
	*
	* @param array $data ['deviceToken', 'msg', 'badge']
	* @return void
	**/
	public function sendPushIos( $data )
	{
		if (!$data || !$data['deviceToken'] || !$data['msg'])
			return false;


		$ctx = stream_context_create();
		stream_context_set_option($ctx, 'ssl', 'local_cert', 'ApnsDev.pem');
		stream_context_set_option($ctx, 'ssl', 'passphrase', self::key['IOS']);

		# Open a connection to the APNS server
		$fp = stream_socket_client(self::url['IOS'], $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

		if (!$fp)
			exit("Failed to connect: $err $errstr" . PHP_EOL);

		echo 'Connected to APNS' . PHP_EOL;

		# Create the payload body
		$body['aps'] = array(
			'badge' => ($data['badge']) ? $data['badge'] : 1,
			'alert' => $data['msg'],
			'sound' => 'default'
			);

		# Encode the payload as JSON
		$payload = json_encode($body);

		# Build the binary notification
		$msg = chr(0) . pack('n', 32) . pack('H*', $data['deviceToken']) . pack('n', strlen($payload)) . $payload;

		# Send it to the server
		$result = fwrite($fp, $msg, strlen($msg));

		if (!$result)
			echo 'Message not delivered' . PHP_EOL;
		else
			echo 'Message successfully delivered' . PHP_EOL;

		# Close the connection to the server
		fclose($fp);

		
	}

	/**
	* sendPushIos - method which send 
	* a push notification for Google.
	*
	* @param array $data [
	*				'deviceToken' => (array), 'msg', 
	*				'title', 'subtitle', 'tickerText']
	* @return void
	**/
	public function sendPushAndroid( $data )
	{
		if (!$data || !$data['deviceToken'] 
			|| !$data['msg'] || !$data['title']
			|| !$data['subtitle'])
			return false;


		// prep the bundle
		$msg = [
			'message' 	=> $data['msg'],
			'title'		=> $data['title'],
			'subtitle'	=> $data['subtitle'],
			'tickerText'=> ($data['tickerText']) ? $data['tickerText'] : '',
			'vibrate'	=> 1,
			'sound'		=> 1,
			'largeIcon'	=> 'large_icon',
			'smallIcon'	=> 'small_icon'
		];

		$fields = [
			'registration_ids' 	=> $data['deviceToken'],
			'data'				=> $msg
		];
		 
		$headers = [
			'Authorization: key=' . self::key['ANDROID'],
			'Content-Type: application/json'
		];
		 
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, self::url['ANDROID'] );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );

		echo $result;
	}
	
}