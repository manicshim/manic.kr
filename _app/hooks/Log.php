<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log {
	function checkPermission()
	{
		$CI =& get_instance();
		$CI->load->library('session');
		$CI->load->helper('url');

		if($CI->session->userdata('is_login')) true;
		else if (in_array($CI->router->method, $CI->allow)) true;
		else redirect('/auth/'); // 로그인창으로 강제 이동
	}
}