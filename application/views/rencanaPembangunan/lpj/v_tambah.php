<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>
		
<?php echo form_open('rencanaPembangunan/c_lpj/simpan_lpj/'); ?>
<legend></legend>
<div class="alert alert-warning" for="=">
Mohon untuk diperhatikan, bagi isian data yang diberikan tanda <b><label style="color:red;">( * ) </label> wajib diisi.</b><br>
</div>

	<legend></legend>
	<div class="form-group">
		<label class="col-md-3 control-label" for="id_spp">Data SPP <label style="color:red;"> *</label></label>
		<div class="col-md-9">
			<span class="help-block">
			 <?php $id_spp = 'id="id_spp" class="form-control" required';
					echo form_dropdown('id_spp',$spp,'',$id_spp)?> 
			<?php echo form_error('id_spp', '<p class="field_error">','</p>')?>	
			</span>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="penerima">Penerima<label style="color:red;"> *</label></label> 
		<div class="col-md-9">
			<span class="help-block">
				<input class="form-control input-md" type="text" name="penerima" id="penerima" placeholder="Penerima" /> 
			</span>
		</div>
	</div>	
		
		
<p>
<legend></legend>

	<input type="submit" value="Simpan" class="btn btn-success" id="simpan"/>
	<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_lpj'"/>
</p>

<?php echo form_close(); ?>


<script>
function nav_active(){
	
	document.getElementById("a-data-anggaran").className = "collapsed active";
	document.getElementById("anggaran").className = "collapsed active";
	
	var d = document.getElementById("nav-lpj");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>
