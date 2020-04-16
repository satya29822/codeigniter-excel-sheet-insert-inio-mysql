<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\Database\Query;

use third_party\PHPExcel\PHPExcel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
 
class SiswaModel extends Model
{
	protected $table = 'siswa';
	public function __construct(){
		parent::__construct();
        $db = \Config\Database::connect();
        $builder = $db->table('siswa');
	}
	
  
	public function view(){
		$query = $this->db->query('select * from siswa');
        return $query->getResult(); 
	}
	
	
	public function upload_file($filename){
		$this->load->library('upload'); 
		
		$config['upload_path'] = './excel/';
		$config['allowed_types'] = 'xlsx';
		$config['max_size']	= '2048';
		$config['overwrite'] = true;
		$config['file_name'] = $filename;
	
		$this->upload->initialize($config); 
		if($this->upload->do_upload('file')){ 
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		}else{
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}
	
	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data){
		
        // $db = \Config\Database::connect();
        // $builder = $db->table('siswa');
		//  //return $this->db->$data;

		// return $builder->set($data)->getCompiledInsert('siswa');
		/*$query = $this->db->insert_batch($this->table)->insert($data);
        
		return $this->db->insertID();*/
		return $this->db->table("siswa")->insert($data);
		}
}
