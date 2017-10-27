<?php

defined('BASEPATH') OR exit('No direct script access allowed'); 
$this->load->model('m_absen');
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=Absen/".$kelas.".xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>

<table border="1">
                <thead>
                    <tr>
                        <th colspan="8" align="center" >
                            <span style="font-size: 20px">Absen Kelas <?php echo $kelas;?></span><br>
                            <span style="font-size: 12px">Tanggal <?php echo nice_date($tgl_awal,'d-m-Y').' s/d '.nice_date($tgl_akhir,'d-m-Y');?></span>
                        
                        </th>
                    </tr>
                    
                    <tr>
                        <th width="38px">#</th>
                        <th width="76px">NIS</th>
                        <th width="265px">Nama</th>
                        <th width="114px">Jenis Kelamin</th>
                        <th width="38px">A</th>
                        <th width="38px">I</th>
                        <th width="38px">S</th>
                        <th width="38px">H</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no=$this->uri->segment(3)+1; 
                	foreach ($siswa->result() as $u) { ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $u->username; ?></td>
                        <td><?php echo $u->nama; ?></td>
                        <td><?php echo $u->jenis_kel; ?></td>
                        <td>
                        <?php 

                            $abs = $this->m_absen->reportAbsen(
                                    $kelas,
                                    $tgl_awal,
                                    $tgl_akhir,
                                    $id_guru,
                                    $u->id_users,
                                    'A')->result() ;
                           print_r($abs[0]->jml_abs);
                        ?>
                        </td>
                        <td>
                        <?php 

                            $abs = $this->m_absen->reportAbsen(
                                    $kelas,
                                    $tgl_awal,
                                    $tgl_akhir,
                                    $id_guru,
                                    $u->id_users,
                                    'I')->result() ;
                           print_r($abs[0]->jml_abs);
                        ?>
                        </td>
                        <td>
                        <?php 

                            $abs = $this->m_absen->reportAbsen(
                                    $kelas,
                                    $tgl_awal,
                                    $tgl_akhir,
                                    $id_guru,
                                    $u->id_users,
                                    'S')->result() ;
                           print_r($abs[0]->jml_abs);
                        ?>
                        </td>
                        <td>
                        <?php 

                            $abs = $this->m_absen->reportAbsen(
                                    $kelas,
                                    $tgl_awal,
                                    $tgl_akhir,
                                    $id_guru,
                                    $u->id_users,
                                    'H')->result() ;
                           print_r($abs[0]->jml_abs);
                        ?>
                        </td>
                        
                    </tr>
                <?php $no++; } ?>
                </tbody>
            </table>