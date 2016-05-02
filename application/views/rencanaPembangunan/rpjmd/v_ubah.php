<h3><?= $page_title ?></h3>
<h5><?= $deskripsi_title ?></h5>
<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>
		
<?php echo form_open('rencanaPembangunan/c_rpjmd/update_rpjmd'); ?>
	<input type="hidden" name="id_rpjmd" id="id_rpjmd" value="<?= $rpjmd->id_rpjmd ?>" size="20" />
	<input type="hidden" name="id_parent_rpjmd" id="id_parent_rpjmd" value="<?= $rpjmd->id_parent_rpjmd ?>" size="20" />
	<input type="hidden" name="id_top_rpjmd" id="id_top_rpjmd" value="<?= $rpjmd->id_top_rpjmd ?>" size="20" />
	<legend></legend>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="program"> Program*</label> 
        <div class="col-md-9">
        <span class="help-block">
			<input class="form-control input-md" type="text" name="program" id="program" value="<?= $rpjmd->program ?>" size="25" /> 
		</span>
		</div>
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="kondisi_awal"> Kondisi Awal</label> 
        <div class="col-md-9">
        <span class="help-block">
			<input class="form-control input-md" type="text" name="kondisi_awal" id="kondisi_awal" value="<?= $rpjmd->kondisi_awal ?>" size="25" /> 
		</span>
		</div>
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="target"> Target</label> 
        <div class="col-md-9">
        <span class="help-block">
			<input class="form-control input-md" type="text" name="target" id="target" value="<?= $rpjmd->target ?>" size="25" /> 
		</span>
		</div>
	</div>
	
<p>
	<legend></legend>
	<input type="submit" value="Simpan" class="btn btn-success" id="simpan"/>
	<?php 
	if(!$rpjmd->id_top_rpjmd == null)
	{
	?>
	<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_rpjmd/show_detail_program/<?= $rpjmd->id_top_rpjmd; ?>'"/>
	<?php
	}
	else
	{
	?>
	<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_rpjmd/'"/>
	<?php
	}
	?>
</p>

<?php echo form_close(); ?>




<script>
function nav_active(){
	
	document.getElementById("a-data-perencanaan").className = "collapsed active";
	document.getElementById("perencanaan").className = "collapsed active";
	
	document.getElementById("a-data-rpjmd").className = "collapsed active";
	document.getElementById("rpjmd").className = "collapsed active";

	var d = document.getElementById("nav-list_rpjmd");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>