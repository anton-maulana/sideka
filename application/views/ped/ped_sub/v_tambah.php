<h2><?= $page_title ?></h2>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php
$attributes = array('name' => 'myform');
echo form_open_multipart('ped/c_ped_sub/simpan_ped_sub', $attributes); 
?>
<legend></legend>

	<div class="form-group">
	<label class="col-md-3 control-label" for="id_ped_kategori">Lahan </label>
		<div class="col-md-9">
		<?php $id = 'id="id_ped_kategori" class="form-control input-md" required';
			echo form_dropdown('id_ped_kategori',$ped_kategori,'',$id)?>
		<span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-3 control-label" for="deskripsi">Nama Jenis Potensi</label>
		<div class="col-md-9">
		<input class="form-control input-md" type="text" name="deskripsi" placeholder="contoh: padi, danau, pantai " id="deskripsi" size="30" required />         
		<span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-3 control-label" for="monetize">Hasil / Satuan</label>
		<div class="col-md-6">
		<input class="form-control input-md" type="text" name="monetize" id="monetize" placeholder="Rp. (contoh : 150000)" onkeypress="return numbersonly(event)" size="30" required/> 
		<span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-md-3">
		<?php $id = 'id="satuan" class="form-control input-md" required';
			echo form_dropdown('satuan',$satuan,'',$id)?>
		<span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group col-md-12 control-label">
	<div class="alert alert-info">
			Kolom <b>Hasil / Satuan</b> digunakan untuk data pendapatan potensi desa, contoh : Rp.15000 / m2.
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