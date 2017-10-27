<?php if (validation_errors()){ ?>
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php echo validation_errors(); ?>
</div>
<?php } ?>

<?php
echo form_open('datasiswa/nilai');
?>
    <fieldset>
        <table width="100%">
	    	<tr>
	    		<td width="20%"><label for="tahun_ajar">Tahun Ajar</label></td>
	    		<td>
	    			<?php
	    			
					foreach (range(date('Y')-2,date('Y')) as $k ) {
						 $l=$k+1;
						 $out[$k.'/'.$l.'/1'] = $k.' / '.$l.' /1';
						 $out[$k.'/'.$l.'/2'] = $k.' / '.$l.' /2';
					    
					}
					$selected = $this->input->post('tahun_ajar') ? $this->input->post('tahun_ajar'):strval(date('Y')).'/'.strval(date('Y')+1 .'/2') ;
			        echo form_dropdown('tahun_ajar', $out, $selected,array('class' => 'form-control' )); 	
			        	
			        	
			        ?>

			        
	    		</td> 
	    	</tr>
	    	<tr>
	    		<td width="20%"><label for="guru">Guru</label></td>
	    		<td width="80%">
	    		<?php

	    		
	    			// $selected= $this->input->post('wali_kelas') ? $this->input->post('wali_kelas') : ''; // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
					echo form_dropdown('guru', $guru, set_value('guru'),array('class' => 'form-control' ));
	    		 ?>

	    		</td>
	    	</tr>
	    	

    	</table>
        <button class="btn btn-lg btn-success" type="submit" target="_blank">Lihat Nilai</button><!--
        <a class="btn btn-lg btn-default" href="<?php echo base_url('siswa');?>">Batal</a> -->
    </fieldset>


<?php
echo form_close();

?>
