<?php if (validation_errors()){ ?>
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php echo validation_errors(); ?>
</div>
<?php } ?>

<?php
echo form_open('guru/update/'.$guru->id_user);
?>
    <fieldset>
        <table width="100%">
	    	<tr>
	    		<td width="20%"><label for="nama">Nama Lengkap</label></td>
	    		<td width="80%"><?php echo form_input('nama',$guru->nama,array('class' => 'form-control' )); ?></td>
	    	</tr>
	    	<tr>
	    		<td width="20%"><label for="username">Username (NIP)</label></td>
	    		<td width="80%"><?php echo form_input('username',$guru->username,array('class' => 'form-control' )); ?></td>
	    	</tr>

	    	<tr>
	    		<td width="20%"><label for="jenis_kel">Jenis Kelamin</label></td>
	    		<td width="80%">
	    		<?php 
	    			$options = array(
					        'Laki-Laki' => 'Laki-Laki',
					        'Perempuan' => 'Perempuan',
					);

					$selected = array($guru->jenis_kel);
					echo form_dropdown('jenis_kel', $options, $selected,array('class' => 'form-control' ));
	    		 ?>
	 
	    		</td>
	    	</tr>
	    	<tr>
	    		<td width="20%"><label for="tmp_lahir">Tempat Lahir</label></td>
	    		<td width="80%"><?php echo form_input('tmp_lahir',$guru->tmp_lahir,array('class' => 'form-control' )); ?></td>
	    	</tr>
	    	<tr>
	    		<?php
	    		$attr = array(
	    		    'type' => 'date',
	    		    'name' => 'tgl_lahir',
	    		    'value' => $guru->tgl_lahir,
	    		    'class' => 'form-control'
	    		);
	    		?>
	    		<td width="20%"><label for="tgl_lahir">Tanggal Lahir</label></td>
	    		<td width="80%"><?php echo form_input($attr); ?></td>
	    	</tr>
	    	<td width="20%"><label for="mapel">Mapel</label></td>
	    		<td width="80%">
	    		<?php 
	    			$selected= $this->input->post('mapel') ? $this->input->post('mapel') : $guru->id_mapel; // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
					echo form_dropdown('mapel', $mapel, $guru->id_mapel,array('class' => 'form-control' ));
	    		 ?>
	 
	    		</td>
	    	<tr>
	    		<td width="20%"><label for="password">Password</label></td>
	    		<td width="80%">
	    		<?php echo form_password('password', set_value('password'), array('class' => 'form-control' )); ?>
	    				
	    		</td>
    		</tr>
	    	
    	</table>                 
        <button class="btn btn-lg btn-success" type="submit">Edit</button>
        <a class="btn btn-lg btn-default" href="<?php echo base_url('guru');?>">Batal</a>
    </fieldset>

    
<?php
echo form_close();

?>

