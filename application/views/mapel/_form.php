<?php if (validation_errors()){ ?>
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php echo validation_errors(); ?>
</div>
<?php } ?>

<?php
echo form_open('mapel/tambah');
?>
    <fieldset>
        <table width="100%">
	    	<tr>
	    		<td width="20%"><label for="kd_mapel">Kode Mapel</label></td>
	    		<td width="80%"><?php echo form_input('kd_mapel',set_value('kd_mapel'),array('class' => 'form-control' )); ?></td>
	    	</tr>
	    	<tr>
	    		<td width="20%"><label for="nama_mapel">Nama Mapel</label></td>
	    		<td width="80%"><?php echo form_input('nama_mapel',set_value('nama_mapel'),array('class' => 'form-control' )); ?></td>
	    	</tr>

	    	<tr>
	    		<td width="20%"><label for="kelas">Kelas</label></td>
	    		<td width="80%">
	    		<?php 
	    			$options = array(
					        'VII' => 'VII',
					        'VIII' => 'VIII',
					        'IX' => 'IX',
					);

					echo form_dropdown('kelas', $options, set_value('kelas'),array('class' => 'form-control' ));
	    		 ?>
	 
	    		</td>
	    	</tr>
	    	<tr>
	    		<td width="20%"><label for="kkm">KKM</label></td>
	    		<td width="80%"><?php echo form_input('kkm',set_value('kkm'),array('class' => 'form-control' )); ?></td>
	    	</tr>
	    	
	    	
    	</table>                 
        <button class="btn btn-lg btn-success" type="submit">Tambah</button>
        <a class="btn btn-lg btn-default" href="<?php echo base_url('mapel');?>">Batal</a>
    </fieldset>

    
<?php
echo form_close();

?>

