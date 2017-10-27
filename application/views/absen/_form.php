<?php if (validation_errors()){ ?>
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php echo validation_errors(); ?>
</div>
<?php } ?>

<?php
echo form_open('absen/index');
?>
    <fieldset>
        <table width="100%">

	    	<tr>
	    		<?php
	    		$attr = array(
	    		    'type' => 'date',
	    		    'name' => 'tgl_absen',
	    		    'value' => set_value('tgl_absen',date('Y-m-d')),
	    		    'class' => 'form-control'
	    		);
	    		?>
	    		<td width="20%"><label for="tgl_absen">Tanggal Absen</label></td>
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
	    		<td width="20%"><label for="jam_ke">Jam Ke</label></td>
	    		<td>
	    			<?php

					foreach (range(1,10) as $k ) {

						 $out[$k] = $k;

					}

			        echo form_dropdown('jam_ke', $out, 1,array('class' => 'form-control' ));


			        ?>


	    		</td>
	    	</tr>

    	</table>
        <button class="btn btn-lg btn-success" type="submit">Lihat Absen</button>
        <a class="btn btn-lg btn-default" href="<?php echo base_url('absen/report');?>">Report</a>
    </fieldset>


<?php
echo form_close();

?>
