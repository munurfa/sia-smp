<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_guru extends CI_Model
{
    function semua($limit, $offset)
    {
        $sql = "SELECT * FROM `tbl_users` 
                INNER JOIN tbl_guru ON tbl_users.id_user=tbl_guru.id_users 
                JOIN tbl_mapel ON tbl_guru.id_mapel=tbl_mapel.id_mapel
                WHERE `hak_akses`='Guru' ORDER BY `nama` ASC LIMIT $limit OFFSET $offset";
        
        return $this->db->query($sql);
    }
    function count()
    {
        $sql = "SELECT * FROM `tbl_users` INNER JOIN tbl_guru ON tbl_users.id_user=tbl_guru.id_users 	WHERE `hak_akses`='Guru'";
        return $this->db->query($sql)->num_rows();
    }
    function satu($id_user)
    {
    	$sql = "SELECT * FROM `tbl_users` 
                INNER JOIN tbl_guru ON tbl_users.id_user=tbl_guru.id_users 
                JOIN tbl_mapel ON tbl_guru.id_mapel=tbl_mapel.id_mapel	
                WHERE `hak_akses`='Guru' AND `id_user`=$id_user ";
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
            "Guru",
        ));
        $last_id = $this->db->insert_id();
        $sql = "INSERT INTO `tbl_guru`(`id_users`, `id_mapel`, `tmp_lahir`, `tgl_lahir`) VALUES (?,?,?,?)";
        $this->db->query($sql, array(
            $last_id,
            $data['mapel'],
            $data['tmp_lahir'],
            $data['tgl_lahir'],
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
        $sql = "UPDATE `tbl_guru` SET `id_mapel`=?,`tmp_lahir`=?,`tgl_lahir`=? WHERE id_users = ?";
        $this->db->query($sql, array(
            $data['mapel'],
            $data['tmp_lahir'],
            $data['tgl_lahir'],
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
    function mapel()
    {
        $sql = "SELECT * FROM `tbl_mapel` ORDER BY `nama_mapel` ASC";
        $result = $this->db->query($sql);
        $dd[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $dd[$row->id_mapel] = $row->nama_mapel.' (Kelas '.$row->kelas.')';
            }
        }
        return $dd;
    }
}

/* End of file m_guru.php */
/* Location: ./application/models/m_guru.php */