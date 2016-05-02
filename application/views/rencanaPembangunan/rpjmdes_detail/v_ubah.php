<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>
		
<?php echo form_open('rencanaPembangunan/c_rpjmdes/update_rpjmdes'); ?>
	<input type="hidden" name="id_rpjmdes" id="id_rpjmdes" value="<?= $rpjmdes->id_rpjmdes ?>" size="20" />
	<input type="hidden" name="id_parent_rpjmdes" id="id_parent_rpjmdes" value="<?= $rpjmdes->id_parent_rpjmdes ?>" size="20" />
	<input type="hidden" name="id_top_rpjmdes" id="id_top_rpjmdes" value="<?= $rpjmdes->id_top_rpjmdes ?>" size="20" />
	<input type="hidden" name="id_rpjmd" id="id_rpjmd" value="<?= $rpjmdes->id_rpjmd ?>" size="20" />
	<input type="hidden" name="id_bidang" id="id_bidang" value="<?= $rpjmdes->id_bidang ?>" size="20" />
	<legend></legend>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="id_periode">Periode</label>
		<div class="col-md-9">
			<span class="help-block">
			<?php $id_periode = 'id="id_periode" class="form-control" required';
					echo form_dropdown('id_periode',$periode,$rpjmdes->id_periode,$id_periode)?> 
			<?php echo form_error('id_periode', '<p class="field_error">','</p>')?>	
			</span>
		</div>
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="kode_bidang"> Kode Bidang*</label> 
        <div class="col-md-9">
        <span class="help-block">
			<input class="form-control input-md" type="text" name="kode_bidang" id="kode_bidang" value="<?= $bidang->kode_bidang ?>" size="25" disabled/> 
		</span>
		</div>
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="deskripsi_bidang"> Deskripsi Bidang*</label> 
        <div class="col-md-9">
        <span class="help-block">
			<input class="form-control input-md" type="text" name="deskripsi_bidang" id="deskripsi_bidang" value="<?= $bidang->deskripsi ?>" size="25" disabled/> 
		</span>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="id_rpjmd">Program RPJMD*</label>
		<div class="col-md-9">
			<span class="help-block">
			 <?php $id_rpjmd = 'id="id_rpjmd" class="form-control" disabled="true"';
					echo form_dropdown('id_rpjmd',$rpjmd,$rpjmdes->id_rpjmd,$id_rpjmd)?> 
			<?php echo form_error('id_rpjmd', '<p class="field_error">','</p>')?>	
			</span>
		</div>
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="program"> Program*</label> 
        <div class="col-md-9">
        <span class="help-block">
			<input class="form-control input-md" type="text" name="program" id="program" value="<?= $rpjmdes->program ?>" size="25" /> 
		</span>
		</div>
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="indikator"> Indikator</label> 
        <div class="col-md-9">
        <span class="help-block">
			<input class="form-control input-md" type="text" name="indikator" id="indikator" value="<?= $rpjmdes->indikator ?>" size="25" /> 
		</span>
		</div>
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="kondisi_awal"> Kondisi Awal</label> 
        <div class="col-md-9">
        <span class="help-block">
			<input class="form-control input-md" type="text" name="kondisi_awal" id="kondisi_awal" value="<?= $rpjmdes->kondisi_awal ?>" size="25" /> 
		</span>
		</div>
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="target"> Target</label> 
        <div class="col-md-9">
        <span class="help-block">
			<input class="form-control input-md" type="text" name="target" id="target" value="<?= $rpjmdes->target ?>" size="25" /> 
		</span>
		</div>
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="capaian"> Capaian</label> 
        <div class="col-md-9">
        <span class="help-block">
			<input class="form-control input-md" type="text" name="capaian" id="capaian" value="<?= $rpjmdes->capaian ?>" size="25" /> 
		</span>
		</div>
	</div>
	
<p>
	<legend></legend>
	<input type="submit" value="Simpan" class="btn btn-success" id="simpan"/>
	<?php 
	if(!$rpjmdes->id_top_rpjmdes == null)
	{
	?>
	<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_rpjmdes/show_detail_program/<?= $rpjmdes->id_top_rpjmdes; ?>'"/>
	<?php
	}
	else
	{
	?>
	<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_rpjmdes/'"/>
	<?php
	}
	?>
</p>

<?php echo form_close(); ?>




<script>
function nav_active(){
	
	document.getElementById("a-data-perencanaan").className = "collapsed active";
	document.getElementById("perencanaan").className = "collapsed active";
	
	document.getElementById("a-data-rpjmdes").className = "collapsed active";
	document.getElementById("rpjmdes").className = "collapsed active";

	var d = document.getElementById("nav-list_rpjmdes");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>