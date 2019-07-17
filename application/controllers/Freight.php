<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Freight extends CI_Controller {

	public function index()
	{
		
	}

	public function download_excel_sample()
	{
		$this->load->library('excel');

		//activate worksheet number 1
	$this->excel->setActiveSheetIndex(0);
	//name the worksheet
	$this->excel->getActiveSheet()->setTitle('test worksheet');
	//set cell A1 content with some text
	$this->excel->getActiveSheet()->setCellValue('A1', 'ID');
	$this->excel->getActiveSheet()->setCellValue('B1', 'destination');
	$this->excel->getActiveSheet()->setCellValue('C1', 'origin');
	$this->excel->getActiveSheet()->setCellValue('D1', 'load');
	$this->excel->getActiveSheet()->setCellValue('E1', 'distance');
	$this->excel->getActiveSheet()->setCellValue('F1', 'freight');
	//change the font size
 

	$filename='just_some_random_name.xls'; //save our workbook as this file name
	header('Content-Type: application/vnd.ms-excel'); //mime type
	header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	header('Cache-Control: max-age=0'); //no cache
            
//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format
	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
//force user to download the Excel file without writing it to server's HD
	$objWriter->save('php://output');


	}

}

/* End of file freight.php */
/* Location: ./application/controllers/freight.php */