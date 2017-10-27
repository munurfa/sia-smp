<?php

defined('BASEPATH') OR exit('No direct script access allowed'); 

 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=Nilai/".$kelas."/".$tahun_ajar.".xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>

<table border="1">
                <thead>
                    <tr>
                        <th colspan="9" align="center" >
                            <span style="font-size: 20px">Nilai Kelas <?php echo $kelas;?></span><br>
                            <span style="font-size: 12px">Tahun Ajar <?php echo str_replace('-','/',$tahun_ajar);?></span>
                        
                        </th>
                    </tr>
                    
                    <tr>
                        <th width="50px">#</th>
                        <th width="150px">NIS</th>
                        <th>Nama</th>
                        <th width="120px">Jenis Kelamin</th>
                        <th width="80px">Kelas</th>
                        <th width="60px">Harian (20%)</th>
                        <th width="60px">UTS (30%)</th>
                        <th width="60px">UAS (50%)</th>
                        <th width="60px">Nilai Akhir</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no=$this->uri->segment(3)+1;
                    foreach ($siswa->result() as $u) {
                        $harian=floatval($u->harian,'0',2);
                        $uts=floatval($u->uts,'0',2);
                        $uas=floatval($u->uas,'0',2);
                 ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $u->username; ?></td>
                        <td><?php echo $u->nama; ?></td>
                        <td><?php echo $u->jenis_kel; ?></td>
                        <td><?php echo $u->nama_kelas; ?></td>
                        <td><?php echo $harian; ?></td>
                        <td><?php echo $uts; ?></td>
                        <td><?php echo $uas; ?></td>
                        <td><?php
                            $akhir = ($harian*0.2)+($uts*0.3)+($uas*0.5);
                            echo floatval($akhir,'0',2);?>
                            
                        </td>
                       


                    </tr>
                <?php $no++; } ?>
                </tbody>
            </table>