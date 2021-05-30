<?php
class Modelkriteria extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function getkriteria($idkriteria = FALSE)
        {
        if ($idkriteria === FALSE)
        {
                $this->db->order_by('idkriteria','desc');
                $query = $this->db->get('kriteria');
                return $query->result_array();
        }
        $query = $this->db->get_where('kriteria', array('idkriteria' => $idkriteria));
        return $query->row_array();
        }
        public function simpankanrekordbarunya()
        {
            $this->load->helper('url');
            $data = array(
               'namakriteria' => html_escape($this->security->xss_clean($this->input->post('namakriteria')))
            );
            return $this->db->insert('kriteria', $data);
        }
        public function simpanrekordkoreksinya()
        {
            $this->load->helper('url');
            $id=htmlentities($this->security->xss_clean($this->input->post('idkriteria')));
            $data = array(
               'namakriteria' => html_escape($this->security->xss_clean($this->input->post('namakriteria')))
            );
            $this->db->where('idkriteria', $id);
            return $this->db->update('kriteria', $data);
        }
		public function simpanbobotkriteria()
		{
			$this->load->helper('url');
			$idkriteria=$this->input->post('idkriteria');
			$bobotharapan=$this->input->post('bobotharapan');
			$jeniskriteria=$this->input->post('jeniskriteria');
			$jumrek=count($idkriteria);
			for ($n=0;$n<$jumrek;@$n++) {
			 $idkriterianya=html_escape($this->security->xss_clean($idkriteria[$n]));
			 $nilaibobotnya=html_escape($this->security->xss_clean($bobotharapan[$n]));
			 $jeniskriterianya=html_escape($this->security->xss_clean($jeniskriteria[$n]));
			 $data=array('bobotpreferensi'=>$nilaibobotnya,'jeniskriteria'=>$jeniskriterianya);
			 $this->db->where('idkriteria',$idkriterianya);
			 $this->db->update('kriteria',$data);
			}
			return;
		}
}