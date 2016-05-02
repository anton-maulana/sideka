<h2><?= $page_title ?></h2>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php
$attributes = array('name' => 'myform');
echo form_open_multipart('ped/c_ped/simpan_ped', $attributes); 
?>
<legend></legend>

	<div class="form-group">
	<label class="col-md-3 control-label" for="id_ped_sub">Nama Jenis Potensi </label>
		<div class="col-md-9">
		<?php $id = 'id="id_ped_sub" class="form-control input-md" required';
			echo form_dropdown('id_ped_sub',$ped_sub,'',$id)?>
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
	<label class="col-md-3 control-label" for="luas">Luas Wilayah</label>
		<div class="col-md-9">
		<input class="form-control input-md" type="text" name="luas" id="luas" placeholder="Ha (contoh: 15.5)" onkeypress='validate(event)' size="30" required /> 
		<span class="help-block"></span>
		</div>
	</div>
	<legend></legend>
	<div class="form-group">
			 <label class="col-md-3 control-label" for="nikKK">Pencarian Data Kepala Keluarga</label>
			 <div class="col-md-9">			 
			 <input type="text" class="form-control" name="nikKK" id="nikKK" size="50" placeholder="Nik Kepala Keluarga / Nama (min 2 karakter)" /> 
			<span class="help-block"></span>
		</div>
		</div>
		<legend></legend>
		<div class="form-group">
			 <label class="col-md-3 control-label" for="nik_sementara">NIK Pengelola</label>
			 <div class="col-md-9">			 
				<input type="text" class="form-control" name="nik" id="nik" size="50" readonly="readonly" placeholder="NIK Pengelola (Kepala Keluarga)" />
				<span class="help-block"><?php echo form_error('nik', '<p class="field_error">','</p>')?>
			</span>
		</div>
	</div>
	
	<div class="form-group col-md-12 control-label">
	<div class="alert alert-info">
			Kolom <b>NIK Pengelola</b> adalah NIK dari kepala keluarga yang mengelola detil potensi desa.
	</div>
	</div>

	
	<legend></legend>

	<div class="form-group">
		<label class="col-md-0 control-label" for="simpan"></label>
		<div class="col-md-9">
			<input type="submit" value="Simpan" id="simpan" class="btn btn-success"/>
			<input type="button" value="Batal" id="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>ped/c_ped'"/>
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

<script>	

  $(function() {
    var noKK = <?php  echo $json_array; ?> ;
    $("#nikKK" ).autocomplete({
      source: noKK,
	  minLength: 2,
	  select: function(event, ui) {
		
		bits = ui.item.value.split(' | ')
		nik = bits[bits.length - 2]
		nama = bits[bits.length - 1]
			$("#nik").val(nik);
			document.getElementById("simpan").disabled = false;
        },
        change: function(event, ui) {
		
		bits = ui.item.value.split(' | ')
		nik = bits[bits.length - 2]
		nama = bits[bits.length - 1]
			$("#nik").val(nik);
		
        }
    });
  });
  
</script>