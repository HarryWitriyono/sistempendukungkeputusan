<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ratingkecocokan extends CI_Controller
{

        public function __construct()
        {
                parent::__construct();
                $this->load->model('Modelratingkecocokan');
                $this->load->helper('url_helper');
        }
        public function index()
        {
                $data['itemratingkecocokan'] = $this->Modelratingkecocokan->getratingkecocokan();
                $data['pilidkriteria'] = $this->Modelratingkecocokan->getpilihankriteria();
                $data['pilidatribut'] = $this->Modelratingkecocokan->getpilihanatribut();
                $this->load->view('header');
                $this->load->view('ratingkecocokan', $data);
                $this->load->view('footer');
        }
        public function buatratingkecocokanbaru()
        {
                $this->load->helper('form');
                $this->load->library('form_validation'); 
                $this->form_validation->set_rules('idkriteria', 'Id Kriteria', 'required');
                $this->form_validation->set_rules('idatribute', 'Id Atribut', 'required');
                $this->form_validation->set_rules('nilairating', 'Nilai Rating', 'required');

                if ($this->form_validation->run() === FALSE) {
                        $this->load->view('header');
                        $this->load->view('ratingkecocokan');
                        $this->load->view('footer');
                        redirect('ratingkecocokan');
                } else {
                        $this->Modelratingkecocokan->simpanrekordratingkecocokan();
                        redirect('ratingkecocokan');
                }
        }
        public function hapusratingkecocokan($id)
        {
                $iddihapus = html_escape($this->security->xss_clean($id));
                $this->db->where('idrating', $iddihapus);
                $this->db->delete('ratingkecocokan');
                redirect('ratingkecocokan');
        }
        public function koreksiratingkecocokan($id)
        {
                $this->load->helper('form');
                $this->load->library('form_validation');

                $this->form_validation->set_rules('idkriteria', 'Id Kriteria', 'required');
                $this->form_validation->set_rules('idatribute', 'Id Atribut', 'required');
                $this->form_validation->set_rules('nilairating', 'Nilai Rating', 'required');

                if ($this->form_validation->run() === FALSE) {
                        $idrating = html_escape($this->security->xss_clean($id));
                        $data['itemratingkecocokan'] = $this->Modelratingkecocokan->getratingkecocokan($idrating);
                        $data['pilidkriteria'] = $this->Modelratingkecocokan->getpilihankriteria();
                        $data['pilidatribut'] = $this->Modelratingkecocokan->getpilihanatribut();
                        $this->load->view('header');
                        $this->load->view('koreksiratingkecocokan', $data);
                        $this->load->view('footer');
                } else {
                        $this->Modelratingkecocokan->simpanhasilkoreksiratingkecocokan();
                        redirect('ratingkecocokan');
                }
        }
	public function json()
	{
		$query = $this->db->query("SELECT * FROM ratingkecocokan");		
		$hasiljson=json_encode($query->result(), JSON_PRETTY_PRINT);
		$this->load->helper('file');
		if(write_file('ratingkecocokan.json', $hasiljson)) {
			$this->load->helper('download');
			force_download('ratingkecocokan.json', $hasiljson);
            echo 'Successfully exported to json file!';
		} else {
			echo 'Error exporting mysql data...';
		}
	}
	public function csv()
	{
		$query = $this->db->query("SELECT * FROM ratingkecocokan");	
        $this->load->dbutil();		
		$delimiter = ",";
		$newline = "\r\n";
		$enclosure = '"';
		$hasilcsv=$this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);
		$this->load->helper('file');
		if(write_file('ratingkecocokan.csv', $hasilcsv)) {
			$this->load->helper('download');
			force_download('ratingkecocokan.csv', $hasilcsv);
            echo 'Successfully exported to csv file!';
		} else {
			echo 'Error exporting mysql data...';
		}
	}
	public function hapusall()
	{
		$this->db->truncate('ratingkecocokan');
		redirect('ratingkecocokan');
	}
	
	public function uploadfilejson()
    {
			$this->load->view('header');
			$this->load->view('uploadjsonratingkecocokan');
			$this->load->view('footer');
    }
	public function uploadfilecsv()
    {
			$this->load->view('header');
			$this->load->view('uploadcsvratingkecocokan');
			$this->load->view('footer');
    }
    public function do_upload($csv=false)
    {
		$config['upload_path']          = './uploads/';
		$config['allowed_types']        = '*';
        $config['max_size']             = 100;
		if ($csv==false) {
			$config['file_name']='ratingkecocokan.json';
		} else {
			$config['file_name']='ratingkecocokan.csv';
		}
		$config['overwrite']=true;
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('userfile'))
        {
            $error = array('error' => $this->upload->display_errors());
			$this->load->view('header');
			if ($csv==false) {
				$this->load->view('uploadjsonratingkecocokan', $error);
			} else {
				$this->load->view('uploadcsvratingkecocokan', $error);
			}
			$this->load->view('footer');
        } else {
			if ($csv==false) {
				$fo=fopen("./uploads/ratingkecocokan.json","r");
				$fr=fread($fo,filesize("./uploads/ratingkecocokan.json"));
				$arrayratingkecocokan=json_decode($fr,true);
				foreach ($arrayratingkecocokan as $rekrat) {
				 $data = array(
			 'idkriteria' => html_escape($this->security->xss_clean($rekrat['idkriteria'])),
			 'idatribute' => html_escape($this->security->xss_clean($rekrat['idatribute'])),
			 'nilairating' => html_escape($this->security->xss_clean($rekrat['nilairating'])),
			 'nilainormalisasi' => html_escape($this->security->xss_clean($rekrat['nilainormalisasi'])),
			 'bobotnormalisasi' => html_escape($this->security->xss_clean($rekrat['bobotnormalisasi']))
			 );
			     $this->db->insert('ratingkecocokan', $data);
		        }
			} else {
				$fo=fopen("./uploads/ratingkecocokan.csv","r");$i=0;
				while ($fr=fgetcsv($fo,4600,',','"','"'))
				{   if ($i>0) {
				      echo "<br>".$fr[1];
					  $data = array(
			          'idkriteria' => html_escape($this->security->xss_clean($fr[1])),
					  'idatribute' => html_escape($this->security->xss_clean($fr[2])),
					  'nilairating' => html_escape($this->security->xss_clean($fr[3])),
					  'nilainormalisasi' => html_escape($this->security->xss_clean($fr[4])),
					  'bobotnormalisasi' => html_escape($this->security->xss_clean($fr[5]))
					  );
			          $this->db->insert('ratingkecocokan', $data);
				    };$i++;
				}
			}
			fclose($fo);
			unlink ("./uploads/".$config['file_name']);
			redirect('ratingkecocokan');
        }
    }
}
