<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('Asia/Kolkata');
 
class Setting extends CI_Controller {
	
		public function __construct() 
		{
			parent::__construct();
			$role = 'absen';
			isLogged($role);
			$this->session->unset_userdata('cutiprint');
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
				$query = $this->db->get_where('mesin', array('ipmesin' => $this->input->post('ip')));

				if ($query->row()==NULL) {
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
			echo "back to home....";
		}

		public function restore()
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
			$this->load->view('v_restore', $data);
			$this->load->view('v_footer', $data);
		}

		public function ajaxdaftarmesin() {
			//success
			$this->db->order_by('namamesin', 'ASC');
			$query = $this->db->get('mesin');
			$data = $query->result();
			$result = array();
			$i=1;
			foreach ($data as $key => $row) {
				$idmesin = $row->id;
				$statusmesin='';
				if(statusMachine($row->ipmesin) > 0) {
					$statusmesin = 'disabled';
				}
				$d = [
					'DT_RowId' => $row->id,
					'no' => $i,
					'namamesin' => $row->namamesin,
					'ipmesin' => $row->ipmesin,
					'restart' => "<a class='btn btn-success mb-1 nav-ajs-cs restartmesin $statusmesin' data-mesin='$idmesin' href=''>Restart</a>",
					'delete' => "<a class='btn btn-danger mb-1 nav-ajs-cs deletemesin' data-mesin='$idmesin' href=''>Delete</a>"
				];
				array_push($result, $d);
				$i++;
			}
			$response['message']='success';
			$response['data']=$result;
			echo json_encode($response);
		}

		public function ajaxdeletemesin($id){
			//success
			if ($id) {
				$this->db->where('id', $id);
				$this->db->delete('mesin');
				$response['message']='success';
				$response['data']='Machine was deleted.';
			} else {
				$response['message']='failed';
				$response['data']='Machine was not deleted.';
			}
			echo json_encode($response);
		}

		public function ajaxrestartmesin($id){
			//not yet try
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
					$response['message']='success';
					$response['data']='Machine was restarted.';
				} else {
					$response['message']='failed';
					$response['data']='Machine is not connected.';
				}
			} else {
				$response['message']='failed';
				$response['data']='Machine failed to restart.';
			}
			echo json_encode($response);
		}

		public function ajaxaddmesin(){
			//success
			$response['message']='failed';
			$response['data']='Failed to add the machine';
			if ($this->input->post('ip') !=='' && $this->input->post('nama') !=='') {
				$ipmesin = $this->input->post('ip');
				$namamesin = $this->input->post('nama');
				
				$query = $this->db->get_where('mesin', array('ipmesin' => $this->input->post('ip')));

				if ($query->row()==NULL) {
					$data = array(
						'id' => '',
						'ipmesin' => $ipmesin,
						'namamesin' => $namamesin
					);
					if ($this->db->insert('mesin', $data)) {
						$response['message']='success';
						$response['data']='Success added the machine.';
					}
				} else {
					$response['message']='failed';
					$response['data']='Failed add machine.';
				}
			} else {
				$response['message']='failed';
				$response['data']='Failed add machine.';
			}
			echo json_encode($response);
		}

		public function ajaxlistrestore()
		{
			//not success
			$this->db->order_by('namamesin', 'ASC');
			$query = $this->db->get('mesin');
			$data = $query->result();
			$result = array();
			$i=1;
			foreach ($data as $key => $row) {
				$idmesin = $row->id;
				$statusmesin='';
				// if(statusMachine($row->ipmesin) > 0) {
				// 	$statusmesin = 'disabled';
				// }
				$d = [
					'DT_RowId' => $row->id,
					'no' => $i,
					'namamesin' => $row->namamesin,
					'retoremesin' => "<a class='btn btn-danger mb-1 btnretoremesin $statusmesin' data-mesin='$idmesin' href=''>Restore</a>"
				];
				array_push($result, $d);
				$i++;
			}
			$response['message']='success';
			$response['data']=$result;
			echo json_encode($response);
		}

		public function ajaxrestorefinger()
		{
			//logika not success
			$id = $this->input->post('mesin');
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

				$this->db->select('*');
				$this->db->from('user');
				$this->db->join('bagian', 'bagian.id = user.bagian');
				$this->db->order_by('nama', 'ASC');
				$this->db->order_by('bnama', 'ASC');
				$query = $this->db->get();
				$datausers = $query->result();

				include_once APPPATH."third_party/zklib/zklib.php";
				$zk = new ZKLib("$ipmesin", 4370);
				$ret = $zk->connect();
				sleep(1);
				if ( $ret ){
					$zk->disableDevice();
					sleep(1);
					$zk->clearAdmin();
					sleep(1);
					$zk->clearUser();
					sleep(1);
					foreach ($datausers as $key => $datauser) {
						$zk->setUser((int)$key + 1, $datauser->uid, $datauser->nama, '', (int)$datauser->role);
						$query = $this->db->get_where('templatefinger', array('uid' => $datauser->uid));
						$resulttemplates = $query->result();
						if ($resulttemplates) {
							foreach ($resulttemplates as $ke => $resulttemplate) {
								$template=[
									(int)$resulttemplate->size, //size
									(int)$key, //pass
									(int)$resulttemplate->finger, //id_finger
									(int)$resulttemplate->valid, //valid
									$resulttemplate->template //template
								];
								$zk->setUserTemplate($template);
							}
						}
						sleep(1);
					}
					$zk->enableDevice();
					sleep(1);
					$zk->disconnect();
					$response['message'] = 'success';
					$response['data'] = "Restore Fingerprint successfully.";
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