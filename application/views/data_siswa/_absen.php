

<?php
if ($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-success alert-dismissable"><strong>' . $this->session->flashdata('sukses') . '</strong>  <a href="'. base_url('datasiswa/absen') .'" class="btn btn-danger btn-xs">Pilih Tanggal Absen</a></div>';
}
?>
<div class="table-responsive">
        <table width="100%" border="1" class="table table-striped table-bordered table-hover">
	    	<tr>
	    		
	    		<td><label for="tgl_absen">Tanggal Absen</label></td>
	    		<td>
	    		
	    				<?php echo nice_date($tgl_awal,'d-m-Y'); ?> Sampai <?php echo nice_date($tgl_akhir,'d-m-Y'); ?>
	    	      
	    				
	    		</td> 
	    	</tr>
	    	<tr>
	    		<td><label for="guru">Guru</label></td>
	    		<td>
	    		<?php print_r($guru->nama);echo ' - ';print_r($guru->nama_mapel);echo ' (Kelas ';print_r($guru->kelas);echo ')';?>

	    		</td>
	    	</tr>
	    	<tr>
	    		<td><label>Tidak Masuk Tanpa Keterangan (A)</label></td>
	    		<td><?php print_r($A->jml_abs) ?></td>
	    	</tr>
	    	<tr>
	    		<td><label>Izin (I)</label></td>
	    		<td><?php print_r($I->jml_abs) ?></td>
	    	</tr>
		    <tr>
			    <td><label>Sakit (S)</label></td>
			    <td><?php print_r($S->jml_abs) ?></td>
		    </tr>
		    <tr>
			    <td><label>Hadir (H)</label></td>
			    <td><?php print_r($H->jml_abs) ?></td>
	    	</tr>
	    	

    	</table>
    	</div>
        <!-- <button class="btn btn-lg btn-success" type="submit" target="_blank">Cetak Absen</button>
        <a class="btn btn-lg btn-default" href="<?php echo base_url('siswa');?>">Batal</a> -->




