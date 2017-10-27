<?php if (validation_errors()){ ?>
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php echo validation_errors(); ?>
</div>
<?php } ?>

<?php
echo form_open('guru/tambah');
?>
    <fieldset>
        <table width="100%">
	    	<tr>
	    		<td width="20%"><label for="nama">Nama Lengkap</label></td>
	    		<td width="80%"><?php echo form_input('nama',set_value('nama'),array('class' => 'form-control' )); ?></td>
	    	</tr>
	    	<tr>
	    		<td width="20%"><label for="username">Username (NIP)</label></td>
	    		<td width="80%"><?php echo form_input('username',set_value('username'),array('class' => 'form-control' )); ?></td>
	    	</tr>

	    	<tr>
	    		<td width="20%"><label for="jenis_kel">Jenis Kelamin</label></td>
	    		<td width="80%">
	    		<?php 
	    		foreach (range(1,14) as $k) {
	    			# code...
	    		}
	    			$options = array(
					        'Laki-Laki' => 'Laki-Laki',
					        'Perempuan' => 'Perempuan',
					);

					echo form_dropdown('jenis_kel', $options, set_value('jenis_kel'),array('class' => 'form-control' ));
	    		 ?>
	 
	    		</td>
	    	</tr>
	    	<tr>
	    		<td width="20%"><label for="tmp_lahir">Tempat Lahir</label></td>
	    		<td width="80%"><?php echo form_input('tmp_lahir',set_value('tmp_lahir'),array('class' => 'form-control' )); ?></td>
	    	</tr>
	    	<tr>
	    		<?php
	    		$attr = array(
	    		    'type' => 'date',
	    		    'name' => 'tgl_lahir',
	    		    'value' => set_value('tgl_lahir'),
	    		    'class' => 'form-control'
	    		);
	    		?>
	    		<td width="20%"><label for="tgl_lahir">Tanggal Lahir</label></td>
	    		<td width="80%"><?php echo form_input($attr); ?></td>
	    	</tr>
	    	<td width="20%"><label for="mapel">Mapel</label></td>
	    		<td width="80%">
	    		<?php 
	    			// $selected= $this->input->post('wali_kelas') ? $this->input->post('wali_kelas') : ''; // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
					echo form_dropdown('mapel', $mapel, set_value('mapel'),array('class' => 'form-control' ));
	    		 ?>
	 
	    		</td>
	    	<tr>
	    	<tr>
	    		<td width="20%"><label for="password">Password</label></td>
	    		<td width="80%">
	    		<?php echo form_password('password', set_value('password'), array('class' => 'form-control' )); ?>
	    				
	    		</td>
    		</tr>
	    	
    	</table>                 
        <button class="btn btn-lg btn-success" type="submit">Tambah</button>
        <a class="btn btn-lg btn-default" href="<?php echo base_url('guru');?>">Batal</a>
    </fieldset>

    
<?php
echo form_close();

?>

