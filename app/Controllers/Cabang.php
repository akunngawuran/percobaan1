<?php

namespace App\Controllers;

class Cabang extends BaseController
{
	public function index(){
		if(isset($this->sesi->login)){
			if($this->sesi->sebagai === "admin"){
				return view('cabang/index');
			}else{
				return $this->ke('beranda');
			}
		}else{
			return $this->ke('login');
		}
	}
}
