<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>
<legend></legend>
<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>
		
<?php echo form_open('rencanaPembangunan/c_bidang/simpan_sub_bidang/'); ?>

	<input type="hidden" name="id_bidang" id="id_bidang" value="<?= $bidang->id_bidang ?>" size="20" />
	<input type="hidden" name="id_parent_bidang" id="id_parent_bidang" value="<?= $bidang->id_parent_bidang ?>" size="20" />
	<input type="hidden" name="id_top_bidang" id="id_top_bidang" value="<?= $bidang->id_top_bidang ?>" size="20" />
	<input type="hidden" name="level" id="level" value="<?= $bidang->level ?>" size="20" />

	<div class="form-group">
    	<label class="col-md-2 control-label" for="kode">Kode</label> 
        <div class="col-md-4">
        <span class="help-block">
         <input class="form-control input-md" type="text" name="kode" id="kode" value="<?= $bidang->kode_bidang ?>" size="25" disabled="true"/> 
		</span>
		</div>
	</div>
	
	
	
	
	<div class="form-group">
    	<label class="col-md-2 control-label" for="deskripsi">Deskripsi</label> 
        <div class="col-md-4">
        <span class="help-block">
         <input class="form-control input-md" type="text" name="deskripsi" id="deskripsi" value="<?= $bidang->deskripsi ?>" size="25" disabled="true"/> 
		</span>
		</div>
	</div>
	<legend></legend>
	<div class="form-group">
    	<label class="col-md-2 control-label" for="sub_kode"> Sub Kode*</label> 
        <div class="col-md-4">
        <span class="help-block">
         <input class="form-control input-md" type="text" name="sub_kode" id="sub_kode" value="<?= $bidang->kode_bidang.'.' ?>"size="25"/> 
		</span>
		</div>
	</div>	
	
	<div class="form-group">
    	<label class="col-md-2 control-label" for="sub_deskripsi"> Sub Deskripsi*</label> 
        <div class="col-md-4">
        <span class="help-block">
         <input class="form-control input-md" type="text" name="sub_deskripsi" id="sub_deskripsi" size="25" /> 
		</span>
		</div>
	</div>
	
	<legend></legend>
	
	<div class="form-group">
		<label class="col-md-2 control-label" for="tgl_pindah_keluar">Kode </label>
			<div class="col-md-4">
				<span class="help-block">
				<div class="input-group">
					<input type="text" class="form-control"  name="tgl_pindah_keluar" id="tgl_pindah_keluar" value="<?= $bidang->kode_bidang ?>" placeholder="B"/>
					<span class="input-group-addon">
						<span class="">.</span>
					</span>
					<input type="text" class="form-control"  name="tgl_pindah_keluar" id="tgl_pindah_keluar" placeholder="U"/>
					<span class="input-group-addon">
						<span class="">.</span>
					</span>
					<input type="text" class="form-control"  name="tgl_pindah_keluar" id="tgl_pindah_keluar" placeholder="P"/>
					<span class="input-group-addon">
						<span class="">.</span>
					</span>
					<input type="text" class="form-control"  name="tgl_pindah_keluar" id="tgl_pindah_keluar" placeholder="K"/>
				</div>
				<b style="font-size:12px;">B = Bidang ; U = Urusan ; P = Program ; K = Kegiatan;</b>
				</span>
			</div>		
	</div>

<p>
	<legend></legend>
	<input type="submit" value="Simpan" class="btn btn-success" id="simpan"/>
	<?php 
	if(!$bidang->id_top_bidang == null)
	{
	?>
		<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_bidang/show_detail_bidang/<?= $bidang->id_top_bidang; ?>'"/>
	<?php
	}
	else
	{
	?>
		<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_bidang/show_detail_bidang/<?= $bidang->id_bidang; ?>'"/>
	<?php
	}
	?>
</p>

<?php echo form_close(); ?>
<script>
function nav_active(){
	
	document.getElementById("a-data-pustaka_per").className = "collapsed active";
	document.getElementById("pustaka_per").className = "collapsed active";

	var d = document.getElementById("nav-bidang");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>