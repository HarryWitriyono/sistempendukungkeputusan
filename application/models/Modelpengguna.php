<?php
class Modelpengguna extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function getpengguna($idpengguna = FALSE)
        {
            if ($idpengguna === FALSE)
            {
                $query = $this->db->get('pengguna');
                return $query->result_array();
            }

        $query = $this->db->get_where('pengguna', array('idpengguna' => $idpengguna));
        return $query->row_array();
        }
        public function cekpengguna(){
            $idpengguna=html_escape($this->security->xss_clean($this->input->post('idpengguna')));
            $password=html_escape($this->security->xss_clean($this->input->post('password')));
            $sql="select * from pengguna where idpengguna='".$idpengguna."' and password=left(password('".$password."'),30);";
            $query=$this->db->query($sql);
            return $query->row_array();
        }
        public function simpankanrekordbarunya(){
        
            $this->load->helper('url');
            $idpengguna=html_escape($this->security->xss_clean($this->input->post('idpengguna')));
            $password=html_escape($this->security->xss_clean($this->input->post('password')));
            $sql="insert into pengguna values ('".$idpengguna."',password('".$password."'));";
            return $this->db->query($sql);

        }
        public function simpanrekordkoreksinya()
        {
            $this->load->helper('url');
            $idpengguna=html_escape($this->security->xss_clean($this->input->post('idpengguna')));
            $password=html_escape($this->security->xss_clean($this->input->post('password')));
            $sql="update pengguna set password=password('".$password."') where idpengguna='".$idpengguna."'";
            return $this->db->query($sql);
        }

}