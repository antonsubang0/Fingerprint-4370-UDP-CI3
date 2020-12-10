<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Welcome extends CI_Controller {
    public function __construct()
        {   
            parent::__construct();
            $this->load->library('Absen');
        }
    public function index()
        {
            $this->load->view('lola', $data);
        }
}