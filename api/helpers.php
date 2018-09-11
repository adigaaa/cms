<?php

if (!function_exists('api_trans')) {
	function api_trans($path)
	{
		return trans('api/'.$path);
	}
	
}