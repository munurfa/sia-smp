<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_datasiswa extends CI_Model {

	function absen($tgl_awal,$tgl_akhir,$id_guru,$id_siswa,$absen)
	{
	    $sql = "SELECT COUNT(a.absen) as jml_abs FROM tbl_siswa as s
               LEFT OUTER  JOIN tbl_absen as a ON a.id_siswa=s.id_users AND (a.tgl_absen BETWEEN ? AND ?) AND a.id_guru=?
                JOIN tbl_users as u ON u.id_user=s.id_users
                join tbl_kelas as k ON k.id_kelas=s.id_kelas
                WHERE  a.absen=? AND a.id_siswa=? LIMIT 1";
        return $this->db->query($sql,array($tgl_awal,$tgl_akhir,$id_guru,$absen,$id_siswa));
	}
	 function nilai($tahun_ajar,$id_siswa,$id_guru)
   {

       $sql = "SELECT a.*,s.*,u.*,k.* FROM tbl_siswa as s
               LEFT JOIN tbl_nilai as a ON a.id_siswa=s.id_users AND a.tahun_ajar=? AND a.id_guru=?
               JOIN tbl_users as u ON u.id_user=s.id_users
               join tbl_kelas as k ON k.id_kelas=s.id_kelas
               WHERE s.id_users= ? LIMIT 1";
       return $this->db->query($sql,array($tahun_ajar,$id_guru,$id_siswa));
   }
	function gurusatu($id_guru)
    {
        $sql = "SELECT a.*,b.*,c.* FROM tbl_guru as a
        		INNER JOIN tbl_mapel as b ON a.id_mapel=b.id_mapel
        		JOIN tbl_users as c ON a.id_users=c.id_user
        		WHERE a.id_users = ? 
        		ORDER BY `nama_mapel` ASC";
        return $this->db->query($sql,array($id_guru));
        ;
    }
   function guru($kelas)
    {
        $sql = "SELECT a.*,b.*,c.* FROM tbl_guru as a
        		INNER JOIN tbl_mapel as b ON a.id_mapel=b.id_mapel
        		JOIN tbl_users as c ON a.id_users=c.id_user
        		WHERE b.kelas = ? 
        		ORDER BY `nama_mapel` ASC";
        $result = $this->db->query($sql,array($kelas));
        $dd[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $dd[$row->id_users] = $row->nama.' ('.$row->nama_mapel.' '.$row->kelas.')';
            }
        }
        return $dd;
    }
    function kelas($id_user)
    {
    		$sql = "SELECT * FROM `tbl_users`
                INNER JOIN tbl_siswa ON tbl_users.id_user=tbl_siswa.id_users 
                JOIN tbl_kelas ON tbl_siswa.id_kelas=tbl_kelas.id_kelas
                WHERE `id_user`=$id_user LIMIT 1";
    	return $this->db->query($sql,array($id_user));
    }

}

/* End of file M_datasiswa.php */
/* Location: ./application/models/M_datasiswa.php */