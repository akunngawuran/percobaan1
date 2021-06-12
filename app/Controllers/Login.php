<?php

namespace App\Controllers;

class Login extends BaseController
{
	public function index(){
		if(isset($this->sesi->login)){
			return $this->ke('beranda');
		}else{
			return view('login/index');
		}
	}

	public function setsesi(){
		$i = $this->request->getPost('idku');
		$k = $this->request->getPost('kotaku');
		$n = $this->request->getPost('namaku');
		$s = $this->request->getPost('sebagai');
		if(!empty($i) && !empty($k)){
			$this->sesi->set(['idku' => $i, 'kotaku' => $k, 'namaku' => $n, 'sebagai' => $s, 'login' => TRUE]);
			return "ok";
		}
		// $this->sesi->destroy();
		// return $this->sesi->get('idku');
		return "tidak ok";
	}
}
