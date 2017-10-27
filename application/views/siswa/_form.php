<?php if (validation_errors()){ ?>
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php echo validation_errors(); ?>
</div>
<?php } ?>

<?php
echo form_open('siswa/tambah');
?>
    <fieldset>
        <table width="100%">
	    	<tr>
	    		<td width="20%"><label for="nama">Nama Lengkap</label></td>
	    		<td width="80%"><?php echo form_input('nama',set_value('nama'),array('class' => 'form-control' )); ?></td>
	    	</tr>
	    	<tr>
	    		<td width="20%"><label for="username">Username (NIS)</label></td>
	    		<td width="80%"><?php echo form_input('username',set_value('username'),array('class' => 'form-control' )); ?></td>
	    	</tr>

	    	<tr>
	    		<td width="20%"><label for="jenis_kel">Jenis Kelamin</label></td>
	    		<td width="80%">
	    		<?php 
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
	    	<tr>
	    	<td width="20%"><label for="kelas">Kelas</label></td>
	    		<td width="80%">
	    		<?php 
	    			// $selected= $this->input->post('wali_kelas') ? $this->input->post('wali_kelas') : ''; // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
					echo form_dropdown('kelas', $kelas, set_value('kelas'),array('class' => 'form-control' ));
	    		 ?>
	 
	    		</td>
	    	</tr>
	    	<tr>
	    		<td width="20%"><label for="tahun_masuk">Tahun Masuk</label></td>
	    		<td>
	    			<?php
	    			
					foreach (range('1990',date('Y')) as $k ) {
						 $l=$k+1;
						 $out[$k.'/'.$l] = $k.' / '.$l;
					    
					}
					$selected = $this->input->post('tahun_masuk') ? $this->input->post('tahun_masuk'):strval(date('Y')).'/'.strval(date('Y')+1) ;
			        echo form_dropdown('tahun_masuk', $out, $selected,array('class' => 'form-control' )); 	
			        	
			        	
			        ?>

			        
	    		</td>
	    	</tr>
	    	<tr>
	    		<td width="20%"><label for="password">Password</label></td>
	    		<td width="80%">
	    		<?php echo form_password('password', set_value('password'), array('class' => 'form-control' )); ?>
	    				
	    		</td>
    		</tr>
	    	
    	</table>                 
        <button class="btn btn-lg btn-success" type="submit">Tambah</button>
        <a class="btn btn-lg btn-default" href="<?php echo base_url('siswa');?>">Batal</a>
    </fieldset>

    
<?php
echo form_close();

?>

