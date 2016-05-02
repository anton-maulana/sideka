<h3><?= $page_title ?></h3>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php echo form_open('rencanaPembangunan/c_tahun_anggaran/update_tahun_anggaran'); ?>
<fieldset>
	<legend></legend>
	<!-- Text input-->
	<div class="form-group">
		<div class="col-md-9">
			<input  value="<?= $hasil->id_tahun_anggaran?>" id="id_tahun_anggaran" name="id_tahun_anggaran" type="hidden" placeholder="Deskripsi" class="form-control input-md">
			<span class="help-block"><?php echo form_error('id_tahun_anggaran', '<p class="field_error">','</p>')?></span>  
		</div>
	</div>

	<!-- Text input-->
	<div class="form-group">
		 <label class="col-md-3 control-label" for="id_periode">Periode</label>
		<div class="col-md-9">
        <span class="help-block">
		 <?php $id_periode = 'id="id_periode" class="form-control" required';
				echo form_dropdown('id_periode',$periode,$hasil->id_periode,$id_periode)?> 
		
		<?php echo form_error('id_periode', '<p class="field_error">','</p>')?>	
		</span>
		</div>
	</div>
	
	<div class="form-group">
		 <label class="col-md-3 control-label" for="tahun">Tahun Anggaran</label>
		<div class="col-md-9">
        <span class="help-block">
		 <?php $tahun = 'id="tahun" class="form-control" required';
				echo form_dropdown('tahun',$year,$hasil->tahun,$tahun)?> 
		
		<?php echo form_error('tahun', '<p class="field_error">','</p>')?>	
		</span>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="deskripsi"> Deskripsi</label> 
		<div class="col-md-9">
		<span class="help-block">
			<input class="form-control input-md" type="text" name="deskripsi" id="deskripsi" size="25" value="<?= $hasil->deskripsi?>"/> 
		</span>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="regulasi"> Regulasi</label> 
		<div class="col-md-9">
		<span class="help-block">
			<input class="form-control input-md" type="text" name="regulasi" id="regulasi" size="25" value="<?= $hasil->regulasi?>"/> 
		</span>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="keterangan"> Keterangan</label> 
		<div class="col-md-9">
		<span class="help-block">
			<input class="form-control input-md" type="text" name="keterangan" id="keterangan" size="25" value="<?= $hasil->keterangan?>"/>
		</span>
		</div>
	</div>
	<legend></legend>
</fieldset>
<p>
<input type="submit" value="Simpan" id="simpan" class="btn btn-success"/>
<input type="button" value="Batal" id="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_tahun_anggaran'"/>
</p>



<script>
function nav_active(){
	
	document.getElementById("a-data-pustaka_per").className = "collapsed active";
	
	document.getElementById("pustaka_per").className = "collapsed";

	var d = document.getElementById("nav-tahun_anggaran");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>