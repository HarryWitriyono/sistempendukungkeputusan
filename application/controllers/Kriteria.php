<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kriteria extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Modelkriteria');
        $this->load->helper('url_helper');
    }
    public function index()
    {
        $data['itemkriteria'] = $this->Modelkriteria->getkriteria();
        $this->load->view('header');
        $this->load->view('kriteria', $data);
        $this->load->view('footer');
    }
    public function simpanrekordbaru()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('namakriteria', 'Nama Kriteria', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('header');
            $this->load->view('kriteria');
            $this->load->view('footer');
        } else {
            $this->Modelkriteria->simpankanrekordbarunya();
            redirect('kriteria');
        }
    }
    public function hapus($id)
    {
        $iddihapus = $this->security->xss_clean($id);
        $this->db->where('idkriteria', $iddihapus);
        $this->db->delete('kriteria');
        redirect('kriteria');
    }
    public function koreksi($id)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('idkriteria', 'Id Kriteria', 'required');
        $this->form_validation->set_rules('namakriteria', 'Nama Kriteria', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['itemkriteria'] = $this->Modelkriteria->getkriteria($id);
            $this->load->view('header');
            $this->load->view('koreksikriteria', $data);
            $this->load->view('footer');
        } else {
            $this->Modelkriteria->simpanrekordkoreksinya();
            redirect('kriteria');
        }
    }
	public function bobotharapan()
	{
		$this->load->helper('form');
		$bSimpan=$this->input->post('bSimpanBobot');
		if (!isset($bSimpan)) {
			$data['itemkriteria'] = $this->Modelkriteria->getkriteria();
            $this->load->view('header');
            $this->load->view('bobotkriteria', $data);
            $this->load->view('footer');
		} else {
			$this->Modelkriteria->simpanbobotkriteria();
			redirect('kriteria/bobotharapan');
		}
	}
	public function json()
	{
		$query = $this->db->query("SELECT * FROM kriteria");		
		$hasiljson=json_encode($query->result(), JSON_PRETTY_PRINT);
		$this->load->helper('file');
		if(write_file('kriteria.json', $hasiljson)) {
			$this->load->helper('download');
			force_download('kriteria.json', $hasiljson);
            echo 'Successfully exported to json file!';
		} else {
			echo 'Error exporting mysql data...';
		}
	}
	public function csv()
	{
		$query = $this->db->query("SELECT * FROM kriteria");	
        $this->load->dbutil();		
		$delimiter = ",";
		$newline = "\r\n";
		$enclosure = '"';
		$hasilcsv=$this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);
		$this->load->helper('file');
		if(write_file('kriteria.csv', $hasilcsv)) {
			$this->load->helper('download');
			force_download('kriteria.csv', $hasilcsv);
            echo 'Successfully exported to csv file!';
		} else {
			echo 'Error exporting mysql data...';
		}
	}
	public function hapusall()
	{
		$this->db->truncate('kriteria');
		redirect('Kriteria');
	}
	
	public function uploadfilejson()
    {
			$this->load->view('header');
			$this->load->view('uploadjson');
			$this->load->view('footer');
    }
	public function uploadfilecsv()
    {
			$this->load->view('header');
			$this->load->view('uploadcsv');
			$this->load->view('footer');
    }
    public function do_upload($csv=false)
    {
		$config['upload_path']          = './uploads/';
		$config['allowed_types']        = '*';
        $config['max_size']             = 100;
		if ($csv==false) {
			$config['file_name']='kriteria.json';
		} else {
			$config['file_name']='kriteria.csv';
		}
		$config['overwrite']=true;
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('userfile'))
        {
            $error = array('error' => $this->upload->display_errors());
			$this->load->view('header');
			if ($csv==false) {
				$this->load->view('uploadjson', $error);
			} else {
				$this->load->view('uploadcsv', $error);
			}
			$this->load->view('footer');
        } else {
			if ($csv==false) {
				$fo=fopen("./uploads/kriteria.json","r");
				$fr=fread($fo,filesize("./uploads/kriteria.json"));
				$arraykriteria=json_decode($fr,true);
				foreach ($arraykriteria as $rekkrit) {
					$data = array(
			 'namakriteria' => html_escape($this->security->xss_clean($rekkrit['namakriteria'])),
			 'bobotpreferensi' => html_escape($this->security->xss_clean($rekkrit['bobotpreferensi'])),
			 'jeniskriteria' => html_escape($this->security->xss_clean($rekkrit['jeniskriteria']))
			 );
			        $this->db->insert('kriteria', $data);
		        }
			} else {
				$fo=fopen("./uploads/kriteria.csv","r");$i=0;
				while ($fr=fgetcsv($fo,4600,',','"','"'))
				{   if ($i>0) {
				      echo "<br>".$fr[1];
					  $data = array(
			          'namakriteria' => html_escape($this->security->xss_clean($fr[1])),
					  'bobotpreferensi' => html_escape($this->security->xss_clean($fr[2])),
					  'jeniskriteria' => html_escape($this->security->xss_clean($fr[4]))
					  );
			          $this->db->insert('kriteria', $data);
				    };$i++;
				}
			}
			fclose($fo);
			unlink ("./uploads/".$config['file_name']);
			redirect('Kriteria');
        }
    }
}
