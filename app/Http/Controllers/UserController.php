<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
	/**
   		@Get("/qq")
   */
	public function index()
	{
		return json_encode(["Murad" => "abaza"]);
	}
}