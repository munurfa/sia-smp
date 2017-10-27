

<?php
if ($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-success alert-dismissable"><strong>' . $this->session->flashdata('sukses') . '</strong>  <a href="'. base_url('datasiswa/nilai') .'" class="btn btn-danger btn-xs">Pilih Tahun Ajar</a></div>';
}
?>
<div class="table-responsive">
        <table width="100%" border="1" class="table table-striped table-bordered table-hover">
	    	<tr>
	    		
	    		<td><label for="tgl_absen">Tahun Ajar</label></td>
	    		<td>
	    		
	    				<?php echo $tahun_ajar; ?>
	    	      
	    				
	    		</td> 
	    	</tr>
	    	<tr>
	    		<td><label for="guru">Guru</label></td>
	    		<td>
	    		<?php print_r($guru->nama);echo ' - ';print_r($guru->nama_mapel);echo ' (Kelas ';print_r($guru->kelas);echo ')';?>

	    		</td>
	    	</tr>
	    	<tr>
	    		<td><label>Nilai Harian (20%)</label></td>
	    		<td><?php $harian = ($nilai->harian==NULL) ? '0' : $nilai->harian;echo $harian; ?></td>
	    	</tr>
	    	<tr>
	    		<td><label>Nilai UTS (30%)</label></td>
	    		<td><?php $uts = ($nilai->uts==NULL) ? '0' : $nilai->uts;echo $uts; ?></td>
	    	</tr>
		    <tr>
			    <td><label>Nilai UAS (50%)</label></td>
			    <td><?php $uas = ($nilai->uas==NULL) ? '0' : $nilai->uas;echo $uas; ?></td>
		    </tr>
		    <tr>
			    <td><label>Total</label></td>
			    <td><?php 
                        $akhir = ($nilai->harian*0.2)+($nilai->uts*0.3)+($nilai->uas*0.5);
                        echo $akhir; ?></td>
	    	</tr>
	    	

    	</table>
    	</div>
        <!-- <button class="btn btn-lg btn-success" type="submit" target="_blank">Cetak Absen</button>
        <a class="btn btn-lg btn-default" href="<?php echo base_url('siswa');?>">Batal</a> -->




