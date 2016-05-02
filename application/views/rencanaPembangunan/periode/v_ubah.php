<h3><?= $page_title ?></h3>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php echo form_open('rencanaPembangunan/c_Periode/update_periode'); ?>
<fieldset>
	<legend></legend>
	<!-- Text input-->
	<div class="form-group">
		<div class="col-md-9">
			<input  value="<?= $hasil->id_periode?>" id="id_periode" name="id_periode" type="hidden" placeholder="Deskripsi" class="form-control input-md">
			<span class="help-block"><?php echo form_error('id_periode', '<p class="field_error">','</p>')?></span>  
		</div>
	</div>


	<!-- Text input-->
	<div class="form-group">
		 <label class="col-md-3 control-label" for="periode_awal">Periode Awal</label>
		<div class="col-md-9">
        <span class="help-block">
		 <?php $periode_awal = 'id="periode_awal" class="form-control" required';
				echo form_dropdown('periode_awal',$year,$hasil->periode_awal,$periode_awal)?> 
		
		<?php echo form_error('periode_awal', '<p class="field_error">','</p>')?>	
		</span>
		</div>
	</div>
	
	<div class="form-group">
		 <label class="col-md-3 control-label" for="periode_akhir">Periode Akhir</label>
		<div class="col-md-9">
        <span class="help-block">
		 <?php $periode_akhir = 'id="periode_akhir" class="form-control" required';
				echo form_dropdown('periode_akhir',$year,$hasil->periode_akhir,$periode_akhir)?> 
		
		<?php echo form_error('periode_akhir', '<p class="field_error">','</p>')?>	
		</span>
		</div>
	</div>
	
	<legend></legend>
</fieldset>
<p>
<input type="submit" value="Simpan" id="simpan" class="btn btn-success"/>
<input type="button" value="Batal" id="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_Periode'"/>
</p>



<script>
function nav_active(){
	
	document.getElementById("a-data-pustaka_per").className = "collapsed active";
	
	document.getElementById("pustaka_per").className = "collapsed";

	var d = document.getElementById("nav-Periode");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>