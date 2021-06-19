<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('Asia/Kolkata');
 
class Login extends CI_Controller {

	public function index() {
		if ($this->session->userdata('username')) {
			$username = $this->session->userdata('username');
			$this->db->where('username', $username);
			$query = $this->db->get('useradmin');
			$result = $query->row_array();

			if ($this->input->ip_address() !== $result['ip']) {		
				redirect(base_url('login/logout'));
			} else {
				$this->db->set('time', time());
				$this->db->where('username', $username);
				$this->db->update('useradmin');
			}

			if( $result['rule'] !== $role ){
				if ($result['rule']=='absen'){
					redirect(base_url());
				}
				if ($result['rule']=='suratjalan'){
					redirect(base_url('suratjalan'));
				}
				if ($result['rule']=='warehouse'){
					redirect(base_url('warehouse'));
				}
			}
		}
		$char = "1234567890QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm";
		$token = "";
		for ($i=0; $i < 100 ; $i++) { 
			$token = $token . $char[random_int(0, strlen($char)-1)];
		}
		$this->session->set_userdata('token', $token);
		$script['jstable']=0;
		$this->load->view('v_login', $script);
	}
	
	public function auth() { 
		if ($this->input->post()) {
			if ($this->input->post('token') !== $this->session->userdata('token')) {
		 		$this->session->set_flashdata('info','You cant hackked');
				redirect(base_url('login'));
			}
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$ip = $this->input->ip_address();
			$this->db->where('username', $username);
			$query = $this->db->get('useradmin');
			$result = $query->row_array();
			if($result) {
				if (time() - $result['time'] > 300 || $ip == $result['ip']) {
					if (password_verify($password,$result['password'])) {
						$this->session->set_userdata('username', $username);
						$this->session->set_userdata('role', $result['rule']);
						$this->session->set_userdata('ip', $ip);
						$this->db->set('ip', $ip);
						$this->db->where('username', $username);
						$this->db->update('useradmin');
						if($result['rule']=='absen'){
							$expiredatt = time() - (60*60*24*90);
							// delete absen 90 hari
							$this->db->where('time <=', $expiredatt);
							$this->db->delete('att');
							$this->session->set_flashdata('info','Login Successfully');
							redirect(base_url());
						} elseif ($result['rule']=='suratjalan'){
							$this->session->set_flashdata('info','Login Successfully');
							redirect(base_url('suratjalan'));
						} else {
							$this->session->set_flashdata('info','Login Successfully');
							redirect(base_url('warehouse'));
						}
					} else {
						//password salah
						$this->session->set_flashdata('info','Wrong Password');
						redirect(base_url('login'));
					}
				} else {
					$this->session->set_flashdata('info','Other Client is Active');
					redirect(base_url('login'));		
				}
				
			} else {
				//username salah
				$this->session->set_flashdata('info','Username not found');
				redirect(base_url('login'));
			}
		} else {
			//harus login
			$this->session->set_flashdata('info','You must login first');
			redirect(base_url('login'));
		}
	}
	
	public function logout () {
		$username = $this->session->userdata('username');
		$this->db->set('time', time()-360);
		$this->db->where('username', $username);
		$this->db->update('useradmin');
		$this->session->sess_destroy();
		$this->session->set_flashdata('info','Logout Sukses');
		redirect(base_url('login'));
	}
	
}