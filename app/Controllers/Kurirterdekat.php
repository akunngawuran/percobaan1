<?php

namespace App\Controllers;

class Kurirterdekat extends BaseController
{
	private $keyApi = "AIzaSyBp4MDXGN2T7ZPDOnDFf_FUuOzwzJ8wYBU";
	private $mapurl = "https://maps.googleapis.com/maps/api/directions/json";

	public function index(){
		return $this->ke('beranda');
	}

	public function cek(){
		$latku = $this->request->getPost('latku');
		$lonku = $this->request->getPost('lonku');
		$latkurir = $this->request->getPost('latkurir');
		$lonkurir = $this->request->getPost('lonkurir');
		return $this->fungsijarak($latku, $lonku, $latkurir, $lonkurir);
	}

	private function fungsijarak($lat1, $lon1, $lat2, $lon2){
	    $url = $this->mapurl."?origin=".$lat1.",".$lon1."&destination=".$lat2.",".$lon2."&sensor=false&units=metric&mode=driving&key=".$this->keyApi;
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	    $response = curl_exec($ch);
	    curl_close($ch);
	    $response_a = json_decode($response, true);
	    $routes = $response_a['routes'][0]['legs'][0]['distance']['text'];
	    $jarak = explode(" km", $routes);

	    return $jarak[0];
	}
}
