<?php

namespace App\Controllers;

class Agen extends BaseController
{
	public function index(){
		if(isset($this->sesi->login)){
			if($this->sesi->sebagai === "admin"){
				return view('agen/admin');
			}else{
				return view('agen/index');
			}
		}else{
			return $this->ke('login');
		}
	}
}
