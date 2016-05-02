<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>
<legend></legend>
<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>
		
<?php echo form_open('rencanaPembangunan/c_rpjmd/simpan_sub_program/'); ?>

	<input type="hidden" name="id_rpjmd" id="id_rpjmd" value="<?= $rpjmd->id_rpjmd ?>" size="20" />
	<input type="hidden" name="id_parent_rpjmd" id="id_parent_rpjmd" value="<?= $rpjmd->id_parent_rpjmd ?>" size="20" />
	<input type="hidden" name="id_top_rpjmd" id="id_top_rpjmd" value="<?= $rpjmd->id_top_rpjmd ?>" size="20" />

	<div class="form-group">
	<legend></legend>
    	<label class="col-md-3 control-label" for="program1"> Program</label> 
        <div class="col-md-9">
        <span class="help-block">
         <input class="form-control input-md" type="text" name="program1" id="program1" value="<?= $rpjmd->program ?>" size="25" disabled="true"/> 
		</span>
		</div>
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="program"> Sub Program*</label> 
        <div class="col-md-9">
        <span class="help-block">
         <input class="form-control input-md" type="text" name="program" id="program" size="25" /> 
		</span>
		</div>
	</div>	
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="kondisi_awal"> Kondisi Awal</label> 
		<div class="col-md-9">
		<span class="help-block">
			<input class="form-control input-md" type="text" name="kondisi_awal" id="kondisi_awal" size="25" /> 
		</span>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="target"> Target</label> 
		<div class="col-md-9">
		<span class="help-block">
			<input class="form-control input-md" type="text" name="target" id="target" size="25" /> 
		</span>
		</div>
	</div>
	
	<div class="form-group">
		 <label class="col-md-3 control-label" for="id_tahun_anggaran">Tahun Anggaran</label>
		<div class="col-md-9">
        <span class="help-block">
		 <?php $id_tahun_anggaran = 'id="id_tahun_anggaran" class="form-control" required';
				echo form_dropdown('id_tahun_anggaran',$tahun_anggaran,'',$id_tahun_anggaran)?> 
		
		<?php echo form_error('id_tahun_anggaran', '<p class="field_error">','</p>')?>	
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
		<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_rpjmd/show_detail_program/<?= $rpjmd->id_rpjmd; ?>'"/>
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