<?php

namespace App\Controllers;

class Keluar extends BaseController
{
	public function index(){
		$this->sesi->destroy();
	}
}
