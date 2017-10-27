<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_nilai extends CI_Model
{
    function siswaPerKelas($kelas,$tahun_ajar,$id_guru)
    {
        $sql = "SELECT a.*,s.*,u.*,k.* FROM tbl_siswa as s
                LEFT JOIN tbl_nilai as a ON a.id_siswa=s.id_users AND a.tahun_ajar=? AND a.id_guru=?
                JOIN tbl_users as u ON u.id_user=s.id_users
                join tbl_kelas as k ON k.id_kelas=s.id_kelas
                WHERE k.nama_kelas= ?
            ORDER BY u.nama,k.nama_kelas ASC";
        return $this->db->query($sql,array($tahun_ajar,$id_guru,$kelas));
    }

    function satu($id_siswa)
   {
       $sql = "SELECT * FROM `tbl_users`
               INNER JOIN tbl_siswa ON tbl_users.id_user=tbl_siswa.id_users
               JOIN tbl_kelas ON tbl_siswa.id_kelas=tbl_kelas.id_kelas
               WHERE `id_users`=$id_siswa LIMIT 1";
       return $this->db->query($sql);
   }
    function satuGuru($id_guru)
    {
      $sql = "SELECT * FROM `tbl_users` 
                INNER JOIN tbl_guru ON tbl_users.id_user=tbl_guru.id_users 
                JOIN tbl_mapel ON tbl_guru.id_mapel=tbl_mapel.id_mapel  
                WHERE `hak_akses`='Guru' AND `id_user`=$id_guru ";
      return $this->db->query($sql);
    }

   function siswaDiNilai($tahun_ajar,$id_siswa,$id_guru)
   {

       $sql = "SELECT a.*,s.*,u.*,k.* FROM tbl_siswa as s
               LEFT JOIN tbl_nilai as a ON a.id_siswa=s.id_users AND a.tahun_ajar=? AND a.id_guru=?
               JOIN tbl_users as u ON u.id_user=s.id_users
               join tbl_kelas as k ON k.id_kelas=s.id_kelas
               WHERE s.id_users= ? LIMIT 1";
       return $this->db->query($sql,array($tahun_ajar,$id_guru,$id_siswa));
   }
    function tambah($data)
    {
      $sql = "INSERT INTO tbl_nilai (`id_siswa`,`id_guru`,`harian`,`uts`,`uas`,`tahun_ajar`) VALUES (?,?,?,?,?,?)";
        $this->db->query($sql, array(
            $data['id_siswa'],
            $data['id_guru'],
            $data['harian'],
            $data['uts'],
            $data['uas'],
            $data['tahun_ajar'],
        ));

    }
    function update($data)
    {
      $sql = "UPDATE `tbl_nilai` SET `harian`=?,`uts`=?, `uas`=?
                WHERE `id_siswa`=? AND `id_guru`=? AND `tahun_ajar`=?" ;
        $this->db->query($sql, array(
          $data['harian'],
          $data['uts'],
          $data['uas'],
          $data['id_siswa'],
          $data['id_guru'],
          $data['tahun_ajar'],
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

}

/* End of file m_guru.php */
/* Location: ./application/models/m_guru.php */
