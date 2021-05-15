<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('Asia/Kolkata');
 
class Synchronisation extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();
		$role = 'absen';
		isLogged($role);
		$this->session->unset_userdata('cutiprint');
		$this->session->set_userdata('report', 0);
	}

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
		$this->load->view('v_sync', $data);
		$this->load->view('v_footer', $data);
	}
	
	public function uploadatt()
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('bagian', 'bagian.id = user.bagian');
		$this->db->join('att', 'user.uid = att.uid');
		$this->db->where('time >=', time()-(60*60*24*32));
		$this->db->order_by('nama', 'ASC');
		$this->db->order_by('time', 'ASC');
		$query = $this->db->get();
		$data['att'] = $query->result();
		$this->db->select('*');
		$this->db->from('bagian');
		$query = $this->db->get();
		$data['bagian'] = $query->result();
		$data['email'] = "anton@mail.com";
		$data['password'] = "absen123";
		echo json_encode($data);
	}
}