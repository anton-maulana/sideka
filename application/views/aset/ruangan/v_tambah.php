<div class="col-md-9">
<h3><?= $page_title ?></h3>
</div>
<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php
$attributes = array('name' => 'myform');
echo form_open_multipart('aset/c_ruangan/simpan_ruangan', $attributes); 
?>
<!-- Form Name -->
	<legend></legend>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="no_sertifikat_nama">Pencarian Data</label>  
	  <div class="col-md-9">
	  <input id="pencarian" name="pencarian" type="text" placeholder="No IMB / Nama Bangunan" class="form-control input-md">
	  <span class="help-block"></span>  
	  </div>
	</div>
	
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="no_imb">No IMB</label>  
	  <div class="col-md-9">
	  <input id="no_imb_sementara" name="no_imb_sementara" type="text" placeholder="No IMB" class="form-control input-md" required="" disabled>
	  <input id="no_imb" name="no_imb" type="hidden" class="form-control input-md" >
	  <span class="help-block"></span>  
	  </div>
	</div>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="deskripsi_bangunan">Nama Bangunan</label>  
	  <div class="col-md-9">
	  <input id="deskripsi_bangunan_sementara" name="deskripsi_bangunan_sementara" type="text" placeholder="Nama Bangunan" class="form-control input-md" required="" disabled >
	  <input id="deskripsi_bangunan" name="deskripsi_bangunan" type="hidden" class="form-control input-md" >
	  <span class="help-block"></span>  
	  </div>
	</div>

<legend></legend>
	
	<div class="form-group">
	<label class="col-md-3 control-label" for="luas">Luas Ruangan</label>
		<div class="col-md-9">
		<input class="form-control input-md" type="text" name="luas" id="luas" placeholder="m2 (contoh: 15.5)" onkeypress='validate(event)' size="30" required /> 
		<span class="help-block"></span>
		</div>
	</div>
		
		
	<div class="form-group">
	<label class="col-md-3 control-label" for="deskripsi">Nama Ruangan</label>
		<div class="col-md-9">
		<textarea name="deskripsi" placeholder="Deskripsi" class="form-control" rows="3" required></textarea>         
		<span class="help-block"></span>
		</div>
	</div>
		
	
	<legend></legend>

	<div class="form-group">
		<label class="col-md-0 control-label" for="simpan"></label>
		<div class="col-md-9">
			<input type="submit" value="Simpan" id="simpan" class="btn btn-success"/>
			<input type="button" value="Batal" id="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>aset/c_ruangan'"/>
		</div>
	</div>

<br>
<?php echo form_close(); ?>
  
<script>	

  $(function() {
    var array = <?php  echo $json_array_nama; ?> ;
    $("#pencarian" ).autocomplete({
      source: array,
	  minLength: 1,
	  select: function(event, ui) {
		
		bits = ui.item.value.split(' | ')
		no_imb = bits[bits.length - 2]
		nama = bits[bits.length - 1]
			$("#no_imb").val(no_imb);
			$("#deskripsi_bangunan").val(nama);
			$("#no_imb_sementara").val(no_imb);
			$("#deskripsi_bangunan_sementara").val(nama);
        },
        change: function(event, ui) {
		
		bits = ui.item.value.split(' | ')
		no_imb = bits[bits.length - 2]
		nama = bits[bits.length - 1]
           	$("#no_imb").val(no_imb);
			$("#deskripsi_bangunan").val(nama);			
			$("#no_imb_sementara").val(no_imb);
			$("#deskripsi_bangunan_sementara").val(nama);
        }
    });
  });
 
  
</script>

<script>


function nav_active(){
	document.getElementById("a-ruangan").className = "collapsed active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});

</script>

