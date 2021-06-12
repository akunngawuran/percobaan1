<?php

namespace App\Controllers;

class Chat extends BaseController
{
	public function index(){
		if(isset($this->sesi->login)){
			if($this->sesi->sebagai === "admin"){
				return view('chat/index');
			}else{
				return $this->ke('beranda');
			}
		}else{
			return $this->ke('login');
		}
	}
}
