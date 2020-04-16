<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\SiswaModel;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\Database\Query;
use third_party\PHPExcel\PHPExcel;
use CodeIgniter\HTTP\Exceptions\HTTPException;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class siswa extends Controller
{
	private $filename = "import_data"; 
	
	
	public function index(){
       
        helper(['form', 'url']);
        $this->SiswaModel = new SiswaModel();
        $data['siswa'] = $this->SiswaModel->view();
        return view('view',$data);
	}
	
	public function form(){
        helper(['form', 'url']);
		$data = array();
		$this->SiswaModel = new SiswaModel();
        $data['siswa'] = $this->SiswaModel->view();

        $file = $this->request->getFile('file');

        $data = array(
            'trx_file'           => $file,
        );


		if(isset($_POST['preview'])){ 
       //include APPPATH.'app/third_party/PHPExcel/PHPExcel.php';
		
    //     //    $reader = new \third_party\PHPExcel\PHPExcel.php;
    //         $excelreader = new PHPExcel_Reader_Excel2007();
	// 	$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); 
    //     $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
    //     // $loadexcel = $reader->load('excel/'.$this->filename.'.xlsx');
        //     $sheet = $loadexcel->getActiveSheet()->toArray();
        $extension = $file->getClientExtension();
        //$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        if('xls' == $extension){
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        // format excel 2010 ke atas
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        
        $spreadsheet = $reader->load($file);
            $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true ,true);

		$data = array();
	// 	    $numrow = 1;
	// 	    foreach($sheet as $row){
	// 		    if($numrow > 1){
				
	// 			array_push($data, array(
	// 				'nis'=>$row['A'], 
    //                 'nama'=>$row['B'],
	// 				'jenis_kelamin'=>$row['C'], 
    //                 'alamat'=>$row['D'], 
    //             	));
	// 		}
			
    //         $numrow++; 
    //         $db = \Config\Database::connect();
    //     $builder = $db->table('siswa');
    //    // $builder->set('nis',$data['nis']);
    //     //echo $row->$data['nis'];
    //     return $builder->insertBatch($data);
    //     }
        foreach($sheet as $idx => $row){
                
            // lewati baris ke 0 pada file excel
            // dalam kasus ini, array ke 0 adalahpara title
            if($idx == 0) {
                continue;
            }
            
            // get product_id from excel
            
            echo $row["A"];
            
            // get trx_date from excel
        //    $nama       = $row['1'];
            // tampilkan harga product berdasarkan product_id menggunakan function getTrxPrice()
            //$trx_price      = $this->getTrxPrice($row[0]);

            $data = [
                'no'           => $row["A"],
                 'name'      => $row["B"],
                 "gender"  => $row["C"],
                 'address' =>    $row["D"]
            ];

            
            
        }
        $simpan = $this->SiswaModel->insert_multiple($data);
            
            if($simpan)
            {
                session()->setFlashdata('success', 'Imported Transaction successfully');
                return redirect()->to(base_url('siswa')); 
            }

      
        
		//$this->SiswaModel->insert_multiple($data);
		
        //redirect("Siswa");
            
		}
		
		return view('form',$data);
	}
	
	}
