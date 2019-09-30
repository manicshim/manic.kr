<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/

// 후킹시점 CI 메뉴얼 참조
$hook['post_controller_constructor'][] = array(
	'class'     => 'Log',
	'function'  => 'checkPermission',
	'filename'  => 'Log.php',
	'filepath'  => 'hooks'
);