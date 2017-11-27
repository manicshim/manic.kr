<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_MD extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	// 로그인 데이터 검출
	public function login($input)
	{
		if ( !empty($input) ) {
			$q = "SELECT 
					mpw,
					nick,
					lv,
					last_log
					FROM member
					WHERE mid = '{$input['mid']}'
					LIMIT 1";
			$r = $this->db->query($q);
			$output = $r->row_array();
		}

		return $output;
	}
}