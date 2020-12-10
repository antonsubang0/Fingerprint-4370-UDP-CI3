<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('Asia/Kolkata');
 
class Akun extends CI_Controller {
	
		public function __construct() 
		{
			parent::__construct();
			$role = 'absen';
			isLogged($role);
		}
		
    	public function index()
		{
			$this->db->order_by('namamesin', 'ASC');
			$query = $this->db->get('mesin');
			$data['daftarmesin'] = $query->result();
			
			
			
			$this->load->view('vheader', $data);
			$this->load->view('akun');
			$this->load->view('vfooter');
		}
}