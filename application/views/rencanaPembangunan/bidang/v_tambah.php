<h3><?= $page_title ?></h3>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php echo form_open('rencanaPembangunan/c_bidang/simpan_bidang'); ?>
<fieldset>
	<legend></legend>

	<!-- Text input-->	
	<div class="form-group">
		<label class="col-md-3 control-label" for="kode_bidang"> Kode Bidang*</label> 
		<div class="col-md-9">
			<span class="help-block">
				<input class="form-control input-md" type="text" name="kode_bidang" id="kode_bidang" size="25" /> 
			</span>
		</div>
	</div>	
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="deskripsi"> Bidang*</label> 
		<div class="col-md-9">
			<span class="help-block">
				<input class="form-control input-md" type="text" name="deskripsi" id="deskripsi" size="25" /> 
			</span>
		</div>
	</div>	
	
	<legend></legend>
</fieldset>
<p>
<input type="submit" value="Simpan" id="simpan" class="btn btn-success"/>
<input type="button" value="Batal" id="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_bidang'"/>
</p>

<script>
function nav_active(){
	
	document.getElementById("a-data-pustaka_per").className = "collapsed active";
	document.getElementById("pustaka_per").className = "collapsed active";

	var d = document.getElementById("nav-bidang");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>