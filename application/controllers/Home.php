<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('Asia/Kolkata');
 
class Home extends CI_Controller {
	
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
		$this->load->view('v_home', $data);
		$this->load->view('v_footer', $data);
	}
	
	
	public function datauser($id="1") {
		$data['jstable']=1;
		$data['jspicker']=0;
		$this->session->set_userdata('report', 0);
		$this->db->order_by('namamesin', 'ASC');
		$query = $this->db->get('mesin');
		$data['daftarmesin'] = $query->result();
		foreach ($query->result() as $row){
				$initmesin[$row->id]['nama'] = $row->namamesin;
				$initmesin[$row->id]['ip'] = $row->ipmesin;
		}
		$ipmesin = $initmesin[$id]['ip'];
		$namamesin = $initmesin[$id]['nama'];

		// status Machine
		$data['statusMachine']=[];
		$statusMachine = $data['daftarmesin'];
		foreach ($statusMachine as $status) {
			$hasilStatus = statusMachine($status->ipmesin);
			$data['statusMachine'][$status->ipmesin]=$hasilStatus;
		}

		$query = $this->db->get('user');
		foreach ($query->result() as $row){
				$base[$row->uid]['nama'] = $row->nama;
				$base[$row->uid]['bagian'] = $row->bagian;
			}
		
		$data['base'] = $base;
		$query = $this->db->get('bagian');
		foreach ($query->result() as $row){
				$bagian[$row->id] = $row->bnama;
			}
		$data['bagian'] = $bagian;
		include_once APPPATH."third_party/zklib/zklib.php";
		$zk = new ZKLib("$ipmesin", 4370);
		$ret = $zk->connect();
		sleep(1);
		if ( $ret ){
			$zk->disableDevice();
			sleep(1);
			$user = $zk->getUser();
			$data['user'] = $user;
			$data['mesin'] = $namamesin;
			$zk->enableDevice();
			sleep(1);
			$zk->disconnect();
		} else {
			$user=[[1,'notfound',1,1,0]];
			$data['user'] = $user;
			$data['mesin'] = $namamesin;
		}
		$data['idmesin'] = $id;
		$this->load->view('v_header', $data);	
		$this->load->view('v_user', $data);
		$this->load->view('v_footer', $data);
	}
	
	public function downloaduser($id="1"){
		$this->db->order_by('namamesin', 'ASC');
		$query = $this->db->get('mesin');
		$data['daftarmesin'] = $query->result();
		foreach ($query->result() as $row){
				$initmesin[$row->id]['nama'] = $row->namamesin;
				$initmesin[$row->id]['ip'] = $row->ipmesin;
		}
		$ipmesin = $initmesin[$id]['ip'];
		$namamesin = $initmesin[$id]['nama'];
		include_once APPPATH."third_party/zklib/zklib.php";
		$zk = new ZKLib("$ipmesin", 4370);
		$ret = $zk->connect();
		sleep(1);
		if ( $ret ){
			$zk->disableDevice();
			sleep(1);
			$user = $zk->getUser();
			$zk->enableDevice();
			sleep(1);
			$zk->disconnect();
		}
		
		if ($user) {
			foreach ($user as $key => $userdata) {

				$query = $this->db->get_where('user', array('uid' => $userdata[0]));
				
				if ($query->row()==NULL){
					$data = array(
					'id' => NULL,
					'uid' => $userdata[0],
					'nama' => $userdata[1],
					'role' => $userdata[4],
					'pass' => $userdata[3],
					'bagian' => 99
					);
					$this->db->insert('user', $data);
				}
			}
			$this->session->set_flashdata('status', 'Success Download Data User to Database');
			redirect('/home/datauser/' . $id);
		}
	}
	
	public function dataabsen($id="1") { //this not perform change line 247
		
		$this->db->order_by('namamesin', 'ASC');
		$query = $this->db->get('mesin');
		$data['daftarmesin'] = $query->result();
		foreach ($query->result() as $row){
				$initmesin[$row->id]['nama'] = $row->namamesin;
				$initmesin[$row->id]['ip'] = $row->ipmesin;
		}
		$ipmesin = $initmesin[$id]['ip'];
		$namamesin = $initmesin[$id]['nama'];
		$query = $this->db->get('user');
		foreach ($query->result() as $row){
				$base[$row->uid]['nama'] = $row->nama;
				$base[$row->uid]['bagian'] = $row->bagian;
			}
		$data['base'] = $base;
		$query = $this->db->get('bagian');
		foreach ($query->result() as $row){
				$bagian[$row->id] = $row->bnama;
			}
		$data['bagian'] = $bagian;
		include_once APPPATH."third_party/zklib/zklib.php";
		$zk = new ZKLib("$ipmesin", 4370);
		$ret = $zk->connect();
		sleep(1);
		if ( $ret ){
			$zk->disableDevice();
			sleep(1);
			$user = $zk->getAttendance();
			$data['user'] = $user;
			$data['mesin'] = $namamesin;
			//$zk->clearAttendance();
			$zk->enableDevice();
			sleep(1);
			$zk->disconnect();
		}
		$data['idmesin']=$id;
		$this->load->view('vheader', $data);	
		$this->load->view('vabsen', $data);
		$this->load->view('vfooter');
	}
	
	public function downloadabsen ($id) {
		// mengambil data mesin
		if (!$id) {
			$this->session->set_flashdata('statusgagal', "Select Machine is not Found");
			redirect('/home/download/');
		}

		$this->db->order_by('namamesin', 'ASC');
		$query = $this->db->get('mesin');
		// variabel data mesin di view
		$data['daftarmesin'] = $query->result();
		// mengambil IP mesin untuk koneksi
		foreach ($query->result() as $row){
				$initmesin[$row->id]['nama'] = $row->namamesin;
				$initmesin[$row->id]['ip'] = $row->ipmesin;
		}
		$ipmesin = $initmesin[$id]['ip'];
		$namamesin = $initmesin[$id]['nama'];

		// last log/absen time
		$lasttime1 = $this->db->order_by('time', 'ASC')->get_where('att', array('mesin' => $id))->last_row();
		if ($lasttime1==NULL) {
			$lasttime2=time()-86400*7;
		} else {
			$lasttime2=$lasttime1->time;
		}
		
		include_once APPPATH."third_party/zklib/zklib.php";
		$zk = new ZKLib("$ipmesin", 4370);
		$ret = $zk->connect();
		sleep(1);
		if ( $ret ){
			$zk->disableDevice();
			sleep(1);
			// $zk->restart(); die(); //dipakai mesin depan mati mesin belakang aman...
			$user = $zk->getAttendance();
			// $zk->clearAttendance(); //DELETE DATA ABSEN
			$zk->enableDevice();
			sleep(1);
			$zk->disconnect();
		}
		if ($user) {
			foreach ($user as $key => $userdata) {
				$query = $this->db->get_where('att', array('time' => strtotime($userdata[3]), 'uid' => $userdata[0])); //cek time dan user
				$hasil = $query->row();
				//jika time dan user null, time harus lebih dari sama dengan database terakhir dimesin, maka data diinsert
				if ($hasil==NULL && strtotime($userdata[3]) >= $lasttime2){
					$lasttimeuser = $this->db->order_by('time', 'ASC')->get_where('att', array('uid' => $userdata[0], 'mesin' => $id))->last_row();
					if (!$lasttimeuser){
						$data = array(
						'no' => NULL,
						'uid' => $userdata[0],
						'inout' => $userdata[4],
						'time' => strtotime($userdata[3]),
						'mesin' => $id
						);
					} else {
						if (strtotime($userdata[3]) - $lasttimeuser->time >= 3600) {
							$data = array(
							'no' => NULL,
							'uid' => $userdata[0],
							'inout' => $userdata[4],
							'time' => strtotime($userdata[3]),
							'mesin' => $id
							);
						} else {
							// warning absen atau absen mengulang
							$data = array(
							'no' => NULL,
							'uid' => $userdata[0],
							'inout' => 5,
							'time' => strtotime($userdata[3]),
							'mesin' => $id
							);
						}
					}
					$this->db->insert('att', $data);
				}
			}


			$pesan = "Success Download Att. Machine $namamesin to Database";
			$this->session->set_flashdata('status', $pesan);
			redirect('/home/download/');
		} else {
			$this->session->set_flashdata('statusgagal', "Failed Download Att. Machine $namamesin to Database / Log Not Found");
			redirect('/home/download/');
		}
	}

	public function download()
	{
		$data['jstable']=1;
		$data['jspicker']=0;
		$this->session->set_userdata('report', 0);
		$this->db->order_by('namamesin', 'ASC');
		$query = $this->db->get('mesin');
		$data['daftarmesin'] = $query->result();
		// status Machine
		$data['statusMachine']=[];
		$statusMachine = $data['daftarmesin'];
		foreach ($statusMachine as $status) {
			$hasilStatus = statusMachine($status->ipmesin);
			$data['statusMachine'][$status->ipmesin]=$hasilStatus;
		}

		$this->load->view('v_header', $data);
		$this->load->view('v_tarik', $data);
		$this->load->view('v_footer', $data);
	}
	
	public function managementuser () {
		$data['jstable']=1;
		$data['jspicker']=0;
		$this->session->set_userdata('report', 0);
		$this->db->order_by('namamesin', 'ASC');
		$query = $this->db->get('mesin');
		$data['daftarmesin'] = $query->result();
		// status Machine
		$data['statusMachine']=[];
		$statusMachine = $data['daftarmesin'];
		foreach ($statusMachine as $status) {
			$hasilStatus = statusMachine($status->ipmesin);
			$data['statusMachine'][$status->ipmesin]=$hasilStatus;
		}

		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('bagian', 'bagian.id = user.bagian');
		$this->db->order_by('nama', 'ASC');
		$this->db->order_by('bnama', 'ASC');
		$query = $this->db->get();
		$data['result'] = $query->result();
		$query = $this->db->get('bagian');
		$data['bagian'] = $query->result();
		$this->load->view('v_header', $data);	
		$this->load->view('v_manauser', $data);
		$this->load->view('v_footer', $data);
	}
	
	public function tambahuser() {
		//	belum selesai dan belum uji coba
		// 	uid automatis perbagian (option //mesin tambahan//kode perusahaan//kode devisi ikut tabel//kode user max 100)
		$query = $this->db->get('user');
		$last = $query->last_row();
		$last = $last->pass + 1;
		$query = $this->db->get_where('user', array('uid' => $this->input->post("tuid")));
		if ($query->row()==NULL){
			$data = array(
				"uid" => $this->input->post("tuid"),
				"nama"=> $this->input->post("tuser"),
				"role" => $this->input->post("trole"),
				"bagian" => $this->input->post("tdevisi"),
				"pass" => $last
			);
			$this->db->insert('user', $data);
			$pesan= "Data has been added.";
		} else {
			$pesan= "Failed data to be added.";
		}
		
		$this->session->set_flashdata('status', $pesan);
		redirect('/home/managementuser/');	
	}
	
	public function registrasi($codemesin, $uid) {
		$this->db->order_by('namamesin', 'ASC');
		$query = $this->db->get('mesin');
		$data['daftarmesin'] = $query->result();
		foreach ($query->result() as $row){
				$initmesin[$row->id]['nama'] = $row->namamesin;
				$initmesin[$row->id]['ip'] = $row->ipmesin;
		}
		$ipmesin = $initmesin[$codemesin]['ip'];
		$namamesin = $initmesin[$codemesin]['nama'];
		
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('bagian', 'bagian.id = user.bagian');
		$this->db->where('uid', $uid);
		$query = $this->db->get();
		$user = $query->row();
		
		if ($user->role==14) {
			$role='LEVEL_ADMIN';
		} else {
			$role='LEVEL_USER';
		}
		
		include_once APPPATH."third_party/zklib/zklib.php";
		$zk = new ZKLib($ipmesin, 4370);
		$ret = $zk->connect();
		sleep(1);
		if ( $ret ){
			$zk->disableDevice();
			sleep(1);
			if($zk->enrollUser($user->pass)){
				$this->session->set_flashdata('status', 'Go to Machine and Register.');
				$zk->setUser((int)$user->pass, $user->uid, $user->nama, '', (int)$user->role);
			}
			$zk->enableDevice();
			sleep(1);
			$zk->disconnect();
		}
		
		redirect('/home/managementuser/');
	}
	
	public function informasi($codemesin, $uid) {
		$this->db->order_by('namamesin', 'ASC');
		$query = $this->db->get('mesin');
		$data['daftarmesin'] = $query->result();
		foreach ($query->result() as $row){
				$initmesin[$row->id]['nama'] = $row->namamesin;
				$initmesin[$row->id]['ip'] = $row->ipmesin;
		}
		$ipmesin = $initmesin[$codemesin]['ip'];
		$namamesin = $initmesin[$codemesin]['nama'];
		
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('bagian', 'bagian.id = user.bagian');
		$this->db->where('uid', $uid);
		$query = $this->db->get();
		$user = $query->row();
		
		include_once APPPATH."third_party/zklib/zklib.php";
		$zk = new ZKLib($ipmesin, 4370);
		$ret = $zk->connect();
		sleep(1);
		if ( $ret ){
			$zk->disableDevice();
			sleep(1);
			$zk->setUser((int)$user->pass, $user->uid, $user->nama, '', (int)$user->role);
			sleep(1);
			$zk->enableDevice();
			sleep(1);
			$zk->disconnect();
		}
		$this->session->set_flashdata('status', 'Success send information');
		redirect('/home/managementuser/');
	}
	
	public function ubahbagian() {
		$pdata = $this->input->post('pbagian');
		foreach ($pdata as $rdata) {
			$rdata = explode(',',$rdata);
			$this->db->set('bagian', $rdata[1]);
			$this->db->where('uid', $rdata[0]);
			$this->db->update('user');
		}
		$this->session->set_flashdata('status', 'Data has been changed.');
		redirect('/home/managementuser/');
	}
	
	public function managementdevisi () {
		$data['jstable']=1;
		$data['jspicker']=0;
		$this->session->set_userdata('report', 0);
		$this->db->order_by('namamesin', 'ASC');
		$query = $this->db->get('mesin');
		$data['daftarmesin'] = $query->result();
		// status Machine
		$data['statusMachine']=[];
		$statusMachine = $data['daftarmesin'];
		foreach ($statusMachine as $status) {
			$hasilStatus = statusMachine($status->ipmesin);
			$data['statusMachine'][$status->ipmesin]=$hasilStatus;
		}

		$this->db->order_by('bnama', 'ASC');
		$query = $this->db->get('bagian');
		$data['result'] = $query->result();
		$this->load->view('v_header', $data);	
		$this->load->view('v_datadevisi', $data);
		$this->load->view('v_footer', $data);
	}
	
	public function dbagian (){
		$pdata = $this->input->post('dbagian');
		foreach ($pdata as $rdata) {
			if ($rdata != 99){
			$this->db->where('id', $rdata);
			$this->db->delete('bagian');
			}
		}
		$this->session->set_flashdata('status', 'Data has been deleted.');
		redirect('/home/managementdevisi/');;
	}
	
	public function tbagian (){
		$pdata = $this->input->post('tbagian');
		$data = array(
				'id' =>"",
				'bnama' => $pdata
		);
		$this->db->insert('bagian', $data);
		$this->session->set_flashdata('status', 'Data has been added.');
		redirect('/home/managementdevisi/');
	}

	public function ajaxalldata()
	{
		//success
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('bagian', 'bagian.id = user.bagian');
		$this->db->order_by('nama', 'ASC');
		$this->db->order_by('bnama', 'ASC');
		$query = $this->db->get();
		$hasil = $query->result();
		$array = array();
		$i=1;

		foreach ($hasil as $a) {
			if ($a->role==14) { $role = 'Admin'; } else { $role = "User";}
			
			array_push($array, [
				'DT_RowId' => $a->uid,
				'no' => $i++, 
				'uid' => $a->uid, 
				'nama' =>$a->nama, 
				'role' => $role,
				'bagian' => $a->bnama
			]);
		}
		$data['data'] = $array;
		$data['message'] = 'success';

		echo json_encode($data);
	}

	public function ajaxsingleuser($id='')
	{
		//success
		if ($id !=='') {
			$this->db->join('bagian', 'bagian.id = user.bagian');
			$query = $this->db->get_where('user', array('uid' => $id));
			$hasil = $query->row_array();
		}
		echo json_encode($hasil);
	}

	public function ajaxsaveuser()
	{
		//sucess
		$pdata['data'] = [$this->input->post(), $this->input->post()];

		$this->db->set('nama', $this->input->post("nama"));
		$this->db->set('role', $this->input->post("role"));
		$this->db->set('bagian', $this->input->post("bagian"));
		$this->db->where('uid', $this->input->post("uid"));
		$data['data'] = '';
		if ($this->db->update('user')) {
			$data['message'] = 'success';
			$this->db->join('bagian', 'bagian.id = user.bagian');
			$query = $this->db->get_where('user', array('uid' => $this->input->post("uid")));
			$hasil = $query->row_array();
			$data['data'] = $hasil;
		} else {
			$data['message'] = 'failed';
		}
		$data['message'] = 'success';

		echo json_encode($data);


	}
	public function ajaxdeleteuser (){
		//success
		$pdata = $this->input->post('uid');
		$this->db->where('uid', $pdata);
		$this->db->delete('user');
		$response['message'] = 'success';
		$response['data'] = 'User berhasil dihapus';
		echo json_encode($response);
	}

	public function ajaxsendregister($codemesin, $uid) {
		//need try
		$this->db->order_by('namamesin', 'ASC');
		$query = $this->db->get('mesin');
		$data['daftarmesin'] = $query->result();
		foreach ($query->result() as $row){
				$initmesin[$row->id]['nama'] = $row->namamesin;
				$initmesin[$row->id]['ip'] = $row->ipmesin;
		}
		$ipmesin = $initmesin[$codemesin]['ip'];
		$namamesin = $initmesin[$codemesin]['nama'];
		
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('bagian', 'bagian.id = user.bagian');
		$this->db->where('uid', $uid);
		$query = $this->db->get();
		$user = $query->row();
		
		if ($user->role==14) {
			$role='LEVEL_ADMIN';
		} else {
			$role='LEVEL_USER';
		}
		
		include_once APPPATH."third_party/zklib/zklib.php";
		$zk = new ZKLib($ipmesin, 4370);
		$ret = $zk->connect();
		sleep(1);
		if ( $ret ){
			$zk->disableDevice();
			sleep(1);
			$useratt = $zk->getUser();
			if ($useratt) {
				$arraymax=array();
				$arrayuser=array();
				foreach ($useratt as $key => $value) {
					array_push($arraymax, $value[3]);
					$arrayuser[$value[0]]=$value[3];
				}
				//jika uid sudah ada
				$pas=$arrayuser[$user->uid];
				if ($pas==null) {
					$pass = max($arraymax) + 1;
				} else {
					$pass = $pas;
				}
			} else {
				$pass=1;
			}
			if($zk->setUser((int)$pass, $user->uid, $user->nama, '', (int)$user->role)){
				$zk->enrollUser($pass);
			}
			$zk->enableDevice();
			sleep(1);
			$zk->disconnect();
			$data['message']='success';
			$data['data']= 'Go to Machine and Register';
		} else {
			$data['message']='failed';
			$data['data']= 'Check Connection';
		}
		echo json_encode($data);
	}

	public function ajaxsendinfouser($codemesin, $uid) {
		// success
		$this->db->order_by('namamesin', 'ASC');
		$query = $this->db->get('mesin');
		$data['daftarmesin'] = $query->result();
		foreach ($query->result() as $row){
				$initmesin[$row->id]['nama'] = $row->namamesin;
				$initmesin[$row->id]['ip'] = $row->ipmesin;
		}
		$ipmesin = $initmesin[$codemesin]['ip'];
		$namamesin = $initmesin[$codemesin]['nama'];
		
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('bagian', 'bagian.id = user.bagian');
		$this->db->where('uid', $uid);
		$query = $this->db->get();
		$user = $query->row();
		
		include_once APPPATH."third_party/zklib/zklib.php";
		$zk = new ZKLib($ipmesin, 4370);
		$ret = $zk->connect();
		sleep(1);
		if ( $ret ){
			$zk->disableDevice();
			sleep(1);
			$useratt = $zk->getUser();
			if ($useratt) {
				$arraymax=array();
				$arrayuser=array();
				foreach ($useratt as $key => $value) {
					array_push($arraymax, $value[3]);
					$arrayuser[$value[0]]=$value[3];
				}
				$pas=$arrayuser[$user->uid];
				if ($pas==null) {
					$pass = max($arraymax) + 1;
				} else {
					$pass = $pas;
				}
			} else {
				$pass=1;
			}
			$zk->setUser((int)$pass, $user->uid, $user->nama, '', (int)$user->role);
			sleep(1);
			$zk->enableDevice();
			sleep(1);
			$zk->disconnect();
			$data['message']='success';
			$data['data']= 'Sent Info User';
		} else {
			$data['message']='failed';
			$data['data']= 'Check Connection';
		}
		echo json_encode($data);
	}

	public function ajaxtambahuser() {
		//	success
		$this->db->order_by('pass', 'ASC');
		$query = $this->db->get('user');
		$last = $query->last_row();
		$last = $last->pass + 1;
		$query = $this->db->get_where('user', array('uid' => $this->input->post("tuid")));
		if ($query->row()==NULL){
			$data = array(
				"uid" => $this->input->post("tuid"),
				"nama"=> $this->input->post("tuser"),
				"role" => $this->input->post("trole"),
				"bagian" => $this->input->post("tdevisi"),
				"pass" => $last
			);
			$this->db->insert('user', $data);
			$response['message'] = 'success';
			$response['data']= "User has been added.";
		} else {
			$response['message'] = 'failed';
			$response['data']= "UID same user old.";
		}
		echo json_encode($response);
	}

	public function ajaxalldevisi()
	{
		//success
		$this->db->order_by('bnama', 'ASC');
		$query = $this->db->get('bagian');
		$hasil = $query->result();
		$array = array();
		$i=1;

		foreach ($hasil as $a) {
			array_push($array, [
				'DT_RowId' => $a->id,
				'no' => $i++,  
				'bagian' =>$a->bnama, 
				'delete' => "<b><svg class='text-danger deletedevisi' xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-x' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z'/>
					</svg></b>"
			]);
		}
		$data['data'] = $array;
		$data['message'] = 'success';

		echo json_encode($data);
	}
	public function ajaxdeletedevisi(){
		//success
		if ($this->input->post('dbagian') !== 99){
			$this->db->where('id', $this->input->post('dbagian'));
			$this->db->delete('bagian');
			$response['message']='success';
			$response['data'] = 'Position was deleted.';
		} else {
			$response['message']='failed';
			$response['data'] = 'Position can not be delete.';
		}

		echo json_encode($response);
	}

	public function ajaxtambahdevisi()
	{
		//success
		$pdata = $this->input->post('tbagian');
		if ($pdata !== '') {
			$data = array(
					'id' =>"",
					'bnama' => $pdata
			);
			if ($this->db->insert('bagian', $data)) {
				$response['message']='success';
				$response['data']='Position was added.';
			}
		} else {
			$response['message']='failed';
			$response['data']='Nothing add.';
		}

		echo json_encode($response);
		
	}

	public function ajaxdownloadabsen($id) {
		// successs
		if (!$id) {
			$response['message']= 'failed';
			$response['data'] = "Machine is not connect.";
		}

		$this->db->order_by('namamesin', 'ASC');
		$query = $this->db->get('mesin');
		// variabel data mesin di view
		$data['daftarmesin'] = $query->result();
		// mengambil IP mesin untuk koneksi
		foreach ($query->result() as $row){
				$initmesin[$row->id]['nama'] = $row->namamesin;
				$initmesin[$row->id]['ip'] = $row->ipmesin;
		}
		$ipmesin = $initmesin[$id]['ip'];
		$namamesin = $initmesin[$id]['nama'];

		// last log/absen time
		$lasttime1 = $this->db->order_by('time', 'ASC')->get_where('att', array('mesin' => $id))->last_row();
		if ($lasttime1==NULL) {
			$lasttime2=time()-86400*7;
		} else {
			$lasttime2=$lasttime1->time;
		}
		
		include_once APPPATH."third_party/zklib/zklib.php";
		$zk = new ZKLib("$ipmesin", 4370);
		$ret = $zk->connect();
		sleep(1);
		if ( $ret ){
			$zk->disableDevice();
			sleep(1);
			// $zk->restart(); die(); //dipakai mesin depan mati mesin belakang aman...
			$user = $zk->getAttendance();
			// $zk->clearAttendance(); //DELETE DATA ABSEN
			$zk->enableDevice();
			sleep(1);
			$zk->disconnect();
			if ($user) {
				foreach ($user as $key => $userdata) {
					$query = $this->db->get_where('att', array('time' => strtotime($userdata[3]), 'uid' => $userdata[0])); //cek time dan user
					$hasil = $query->row();
					//jika time dan user null, time harus lebih dari sama dengan database terakhir dimesin, maka data diinsert
					if ($hasil==NULL && strtotime($userdata[3]) >= $lasttime2){
						$lasttimeuser = $this->db->order_by('time', 'ASC')->get_where('att', array('uid' => $userdata[0], 'mesin' => $id))->last_row();
						if (!$lasttimeuser){
							$data = array(
							'no' => NULL,
							'uid' => $userdata[0],
							'inout' => $userdata[4],
							'time' => strtotime($userdata[3]),
							'mesin' => $id
							);
						} else {
							if (strtotime($userdata[3]) - $lasttimeuser->time >= 3600) {
								$data = array(
								'no' => NULL,
								'uid' => $userdata[0],
								'inout' => $userdata[4],
								'time' => strtotime($userdata[3]),
								'mesin' => $id
								);
							} else {
								// warning absen atau absen mengulang
								$data = array(
								'no' => NULL,
								'uid' => $userdata[0],
								'inout' => 5,
								'time' => strtotime($userdata[3]),
								'mesin' => $id
								);
							}
						}
						$this->db->insert('att', $data);
					}
				}
				$response['message'] = 'success';
				$response['data'] = "Success Download Att. Machine $namamesin to Database";
			} else {
				$response['message']= 'failed';
				$response['data'] = "Failed Download Att. Machine $namamesin to Database or Log Not Found";
			}
		} else {
			$response['message']= 'failed';
			$response['data'] = "Machine is not connect.";
		}
		
		echo json_encode($response);
	}

	public function ajaxtodownloaduser($id){
		//not try yet
		if ($id) {
			$this->db->order_by('namamesin', 'ASC');
			$query = $this->db->get('mesin');
			$data['daftarmesin'] = $query->result();
			foreach ($query->result() as $row){
					$initmesin[$row->id]['nama'] = $row->namamesin;
					$initmesin[$row->id]['ip'] = $row->ipmesin;
			}
			$ipmesin = $initmesin[$id]['ip'];
			$namamesin = $initmesin[$id]['nama'];
			include_once APPPATH."third_party/zklib/zklib.php";
			$zk = new ZKLib("$ipmesin", 4370);
			$ret = $zk->connect();
			sleep(1);
			if ( $ret ){
				$zk->disableDevice();
				sleep(1);
				$user = $zk->getUser();
				$zk->enableDevice();
				sleep(1);
				$zk->disconnect();
				if ($user) {
					foreach ($user as $key => $userdata) {
						$query = $this->db->get_where('user', array('uid' => $userdata[0]));
						if ($query->row()==NULL){
							$data = array(
							'id' => NULL,
							'uid' => $userdata[0],
							'nama' => $userdata[1],
							'role' => $userdata[4],
							'pass' => $userdata[3],
							'bagian' => 99
							);
							$this->db->insert('user', $data);
						}
					}
					$response['message'] = 'success';
					$response['data'] = "Success Download Att. Machine $namamesin to Database.";
				} else {
					$response['message'] = 'failed';
					$response['data'] = "No User From Att. Machine $namamesin.";
				}
			} else {
				$response['message'] = 'failed';
				$response['data'] = "Machine $namamesin is not connection.";
			}	
		} else {
			$response['message'] = 'failed';
			$response['data'] = "Error.";
		}
		echo json_encode($response);
	}

}