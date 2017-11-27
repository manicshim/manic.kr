<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('getRand')) {
	function getRand($sub="", $sup="")
	{	// 랜덤코드 반환(중복 안되게)
		$tmpRand = date("ymdHis")."_".mt_rand(10000, 99999);
		$tmpRand = (!empty($sub)) ? "{$sub}_{$tmpRand}" : $tmpRand;
		$tmpRand = (!empty($sup)) ? "{$tmpRand}_{$sup}" : $tmpRand;

		return $tmpRand;
	}
}

if ( ! function_exists('debug')) {
	// 디버그 함수
	function debug($data)
	{
		print "<xmp style=\"display:block;font:9pt 'Bitstream Vera Sans Mono, Courier New';background:#202020;color:#D2FFD2;padding:10px;margin:5px;\">";
		print_r($data);
		print "</xmp>";
	}
}