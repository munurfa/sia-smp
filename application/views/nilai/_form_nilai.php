<?php
if ($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-success alert-dismissable"><strong>' . $this->session->flashdata('sukses') . '</strong> </div>';
}
?>
<?php if (validation_errors()){ ?>
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php echo validation_errors(); ?>
</div>
<?php } ?>

<?php
echo form_open('nilai/tambah/'.$siswa->id_users.'/'.$this->uri->segment(4));
?>
    <fieldset>
        <table width="100%">

	    	<tr>
	    		<td width="20%"><label for="nama_siswa">Nama Siswa</label></td>
	    		<td width="80%">
	    		<?php echo form_input('nama_siswa', $siswa->nama, array('class'=>'form-control','readonly'=>TRUE));?>
	    		<?php echo form_hidden('id_guru', $id_guru); ?>
  	 			<?php echo form_hidden('id_siswa', $siswa->id_users); ?>
  	 			<?php echo form_hidden('tahun_ajar', $tahun_ajar); ?>
  	 			<!-- <?php echo form_hidden('uas', $uas); ?> -->
	    		</td>
	    	</tr>
	    	<tr>
	    		<td width="20%"><label for="kelas">Kelas</label></td>
	    		<td width="80%">
	    		<?php echo form_input('kelas', $siswa->nama_kelas, array('class'=>'form-control','readonly'=>TRUE));?>

	    	</td>
        <tr>
	    		<td width="20%"><label for="harian">Nilai Harian</label></td>
	    		<td width="80%">
          <input type="text" name="harian" value="<?php echo set_value('harian','0.00') ?>"  class="form-control">
	    	</td>
        <tr>
	    		<td width="20%"><label for="uts">Nilai UTS</label></td>
	    		<td width="80%">
          <input type="text" name="uts" value="<?php echo set_value('uts','0.00') ?>"  class="form-control">
	    	</td>
        <tr>
	    		<td width="20%"><label for="uas">Nilai UAS</label></td>
	    		<td width="80%">
          <input type="text" name="uas" value="<?php echo set_value('uas','0.00') ?>" class="form-control">
	    	</td>


    	</table>
        <button class="btn btn-lg btn-success" type="submit">Simpan Nilai</button>
        <a class="btn btn-lg btn-default" href="<?php echo base_url('nilai/daftarsiswa/'.$siswa->nama_kelas.'/'.$this->uri->segment(4));?>">Batal</a>
    </fieldset>


<?php
echo form_close();

?>
<br>
<div class="well">
    <h4>Keterangan Nilai</h4>
    <p>*Input Nilai Harus Numeric (untuk nilai desimal dipisahkan titik(.))</p>

</div>