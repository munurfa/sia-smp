<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_mapel extends CI_Model
{
    function semua($limit, $offset)
    {
        $sql = "SELECT * FROM `tbl_mapel` ORDER BY `kelas` ASC LIMIT $limit OFFSET $offset";
        
        return $this->db->query($sql);
    }
    function count()
    {
        $sql = "SELECT * FROM `tbl_mapel`";
        return $this->db->query($sql)->num_rows();
    }
    function satu($id)
    {
    	$sql = "SELECT * FROM `tbl_mapel` WHERE id_mapel=$id LIMIT 1 ";
    	return $this->db->query($sql);
    }
    function tambah($data)
    {
    	$sql = "INSERT INTO tbl_mapel (`kd_mapel`,`nama_mapel`,`kelas`,`kkm`) VALUES (?,?,?,?)";
        $this->db->query($sql, array(
            $data['kd_mapel'],
            $data['nama_mapel'],
            $data['kelas'],
            $data['kkm'],
        ));
    }
    function update($data)
    {
    	$sql = "UPDATE `tbl_mapel` SET `kd_mapel`=?,`nama_mapel`=?,`kelas`=?,`kkm`=? WHERE id_mapel=?";
        $this->db->query($sql, array(
            $data['kd_mapel'],
            $data['nama_mapel'],
            $data['kelas'],
            $data['kkm'],
            $data['id']
        ));
    }
    function hapus($data)
    {
        $sql = "DELETE FROM `tbl_mapel` WHERE `id_mapel`=?";
        $this->db->query($sql, array(
            $data['id']
        ));
    }
}

/* End of file m_guru.php */
/* Location: ./application/models/m_guru.php */