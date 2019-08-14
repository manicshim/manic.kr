<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->allow = array('index','main','info'); // 로그인체크 제외
	}

	// 헤더,푸터 매핑
	public function _remap($method, $params = array())
	{
		// 헤더, 푸터 포함할 메소드는 배열추가
		$allow_method = array('index', 'info');
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
	
	// 메인페이지
	public function main()
	{
		// main page에 필요한 소스코드 작성
		$this->load->view('main/index');
	}
	
	public function info()
	{

		$this->load->view('main/info');

	}
}
