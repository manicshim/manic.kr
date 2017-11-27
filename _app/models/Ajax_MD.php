<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_MD extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	// 회원가입 유효성
	public function joinValidate($field, $val)
	{
		$s = "SELECT $field FROM member WHERE $field = '{$val}'";
		$r = $this->db->query($s);
		$output = ($r->num_rows()>0)?1:0; // 중복1,0
		return $output;
	}

	// 회원가입
	public function join($input)
	{
		$nick = explode("@", $input['mid']);
		$input['mpw_crypt'] = hash("sha256", $input['mpw']);	// 추구 패스워드 암호화 저장후 sha256처리

		$s = "INSERT INTO member
				(
					mid,
					mpw,
					nick,
					phone,
					lv,
					ip,
					reg_date
				) 
				VALUES
				(
					'{$input['mid']}',
					'{$input['mpw_crypt']}',
					'{$nick[0]}',
					'{$input['phone']}',
					'C',
					'{$_SERVER['REMOTE_ADDR']}',
					 NOW()
				)";
		$this->db->query($s);
		$output = ($this->db->affected_rows()>0)?1:0; //정상1,0

		return $output;
	}
}