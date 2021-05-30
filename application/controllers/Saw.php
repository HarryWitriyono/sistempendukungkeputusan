<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Saw extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Modelsaw');
		$this->load->model('Modelratingkecocokan');
        $this->load->helper('url_helper');
    }
	public function index()
	{
		$this->load->view('header');
		//hitungratingkecocokan dan tampilkan hasilnya
		$this->Modelsaw->hitungratingkecocokan();
		$data['itemratingkecocokan'] = $this->Modelratingkecocokan->getratingkecocokan();
        $data['pilidkriteria'] = $this->Modelratingkecocokan->getpilihankriteria();
        $data['pilidatribut'] = $this->Modelratingkecocokan->getpilihanatribut();
		$this->load->view('matrixnilainormal',$data);
		$this->load->view('footer');
	}
	public function hasil()
	{
		$data['itemratingkecocokan'] = $this->Modelratingkecocokan->getratingkecocokan();
        $data['pilidkriteria'] = $this->Modelratingkecocokan->getpilihankriteria();
        $data['pilidatribut'] = $this->Modelratingkecocokan->getpilihanatribut();
		$data['rangking']=$this->Modelsaw->lakukanperangkingan();
		$this->load->view('header');
		$this->load->view('hasil',$data);
		$this->load->view('footer');
	}
	public function csv()
	{
		$this->load->dbutil();
		$query = $this->db->query("SELECT * FROM ratingkecocokan");
		$delimiter = ",";
		$newline = "\r\n";
		$enclosure = '"';
		$hasilcsv=$this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);
		$this->load->helper('file');
		if(write_file('data_saw.csv', $hasilcsv)) {
			$this->load->helper('download');
			force_download('data_saw.csv', $hasilcsv);
            echo 'Successfully exported to csv file!';
		} else {
			echo 'Error exporting mysql data...';
		}
	}
	public function xml()
	{
		$this->load->dbutil();
		$query = $this->db->query("SELECT * FROM ratingkecocokan");
		$config = array (
        'root'          => 'root',
        'element'       => 'element',
        'newline'       => "\n",
        'tab'           => "\t"
		);
		$hasilxml = $this->dbutil->xml_from_result($query, $config);
		$this->load->helper('file');
		if(write_file('data_saw.xml', $hasilxml)) {
			$this->load->helper('download');
			force_download('data_saw.xml', $hasilxml);
            echo 'Successfully exported to xml file!';
		} else {
			echo 'Error exporting mysql data...';
		}
	}
	public function json()
	{
		$query = $this->db->query("SELECT * FROM ratingkecocokan");		
		$hasiljson=json_encode($query->result(), JSON_PRETTY_PRINT);
		$this->load->helper('file');
		if(write_file('data_saw.json', $hasiljson)) {
			$this->load->helper('download');
			force_download('data_saw.json', $hasiljson);
            echo 'Successfully exported to json file!';
		} else {
			echo 'Error exporting mysql data...';
		}
	}
}