<?php

namespace App\Controllers;

class Barangdatang extends BaseController
{
	public function index(){
		return $this->ke('beranda');
	}

	public function agen(){
		return view('barangdatang/inagen');
	}

	public function cabang(){
		return view('barangdatang/incabang');
	}
}
