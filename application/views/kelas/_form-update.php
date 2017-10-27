<?php if (validation_errors()){ ?>
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php echo validation_errors(); ?>
</div>
<?php } ?>

<?php
echo form_open('kelas/update/'.$kelas->id_kelas);
?>
    <fieldset>
        <table width="100%">
	    	<tr>
	    		<td width="20%"><label for="nama_kelas">Nama Kelas</label></td>
	    		<td width="80%"><?php echo form_input('nama_kelas',$kelas->nama_kelas,array('class' => 'form-control' )); ?></td>
	    	</tr>
	    	<tr>
	    		<td width="20%"><label for="wali_kelas">Wali Kelas</label></td>
	    		<td width="80%">
	    		<?php 
	    			$selected= $this->input->post('wali_kelas') ? $this->input->post('wali_kelas') : $kelas->wali_kelas; // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
					echo form_dropdown('wali_kelas', $guru, $selected,array('class' => 'form-control' ));
	    		 ?>
	 
	    		</td>
	    	</tr>
    	</table>                 
        <button class="btn btn-lg btn-success" type="submit">Edit</button>
        <a class="btn btn-lg btn-default" href="<?php echo base_url('kelas');?>">Batal</a>
    </fieldset>

    
<?php
echo form_close();

?>

