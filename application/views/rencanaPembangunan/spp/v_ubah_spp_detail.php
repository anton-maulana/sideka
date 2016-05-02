<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>
		
<?php echo form_open('rencanaPembangunan/c_spp/update_spp_detail/'); ?>

<legend></legend>
<div class="alert alert-warning" for="=">
Mohon untuk diperhatikan, bagi isian data yang diberikan tanda <b><label style="color:red;">( * ) </label> wajib diisi.</b><br>
</div>
<input value="<?= $spp->id_spp ?>" class="form-control input-md" type="hidden" name="id_spp" id="id_spp" /> 
<input value="<?= $spp_detail->id_spp_detail ?>" class="form-control input-md" type="hidden" name="id_spp_detail" id="id_spp_detail" /> 
<input value="<?= $spp_detail->id_rabdes_anggaran ?>" class="form-control input-md" type="hidden" name="id_rabdes_anggaran" id="id_rabdes_anggaran" /> 
<legend></legend>
<div class="form-group">
		<label class="col-md-3 control-label" for="permintaan_sekarang"> Uraian RABDes Anggaran <label style="color:red;"> *</label></label> 
		<div class="col-md-9">
			<span class="help-block">
				<input value="<?= $spp_detail->uraian?>" class="form-control input-md" type="text" name="permintaan_sekarang" id="permintaan_sekarang" placeholder="Permintaan Sekarang" disabled/> 
			</span>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="permintaan_sekarang"> Pagu Anggaran <label style="color:red;"> *</label></label> 
		<div class="col-md-9">
			<span class="help-block">
				<input value="<?= $spp_detail->pagu_anggaran?>" class="form-control input-md" type="text" name="permintaan_sekarang" id="permintaan_sekarang" placeholder="Permintaan Sekarang" disabled/> 
			</span>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="permintaan_sekarang"> Permintaan Sekarang <label style="color:red;"> *</label></label> 
		<div class="col-md-9">
			<span class="help-block">
				<input value="<?= $spp_detail->permintaan_sekarang?>" class="form-control input-md" type="text" name="permintaan_sekarang" id="permintaan_sekarang" placeholder="Permintaan Sekarang" /> 
			</span>
		</div>
	</div>
	
<p>
<legend></legend>

	<input type="submit" value="Simpan" class="btn btn-success" id="simpan"/>
	<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_spp/show_spp_detail/<?= $spp->id_spp ?>'"/>

</p>

       

<?php echo form_close(); ?>

<script>
function nav_active(){
	
	document.getElementById("a-data-anggaran").className = "collapsed active";
	document.getElementById("anggaran").className = "collapsed active";
	
	var d = document.getElementById("nav-spp");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});

</script>