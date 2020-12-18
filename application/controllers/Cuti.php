<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('Asia/Kolkata');
 
class Cuti extends CI_Controller {
	
		// public function __construct() 
		// {
		// 	parent::__construct();
		// 	$role = 'absen';
		// 	isLogged($role);
		// }
		
    public function index()
	{
			$this->db->order_by('namamesin', 'ASC');
		$query = $this->db->get('mesin');
		$data['daftarmesin'] = $query->result();
		$data['jstable']=0;
		$data['jspicker']=0;
		$this->session->set_userdata('report', 0);
		// status Machine
		$data['statusMachine']=[];
		$statusMachine = $data['daftarmesin'];
		foreach ($statusMachine as $status) {
			$hasilStatus = statusMachine($status->ipmesin);
			$data['statusMachine'][$status->ipmesin]=$hasilStatus;
		}
		$this->load->view('v_header', $data);
		$this->load->view('v_cuti', $data);
		$this->load->view('v_footer_vue', $data);
	}
}