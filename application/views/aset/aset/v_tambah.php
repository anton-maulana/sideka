<div class="col-md-9">
<h3><?= $page_title ?></h3>
</div>
<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php
$attributes = array('name' => 'myform');
echo form_open_multipart('aset/c_aset/simpan_aset', $attributes); 
?>
<!-- Form Name -->
	<legend></legend>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="no_sertifikat_nama">Pencarian Data</label>  
	  <div class="col-md-9">
	  <input id="pencarian" name="pencarian" type="text" placeholder="Nama Ruangan / Nama Bangunan" class="form-control input-md">
	  <span class="help-block"></span>  
	  </div>
	</div>
	
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="nama_ruangan">Nama Ruangan</label>  
	  <div class="col-md-9">
	  <input id="nama_ruangan_sementara" name="nama_ruangan_sementara" type="text" placeholder="Nama Ruangan" class="form-control input-md" required="" disabled>
	  <input id="nama_ruangan" name="nama_ruangan" type="hidden" class="form-control input-md" >
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
	<label class="col-md-3 control-label" for="nama">Nama</label>
		<div class="col-md-9">
		<input class="form-control input-md" type="text" name="nama" placeholder="Nama" id="nama" size="30" required />           
		<span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-3 control-label" for="merk">Merk</label>
		<div class="col-md-9">
		<input class="form-control input-md" type="text" name="merk" placeholder="Merk" id="merk" size="30" required />           
		<span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="tgl_beli">Tanggal Beli</label> 
        
        <div class="col-md-9">
			<a href="javascript:NewCssCal('ttl','ddmmyyyy')">
			<div class="input-group">
				 <span class="input-group-addon">
					<span class="fa fa-table"></span>
				</span>
				<input class="form-control input-md" type="text" name="tgl_beli" id="ttl" size="20" readonly="readonly" placeholder="Tgl-Bln-Thn"/>						
			</div>
			<span class="help-block"></span>	
			</a>		
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="id_kategori_aset">Kategori </label>
        <div class="col-md-9">         
         <?php $id = 'id="id_kategori_aset" class="form-control input-md" required';
				echo form_dropdown('id_kategori_aset',$kategori,'',$id)?>
		 <span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-3 control-label" for="id_kepemilikan_aset">Kepemilikan </label>
        <div class="col-md-9">         
         <?php $id = 'id="id_kepemilikan_aset" class="form-control input-md" required';
				echo form_dropdown('id_kepemilikan_aset',$kepemilikan,'',$id)?>
		 <span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-3 control-label" for="id_asal_aset">Asal Aset </label>
        <div class="col-md-9">         
         <?php $id = 'id="id_asal_aset" class="form-control input-md" required';
				echo form_dropdown('id_asal_aset',$asal,'',$id)?>
		 <span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">	
	 	<label class="col-md-3 control-label" for="ketersediaan">Ketersediaan</label>
        <div class="col-md-3">
        <div class="radio">
		<?php echo form_radio('ketersediaan', 'Ya', TRUE); ?> Ya
		</div>
		<div class="radio">
		<?php echo form_radio('ketersediaan', 'Tidak', FALSE); ?> Tidak
		</div>
		</div>
	</div>
	
	<div class="form-group">	
	 	<label class="col-md-1 control-label" for="kondisi">Kondisi</label>
        <div class="col-md-3">
        <div class="radio">
		<?php echo form_radio('kondisi', 'Baik', TRUE); ?> Baik
		</div>
		<div class="radio">
		<?php echo form_radio('kondisi', 'Tidak Baik', FALSE); ?> Tidak Baik
		</div>
		</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-3 control-label" for="spesifikasi">Spesifikasi</label>
		<div class="col-md-9">
		<textarea name="spesifikasi" placeholder="Spesifikasi" class="form-control" rows="3"></textarea>         
		<span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-3 control-label" for="keterangan">Keterangan</label>
		<div class="col-md-9">
		<textarea name="keterangan" placeholder="contoh : (masa garansi) / (serial number) / (tgl expired)" class="form-control" rows="3" ></textarea>         
		<span class="help-block"></span>
		</div>
	</div>
	
	
	
	<legend></legend>

	<div class="form-group">
		<label class="col-md-0 control-label" for="simpan"></label>
		<div class="col-md-9">
			<input type="submit" value="Simpan" id="simpan" class="btn btn-success"/>
			<input type="button" value="Batal" id="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>aset/c_aset'"/>
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
		nama_bangunan = bits[bits.length - 1]
		nama_ruangan = bits[bits.length - 2]
			$("#nama_ruangan").val(nama_ruangan);
			$("#deskripsi_bangunan").val(nama_bangunan);
			$("#nama_ruangan_sementara").val(nama_ruangan);
			$("#deskripsi_bangunan_sementara").val(nama_bangunan);
        },
        change: function(event, ui) {
		
		bits = ui.item.value.split(' | ')
		nama_bangunan = bits[bits.length - 1]
		nama_ruangan = bits[bits.length - 2]
			$("#nama_ruangan").val(nama_ruangan);
			$("#deskripsi_bangunan").val(nama_bangunan);
			$("#nama_ruangan_sementara").val(nama_ruangan);
			$("#deskripsi_bangunan_sementara").val(nama_bangunan);
        }
    });
  });
 
  
</script>

<script>


function nav_active(){
	document.getElementById("a-data-aset").className = "collapsed active";
	
	document.getElementById("aset").className = "collapsed";

	var d = document.getElementById("nav-aset");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});

</script>

