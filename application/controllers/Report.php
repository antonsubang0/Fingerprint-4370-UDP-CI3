<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('Asia/Kolkata');
 
class Report extends CI_Controller {
	
		public function __construct() 
		{
			parent::__construct();
			$role = 'absen';
			isLogged($role);
		}
		
    	public function index()
		{
			$data['jstable']=1;
			$data['jspicker']=1;
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
			$data['bagian'] = $query->result();
			$this->db->select('*');
			$this->db->from('user');
			$this->db->join('bagian', 'bagian.id = user.bagian');
			$this->db->order_by('bnama', 'ASC');
			$query = $this->db->get();
			$data['add'] = $query->result();
			$data['user'] = '';
			$data['tabel'] = '';

			if ($this->session->userdata('report')==0) {
				$this->session->unset_userdata('group');
				$this->session->unset_userdata('personal');
				$this->session->unset_userdata('awal');
				$this->session->unset_userdata('akhir');
			}

			if($this->input->post('group')!==null && $this->input->post('personal')==null){
				$this->session->set_userdata('report', 1);
				$this->session->set_userdata('group', $this->input->post('group'));
				$this->session->set_userdata('personal', null);
				$this->session->set_userdata('awal', $this->input->post('awal'));
				$this->session->set_userdata('akhir', $this->input->post('akhir'));
			}
			if($this->input->post('group')==!null && $this->input->post('personal')==!null){
				if ($this->input->post('group') !== $this->session->userdata('group')) {
					$this->session->set_userdata('report', 1);
					$this->session->set_userdata('group', $this->input->post('group'));
					$this->session->set_userdata('personal', null);
					$this->session->set_userdata('awal', $this->input->post('awal'));
					$this->session->set_userdata('akhir', $this->input->post('akhir'));
				} else {
					$this->session->set_userdata('report', 1);
					$this->session->set_userdata('group', $this->input->post('group'));
					$this->session->set_userdata('personal', $this->input->post('personal'));
					$this->session->set_userdata('awal', $this->input->post('awal'));
					$this->session->set_userdata('akhir', $this->input->post('akhir'));
				}
			}
			// var_dump($this->session->userdata()); die();
			// var_dump($this->session->userdata('group') !==null && $this->session->userdata('personal')==''); die();
			if( $this->session->userdata('group') !== null && $this->session->userdata('personal') == null){
				$this->db->where('bagian', $this->session->userdata('group'));
				$query = $this->db->get('user');
				$data['user'] = $query->result(); //variable hasil query user bagian
				$this->db->select('*');
				$this->db->from('user');
				$this->db->join('bagian', 'bagian.id = user.bagian');
				$this->db->join('att', 'user.uid = att.uid');
				$this->db->where('bagian', $this->session->userdata('group'));
				$this->db->where('time >=', strtotime($this->session->userdata('awal')));
				$this->db->where('time <=', strtotime($this->session->userdata('akhir'))+(60*60*24));
				$this->db->order_by('nama', 'ASC');
				$this->db->order_by('time', 'ASC');
				$query = $this->db->get();
				$data['tabel'] = $query->result(); //variable hasil query bagian absen
				//var_dump(date_format(date_create($this->input->post('awal')),"Y-m-d H:i:s"));die();
			}
			
			if($this->session->userdata('group') !== null && $this->session->userdata('personal') !== null){
				$this->db->where('bagian', $this->session->userdata('group'));
				$query = $this->db->get('user');
				$data['user'] = $query->result(); //variable hasil query user bagian
				$this->db->select('*');
				$this->db->from('user');
				$this->db->join('bagian', 'bagian.id = user.bagian');
				$this->db->join('att', 'user.uid = att.uid');
				$this->db->where('bagian', $this->session->userdata('group'));
				$this->db->where_in('user.uid', $this->session->userdata('personal'));
				$this->db->where('time >=', strtotime($this->session->userdata('awal')));
				$this->db->where('time <=', strtotime($this->session->userdata('akhir'))+(60*60*24));
				$this->db->order_by('nama', 'ASC');
				$this->db->order_by('time', 'ASC');
				$query = $this->db->get();
				$data['tabel'] = $query->result(); //variable hasil query personal absen
			}
			if ($this->input->post('download')==2) {
				$this->load->view('exexcel1', $data);
			} else {
				$this->load->view('v_header', $data);	
				$this->load->view('v_report', $data);
				$this->load->view('v_footer', $data);
			}
			
		}
		 public function horizontal(){
		 	$data['jstable']=1;
		 	$data['jspicker']=1;
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
			$data['bagian'] = $query->result();
			$query = $this->db->get('user');
			$data['user'] = '';
			$data['tabel'] = '';
			$data['stateawal']= date('d-m-Y');
			// optional
			$data['optcount'] = 0;
			if ($this->input->post('showcount')) {
				$data['optcount'] = 1;
			}

			if(!$this->input->post('group')=='' && $this->input->post('personal')==null){
				$this->db->where('bagian', $this->input->post('group'));
				$query = $this->db->get('user');
				$data['user'] = $query->result(); //variable hasil query user bagian
				$this->db->select('*');
				$this->db->from('user');
				$this->db->join('bagian', 'bagian.id = user.bagian');
				$this->db->join('att', 'user.uid = att.uid');
				$this->db->where('bagian', $this->input->post('group'));
				$this->db->where('time >=', strtotime($this->input->post('awal')));
				$this->db->where('time <=', strtotime($this->input->post('akhir'))+(60*60*24));
				$this->db->order_by('nama', 'ASC');
				$this->db->order_by('time', 'ASC');
				$query = $this->db->get();
				$data['tabel'] = $query->result(); //variable hasil query bagian absen
				$data['countquery'] = $query->num_rows(); //untuk total terakhir
				$data['stateawal']=date_format(date_create($this->input->post('awal')),"d-m-Y");
				//var_dump(date_format(date_create($this->input->post('awal')),"Y-m-d H:i:s"));die();
			}
			
			if($this->input->post('group')==!null && $this->input->post('personal')==!null){
				$this->db->where('bagian', $this->input->post('group'));
				$query = $this->db->get('user');
				$data['user'] = $query->result(); //variable hasil query user bagian
				$this->db->select('*');
				$this->db->from('user');
				$this->db->join('bagian', 'bagian.id = user.bagian');
				$this->db->join('att', 'user.uid = att.uid');
				$this->db->where('bagian', $this->input->post('group'));
				$this->db->where_in('user.uid', $this->input->post('personal'));
				$this->db->where('time >=', strtotime($this->input->post('awal')));
				$this->db->where('time <=', strtotime($this->input->post('akhir'))+(60*60*24));
				$this->db->order_by('nama', 'ASC');
				$this->db->order_by('time', 'ASC');
				$query = $this->db->get();
				$data['tabel'] = $query->result(); //variable hasil query personal
				$data['countquery'] = $query->num_rows(); //untuk total terakhir
				$data['stateawal']=date_format(date_create($this->input->post('awal')),"d-m-Y");
			}
			
			if ($this->input->post('download')==2) {
				$this->load->view('exexcel2', $data);
			} else {
				$this->load->view('v_header', $data);	
				$this->load->view('v_rehorizontal', $data);
				$this->load->view('v_footer', $data);
			}
		}
		
		public function delabsensi(){
			if ($this->input->post('absendelete')) {
				$pdata = $this->input->post('absendelete');
				foreach ($pdata as $rdata) {
				$this->db->where('no', $rdata);
				$this->db->delete('att');
				}
				$this->session->set_flashdata('status', 'Data has been changed or deleted.');
			}
			
			if ($this->input->post('inout')){
				$pdata = $this->input->post('inout');
				foreach ($pdata as $rdata) {
					$rdata = explode(',',$rdata);
					$this->db->set('inout', $rdata[0]);
					$this->db->where('no', $rdata[1]);
					$this->db->update('att');
				}
				$this->session->set_flashdata('status', 'Data has been changed or deleted.');
			}

			if (!$this->input->post('absendelete') && !$this->input->post('inout')) {
				$this->session->set_flashdata('status', 'Data has not been changed or deleted.');
			}
			redirect('/report/');
		}
		
		public function addabsensi(){
			if ($this->input->post('uid') !== '' && $this->input->post('inout') !== '' && $this->input->post('time') !== '') {
				$data = array(
					'no' => '',
					'uid' => $this->input->post('uid'),
					'inout' => $this->input->post('inout'),
					'time' => strtotime($this->input->post('time')),
					'mesin' => 0
				);
				$this->db->insert('att', $data);
				$this->session->set_flashdata('status', 'Data has been added');
			} else {
				$this->session->set_flashdata('status', 'Failed to add the data.');
			}
			redirect('/report/');
		}

		public function ajaxubahstatus()
		{
			//success
			$response['message']='failed';
			$response['data']= 'Data was not changed.';
			if ($this->input->post('no')) {
				$this->db->set('inout', $this->input->post('status') );
				$this->db->where('no', $this->input->post('no'));
				if ($this->db->update('att')){
					$response['message']='success';
					$response['data']= 'Data was changed.';
				}
			}
			echo json_encode($response);
		}

		public function ajaxdeleteabsensi()
		{
			//success
			$response['message']='failed';
			$response['data']= 'Data was not deleted.';
			if ($this->input->post('no')) {
				$this->db->where('no', $this->input->post('no'));
				if ($this->db->delete('att')) {
					$response['message']='success';
					$response['data']= 'Data was deleted.';
				}
			}
			echo json_encode($response);
		}

		public function ajaxaddabsensi()
		{
			//success
			if ($this->input->post('uid') !== '' && $this->input->post('inout') !== '' && $this->input->post('time') !== '') {
				$data = array(
					'no' => '',
					'uid' => $this->input->post('uid'),
					'inout' => $this->input->post('inout'),
					'time' => strtotime($this->input->post('time')),
					'mesin' => 0
				);
				if ($this->db->insert('att', $data)) {
					$this->db->select('*');
					$this->db->from('user');
					$this->db->join('bagian', 'bagian.id = user.bagian');
					$this->db->join('att', 'user.uid = att.uid');
					$this->db->order_by('no', 'ASC');
					$query = $this->db->get();
					$response['data1'] = $query->last_row();
				}

				$response['message']='success';
				$response['data']= 'Data was added.';
			} else {
				$response['message']='failed';
				$response['data']= 'Data can not add.';
			}
			echo json_encode($response);
		}
}