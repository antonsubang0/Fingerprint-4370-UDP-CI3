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

	public function test()
	{
		
		include_once APPPATH."third_party/zklib/zklib.php";
		$zk = new ZKLib("192.168.100.15", 4370);
		$ret = $zk->connect();
		sleep(1);
		if ( $ret ){
			$zk->disableDevice();
			sleep(1);
			$user = $zk->getUser();
			// var
			//$template = $zk->getUserTemplateAll(5);
			//result vardump $template
			//{[0]=> int(1118) [1]=> int(5) [2]=> int(5) [3]=> int(1) [4]=> string(1118)binary}{}
			//0=>size 1=>pass 2=>id_finger 3=>valid=1 4=>template binary
			// fix
			foreach ($user as $value) {
				$template = $zk->getUserTemplateAll($value[3]);
				foreach ($template as $key => $val) {
					if ($val) {
						$data = array(
							'no' => NULL,
							'uid' => $value[0],
							'finger'=> $val[2],
							'size' => $val[0],
							'valid' => $val[3],
							'template' => $val[4]
						);
						$this->db->insert('templatefinger', $data);
					}
				}
				sleep(1);
			}
			$zk->enableDevice();
			sleep(1);
			$zk->disconnect();
		}
	}

	public function ajaxalldata()
	{
		$this->db->select('*');
		$this->db->from('cuti');
		$this->db->join('user', 'cuti.uid = user.uid');
		$this->db->join('bagian', 'bagian.id = user.bagian');
		$this->db->order_by('tgl_cuti', 'ASC');
		$query = $this->db->get();
		$response = $query->result();
		echo json_encode($response);
	}

	public function ajaxsingledata()
	{
		$this->db->select('*');
		$this->db->from('cuti');
		$this->db->join('user', 'cuti.uid = user.uid');
		$this->db->join('bagian', 'bagian.id = user.bagian');
		$this->db->order_by('tgl_cuti', 'ASC');
		$query = $this->db->get();
		$response = $query->result();
		echo json_encode($response);
	}
}