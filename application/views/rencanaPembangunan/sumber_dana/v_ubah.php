<h3><?= $page_title ?></h3>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php echo form_open('rencanaPembangunan/c_sumber_dana/update_sumber_dana'); ?>
<fieldset>
	<legend></legend>
	<!-- Text input-->
	<div class="form-group">
		<div class="col-md-9">
			<input  value="<?= $hasil->id_sumber_dana?>" id="id_sumber_dana" name="id_sumber_dana" type="hidden" placeholder="Deskripsi" class="form-control input-md">
			<span class="help-block"><?php echo form_error('id_sumber_dana', '<p class="field_error">','</p>')?></span>  
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="sumber"> Sumber Dana*</label> 
		<div class="col-md-9">
			<span class="help-block">
				<input value="<?= $hasil->sumber?>" class="form-control input-md" type="text" name="sumber" id="sumber" size="25" /> 
			</span>
		</div>
	</div>	
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="deskripsi"> Deskripsi*</label> 
		<div class="col-md-9">
			<span class="help-block">
				<input value="<?= $hasil->deskripsi?>" class="form-control input-md" type="text" name="deskripsi" id="deskripsi" size="25" /> 
			</span>
		</div>
	</div>
	

	<div class="form-group">
		<label class="col-md-3 control-label" for="nominal"> Nominal</label> 
		<div class="col-md-9">
		<span class="help-block">
			<div class="input-group">
				<span class="input-group-addon">
					<span class="fa">Rp&nbsp;</span>
				</span>
				<input value="<?= $hasil->nominal?>" class="form-control input-md" type="number" name="nominal" id="nominal" placeholder="1000000 = Rp 1.000.000,-" 
				onkeypress='return event.charCode >= 48 && event.charCode <= 57' required/>
			</div>
			<?php echo form_error('nominal', '<p class="field_error">','</p>')?>	
		</span>
		</div>
	</div>
	
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="id_tahun_anggaran">Tahun Anggaran</label>
		<div class="col-md-9">
			<span class="help-block">
			<?php $id_tahun_anggaran = 'id="id_tahun_anggaran" class="form-control" required';
					echo form_dropdown('id_tahun_anggaran',$tahun_anggaran,$hasil->id_tahun_anggaran,$id_tahun_anggaran)?> 
			<?php echo form_error('id_tahun_anggaran', '<p class="field_error">','</p>')?>	
			</span>
		</div>
	</div>
	
	<legend></legend>
</fieldset>
<p>
<input type="submit" value="Simpan" id="simpan" class="btn btn-success"/>
<input type="button" value="Batal" id="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_sumber_dana'"/>
</p>



<script>
function nav_active(){
	
		document.getElementById("a-data-pustaka_per").className = "collapsed active";
	
	document.getElementById("pustaka_per").className = "collapsed";

	var d = document.getElementById("nav-sumber_dana");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>