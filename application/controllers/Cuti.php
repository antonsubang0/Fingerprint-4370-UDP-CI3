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
		//Status machine
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
			$this->db->set('ijin', 0);
			$this->db->set('sakit', 0);
			$this->db->where('uid', $a->uid);
			$this->db->update('hakcuti');
		}
	}

	public function ajaxalldata()
	{
		$wktini = date("Y-m-d", time());
		$this->db->set('enable', null);
		$this->db->where('tgl_cuti <', $wktini);
		$this->db->update('cuti');

		$this->db->select('*');
		$this->db->from('cuti');
		$this->db->join('user', 'cuti.uid = user.uid');
		$this->db->join('bagian', 'bagian.id = user.bagian');
		$this->db->order_by('tgl_cuti', 'DESC');
		$query = $this->db->get();
		$result = $query->result();
		$response=[];
		foreach ($result as $row) {
			$x=[
				'no' => $row->no,
				'uid' => $row->uid,
				'tgl_cuti' => date('d-m-Y', strtotime($row->tgl_cuti)),
				'nama' => $row->nama,
				'bnama' => $row->bnama,
				'keperluan' => $row->keperluan,
				'cuti' => $row->cuti,
				'enable' => $row->enable
			];
			array_push($response, $x);
		}
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
		$wktini = date("Y-m-d", time());
		$this->db->set('enable', null);
		$this->db->where('tgl_cuti <', $wktini);
		$this->db->update('cuti');

		if ($id) {
			$this->db->select('*');
			$this->db->from('cuti');
			$this->db->join('user', 'cuti.uid = user.uid');
			$this->db->join('bagian', 'bagian.id = user.bagian');
			$this->db->like('user.nama', $id, 'both');
			$this->db->or_like('bagian.bnama', $id, 'both');
			$this->db->order_by('tgl_cuti', 'DESC');
			$query = $this->db->get();
			$result = $query->result();
			$response=[];
			foreach ($result as $row) {
				$x=[
					'no' => $row->no,
					'uid' => $row->uid,
					'tgl_cuti' => date('d-m-Y', strtotime($row->tgl_cuti)),
					'nama' => $row->nama,
					'bnama' => $row->bnama,
					'keperluan' => $row->keperluan,
					'cuti' => $row->cuti,
					'enable' => $row->enable
				];
				array_push($response, $x);
			}
		} else {
			$this->db->select('*');
			$this->db->from('cuti');
			$this->db->join('user', 'cuti.uid = user.uid');
			$this->db->join('bagian', 'bagian.id = user.bagian');
			$this->db->order_by('tgl_cuti', 'DESC');
			$query = $this->db->get();
			$result = $query->result();
			$response=[];
			foreach ($result as $row) {
				$x=[
					'no' => $row->no,
					'uid' => $row->uid,
					'tgl_cuti' => date('d-m-Y', strtotime($row->tgl_cuti)),
					'nama' => $row->nama,
					'bnama' => $row->bnama,
					'keperluan' => $row->keperluan,
					'cuti' => $row->cuti,
					'enable' => $row->enable
				];
				array_push($response, $x);
			}
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

	public function ajaxallbagian()
	{
		$this->db->select('*');
		$this->db->from('bagian');
		$query = $this->db->get();
		$response = $query->result();
		echo json_encode($response);
	}

	public function ajaxuserbagian($id)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('bagian', 'bagian.id = user.bagian');
		$this->db->join('hakcuti', 'hakcuti.uid = user.uid');
		$this->db->order_by('nama', 'ASC');
		$this->db->where('bagian.id', $id);
		$query = $this->db->get();
		$response = $query->result();
		echo json_encode($response);
	}

	public function ajaxtambahcuti()
	{
		$data = json_decode(trim(file_get_contents('php://input')), true);
		$response ='failed';

		if ($data['uid']) {
			if ($data['tgl_cuti']){
				if ($data['keperluan']) {
					if ($data['cuti'] < 13) {
						if ($this->db->insert('cuti', $data)) {
							$response= 'success';
						}
					} else {
						$response='Cuti Habis';
					}
				} else {
					$response='Keperluan kosong';
				}
			} else {
				$response='tanggal belum diisi';
			}
		} else {
			$response='Employer Kosong';
		}
		echo json_encode($response);
	}

	public function postprint()
	{
		$data = json_decode(trim(file_get_contents('php://input')), true);
		$this->session->set_userdata('cutiprint', $data);
		echo json_encode('success');
	}

	public function cutiprint()
	{
		include_once APPPATH."third_party/pdf/fpdf.php";
		$data = $this->session->userdata('cutiprint');
		$pdf = new FPDF('P','mm','A4');
		// Column headings
		$header = array('No', 'Tanggal' , 'Nama', 'Position', 'Informasi', 'Cuti');
		// Data loading
		$pdf->SetTitle('Data Cuti Karyawan');
		$pdf->SetAuthor('Antonius-Riyanto');
		$pdf->SetCreator('Antonius-Riyanto');
		$pdf->SetFont('Courier','B',16);
		$pdf->AddPage();
		$pdf->Image('berkas/img/cutilogo.png', 10, 5, 190, 277);
		$pdf->Cell(190,5,'Data Cuti Karyawan',0,1,'C');
		$pdf->Ln();
		$pdf->SetFont('Courier','B',12);
		$pdf->SetFillColor(255,0,0);
		$pdf->SetTextColor(255);
		$pdf->SetDrawColor(128,0,0);
		$pdf->SetLineWidth(.3);
		    // Header
	    $w = array(12, 25, 45, 30, 62, 18);
	    for($i=0;$i<count($header);$i++)
	        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
	    $pdf->Ln();
	    // Color and font restoration
	    $pdf->SetFillColor(224,235,255);
	    $pdf->SetTextColor(0);
	    $pdf->SetFont('Courier','',8);
	    // Data
	    $fill = false;
	    $no=1;
	    foreach($data as $row)
	    {
	        $pdf->Cell($w[0],6,$no,'LR',0,'C',$fill);
	        $pdf->Cell($w[1],6,$row['tgl_cuti'],'LR',0,'L',$fill);
	        $pdf->Cell($w[2],6,$row['nama'],'LR',0,'L',$fill);
	        $pdf->Cell($w[3],6,$row['bnama'],'LR',0,'L',$fill);
	        $pdf->Cell($w[4],6,$row['keperluan'],'LR',0,'L',$fill);
	        $pdf->Cell($w[5],6,$row['cuti'],'LR',0,'C',$fill);
	        $pdf->Ln();
	        $fill = !$fill;
	        $no++;
	    }
	    // Closing line
	    $pdf->Cell(array_sum($w),0,'','T');
		$pdf->Output();
	}
}