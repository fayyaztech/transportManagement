<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Freight extends CI_Controller
{

    public function index()
    {

    }

    public function upload_excel()
    {
        if (isset($_FILES['excel'])) {
            $consignor_id = 1;
            // print_r($_FILES["excel"]);
            $this->load->library('excel');

            //php excel IO class object
            $objPHPExcel = PHPExcel_IOFactory::load($_FILES["excel"]['tmp_name']);
            $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();

            //extract to a PHP readable array format

            foreach ($cell_collection as $cell) {
                $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();

                //The header will/should be in row 1 only. of course, this can be modified to suit your need.
                if ($row == 1) {
                    $header[$row][$column] = $data_value;
                } else {
                    $arr_data[$row][] = $data_value;

                }
            }

            $this->_upload_to_database($arr_data, $header, $consignor_id);

        }

    }

    public function download_excel_sample()
    {

        $consignor_id = 1; //received by get method
        $name_of_consigner = "bajaj auto"; // received by get method

        $this->load->library('excel');
        $alphbets = alphabet_array();

        //alphabet array from genral helper
        $alphbets = alphabet_array();

        //freight model
        $loads = $this->freight_model->get_loads($consignor_id);
        $routes = $this->freight_model->get_routes();

        $excel_file[0]["A1"] = "AFFECTED DATE";
        $excel_file[0]["B1"] = "ORIGIN";
        $excel_file[0]["C1"] = "DESTINATION";
        $excel_file[0]["D1"] = "DISTANCE";

        $alphabet_series = 4;
        foreach ($loads as $value) {
            $excel_file[0][$alphbets[$alphabet_series++] . 1] = $value->load_name;
        }

        //add routes data in excel file
        // excel array index for add more value in array after 0 index
        $excel_array_index = 1;
        $alphabet_series = 0; //array index 1 is B;
        $cell_number = 2;
        foreach ($routes as $r) {
            // $excel_file[$excel_array_index][$alphbets[$alphabet_series++] . $cell_number] = $r->route_id;
            // $excel_file[$excel_array_index][$alphbets[$alphabet_series++] . $cell_number] = $excel_array_index;
            $excel_file[$excel_array_index][$alphbets[$alphabet_series++] . $cell_number] = "";
            $excel_file[$excel_array_index][$alphbets[$alphabet_series++] . $cell_number] = $r->route_origin;
            $excel_file[$excel_array_index][$alphbets[$alphabet_series++] . $cell_number] = $r->route_destination;
            $excel_file[$excel_array_index][$alphbets[$alphabet_series++] . $cell_number] = $r->route_distance;
            $excel_array_index++;
            $alphabet_series = 0;
            $cell_number++;

        }

        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('test worksheet');
        //set cell A1 content with some text

        for ($i = 0; $i < count($excel_file); $i++) {
            foreach ($excel_file[$i] as $cell => $value) {
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue($cell, $value);
                // if (strpos("A",$cell)) {
                //     $this->excel->getActiveSheet()->freezePane($cell);
                // }
            }
        }
        $this->excel->getActiveSheet()->protectCells("A1:A" . count($excel_file));

        $filename = $name_of_consigner . '.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

// //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        // //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
// //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

    }

    private function _upload_to_database($arr_data = "", $header, $consignor_id)
    {

        $logs_serial = 0;

        if (!empty($arr_data)) {
            $alphbets = alphabet_array();
            $alphabet_series = 4;

            //for each for extract head data from header
            foreach ($header as $key => $head) {}

            // limit is counting cells of loads are available in excel
            $limit = count($head) - $alphabet_series;

            //load_ids used to get table row ids of that loads
            for ($i = 0; $i < $limit; $i++) {
                $load = $head[$alphbets[$alphabet_series++]];
                $load_ids[] = $this->freight_model->get_load_id($load, $consignor_id);
            }

            $fix_cells = 4;
            foreach ($arr_data as $key => $value) {
                for ($i = 0; $i < count($value); $i++) {

                    /*
                    $value[0] effected date
                    $value[1] is origin
                    $value[2] is destination of route
                     */

                    $route_id = $this->freight_model->getRouteId($value[1], $value[2], $value[3]);

                    if ($i >= $fix_cells) {
                        $load_array_count = ($i - $fix_cells);
                        $load_route_data = ["load_id" => $load_ids[$load_array_count], "route_id" => $route_id];
                        $load_routes = $this->freight_model->getLoadRoutsId($load_route_data);

                        $freight_date = date("Y-m-d", strtotime($value[0]));
                        $new_freights = ["load_routes_id" => $load_routes, "freight_effected_date" => $freight_date, "freight" => $value[$load_array_count + $fix_cells]];
                        $this->freight_model->insert_new_load($new_freights);

                    }

                }
            }
        }
    }

    public function __construct()
    {
        parent::__construct();
        $this->load->model('freight_model');

    }

}

/* End of file freight.php */
/* Location: ./application/controllers/freight.php */
