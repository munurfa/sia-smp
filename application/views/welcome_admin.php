<?php
if ($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-danger alert-dismissable"><strong>' . $this->session->flashdata('sukses') . '</strong></div>';
}
?>
<div style="text-align: center;" ">
	
	<img src="<?php echo base_url('/template/startmin/img/logo.jpg') ?>" width="35%" height="35%">
	<h1>SISTEM INFORMASI AKADEMIK</h1>
</div>