<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Renewal extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		//echo "test";
		show_404();
		exit;
	}
}
