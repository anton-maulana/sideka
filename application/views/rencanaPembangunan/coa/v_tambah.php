<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>
		
<?php echo form_open('rencanaPembangunan/c_coa/simpan_coa/'); ?>
	<legend></legend>
	<div class="form-group">
		<label class="col-md-3 control-label" for="kode_rekening"> Kode Rekening*</label> 
		<div class="col-md-9">
		<span class="help-block">
			<input class="form-control input-md" type="text" name="kode_rekening" id="kode_rekening" placeholder="Kode Rekening" size="25" /> 
		</span>
		</div>
	</div>	
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="deskripsi"> Deskripsi*</label> 
		<div class="col-md-9">
		<span class="help-block">
			<input class="form-control input-md" type="text" name="deskripsi" id="deskripsi" placeholder="Deskripsi Kode Rekening" size="25" /> 
		</span>
		</div>
	</div>

	<p>
		<legend></legend>
		<input type="submit" value="Simpan" class="btn btn-success" id="simpan"/>
		<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_coa'"/>
	</p>

<?php echo form_close(); ?>


<script>
function nav_active(){
	
	document.getElementById("a-data-pustaka_per").className = "collapsed active";
	
	document.getElementById("pustaka_per").className = "collapsed";

	var d = document.getElementById("nav-coa");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>