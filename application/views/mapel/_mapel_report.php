<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=mapel.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>
<table border="1" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Mapel</th>
                        <th>Nama Mapel</th>
                        <th>Kelas</th>
                        <th>KKM</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no=$this->uri->segment(3)+1; 
                	foreach ($guru->result() as $u) { ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $u->kd_mapel; ?></td>
                        <td><?php echo $u->nama_mapel; ?></td>
                        <td><?php echo $u->kelas; ?></td>
                        <td><?php echo $u->kkm; ?></td>
                        
                    </tr>
                <?php $no++; } ?>
                </tbody>
            </table>