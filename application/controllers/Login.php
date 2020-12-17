<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('Asia/Kolkata');
 
class Login extends CI_Controller {

		
	public function index() {
		$script['jstable']=0;
		$this->load->view('v_login', $script);
	}
	
	public function auth() {
		if ($this->input->post()) {
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