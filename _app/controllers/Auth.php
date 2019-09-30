<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public $data;
	public function __construct()
	{
		parent::__construct();
		$this->allow=array('index','login','logout');	// 로그인체크 제외
		//post 전송된 모든 변수값에 대해 xss clean 처리
		$this->data = $this->input->post(NULL, TRUE);
	}

	// 헤더,푸터 매핑
	public function _remap($method, $params = array())
	{
		// 헤더, 푸터 포함할 메소드는 배열추가
		$allow_method = array('index');
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
		$this->load->view('auth/login');
	}

	// 로그인
	public function login()
	{
		// 데이터 전송이 있을경우에만
		if ($this->data) {
			$input['mid'] = $this->data['mid'];
			$input['mpw'] = hash("sha256", $this->data['mpw']);

			// Model
			$output = $this->Auth_MD->login($input);

			if ( !empty($output) ) {
				// DB 검출후 비번 검증
				if ($output['mpw'] == $input['mpw']) {
					$sessionData = array(
						'id'        => $input['mid'],
						'lv'        => $output['lv'],
						'last'      => $output['last_log'],
						'is_login'  => TRUE
					);
					$this->session->set_userdata($sessionData); //세션담기

					$result['code'] = 1; // "Success";"로그인 성공";
					$result['msg'] = "즐거운 관람 되십시오.";
				} else {
					$result['code']= 2; // "Fail";"비밀번호 실패";
					$result['msg'] = "비밀번호를 확인하세요.";
				}
			} else {
				$result['code'] = 0; // "Fail";"로그인 실패";
				$result['msg'] = "오류가 발생되었습니다.";
			}
			
			// json 출력
			//$json_encode = json_encode($result);
			echo $result;
		} else {
			show_404();
		}
	}

	// 로그아웃
	public function logout()
	{
		$this->session->sess_destroy();
		header('Location: '.base_url());
	}
}