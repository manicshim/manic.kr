<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('alert')) {
	// 경고메세지를 경고창으로
	function alert($msg = '', $url = '')
	{
		$CI =& get_instance();

		if (!$msg) $msg = '올바른 방법으로 이용해 주십시오.';

		echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=" . $CI->config->item('charset') . "\">";
		echo "<script type='text/javascript'>alert('" . $msg . "');";
		if ($url)
			echo "location.replace('" . $url . "');";
		else
			echo "history.go(-1);";
		echo "</script>";
		exit;
	}
}

if ( ! function_exists('alert_close')) {
	// 경고메세지 출력후 창을 닫음
	function alert_close($msg)
	{
		$CI =& get_instance();

		echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=" . $CI->config->item('charset') . "\">";
		echo "<script type='text/javascript'> alert('" . $msg . "'); window.close(); </script>";
		exit;
	}
}


if ( ! function_exists('alert_only')) {
	// 경고메세지만 출력
	function alert_only($msg)
	{
		$CI =& get_instance();

		echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=" . $CI->config->item('charset') . "\">";
		echo "<script type='text/javascript'> alert('" . $msg . "'); </script>";
		exit;
	}
}

if ( ! function_exists('alert_continue')) {
	function alert_continue($msg)
	{
		$CI =& get_instance();

		echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=" . $CI->config->item('charset') . "\">";
		echo "<script type='text/javascript'> alert('" . $msg . "'); </script>";
	}
}