<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Atribut extends CI_Controller {
 public function __construct()
        {
                parent::__construct();
                $this->load->model('Modelatribut');
                $this->load->helper('url_helper');
        }
    public function index()
	{
        $data['itematribut'] = $this->Modelatribut->getatribut();
		$this->load->view('header');
        $this->load->view('atribut',$data);
        $this->load->view('footer');
	}
    public function simpanrekordbaru()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('namaatribut', 'Nama Atribut', 'required');

        if ($this->form_validation->run() === FALSE)
           {
               $this->load->view('header');
               $this->load->view('atribut');
               $this->load->view('footer');
            } else {
               $this->Modelatribut->simpankanrekordbarunya();
               redirect('atribut');
            }
    }
    public function hapus($id)
    {
       $iddihapus=$this->security->xss_clean($id);
       $this->db->where('idatribute', $iddihapus);
       $this->db->delete('atribut');
       redirect('atribut');
    }
    public function koreksi($id)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('idatribute', 'Id atribut', 'required');
        $this->form_validation->set_rules('namaatribut', 'Nama atribut', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $data['itematribut'] = $this->Modelatribut->getatribut($id);
            $this->load->view('header');
            $this->load->view('koreksiatribut',$data);
            $this->load->view('footer');
        } else {
            $this->Modelatribut->simpanrekordkoreksinya();
            redirect('atribut');
        }
    }
	public function json()
	{
		$query = $this->db->query("SELECT * FROM atribut");		
		$hasiljson=json_encode($query->result(), JSON_PRETTY_PRINT);
		$this->load->helper('file');
		if(write_file('atribut.json', $hasiljson)) {
			$this->load->helper('download');
			force_download('atribut.json', $hasiljson);
            echo 'Successfully exported to json file!';
		} else {
			echo 'Error exporting mysql data...';
		}
	}
	public function csv()
	{
		$query = $this->db->query("SELECT * FROM atribut");	
        $this->load->dbutil();		
		$delimiter = ",";
		$newline = "\r\n";
		$enclosure = '"';
		$hasilcsv=$this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);
		$this->load->helper('file');
		if(write_file('atribut.csv', $hasilcsv)) {
			$this->load->helper('download');
			force_download('atribut.csv', $hasilcsv);
            echo 'Successfully exported to csv file!';
		} else {
			echo 'Error exporting mysql data...';
		}
	}
	public function hapusall()
	{
		$this->db->truncate('atribut');
		redirect('Atribut');
	}
	public function uploadfilejson()
    {
			$this->load->view('header');
			$this->load->view('uploadjsonatribut');
			$this->load->view('footer');
    }
	public function uploadfilecsv()
    {
			$this->load->view('header');
			$this->load->view('uploadcsvatribut');
			$this->load->view('footer');
    }
    public function do_upload($csv=false)
    {
		$config['upload_path']          = './uploads/';
		$config['allowed_types']        = '*';
        $config['max_size']             = 100;
		if ($csv==false) {
			$config['file_name']='atribut.json';
		} else {
			$config['file_name']='atribut.csv';
		}	
		$config['overwrite']=true;
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('userfile'))
        {
            $error = array('error' => $this->upload->display_errors());
			$this->load->view('header');
			if ($csv==false) {
				$this->load->view('uploadjsonatribut', $error);
			} else {
				$this->load->view('uploadcsv', $error);
			}
			$this->load->view('footer');
        } else {
			if ($csv==false) {
				$fo=fopen("./uploads/atribut.json","r");
				$fr=fread($fo,filesize("./uploads/atribut.json"));
				$arrayatribut=json_decode($fr,true);
				fclose($fr);
				foreach ($arrayatribut as $rekatr) {
					$data = array(
					'namaatribut' => html_escape($this->security->xss_clean($rekatr['namaatribut'])));
					$this->db->insert('atribut', $data);
				}
			} else {
				$fo=fopen("./uploads/atribut.csv","r");$i=0;
				while ($fr=fgetcsv($fo,4600,',','"','"'))
				{   if ($i>0) {
				      echo "<br>".$fr[1];
					  $data = array(
			          'namaatribut' => html_escape($this->security->xss_clean($fr[1])));
			          $this->db->insert('atribut', $data);
				    };$i++;
				}
			}
			fclose($fo);
			unlink ("./uploads/".$config['file_name']);
			redirect('Atribut');
        }
    }
}
