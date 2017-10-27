<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kelas extends CI_Model
{
    function semua($limit, $offset)
    {
        $sql = "SELECT * FROM `tbl_kelas` ORDER BY `nama_kelas`  ASC LIMIT $limit OFFSET $offset ";
        
        return $this->db->query($sql);
    }
    function count()
    {
        $sql = "SELECT * FROM `tbl_kelas`";
        return $this->db->query($sql)->num_rows();
    }
    function satu($id)
    {
    	$sql = "SELECT * FROM `tbl_kelas` WHERE id_kelas=$id LIMIT 1 ";
    	return $this->db->query($sql);
    }
    function tambah($data)
    {
    	$sql = "INSERT INTO tbl_kelas (`nama_kelas`,`wali_kelas`) VALUES (?,?)";
        $this->db->query($sql, array(
            $data['nama_kelas'],
            $data['wali_kelas'],
        ));
    }
    function update($data)
    {
    	$sql = "UPDATE `tbl_kelas` SET `nama_kelas`=?,`wali_kelas`=? WHERE id_kelas=?";
        $this->db->query($sql, array(
            $data['nama_kelas'],
            $data['wali_kelas'],
            $data['id']
        ));
    }
    function hapus($data)
    {
        $sql = "DELETE FROM `tbl_kelas` WHERE `id_kelas`=?";
        $this->db->query($sql, array(
            $data['id']
        ));
    }
    function guru()
    {
        $sql = "SELECT * FROM `tbl_users` WHERE `hak_akses`='Guru' ORDER BY `nama`";
        $result = $this->db->query($sql);
        $dd[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $dd[$row->nama] = $row->nama;
            }
        }
        return $dd;
    }
}

/* End of file m_guru.php */
/* Location: ./application/models/m_guru.php */