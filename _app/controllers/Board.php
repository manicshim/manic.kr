<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Board extends CI_Controller
{
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->allow = array('index'); // 로그인체크 제외
		//post 전송된 모든 변수값에 대해 xss clean 처리
		$this->data = $this->input->post(NULL, true);
	}

	// 헤더,푸터 매핑
	public function _remap($method, $params = array())
	{
		// 헤더, 푸터 포함할 메소드는 배열추가
		$allow_method = array();
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
		echo "게시판";
	}
}