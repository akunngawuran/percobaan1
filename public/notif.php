<?php
	function send_notification($tokens, $message){
		$url = 'https://fcm.googleapis.com/fcm/send';
		$fields = array('registration_ids' => $tokens,'data' => $message);
		
		$headers = array(
		'Authorization:key = AAAAOOW1Ssk:APA91bH9IkjQkECZ-KNmQficX98FzbM0U9OIDO8MxYoyg5YswI58PwBkvT2J5qbhiqdGNKlIiimNlMGyW3whgn07bW7dt_gq5pSEtmCKdy62SzI8iHEZmBL1AXNPVXhfgO9gGOU5wbw1',
		'Content-Type: application/json'
		);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		if($result === FALSE){
			die('Curl failed: ' . curl_error($ch));
		}
		curl_close($ch);
		return $result;
	}
	
	$tokens = array();
	$radi = array("tokens" => $_GET['tokennya']);
	$tokens[] = $radi['tokens'];
	
	$message = array("title" => $_GET['judul'], "body" => $_GET['pesan']);
	$message_status = send_notification($tokens, $message);
	echo "<script>alert('$message_status')</script>";
?>