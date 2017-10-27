<!--  <div>
 <a href="<?php echo base_url('siswa/tambah'); ?>" class="btn btn-danger">Tambah <?php echo $pageTitle; ?></a>
 </div><br> -->
<?php
if ($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-success alert-dismissable"><strong>' . $this->session->flashdata('sukses') . '</strong>  <a href="'. base_url('absen/index') .'" class="btn btn-danger btn-xs">Pilih Tanggal Absen</a></div>';
}
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        Semua <?php echo $pageTitle; ?>
       <div style="text-align: right">
        <?php foreach (range(1,10) as $k): ?>
            <?php $btn = ($k==$this->uri->segment(5)) ? "btn-default" : "btn-danger" ; ?>
            <a href="<?php echo base_url('absen/daftarsiswa/').$kelas.'/'.$tgl_absen.'/'.$k; ?>" class="btn <?php echo $btn; ?> btn-xs">Jam Ke- <?php echo $k ?></a>
        <?php endforeach ?>
        </div>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th width="150px">NIS</th>
                        <th>Nama</th>
                        <th width="120px">Jenis Kelamin</th>
                        <th width="80px">Kelas</th>
                        <th width="60px">A</th>
                        <th width="60px">I</th>
                        <th width="60px">S</th>
                        <th width="60px">H</th>
                        <th width="60px">I</th>
                    </tr>
                </thead>
                
                <tbody>
                <?php 
                $action = ($jml_abs->jml_abs==0)  ? 'tambah' : 'update' ;
                $kelas = $this->uri->segment(3);
                $tgl_absen = $this->uri->segment(4);
                $jam_ke = $this->uri->segment(5);
                echo form_open(site_url('absen/'.$action.'/'.$tgl_absen.'/'.$jam_ke.'/'.$kelas)); 
              
                ?>
                <?php $no=$this->uri->segment(3)+1; 
                	foreach ($siswa->result() as $u) { 
                        echo form_hidden('id_siswa[]', $u->id_siswa);
                 ?>       
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $u->username; ?></td>
                        <td><?php echo $u->nama; ?></td>
                        <td><?php echo $u->jenis_kel; ?></td>
                        <td><?php echo $u->nama_kelas; ?></td>
                        <td><?php 
                        echo form_radio('absen'.$u->id_siswa, 'A', ($u->absen=='A') ? TRUE : FALSE) ?>
                        </td>
                        <td><?php 
                        echo form_radio('absen'.$u->id_siswa, 'I', ($u->absen=='I') ? TRUE : FALSE) ?></td>
                        <td><?php 
                        echo form_radio('absen'.$u->id_siswa, 'S', ($u->absen=='S') ? TRUE : FALSE) ?>
                        </td>
                        <td><?php 
                        echo form_radio('absen'.$u->id_siswa, 'H', ($u->absen=='H') ? TRUE : FALSE) ?></td>
                        <td><?php 
                        echo form_radio('absen'.$u->id_siswa, 'N', (($u->absen==NULL) or ($u->absen=='N')) ? TRUE : FALSE) ?></td>
                      
                        
                    </tr>
                <?php $no++; } ?>
                </tbody>
            </table>
            <div class="text-center">
                <?php $btn = ($jml_abs->jml_abs==0)  ? 'Simpan' : 'Update' ; ?>
            <button type="submit" class="btn btn-danger btn-lg"><?php echo $btn; ?></a>
            <?php echo form_close(); ?>
            </div>
             

        </div>
        <!-- /.table-responsive -->
    </div>
<!-- /.panel-body -->
  


</div>
<!-- /.panel -->

<div class="well">
    <h4>Keterangan Absensi</h4>
    <p>A = Tidak Masuk Tanpa Keterangan</p>
    <p>I = Tidak Masuk Ada Surat Ijin Atau Pemberitahuan</p>
    <p>S = Tidak Masuk Ada Surat Dokter Atau Pemberitahuan</p>
    <p>H = Hadir</p>
    <p>N = Belum Ada Keterangan Absensi</p>

</div>
