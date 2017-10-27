 <div>
 <a href="<?php echo base_url('guru/tambah'); ?>" class="btn btn-danger">Tambah <?php echo $pageTitle; ?></a>
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
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Username (NIP)</th>
                        <th>Jenis Kelamin</th>
                        <th>Mapel</th>
                        <th width="120px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no=$this->uri->segment(3)+1; 
                	foreach ($guru->result() as $u) { ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $u->nama; ?></td>
                        <td><?php echo $u->username; ?></td>
                        <td><?php echo $u->jenis_kel; ?></td>
                        <td><?php echo $u->nama_mapel.' (Kelas '.$u->kelas.')'; ?></td>
                        <td>
                        	<a href="<?php echo base_url('guru/ubah/').$u->id_user; ?>" class="btn btn-warning btn-xs">Edit</a>
                            <a onclick="return confirm('Apakah Yakin Data Ini Akan Dihapus ?')" href="<?php echo base_url('guru/hapus/').$u->id_user; ?>" class="btn btn-danger btn-xs">Hapus</a>
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
