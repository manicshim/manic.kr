<?php
defined('BASEPATH') OR exit('No direct scripot access allower');

class Member extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->allow = array('index','join'); // 로그인 확인, 제외일경우 메소드를 배열추가
	}
	
	// 헤더,푸터 매핑
	public function _remap($method, $params = array())
	{
		// 헤더, 푸터 포함할 메소드는 배열추가
		$allow_method = array('index', 'join');
		if (in_array($method, $allow_method)) {
			$this->load->view('inc/header');
			if (method_exists($this, $method)) call_user_func_array(array($this, $method), $params);
			$this->load->view('inc/footer');
		} else {
			if (method_exists($this, $method)) call_user_func_array(array($this, $method), $params);
		}
	}

	// 라우터 설정
	public function index()
	{
		$this->main();
	}

	public function main()
	{
		show_404();
	}

	public function join()
	{
		$this->load->view('member/join');
	}
}