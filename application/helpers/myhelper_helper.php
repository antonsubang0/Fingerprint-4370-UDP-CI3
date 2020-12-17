<?php 

function isLogged($role) {
	$ci = get_instance();
	if (!$ci->session->userdata('username')) {
		redirect('login');
	} else {
		$username = $ci->session->userdata('username');
		$ci->db->where('username', $username);
		$query = $ci->db->get('useradmin');
		$result = $query->row_array();
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
		if ($ci->input->ip_address() !== $result['ip']) {		
			redirect(base_url('login/logout'));
		} else {
			$ci->db->set('time', time());
			$ci->db->where('username', $username);
			$ci->db->update('useradmin');
		}
	}
}

function statusMachine($host) {
	$tB = microtime(true);
	$timeout = 1;
	$errstr = '';
	$errno = 0;
	$port = 4370;
	// $fP = fSockOpen($host, $port, $errno, $errstr, $timeout);
	$fP = @fsockopen($host, $port, $errno, $errstr, $timeout);
	$tA = microtime(true);
	return $errno;

}