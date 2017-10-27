 <div>
 <a href="<?php echo base_url('mapel/tambah'); ?>" class="btn btn-danger">Tambah <?php echo $pageTitle; ?></a>
 </div><br>
<?php
if ($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>' . $this->session->flashdata('sukses') . '</strong></div>';
}
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        Semua <?php echo $pageTitle; ?>
        <!-- <a href="<?php echo base_url('mapel/report'); ?>" class="btn btn-danger btn-xs">Cetak Report</a> -->
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Mapel</th>
                        <th>Nama Mapel</th>
                        <th>Kelas</th>
                        <th>Mapel</th>
                        <th width="120px">Aksi</th>
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
                        <td>
                        	<a href="<?php echo base_url('mapel/ubah/').$u->id_mapel; ?>" class="btn btn-warning btn-xs">Edit</a>
                            <a onclick="return confirm('Apakah Yakin Data Ini Akan Dihapus ?')" href="<?php echo base_url('mapel/hapus/').$u->id_mapel; ?>" class="btn btn-danger btn-xs">Hapus</a>
                        </td>
                    </tr>
                <?php $no++; } ?>
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
<!-- /.panel-body -->
    <div class="panel-footer text-center">
        <?php echo $this->pagination->create_links();?>
    </div>
</div>
<!-- /.panel -->
