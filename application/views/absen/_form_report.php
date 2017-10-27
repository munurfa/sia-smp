<?php if (validation_errors()){ ?>
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php echo validation_errors(); ?>
</div>
<?php } ?>

<?php
echo form_open('absen/report',array('target' => '_blank', ));
?>
    <fieldset>
        <table width="100%">
	    	<tr>
	    		<?php
	    		$awal = array(
	    		    'type' => 'date',
              'name' => 'tgl_awal',
	    		    'value' => set_value('tgl_awal',date('Y-m-d')),
	    		    'class' => 'form-control'
	    		);
          $akhir = array(
	    		    'type' => 'date',
              'name' => 'tgl_akhir',
	    		    'value' => set_value('tgl_akhir',date('Y-m-d')),
	    		    'class' => 'form-control'
	    		);
	    		?>
	    		<td width="20%"><label for="tgl_absen">Tanggal Absen</label></td>
	    		<td width="30%" >
	    		<div class="row">
	    			<div class="col-sm-4">
	    				<?php echo form_input($awal); ?>
	    			</div>
	    			<div class="col-sm-4 text-center">
	    				Sampai
	    			</div>
	    			<div class="col-sm-4">
	    				<?php echo form_input($akhir); ?>
	    			</div>
	    		</div>	
	    				
	    		</td> 
	    	</tr>
	    	<tr>
	    		<td width="20%"><label for="kelas">Kelas</label></td>
	    		<td width="80%">
	    		<?php
	    			// $selected= $this->input->post('wali_kelas') ? $this->input->post('wali_kelas') : ''; // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
					echo form_dropdown('kelas', $kelas, set_value('kelas'),array('class' => 'form-control' ));
	    		 ?>

	    		</td>
	    	</tr>
	    	

    	</table>
        <button class="btn btn-lg btn-success" type="submit" target="_blank">Lihat Absen</button><!--
        <a class="btn btn-lg btn-default" href="<?php echo base_url('siswa');?>">Batal</a> -->
    </fieldset>


<?php
echo form_close();

?>
