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
<<<<<<< HEAD
		// main page에 필요한 소스코드 작성i
		// 주석문확인
		// 점점 늘어나는 주석
		// 데리고 올생각이다
=======
>>>>>>> manic
		$this->load->view('main/index');
	}
	
	public function info()
	{
		// info mation 페이지를 생성했느냐?
		$this->load->view('main/info');

	}
}
