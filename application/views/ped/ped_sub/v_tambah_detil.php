<h2><?= $page_title ?></h2>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php
$attributes = array('name' => 'myform');
echo form_open_multipart('ped/c_ped_sub/simpan_detil_ped', $attributes); 
?>
<legend></legend>

	<input type="hidden" value="<?= $ped_sub->id_ped_sub?>" name="id_ped_sub"/>   
		
	<div class="form-group">
	<label class="col-md-3 control-label" for="deskripsi">Nama Jenis Potensi</label>
		<div class="col-md-9">
		<input class="form-control input-md" type="text" value="<?= $ped_sub->deskripsi?>" size="30" disabled />         
		<span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-3 control-label" for="deskripsi">Nama Detil Potensi</label>
		<div class="col-md-9">
		<input class="form-control input-md" type="text" name="deskripsi" placeholder="contoh: padi pak dodi / pantai parang tritis / tumpang sari #TS-1A " id="deskripsi" size="30" required />         
		<span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-3 control-label" for="luas">Luas</label>
		<div class="col-md-9">
		<input class="form-control input-md" type="text" name="luas" id="luas" placeholder="Ha (contoh: 15.5)" onkeypress='validate(event)' size="30" required/> 
		<span class="help-block"></span>
		</div>
	</div>
	


	
	<legend></legend>

	<div class="form-group">
		<label class="col-md-0 control-label" for="simpan"></label>
		<div class="col-md-9">
			<input type="submit" value="Simpan" id="simpan" class="btn btn-success"/>
			<input type="button" value="Batal" id="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>ped/c_ped_sub'"/>
		</div>
	</div>

<br>
<?php echo form_close(); ?>
  


<script>


function nav_active(){
	
	document.getElementById("a-data-ped").className = "collapsed active";
	
	document.getElementById("ped").className = "collapsed";

	var d = document.getElementById("nav-ped-sub");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});

</script>