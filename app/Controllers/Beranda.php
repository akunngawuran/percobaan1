<?php

namespace App\Controllers;

class Beranda extends BaseController
{
	public function index(){
		if(isset($this->sesi->login)){
			if($this->sesi->sebagai === "admin"){
				return view('beranda/admin');
			}else{
				return view('beranda/index');
			}
		}else{
			return $this->ke('login');
		}
	}
}
