<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('Asia/Kolkata');
 
class Setting extends CI_Controller {
	
		public function __construct() 
		{
			parent::__construct();
			$role = 'absen';
			isLogged($role);
			autologout();
		}
		
    	public function index() {
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
			$this->load->view('v_machines', $data);
			$this->load->view('v_footer', $data);
		}
		
		public function addmachine() {
			if ($this->input->post('ip') !=='' && $this->input->post('nama') !=='') {
				$data = array(
					'id' => '',
					'ipmesin' => $this->input->post('ip'),
					'namamesin' =>$this->input->post('nama')
				);
				$this->db->insert('mesin', $data);
				$this->session->set_flashdata('status', 'Success added the machine.');
			} else {
				$this->session->set_flashdata('status', 'Failed to add the machine.');
			}
			redirect('/setting');
		}
		
		public function delmachine($id) {

			if ($id) {
				$this->db->where('id', $id);
				$this->db->delete('mesin');
				$this->session->set_flashdata('status', 'Machine was deleted.');
				redirect('/setting');
			} else {
				$this->session->set_flashdata('status', 'Not rules.');
				redirect('/setting');
			}
			
		}

		public function restart($id)
		{
			if ($id) {
				// mengambil data mesin
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

				include_once APPPATH."third_party/zklib/zklib.php";
				$zk = new ZKLib("$ipmesin", 4370);
				$ret = $zk->connect();
				sleep(1);
				if ( $ret ){
					$zk->disableDevice();
					sleep(1);
					$zk->restart();
					$zk->enableDevice();
					sleep(1);
					$zk->disconnect();
					$this->session->set_flashdata('status', 'Success Restart.');
				}
				redirect('/setting');
			} else {
				$this->session->set_flashdata('status', 'No rules.');
				redirect('/setting');
			}
			
			
		}
		
		public function kunciabsen() {
			$data['jstable']=0;
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
			$this->db->where('id', 1);
			$query = $this->db->get('useradmin');
			$data['user'] = $query->row_array();
			$this->load->view('v_header', $data);
			$this->load->view('v_kunci', $data);
			$this->load->view('v_footer',$data);
		}
		
		public function setkunciabsen (){
			if ($this->input->post('username') !=='' && $this->input->post('password') !=='') {
				$this->db->set('ip', $this->input->ip_address());
				$this->db->set('username', $this->input->post('username'));
				$this->db->set('password', password_hash($this->input->post('password'), PASSWORD_DEFAULT));
				$this->db->where('id', 1);
				$this->db->update('useradmin');
				$this->session->set_flashdata('status', 'Has been changed.');
			} else {
				$this->session->set_flashdata('status', 'No changed.');
			}
			redirect('/setting/kunciabsen');
		}
		
		public function payroll() {
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
			$this->db->select('*');
			$this->db->from('user');
			$this->db->join('bagian', 'bagian.id = user.bagian');
			$query = $this->db->get();
			$data['add'] = $query->result();
			$data['user'] = '';
			$data['tabel'] = ''; 
			if(!$this->input->post('group')=='' && $this->input->post('personal')==null){
				$this->db->where('bagian', $this->input->post('group'));
				$query = $this->db->get('user');
				$data['user'] = $query->result();
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
				$data['tabel'] = $query->result();
				//var_dump(date_format(date_create($this->input->post('awal')),"Y-m-d H:i:s"));die();
			}
			
			if($this->input->post('group')==!null && $this->input->post('personal')==!null){
				$this->db->where('bagian', $this->input->post('group'));
				$query = $this->db->get('user');
				$data['user'] = $query->result();
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
				$data['tabel'] = $query->result();
			}
			$this->load->view('vheader', $data);	
			$this->load->view('vabsensi', $data);
			$this->load->view('vfooter');
		}
}