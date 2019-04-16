<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

function __construct(){
	parent::__construct();

	if($this->session->userdata('login') == 0){
		redirect(base_url('login'));
	}

	$this->load->model('mUser');

}

function view($page = 'dashboard') {
	    if ( ! file_exists(APPPATH.'views/admin/'.$page.'.php'))
	        {
	                // Whoops, we don't have a page for that!
	                show_404();
	        }
        		$this->load->view('template/header');
        		$this->load->view('admin/'.$page);
        		$this->load->view('template/footer');
	}

function css()
{
	$this->load->view('template/css');
}

function js()
{
	$this->load->view('template/js');
}

}
