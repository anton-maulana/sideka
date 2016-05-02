<h3><?= $page_title ?></h3>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php echo form_open('rencanaPembangunan/c_coa/update_coa'); ?>
<input type="hidden" name="id_coa" id="id_coa" value="<?= $coa->id_coa ?>" size="20" />
<input type="hidden" name="id_parent_coa" id="id_parent_coa" value="<?= $coa->id_parent_coa ?>" size="20" />
<input type="hidden" name="id_top_coa" id="id_top_coa" value="<?= $coa->id_top_coa ?>" size="20" />
<input type="hidden" name="level" id="level" value="<?= $coa->level ?>" size="20" />

<legend></legend>
	<div class="form-group">
		<label class="col-md-3 control-label" for="kode_rekening"> Kode Rekening*</label> 
		<div class="col-md-9">
		<span class="help-block">
			<input class="form-control input-md" type="text" name="kode_rekening" id="kode_rekening" value="<?= $coa->kode_rekening ?>" size="25" /> 
		</span>
		</div>
	</div>	
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="deskripsi"> Deskripsi*</label> 
		<div class="col-md-9">
		<span class="help-block">
			<input class="form-control input-md" type="text" name="deskripsi" id="deskripsi" value="<?= $coa->deskripsi ?>" size="25" /> 
		</span>
		</div>
	</div>
<p>
	<legend></legend>
	<input type="submit" value="Simpan" class="btn btn-success" id="simpan"/>
	<?php 
	if(!$coa->id_top_coa == null)
	{
	?>
	<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_coa/show_detail_coa/<?= $coa->id_top_coa; ?>'"/>
	<?php
	}
	else
	{
	?>
	<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_coa/'"/>
	<?php
	}
	?>
</p>


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