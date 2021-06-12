<?php

namespace App\Controllers;

class Notifikasi extends BaseController
{
	public function index(){
		return $this->ke('login');
	}

	public function cabangkeagen(){
		$t = $this->request->getPost('tokennya');
		$j = $this->request->getPost('judul');
		$p = $this->request->getPost('pesan');
		if(!empty($t) && !empty($j)){
			$tokens = array();
			$radi = array("tokens" => $t);
			$tokens[] = $radi['tokens'];
			
			$message = array("title" => $j, "body" => $p);
			$message_status = $this->kirimnotif($tokens, $message);

			return "ok";
		}
		return "tidak ok";
	}

	public function cabangkekurir(){
		$t = $this->request->getPost('tokennya');
		$j = $this->request->getPost('judul');
		$p = $this->request->getPost('pesan');
		if(!empty($t) && !empty($j)){
			$tokens = array();
			$radi = array("tokens" => $t);
			$tokens[] = $radi['tokens'];
			
			$message = array("title" => $j, "body" => $p);
			$message_status = $this->kirimnotif($tokens, $message);

			return "ok";
		}
		return "tidak ok";
	}

	private function kirimnotif($tokens, $message){
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
}
