<?php
require 'lib/Push.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($_POST['type'] == 'ios') :
			echo Push::sendPushIos( $_POST );
		endif;

		if ($_POST['type'] == 'android') :
			echo Push::sendPushIos( $_POST );
		endif;
}