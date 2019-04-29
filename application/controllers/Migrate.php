<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migrate extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('migration');
    }

    public function index() {

      if (ENVIRONMENT == 'development') {
       
        if ( ! $this->migration->current()) {
          show_error($this->migration->error_string());
        } else {
          echo "success";
        }

      } else {
        echo "go away";
      }
      
    }

}