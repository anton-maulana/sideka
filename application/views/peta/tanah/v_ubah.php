<h2><?= $page_title ?></h2>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php
$attributes = array('name' => 'myform');
echo form_open_multipart('aset/c_tanah/update_tanah', $attributes); 
?>

<input type="hidden" value="<?= $tanah->id_aset_tanah?>" name="id_aset_tanah"/>  

<legend></legend>

	<div class="form-group">
	<label class="col-md-3 control-label" for="no_sertifikat">Nomor Sertifikat</label>
		<div class="col-md-9">
		<input class="form-control input-md" value="<?= $tanah->no_sertifikat?>" type="text" name="no_sertifikat" placeholder="contoh: 1107.06534.6693 " id="no_sertifikat" size="30" required />           
		<span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-3 control-label" for="luas">Luas Tanah</label>
		<div class="col-md-9">
		<input class="form-control input-md" value="<?= $tanah->luas?>" type="text" name="luas" id="luas" placeholder="Ha (contoh: 15.5)" onkeypress='validate(event)' size="30" required /> 
		<span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="id_kepemilikan_aset">Kepemilikan </label>
        <div class="col-md-9">         
         <?php $id = 'id="id_kepemilikan_aset" class="form-control input-md" required';
				echo form_dropdown('id_kepemilikan_aset',$kepemilikan,$tanah->id_kepemilikan_aset,$id)?>
		 <span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-3 control-label" for="deskripsi">Deskripsi Tanah</label>
		<div class="col-md-9">
		<textarea name="deskripsi" placeholder="Deskripsi Tanah" class="form-control" rows="3" required><?= $tanah->deskripsi?></textarea>         
		<span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-3 control-label" for="lokasi">Koordinat Poligon</label>
		<div class="col-md-9">
		<textarea name="lokasi" placeholder="Salin koordinat poligon disini" class="form-control" rows="3" ><?= $tanah->lokasi?></textarea>
		<span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group col-md-12 control-label">
	<div class="alert alert-info">
			Kolom <b>Koordinat Poligon</b> dapat dikosongkan untuk selanjutnya diisikan oleh <b>Pengelola Peta</b>.
	</div>
	</div>

	
	<legend></legend>

	<div class="form-group">
		<label class="col-md-0 control-label" for="simpan"></label>
		<div class="col-md-9">
			<input type="submit" value="Simpan" id="simpan" class="btn btn-success"/>
			<input type="button" value="Batal" id="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>aset/c_tanah'"/>
		</div>
	</div>

<br>
<?php echo form_close(); ?>
  


<script>


function nav_active(){
	
	document.getElementById("a-data-ped").className = "collapsed active";
	
	document.getElementById("ped").className = "collapsed";

	var d = document.getElementById("nav-ped");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});

</script>