<?php
class Modelatribut extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function getatribut($idatribute = FALSE)
        {
        if ($idatribute === FALSE)
        {
                $this->db->order_by('idatribute','desc');
                $query = $this->db->get('atribut');
                return $query->result_array();
        }
        $query = $this->db->get_where('atribut', array('idatribute' => $idatribute));
        return $query->row_array();
        }
        public function simpankanrekordbarunya()
        {
            $this->load->helper('url');
            $data = array(
               'namaatribut' => html_escape($this->security->xss_clean($this->input->post('namaatribut')))
            );
            return $this->db->insert('atribut', $data);
        }
        public function simpanrekordkoreksinya()
        {
            $this->load->helper('url');
            $id=htmlentities($this->security->xss_clean($this->input->post('idatribute')));
            $data = array(
               'namaatribut' => html_escape($this->security->xss_clean($this->input->post('namaatribut')))
            );
            $this->db->where('idatribute', $id);
            return $this->db->update('atribut', $data);
        }
}