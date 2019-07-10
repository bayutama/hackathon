<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	function __construct()
	{
		//$request = new Request;
		$this->main_menu  = "";
		$this->aaaToken   = "";
		$this->userInfo   = "";
		// $this->aaaToken   = $request->session()->get('aaaToken');
		// $this->userInfo   = $request->session()->get('userInfo');
		$this->session_id = session_id();
		
	}
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
}
