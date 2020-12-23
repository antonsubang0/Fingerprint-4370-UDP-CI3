<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('Asia/Kolkata');
 
class Cuti extends CI_Controller {
	
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
	public function test1()
	{
		$response = 'success';
		include_once APPPATH."third_party/zklib/zklib.php";
		$zk = new ZKLib("192.168.100.15", 4370);
		$ret = $zk->connect();
		sleep(1);
		if ( $ret ){
			$zk->disableDevice();
			sleep(1);
			$zk->setUser(2, '180006', 'Antonius', '', 14);
			sleep(1);
			$query = $this->db->get_where('templatefinger', array('uid' => '180006'));
			$resulttemplates = $query->result();
			if ($resulttemplates) {
				foreach ($resulttemplates as $ke => $resulttemplate) {
					$template=[
						$resulttemplate->size, //size
						2, //pass
						$resulttemplate->finger, //id_finger
						$resulttemplate->valid, //valid
						$resulttemplate->template //template
					];
					// var_dump($template); die();
					var_dump($zk->setUserTemplate($resulttemplate->template)); die();
					// if ($zk->setUserTemplate($resulttemplate->template)) {
					// 	$response = 'success';
					// }
				}
			}
			sleep(1);
			$zk->enableDevice();
			sleep(1);
			$zk->disconnect();

			echo json_encode($response);
		}
	}

	public function ajaxresetcuti()
	{
		$this->db->select('*');
		$this->db->from('user');
		$query = $this->db->get();
		$result = $query->result();
		foreach ($result as $key => $a) {
			$this->db->set('sisa_cuti', 12);
			$this->db->where('uid', $a->uid);
			$this->db->update('hakcuti');
		}
	}

	public function ajaxalldata()
	{
		$this->db->select('*');
		$this->db->from('cuti');
		$this->db->join('user', 'cuti.uid = user.uid');
		$this->db->join('bagian', 'bagian.id = user.bagian');
		$this->db->order_by('tgl_cuti', 'DESC');
		$this->db->limit(500);
		$query = $this->db->get();
		$response = $query->result();
		echo json_encode($response);
	}

	public function ajaxinfodetail($uid)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('bagian', 'bagian.id = user.bagian');
		$this->db->join('hakcuti', 'hakcuti.uid = user.uid');
		$this->db->where('user.uid', $uid);
		$query = $this->db->get();
		$response = $query->result();
		echo json_encode($response);
	}

	public function ajaxsearchcuti($id=null)
	{
		if ($id) {
			$this->db->select('*');
			$this->db->from('cuti');
			$this->db->join('user', 'cuti.uid = user.uid');
			$this->db->join('bagian', 'bagian.id = user.bagian');
			$this->db->like('user.nama', $id, 'both');
			$this->db->or_like('bagian.bnama', $id, 'both');
			$this->db->order_by('tgl_cuti', 'DESC');
			$query = $this->db->get();
			$response = $query->result();
		} else {
			$this->db->select('*');
			$this->db->from('cuti');
			$this->db->join('user', 'cuti.uid = user.uid');
			$this->db->join('bagian', 'bagian.id = user.bagian');
			$this->db->order_by('tgl_cuti', 'DESC');
			$this->db->limit(150);
			$query = $this->db->get();
			$response = $query->result();
		}
		echo json_encode($response);
	}
	public function ajaxdeletecuti($id)
	{
		if ($id) {
			$this->db->where('no', $id);
			$this->db->delete('cuti');
			$response='success';
		}
		echo json_encode($response);
	}

	public function ajaxalluser()
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('bagian', 'bagian.id = user.bagian');
		$this->db->order_by('bnama', 'ASC');
		$this->db->order_by('nama', 'ASC');
		$query = $this->db->get();
		$response = $query->result();
		echo json_encode($response);
	}

	public function ajaxtambahcuti()
	{
		$data = json_decode(trim(file_get_contents('php://input')), true);
		if ($data['uid']) {
			if ($data['tgl_cuti']){
				if ($data['keperluan']) {
					$this->db->insert('cuti', $data);
					$response= 'success';
				}
			}
		}
		echo json_encode($response);
	}
}