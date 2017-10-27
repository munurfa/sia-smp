<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Siswa extends CI_Model
{
    function semua($limit, $offset)
    {
        $sql = "SELECT * FROM `tbl_users` 
                INNER JOIN tbl_siswa ON tbl_users.id_user=tbl_siswa.id_users 
                JOIN tbl_kelas ON tbl_siswa.id_kelas=tbl_kelas.id_kelas
            WHERE `hak_akses`='Siswa' 
            ORDER BY tbl_kelas.nama_kelas , tbl_users.nama  ASC
            LIMIT $limit OFFSET $offset";        
        return $this->db->query($sql);
    }
    function count()
    {
        $sql = "SELECT * FROM `tbl_users` INNER JOIN tbl_siswa ON tbl_users.id_user=tbl_siswa.id_users 	WHERE `hak_akses`='Siswa'";
        return $this->db->query($sql)->num_rows();
    }
    function satu($id_user)
    {
    	$sql = "SELECT * FROM `tbl_users`
                INNER JOIN tbl_siswa ON tbl_users.id_user=tbl_siswa.id_users 
                JOIN tbl_kelas ON tbl_siswa.id_kelas=tbl_kelas.id_kelas
                WHERE `hak_akses`='Siswa' AND `id_user`=$id_user ";
    	return $this->db->query($sql);
    }
    function tambah($data)
    {
    	$sql = "INSERT INTO tbl_users (`nama`,`username`,`password`,`jenis_kel`,`hak_akses`) VALUES (?,?,?,?,?)";
        $this->db->query($sql, array(
            $data['nama'],
            $data['username'],
            $data['password'],
            $data['jenis_kel'],
            "Siswa",
        ));
        $last_id = $this->db->insert_id();
        $sql = "INSERT INTO `tbl_siswa`(`id_users`, `id_kelas`,`tmp_lahir`, `tgl_lahir`, `tahun_masuk`) VALUES (?,?,?,?,?)";
        $this->db->query($sql, array(
            $last_id,
            $data['kelas'],
            $data['tmp_lahir'],
            $data['tgl_lahir'],
            $data['tahun_masuk'],
        ));
    }
    function update($data)
    {
    	$sql = "UPDATE `tbl_users` SET `nama`=?,`username`=?,`password`=?,`jenis_kel`=? WHERE `id_user`=?";
        $this->db->query($sql, array(
            $data['nama'],
            $data['username'],
            $data['password'],
            $data['jenis_kel'],
            $data['id_user']
        ));
        $sql = "UPDATE `tbl_siswa` SET `id_kelas`=?, `tmp_lahir`=?,`tgl_lahir`=?, `tahun_masuk`=? WHERE id_users = ?";
        $this->db->query($sql, array(
            $data['kelas'],
            $data['tmp_lahir'],
            $data['tgl_lahir'],
            $data['tahun_masuk'],
            $data['id_user']
        ));
    }
    function hapus($data)
    {
        $sql = "DELETE FROM `tbl_users` WHERE `id_user`=?";
        $this->db->query($sql, array(
            $data['id_user']
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
                $dd[$row->id_kelas] = 'Kelas '.$row->nama_kelas;
            }
        }
        return $dd;
    }
}

/* End of file m_guru.php */
/* Location: ./application/models/m_guru.php */