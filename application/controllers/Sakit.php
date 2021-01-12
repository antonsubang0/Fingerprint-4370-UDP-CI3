<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('Asia/Kolkata');
 
class Sakit extends CI_Controller {
	
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
		$this->load->view('v_sakit', $data);
		$this->load->view('v_footer_sakit_vue', $data);
	}

	public function ringkasan()
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

		$this->db->select('*');
		$this->db->from('hakcuti');
		$this->db->join('user', 'hakcuti.uid = user.uid');
		$this->db->join('bagian', 'bagian.id = user.bagian');
		$this->db->where('bnama !=', 'Unknown');
		$this->db->order_by('bnama', 'ASC');
		$this->db->order_by('nama', 'ASC');
		$query = $this->db->get();
		$data['ijinsakit'] = $query->result();

		$this->load->view('v_header', $data);
		$this->load->view('v_ringkasansakit', $data);
		$this->load->view('v_footer', $data);
	}

	public function ajaxsearch($id=null)
	{
		$wktini = time()-259200;
		$this->db->set('status', null);
		$this->db->where('created <', $wktini);
		$this->db->update('ijinsakit');

		if ($id) {
			$this->db->select('*');
			$this->db->from('ijinsakit');
			$this->db->join('user', 'ijinsakit.uid = user.uid');
			$this->db->join('bagian', 'bagian.id = user.bagian');
			$this->db->like('user.nama', $id, 'both');
			$this->db->or_like('bagian.bnama', $id, 'both');
			$this->db->order_by('tanggal', 'DESC');
			$query = $this->db->get();
			$result = $query->result();
			$response=[];
			foreach ($result as $row) {
				$x=[
					'no' => $row->no,
					'uid' => $row->uid,
					'tanggal' => date('d-m-Y', strtotime($row->tanggal)),
					'nama' => $row->nama,
					'bnama' => $row->bnama,
					'reason' => $row->reason,
					'type' => $row->type,
					'status' => $row->status
				];
				array_push($response, $x);
			}
		} else {
			$this->db->select('*');
			$this->db->from('ijinsakit');
			$this->db->join('user', 'ijinsakit.uid = user.uid');
			$this->db->join('bagian', 'bagian.id = user.bagian');
			$this->db->order_by('tanggal', 'DESC');
			$query = $this->db->get();
			$result = $query->result();
			$response=[];
			foreach ($result as $row) {
				$x=[
					'no' => $row->no,
					'uid' => $row->uid,
					'tanggal' => date('d-m-Y', strtotime($row->tanggal)),
					'nama' => $row->nama,
					'bnama' => $row->bnama,
					'reason' => $row->reason,
					'type' => $row->type,
					'status' => $row->status
				];
				array_push($response, $x);
			}
		}
		echo json_encode($response);
	}
	public function ajaxdelete($id)
	{
		if ($id) {
			$this->db->where('no', $id);
			$this->db->delete('ijinsakit');
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
		$this->db->order_by('nama', 'ASC');
		$this->db->where('bagian.id', $id);
		$query = $this->db->get();
		$response = $query->result();
		echo json_encode($response);
	}

	public function ajaxtambah()
	{
		$data = json_decode(trim(file_get_contents('php://input')), true);
		if ($data['uid']) {
			if ($data['tanggal']){
				if ($data['reason']) {
					if ($data['type']) {
						$data['created'] = time();
						$this->db->insert('ijinsakit', $data);

						if ($data['type']==1) {
							$this->db->set('sakit', 'sakit+1', FALSE);
							$this->db->where('uid', $data['uid']);
							$this->db->update('hakcuti');
						}
						if ($data['type']==2) {
							$this->db->set('ijin', 'ijin+1', FALSE);
							$this->db->where('uid', $data['uid']);
							$this->db->update('hakcuti');
						}

						$response= 'success';
					} else {
						$response= 'Type Empty';
					}
				} else {
					$response= 'Reason Empty';
				}
			} else {
				$response= 'Date Empty';
			}
		} else {
			$response= 'User Empty';
		}
		echo json_encode($response);
	}

	public function postprint()
	{
		$data = json_decode(trim(file_get_contents('php://input')), true);
		$this->session->set_userdata('cutiprint', $data);
		echo json_encode('success');
	}

	public function isprint()
	{
		include_once APPPATH."third_party/pdf/fpdf.php";
		$data = $this->session->userdata('cutiprint');
		$pdf = new FPDF('P','mm','A4');
		// Column headings
		$header = array('No', 'Tanggal' , 'Nama', 'Bagian', 'Keterangan', 'Info');
		// Data loading
		$pdf->SetTitle('Ijin / Sakit Karyawan');
		$pdf->SetAuthor('Antonius-Riyanto');
		$pdf->SetCreator('Antonius-Riyanto');
		$pdf->SetFont('Courier','B',16);
		$pdf->AddPage();
		$pdf->Image('berkas/img/cutilogo.png', 10, 5, 190, 277);
		$pdf->Cell(190,5,'Data Ijin / Sakit Karyawan',0,1,'C');
		$pdf->Ln();
		$pdf->SetFont('Courier','B',12);
		$pdf->SetFillColor(255,0,0);
		$pdf->SetTextColor(255);
		$pdf->SetDrawColor(128,0,0);
		$pdf->SetLineWidth(.3);
		    // Header
	    $w = array(10, 25, 40, 30, 70, 15);
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
	        $pdf->Cell($w[1],6,$row['tanggal'],'LR',0,'L',$fill);
	        $pdf->Cell($w[2],6,$row['nama'],'LR',0,'L',$fill);
	        $pdf->Cell($w[3],6,$row['bnama'],'LR',0,'L',$fill);
	        $pdf->Cell($w[4],6,$row['reason'],'LR',0,'L',$fill);
	        $pdf->Cell($w[5],6,($row['type']==1) ? 'Sakit' : 'Ijin','LR',0,'L',$fill);
	        $pdf->Ln();
	        $fill = !$fill;
	        $no++;
	    }
	    // Closing line
	    $pdf->Cell(array_sum($w),0,'','T');
		$pdf->Output();
	}

	public function printringkasan()
	{
		$this->db->select('*');
		$this->db->from('hakcuti');
		$this->db->join('user', 'hakcuti.uid = user.uid');
		$this->db->join('bagian', 'bagian.id = user.bagian');
		$this->db->where('bnama !=', 'Unknown');
		$this->db->order_by('bnama', 'ASC');
		$this->db->order_by('nama', 'ASC');
		$query = $this->db->get();
		$data = $query->result();

		include_once APPPATH."third_party/pdf/fpdf.php";
		$pdf = new FPDF('P','mm','A4');
		// Column headings
		$header = array('No', 'Nama', 'Position','Sisa Cuti', 'Sakit', 'Ijin');
		// Data loading
		$pdf->SetTitle('Ringklasan Ijin / Sakit Karyawan');
		$pdf->SetAuthor('Antonius-Riyanto');
		$pdf->SetCreator('Antonius-Riyanto');
		$pdf->SetFont('Courier','B',16);
		$pdf->AddPage();
		$pdf->Image('berkas/img/cutilogo.png', 10, 5, 190, 277);
		$pdf->Cell(190,5,'Ringkasan Ijin / Sakit Karyawan',0,1,'C');
		$pdf->Ln();
		$pdf->SetFont('Courier','B',12);
		$pdf->SetFillColor(255,0,0);
		$pdf->SetTextColor(255);
		$pdf->SetDrawColor(128,0,0);
		$pdf->SetLineWidth(.3);
		    // Header
	    $w = array(10, 60, 40, 30, 25, 25);
	    for($i=0;$i<count($header);$i++)
	        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
	    $pdf->Ln();
	    // Color and font restoration
	    $pdf->SetFillColor(240,240,240);
	    $pdf->SetTextColor(0);
	    $pdf->SetFont('Courier','',12);
	    // Data
	    $fill = false;
	    $no=1;
	    foreach($data as $key => $value)
	    {
	        $pdf->Cell($w[0],6,$key + 1,'LR',0,'C',$fill);
	        $pdf->Cell($w[1],6,$value->nama,'LR',0,'L',$fill);
	        $pdf->Cell($w[2],6,$value->bnama,'LR',0,'L',$fill);
	        $pdf->Cell($w[3],6,$value->sisa_cuti,'LR',0,'C',$fill);
	        $pdf->Cell($w[4],6,$value->sakit,'LR',0,'C',$fill);
	        $pdf->Cell($w[5],6,$value->ijin,'LR',0,'C',$fill);
	        $pdf->Ln();
	        $fill = !$fill;
	        $no++;
	    }
	    // Closing line
	    $pdf->Cell(array_sum($w),0,'','T');
		$pdf->Output();
	}
}