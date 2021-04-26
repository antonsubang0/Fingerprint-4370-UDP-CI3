<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('Asia/Kolkata');
 
class Flashdisk extends CI_Controller {
	
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
		print_r($this->session->all_userdata());

		$this->load->view('v_header', $data);
		$this->load->view('v_flashdisk', $data);
		$this->load->view('v_footer', $data);
	}
	public function upload()
	{
		$config['upload_path'] = './berkas/';
	    $config['allowed_types'] = 'dat';
	    $config['max_size']  = '2048';
	    $config['overwrite'] = true;
	    $config['detect_mime'] = true;

        $this->load->library('upload', $config);
        $this->load->helper('file');

		if ( ! $this->upload->do_upload('data')) {
			$this->session->set_flashdata('notifinputfd', 'Failed Import Data.');
			redirect('/flashdisk');
		} else {
			$fullnametoid = explode('_', $this->upload->data()['file_name']);
			$id = $fullnametoid[0];
			// mengambil data terakhir mesin
	        $lasttime1 = $this->db->order_by('time', 'ASC')->get_where('att', array('mesin' => $id))->last_row();
			if ($lasttime1==NULL) {
				$lasttime2=time()-86400*7;
			} else {
				$lasttime2=$lasttime1->time;
			}
			// membaca file *_attlog.dat
			$data = read_file($this->upload->data()["full_path"]);
			$array = explode('   ', $data);
			$data1 = [];
			for ($i=1; $i < count($array) ; $i++) {
				$array1 = explode('	', $array[$i]);
				if ($array1) {
					$query = $this->db->get_where('att', array('time' => strtotime($array1[1]), 'uid' => $array1[0])); //cek time dan user
					$hasil = $query->row();
					//jika time dan user null, time harus lebih dari sama dengan database terakhir dimesin, maka data diinsert
					if ($hasil==NULL && strtotime($array1[1]) >= $lasttime2){
						$lasttimeuser = $this->db->order_by('time', 'ASC')->get_where('att', array('uid' => $array1[0], 'mesin' => $array1[2]))->last_row();
						if (!$lasttimeuser){
							$data = array(
							'no' => NULL,
							'uid' => $array1[0],
							'inout' => $array1[3],
							'time' => strtotime($array1[1]),
							'mesin' => $array1[2]
							);
						} else {
							if (strtotime($array1[1]) - $lasttimeuser->time >= 3600) {
								$data = array(
								'no' => NULL,
								'uid' => $array1[0],
								'inout' => $array1[3],
								'time' => strtotime($array1[1]),
								'mesin' => $array1[2]
								);
							} else {
								// warning absen atau absen mengulang
								$data = array(
								'no' => NULL,
								'uid' => $array1[0],
								'inout' => 7,
								'time' => strtotime($array1[1]),
								'mesin' => $array1[2]
								);
							}
						}
						$this->db->insert('att', $data);
					}
				}
			}
			$this->session->set_flashdata('notifinputfd', 'Import Data Successfully.');
			redirect('/flashdisk');
		}
	}

}