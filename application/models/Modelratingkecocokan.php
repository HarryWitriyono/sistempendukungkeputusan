<?php
class Modelratingkecocokan extends CI_Model
{
        public function __construct()
        {
                $this->load->database();
        }
        public function getratingkecocokan($idrating = FALSE)
        {
                if ($idrating === FALSE) {
                        $query = $this->db->get('ratingkecocokan');
                        return $query->result_array();
                } else {
                        $query = $this->db->get_where('ratingkecocokan', array('idrating' => $idrating));
                        return $query->row_array();
                }
        }
        public function getpilihankriteria()
        {
                $q = $this->db->get('kriteria');
                return $q->result_array();
        }
        public function getpilihanatribut()
        {
                $qa = $this->db->get('atribut');
                return $qa->result_array();
        }
        public function simpanrekordratingkecocokan()
        {
                $this->load->helper('url');
                $post = $this->input->post();
                $idkriteria = html_escape($this->security->xss_clean($post['idkriteria']));
				if (!isset($_SESSION)) session_start();
				$_SESSION['pilikrit']=$idkriteria;
                $idatribute = html_escape($this->security->xss_clean($post['idatribute']));
				$_SESSION['pilidat']=$idatribute;
                $nilairating = html_escape($this->security->xss_clean($post['nilairating']));
                $data = array('idkriteria' => $idkriteria, 'idatribute' => $idatribute, 'nilairating' => $nilairating);
                return $this->db->insert('ratingkecocokan', $data);
        }
        public function simpanhasilkoreksiratingkecocokan()
        {
                $post = $this->input->post();
                $idkriteria = html_escape($this->security->xss_clean($post['idkriteria']));
                $idatribute = html_escape($this->security->xss_clean($post['idatribute']));
                $nilairating = html_escape($this->security->xss_clean($post['nilairating']));
                $data = array('idkriteria' => $idkriteria, 'idatribute' => $idatribute, 'nilairating' => $nilairating);
                $where = " idkriteria = '" . $idkriteria . "' and idatribute = '" . $idatribute . "'";
                return $this->db->update('ratingkecocokan', $data, $where);
        }
}
