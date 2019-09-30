<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller
{
	public $data;
	private $responseType = 'json'; // json or jsonp or html

	public function __construct()
	{
		parent::__construct();
		$this->allow=array('join','upload','mid_chk','login');	// 로그인체크 제외
		$this->setHeader();
		//post 전송된 모든 변수값에 대해 xss clean 처리
		$this->data = $this->input->post(NULL, true);
	}

	// Set Response Header
	private function setHeader()
	{
		$uris = explode("/", $this->uri->uri_string);
		$this->responseType = $uris[sizeof($uris) - 1];

		if ($this->responseType == "json") {
			header("Content-type:application/json;charset=UTF-8");
		} else if ($this->responseType == "html") {
			header("Content-type:text/html;charset=UTF-8");
		}  else if ($this->responseType == "jsonp") {
			header("Content-type:text/javascript;charset=UTF-8");
		} else {
			header("Content-type:application/json;charset=UTF-8");
			$arr["result"] = false;
			$arr["error"]["code"] = 900;
			$arr["error"]["message"] = "invalid response data Type [json or jsonp]";

			echo json_encode($arr);
			exit();
		}
	}

	// Set Response Body
	private function setBody($responseData)
	{
		if ($this->responseType == "json") {
			echo json_encode($responseData);
		} else if ($this->responseType == "html") {
			foreach ($responseData as $key => $val) {
				debug( $responseData );
			}
		} else if ($this->responseType == "jsonp") {
			$stringJSON = json_encode($responseData);
			echo $_GET['callback'] . "(" . urldecode($stringJSON) . ");";
		}
	}

	//json 샘플
	public function sample()
	{
		$res["test"] = 1;
		$res["post"] = 2;
		$this->setBody($res);
	}

	// 로그인
	public function login()
	{
		// 데이터 전송이 있을경우에만
		if ( !empty($this->data) ) {
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

					$output['code'] = 1; // "Success";"로그인 성공";
					$output['msg'] = "즐거운 관람 되십시오.";
				} else {
					$output['code']= 2; // "Fail";"비밀번호 실패";
					$output['msg'] = "비밀번호를 확인하세요.";
				}
			} else {
				$output['code'] = 0; // "Fail";"로그인 실패";
				$output['msg'] = "오류가 발생되었습니다.";
			}

			$this->setBody($output);
		} else {
			show_404();
		}
	}

	// 회원가입 중복검사
	private function validate($val)
	{
		$output = $this->Ajax_MD->joinValidate($val, $this->data[$val]);
		return $output;
	}

	// 회원가입
	public function join()
	{
		if ( !empty($this->data) ) {
			// mid 중복확인
			if ($this->validate('mid') == 1) {
				$output['result'] = "Fail";
				$output['result_msg'] = "E-mail 주소가 이미 가입되어있습니다.";
			} else if ($this->validate('phone') == 1) { // phone 중복확인
				$output['result'] = "Fail";
				$output['result_msg'] = "휴대폰 번호가 이미 가입되어있습니다.";
			} else {
				// 중복확인 이후 회원가입 DB 처리
				$result = $this->Ajax_MD->join($this->data);
				// DB 처리가 정상일 경우
				if ($result == 1) {
					$output['result'] = "Success";
					$output['result_msg'] = "정상적으로 회원가입 되었습니다.\r로그인 페이지로 이동합니다.";
				} else {
					$output['result'] = "Fail";
					$output['result_msg'] = "MD: 회원가입 실패";
				}
			}
		}else{
			$output['result'] = "Fail";
			$output['result_msg'] = "CR: 회원가입 실패";
		}

		$this->setBody($output);
	}

	// 회원 mid 검출
	public function mid_chk()
	{
		if ( !empty($this->data) ) {
			if ($this->validate('mid') == 1) { //mid 존재
				$output['res'] = "success";
				$output['msg'] = "정상";
			} else {
				$output['res'] = "fail";
				$output['msg'] = "E-mail 주소를 확인하세요.";
			}
		}

		$this->setBody($output);
	}

	
	// 파일업로드
	public function upload()
	{
		if ( !empty($this->data) ) {
			$input = $this->data;

			// 디렉토리 구분
			if ( !empty($input['category']) ){
				// 필드명 찾기
				foreach($_FILES as $key => $val) {
					$field = $key;
				}

				if ($_FILES[$field]['tmp_name']) {
					$rand = getRand();
					$_name = $_FILES[$field]['name'];
					$_arr_ext = explode(".", $_name);
					$_ext = $_arr_ext[1];

					//파일명 재설정
					$file_name = "{$rand}.{$_ext}";

					// 카테고리 폴더가 없다면 생성
					$category_folder = PATH_FILE_PHOTO . "/" . $input['category'];
					if ( !is_dir($category_folder) ) {
						mkdir($category_folder,0707);
						chmod($category_folder, 0707);
					}

					// 파일 저장소가 없다면 생성
					$upload_path = PATH_FILE_PHOTO . "/" . $input['category'] . "/" .  substr($file_name, 0, 6);
					if ( !is_dir($upload_path) ) {
						mkdir($upload_path, 0707);
						chmod($upload_path, 0707);
					}

					// 업로드 설정//
					$upload_config = array(
						'upload_path' => $upload_path,
						'allowed_types' => "gif|jpg|png",
						'file_name' => $file_name,
						'max_size' => '10000'  // kbyte(10M)
					);
					$this->upload->initialize($upload_config);


					if ( ! $this->upload->do_upload( $field ))
					{
						$output['result'] = "fail";
						$output['msg'] = $this->upload->display_errors();
					}else{

						$output['result'] = "success";
						$output['msg'] = "업로드 완료";
						$this->data[$field] = $file_name; //변수를 변경한다.

						//새로운 파일이 등록되며 예전파일을 강제 삭제한다.
						//$old = $this->member_MD->find_img($this->param);
						//$old_path = PATH_FILE_PROFILE . "/" . substr($old->m_pimg, 0, 6);
						//@unlink($old_path . "/" . $old->m_pimg);
					}
				}
			} else {
				$output['result'] = "fail";
				$output['msg'] = "분류 지정이 없음";
			}
		} else {
			$output['result'] = "fail";
			$output['msg'] = "지정된 카테고리 없음";
		}
		
		// 결과출력
		$this->setBody($output);
	}
}

