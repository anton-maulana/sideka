<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>
<legend></legend>
<div class="alert alert-warning" for="=">
Mohon untuk diperhatikan, bagi isian data yang diberikan tanda <b><label style="color:red;">( * ) </label> wajib diisi.</b><br>
</div>
<legend></legend>
<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>
		
<?php echo form_open('rencanaPembangunan/c_rpjmdes/simpan_sub_program/'); ?>

	<input type="hidden" name="id_rpjmdes" id="id_rpjmdes" value="<?= $rpjmdes->id_rpjmdes ?>" size="20" />
	<input type="hidden" name="id_parent_rpjmdes" id="id_parent_rpjmdes" value="<?= $rpjmdes->id_parent_rpjmdes ?>" size="20" />
	<input type="hidden" name="id_top_rpjmdes" id="id_top_rpjmdes" value="<?= $rpjmdes->id_top_rpjmdes ?>" size="20" />
	<input type="hidden" name="id_rpjmd" id="id_rpjmd" value="<?= $rpjmdes->id_rpjmd ?>" size="20" />
	<input type="hidden" name="id_bidang" id="id_bidang" value="<?= $rpjmdes->id_bidang ?>" size="20" />
	
	<div class="form-group">
		 <label class="col-md-3 control-label" for="id_periode">Periode*</label>
		<div class="col-md-9">
        <span class="help-block">
		 <?php $id_periode = 'id="id_periode" class="form-control" required';
				echo form_dropdown('id_periode',$periode,$rpjmdes->id_periode,$id_periode)?> 
		
		<?php echo form_error('id_periode', '<p class="field_error">','</p>')?>	
		</span>
		</div>
	</div>

		
		<div class="form-group">
			 <label class="col-md-3 control-label" for="kode_bidang">Kode Bidang*</label> 
			 <div class="col-md-9">
			 <span class="help-block">
				<input id="kode_bidang" name="kode_bidang" type="text" placeholder="Kode Bidang" class="form-control input-md" value="<?= $kode_bidang->kode_bidang ?>" required="" disabled/>
			</span>
			 </div>
		</div>
		
		<div class="form-group">
			 <label class="col-md-3 control-label" for="deskripsi_bidang">Deskripsi*</label> 
			 <div class="col-md-9">
			 <span class="help-block">
				<input id="deskripsi_bidang" name="deskripsi_bidang" type="text" placeholder="Deskripsi" class="form-control input-md" value="<?= $kode_bidang->deskripsi ?>" required="" disabled/>
			</span>
			 </div>
			<?php echo form_error('nama_ayah', '<p class="field_error">','</p>')?>	
	
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="program_rpjmd"> Program RPJMD</label> 
        <div class="col-md-9">
        <span class="help-block">
         <input class="form-control input-md" type="text" name="program_rpjmd" id="program_rpjmd" value="<?= $program_rpjmd ?>" size="25" disabled="true"/> 
		</span>
		</div>
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="program_rpjmdes"> Program RPJMDes</label> 
        <div class="col-md-9">
        <span class="help-block">
         <input class="form-control input-md" type="text" name="program_rpjmdes" id="program_rpjmdes" value="<?= $rpjmdes->program ?>" size="25" disabled="true"/> 
		</span>
		</div>
	</div>
	<legend></legend>
	<div class="form-group">
    	<label class="col-md-3 control-label" for="sub_program"> Sub Program*</label> 
        <div class="col-md-9">
        <span class="help-block">
         <input class="form-control input-md" type="text" name="sub_program" id="sub_program" size="25" required/> 
		</span>
		</div>
	</div>	
	<div class="form-group">
		<label class="col-md-3 control-label" for="indikator"> Indikator*</label> 
		<div class="col-md-9">
		<span class="help-block">
			<input class="form-control input-md" type="text" name="indikator" id="indikator" size="25" required/> 
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
		<label class="col-md-3 control-label" for="capaian"> Capaian</label> 
		<div class="col-md-9">
		<span class="help-block">
			<input class="form-control input-md" type="text" name="capaian" id="capaian" size="25" /> 
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
		<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_rpjmdes/show_detail_program/<?= $rpjmdes->id_rpjmdes; ?>'"/>
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