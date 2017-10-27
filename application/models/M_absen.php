<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Absen extends CI_Model
{
    function siswaPerKelas($kelas,$tgl_absen,$jam_ke,$id_guru)
    {
       // contoh sql asli bisa dirun di phpmyadmin, nilai setelah = sesuaikan record
        // SELECT a.*,s.*,u.*,k.* FROM tbl_siswa as s
        // LEFT JOIN tbl_absen as a ON a.id_siswa=s.id_users AND a.tgl_absen='2017-06-26' AND a.jam_ke=4
        // JOIN tbl_users as u ON u.id_user=s.id_users
        // join tbl_kelas as k ON k.id_kelas=s.id_kelas
        // WHERE k.nama_kelas= 'VIIC'
        $sql = "SELECT a.*,s.*,u.*,k.* FROM tbl_siswa as s
                LEFT JOIN tbl_absen as a ON a.id_siswa=s.id_users AND a.tgl_absen=? AND a.jam_ke=? AND a.id_guru=?
                JOIN tbl_users as u ON u.id_user=s.id_users
                join tbl_kelas as k ON k.id_kelas=s.id_kelas
                WHERE k.nama_kelas= ?
            ORDER BY u.nama,k.nama_kelas ASC";
        return $this->db->query($sql,array($tgl_absen,$jam_ke,$id_guru,$kelas));
    }
    function jml_abs($kelas,$tgl_absen,$jam_ke,$id_guru)
    {
       
        $sql = "SELECT count(a.absen) as jml_abs FROM tbl_siswa as s
                LEFT JOIN tbl_absen as a ON a.id_siswa=s.id_users AND a.tgl_absen=? AND a.jam_ke=? AND a.id_guru=?
                JOIN tbl_users as u ON u.id_user=s.id_users
                join tbl_kelas as k ON k.id_kelas=s.id_kelas
                WHERE k.nama_kelas= ?
            ORDER BY u.nama,k.nama_kelas ASC";
        return $this->db->query($sql,array($tgl_absen,$jam_ke,$id_guru,$kelas))->row();
    }
     function satu($id_siswa)
    {
        $sql = "SELECT * FROM `tbl_users`
                INNER JOIN tbl_siswa ON tbl_users.id_user=tbl_siswa.id_users
                JOIN tbl_kelas ON tbl_siswa.id_kelas=tbl_kelas.id_kelas
                WHERE `id_users`=$id_siswa LIMIT 1";
        return $this->db->query($sql);
    }

    function siswaDiAbsen($tgl_absen,$jam_ke,$id_siswa,$id_guru)
    {
        // contoh sql asli bisa dirun di phpmyadmin, nilai setelah = sesuaikan record
        // SELECT a.*,s.*,u.*,k.* FROM tbl_siswa as s
        // LEFT JOIN tbl_absen as a ON a.id_siswa=s.id_users AND a.tgl_absen='2017-06-26' AND a.jam_ke=4
        // JOIN tbl_users as u ON u.id_user=s.id_users
        // join tbl_kelas as k ON k.id_kelas=s.id_kelas
        // WHERE s.id_users=62
        $sql = "SELECT a.*,s.*,u.*,k.* FROM tbl_siswa as s
                LEFT JOIN tbl_absen as a ON a.id_siswa=s.id_users AND a.tgl_absen=? AND a.jam_ke=? AND a.id_guru=?
                JOIN tbl_users as u ON u.id_user=s.id_users
                join tbl_kelas as k ON k.id_kelas=s.id_kelas
                WHERE s.id_users= ? LIMIT 1";
        return $this->db->query($sql,array($tgl_absen,$jam_ke,$id_guru,$id_siswa));
    }

    function tambah($data)
    {
    	// $sql = "INSERT INTO tbl_absen (`id_siswa`,`id_guru`,`tgl_absen`,`absen`,`keterangan`,`jam_ke`) VALUES (?,?,?,?,?,?)";
     //    $this->db->query($sql, array(
     //        $data['id_siswa'],
     //        $data['id_guru'],
     //        $data['tgl_absen'],
     //        $data['absen'],
     //        $data['ket'],
     //        $data['jam_ke'],
     //    ));
     $this->db->insert_batch('tbl_absen', $data);

    }
    function update($data)
    {

    	$sql = "UPDATE `tbl_absen` SET `absen`=?
                WHERE `id_siswa`=? AND `id_guru`=? AND `tgl_absen`=? AND `jam_ke`=?";
        $this->db->query($sql, array(
            $data['absen'],
            $data['id_siswa'],
            $data['id_guru'],
            $data['tgl_absen'],
            $data['jam_ke'],
        ));

    }

    function kelas()
    {
        $sql = "SELECT * FROM `tbl_kelas` ORDER BY `nama_kelas` ASC";
        $result = $this->db->query($sql);
        $dd[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $dd[$row->nama_kelas] = 'Kelas '.$row->nama_kelas;
            }
        }
        return $dd;
    }
    function report($kelas)
    {
        $sql = "SELECT * FROM `tbl_users` 
                INNER JOIN tbl_siswa ON tbl_users.id_user=tbl_siswa.id_users 
                JOIN tbl_kelas ON tbl_siswa.id_kelas=tbl_kelas.id_kelas
            WHERE `hak_akses`='Siswa' AND tbl_kelas.nama_kelas=?
            ORDER BY tbl_kelas.nama_kelas , tbl_users.nama  ASC";        
        return $this->db->query($sql,$kelas);
    }
    public function reportAbsen($kelas,$tgl_awal,$tgl_akhir,$id_guru,$id_siswa,$absen)
    {
        $sql = "SELECT COUNT(a.absen) as jml_abs FROM tbl_siswa as s
               LEFT OUTER  JOIN tbl_absen as a ON a.id_siswa=s.id_users AND (a.tgl_absen BETWEEN ? AND ?) AND a.id_guru=?
                JOIN tbl_users as u ON u.id_user=s.id_users
                join tbl_kelas as k ON k.id_kelas=s.id_kelas
                WHERE k.nama_kelas= ? AND a.absen=? AND a.id_siswa=?";
        return $this->db->query($sql,array($tgl_awal,$tgl_akhir,$id_guru,$kelas,$absen,$id_siswa));
    }
}

/* End of file m_guru.php */
/* Location: ./application/models/m_guru.php */
