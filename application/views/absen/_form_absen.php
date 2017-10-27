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
echo form_open('absen/tambah/'.$siswa->id_users.'/'.$tgl_absen.'/'.$this->uri->segment(5));
?>
    <fieldset>
        <table width="100%">

	    	<!-- <tr>
	    		<?php
	    		$attr = array(
	    		    'type' => 'date',
	    		    'name' => 'tgl_absen',
	    		    'value' => $tgl_absen,
	    		    'class' => 'form-control',
	    		    'readonly'=> TRUE
	    		);
	    		?>
	    		<td width="20%"><label for="tgl_absen">Tanggal Absen</label></td>
	    		<td width="80%"><?php echo form_input($attr); ?></td>
	    	</tr> -->
	    	<tr>
	    		<td width="20%"><label for="nama_siswa">Nama Siswa</label></td>
	    		<td width="80%">
	    		<?php echo form_input('nama_siswa', $siswa->nama, array('class'=>'form-control','readonly'=>TRUE));?>
	    		<?php echo form_hidden('id_guru', $id_guru); ?>
	 			<?php echo form_hidden('id_siswa', $siswa->id_users); ?>
	 			<?php echo form_hidden('tgl_absen', $tgl_absen); ?>
	 			<?php echo form_hidden('jam_ke', $jam_ke); ?>
	    		</td>
	    	</tr>
	    	<tr>
	    		<td width="20%"><label for="kelas">Kelas</label></td>
	    		<td width="80%">
	    		<?php echo form_input('kelas', $siswa->nama_kelas, array('class'=>'form-control','readonly'=>FALSE));?>

	    		</td>
	    	</tr>
	    	<!-- <tr>
	    		<td width="20%"><label for="jam_ke">Jam Ke</label></td>
	    		<td width="80%">
	    		<?php echo form_input('jam_ke', $jam_ke, array('class'=>'form-control','readonly'=>TRUE));?>

	    		</td>
	    	</tr> -->
	    	<tr>
	    		<td width="20%"><label for="absen">Absen</label></td>
	    		<td width="80%">
	    			<!-- A<?php echo form_radio('absen','A',$siswa->absen=='A',array('class'=>'form-control'));?>
	 				I<?php echo form_radio('absen','I',$siswa->absen=='I',array('class'=>'form-control'));?>
	 				S<?php echo form_radio('absen','S',$siswa->absen=='S',array('class'=>'form-control'));?>
	 				H<?php echo form_radio('absen','H',$siswa->absen=='H',array('class'=>'form-control'));?>
	 				N<?php echo form_radio('absen','N',($siswa->absen=='N'||$siswa->absen==''),array('class'=>'form-control'));?> -->
		<input type="radio" name="absen" value="A" style="width: 50px;height: 30px" class="radio-inline" <?php echo  set_radio('absen', 'A'); ?> /><label>A</label>
		<input type="radio" name="absen" value="I" style="width: 50px;height: 30px" class="radio-inline" <?php echo  set_radio('absen', 'I'); ?> /><label>I</label>
		<input type="radio" name="absen" value="S" style="width: 50px;height: 30px" class="radio-inline" <?php echo  set_radio('absen', 'S'); ?> /><label>S</label>
		<input type="radio" name="absen" value="H" style="width: 50px;height: 30px" class="radio-inline" <?php echo  set_radio('absen', 'H'); ?> /><label>H</label>
		<input type="radio" name="absen" value="N" style="width: 50px;height: 30px" class="radio-inline" <?php echo  set_radio('absen', 'N', TRUE); ?> /><label>N</label>

	    		</td>
	    	</tr>
	    	<tr>
	    		<td width="20%"><label for="ket">Keterangan</label></td>
	    		<td width="80%">
	    		<?php echo form_textarea('ket', set_value('ket'), array('class'=>'form-control'));?>

	    		</td>
	    	</tr>

    	</table>
        <button class="btn btn-lg btn-success" type="submit">Simpan Absen</button>
        <a class="btn btn-lg btn-default" href="<?php echo base_url('absen/daftarsiswa/'.$siswa->nama_kelas.'/'.$tgl_absen.'/'.$this->uri->segment(5));?>">Batal</a>
    </fieldset>


<?php
echo form_close();

?>
<br>
<div class="well">
    <h4>Keterangan Absensi</h4>
    <p>A = Tidak Masuk Tanpa Keterangan</p>
    <p>I = Tidak Masuk Ada Surat Ijin Atau Pemberitahuan</p>
    <p>S = Tidak Masuk Ada Surat Dokter Atau Pemberitahuan</p>
    <p>H = Hadir</p>
    <p>N = Belum Ada Keterangan Absensi</p>

</div>
