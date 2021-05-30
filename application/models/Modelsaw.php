<?php
class Modelsaw extends CI_Model {
	public function __construct()
	{
		$this->load->database();
    }
	public function hitungratingkecocokan()
	{
		//cari nilai maximum per kriteria
		$sql="select *,max(nilairating) as maxkriteria from ratingkecocokan group by idkriteria";
		$qmax=$this->db->query($sql);
		//hitung nilai r per kriteria tergantung jenisnya cost atau benefit
		foreach ($qmax->result() as $rekk) {
			$sqlk="select * from kriteria where idkriteria='".$rekk->idkriteria."'";
			$qk=$this->db->query($sqlk);
			foreach ($qk->result() as $rk) {
				$sqla="select * from atribut";
				$qa=$this->db->query($sqla);
				foreach ($qa->result() as $ra) {
					if ($rk->jeniskriteria == '1') {
						$sqlr="select nilairating/".$rekk->maxkriteria." as nilair from ratingkecocokan where 
			            idkriteria='".$rekk->idkriteria."' and idatribute='".$ra->idatribute."'";
                    } else {
						$sqlr="select ".$rekk->maxkriteria."/nilairating"." as nilair from ratingkecocokan where 
			            idkriteria='".$rekk->idkriteria."' and idatribute='".$ra->idatribute."'";	
			        }
                    $qr=$this->db->query($sqlr);$nilair=0;
                    foreach ($qr->result() as $rr) {
					  $bobotnormalisasi=$rk->bobotpreferensi * $rr->nilair;
					  $nilair=$rr->nilair;
			          $sqlri="update ratingkecocokan set nilainormalisasi = '".$nilair."' , 
					  bobotnormalisasi = ".$bobotnormalisasi." where 
					  idkriteria ='".$rekk->idkriteria."' and idatribute='".$ra->idatribute."'";
			          $qri=$this->db->query($sqlri);
                    }
				}
			}
		}
		//hitungnilaipreferensi
		$sqla="select * from atribut";
		$qa=$this->db->query($sqla);
		foreach ($qa->result() as $ra) {
			$sqlr="select sum(bobotnormalisasi) as nilaipreferensi from ratingkecocokan 
			where idatribute='".$ra->idatribute."' group by idatribute";
			$qr=$this->db->query($sqlr);
			foreach ($qr->result() as $rr) {
				$sqlua="update atribut set nilaipreferensi=".$rr->nilaipreferensi." 
				where idatribute='".$ra->idatribute."'";
				$qua=$this->db->query($sqlua);
			}
		}
		return;  
	}
	public function lakukanperangkingan()
	{
		$sqla="select * from atribut order by nilaipreferensi desc";
		$qa=$this->db->query($sqla);
		return $qa->result_array();
	}
}