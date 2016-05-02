<h3><?= $page_title ?></h3>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php echo form_open('rencanaPembangunan/c_bidang/update_bidang'); ?>
<input type="hidden" name="id_bidang" id="id_bidang" value="<?= $bidang->id_bidang ?>" size="20" />
<input type="hidden" name="id_parent_bidang" id="id_parent_bidang" value="<?= $bidang->id_parent_bidang ?>" size="20" />
<input type="hidden" name="id_top_bidang" id="id_top_bidang" value="<?= $bidang->id_top_bidang ?>" size="20" />
<input type="hidden" name="level" id="level" value="<?= $bidang->level ?>" size="20" />

<legend></legend>
	<div class="form-group">
		<label class="col-md-3 control-label" for="kode_bidang"> Kode Rekening*</label> 
		<div class="col-md-9">
		<span class="help-block">
			<input class="form-control input-md" type="text" name="kode_bidang" id="kode_bidang" value="<?= $bidang->kode_bidang ?>" size="25" /> 
		</span>
		</div>
	</div>	
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="deskripsi"> Deskripsi*</label> 
		<div class="col-md-9">
		<span class="help-block">
			<input class="form-control input-md" type="text" name="deskripsi" id="deskripsi" value="<?= $bidang->deskripsi ?>" size="25" /> 
		</span>
		</div>
	</div>
<p>
	<legend></legend>
	<input type="submit" value="Simpan" class="btn btn-success" id="simpan"/>
	<?php 
	if(!$bidang->id_top_bidang == null)
	{
	?>
	<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_bidang/show_detail_bidang/<?= $bidang->id_top_bidang; ?>'"/>
	<?php
	}
	else
	{
	?>
	<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_bidang/'"/>
	<?php
	}
	?>
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