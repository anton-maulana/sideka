<h2><?= $page_title ?></h2>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php
$attributes = array('name' => 'myform');
echo form_open_multipart('ped/c_ped_kategori/update_ped_kategori', $attributes); 
?>

<input type="hidden" value="<?= $ped_kategori->id_ped_kategori?>" name="id_ped_kategori"/>  

<legend></legend>

	<div class="form-group">
	<label class="col-md-3 control-label" for="deskripsi">Nama Lahan Potensi</label>
		<div class="col-md-9">
		<input class="form-control input-md" type="text" value="<?= $ped_kategori->deskripsi?>" name="deskripsi" placeholder="contoh: Pertambangan / Pertanian / Wisata / Sumber Energi " id="deskripsi" size="30" required />           
		<span class="help-block"></span>
		</div>
	</div>
	
	<legend></legend>

	<div class="form-group">
		<label class="col-md-0 control-label" for="simpan"></label>
		<div class="col-md-9">
			<input type="submit" value="Simpan" id="simpan" class="btn btn-success"/>
			<input type="button" value="Batal" id="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>ped/c_ped_kategori'"/>
		</div>
	</div>

<br>
<?php echo form_close(); ?>
  


<script>


function nav_active(){
	
	document.getElementById("a-data-ped").className = "collapsed active";
	
	document.getElementById("ped").className = "collapsed";

	var d = document.getElementById("nav-ped-kategori");
	d.className = d.className + "active";
	}
// very simple to use!
$(document).ready(function() {
  nav_active();
});

</script>