<!--  <div>
 <a href="<?php echo base_url('siswa/tambah'); ?>" class="btn btn-danger">Tambah <?php echo $pageTitle; ?></a>
 </div><br> -->
<?php
if ($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-success alert-dismissable"><strong>' . $this->session->flashdata('sukses') . '</strong>  <a href="'. base_url('nilai/index') .'" class="btn btn-danger btn-xs">Pilih Tahun Ajar</a></div>';
}
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        Semua <?php echo $pageTitle; ?>

        <a href="<?php echo base_url('nilai/report/'.$kelas.'/'.str_replace('/','-',$tahun_ajar)); ?>" class="btn btn-danger btn-xs" target="_blank">Cetak Report</a>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive">
        <h4><?php echo $guru->nama_mapel ?> (<?php echo $guru->kd_mapel ?>) - KKM = <?php echo $guru->kkm ?></h4>
            <table class="table table-striped table-bordered table-hover">
                <thead>
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
                        <th width="60px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                <?php $no=$this->uri->segment(3)+1;
                    foreach ($siswa->result() as $u) {
                 ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $u->username; ?></td>
                        <td><?php echo $u->nama; ?></td>
                        <td><?php echo $u->jenis_kel; ?></td>
                        <td><?php echo $u->nama_kelas; ?></td>
                        <td><?php echo $u->harian; ?></td>
                        <td><?php echo $u->uts; ?></td>
                        <td><?php echo $u->uas; ?></td>
                        <td><?php
                          $akhir = ($u->harian*0.2)+($u->uts*0.3)+($u->uas*0.5);
                        echo round($akhir,2); ?></td>
                        <td>


                            <?php if (empty($u->tahun_ajar)): ?>
                            <a href="<?php echo base_url('nilai/tambah/').$u->id_users.'/'.$tahun_ajar.'/'.$this->uri->segment(5); ?>" class="btn btn-danger btn-xs">Simpan Nilai</a>
                            <?php else: ?>
                             <a href="<?php echo base_url('nilai/update/').$u->id_users.'/'.$tahun_ajar.'/'.$this->uri->segment(5); ?>" class="btn btn-success btn-xs">Edit Nilai</a>
                            <?php endif ?>
                        </td>


                    </tr>
                <?php $no++; } ?>
                </tbody>
                            </table>

        </div>
        <!-- /.table-responsive -->
    </div>
<!-- /.panel-body -->



</div>
<!-- /.panel -->
