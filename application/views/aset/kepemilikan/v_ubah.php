<div class="col-md-9">
<h3><?= $page_title ?></h3>
</div>
<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php
$attributes = array('name' => 'myform');
echo form_open_multipart('aset/c_kepemilikan/update_kepemilikan', $attributes); 
?>

<input type="hidden" value="<?= $kepemilikan->id_kepemilikan_aset?>" name="id_kepemilikan_aset"/>  

<legend></legend>

	<div class="form-group">
	<label class="col-md-3 control-label" for="deskripsi">Deskripsi</label>
		<div class="col-md-9">
		<input class="form-control input-md" value="<?= $kepemilikan->deskripsi?>" type="text" name="deskripsi" placeholder="deskripsi" id="deskripsi" size="30" required />           
		<span class="help-block"></span>
		</div>
	</div>
	
	<legend></legend>

	<div class="form-group">
		<label class="col-md-0 control-label" for="simpan"></label>
		<div class="col-md-9">
			<input type="submit" value="Simpan" id="simpan" class="btn btn-success"/>
			<input type="button" value="Batal" id="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>aset/c_kepemilikan'"/>
		</div>
	</div>

<br>
<?php echo form_close(); ?>
  


<script>


function nav_active(){
	document.getElementById("a-data-pustaka").className = "collapsed active";
	
	document.getElementById("pustaka").className = "collapsed";

	var d = document.getElementById("nav-kepemilikan");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});

</script>