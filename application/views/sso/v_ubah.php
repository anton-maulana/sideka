<h3><?= $page_title ?></h3>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php echo form_open('admin/c_sso/update_sso'); ?>
<fieldset>
	<legend></legend>
	<div class="alert alert-info">
			Pengaturan <b>Single Sign On</b> digunakan untuk mengintegrasikan halaman <i>Front-End</i> SIDeKa dengan Aplikasi lain yang terdaftar pada program <b>Desa Broadband</b>.
			Anda harus mendaftarkan aplikasi pada halaman <a href="https://aplikasi.klikindonesia.or.id/">https://aplikasi.klikindonesia.or.id/</a> untuk mendapatkan pengaturan <i>Application ID</i> dan <i>Token</i>.
						
		</div>	
	<!-- Text input-->
	<div class="form-group">
		<label  class="col-md-3 control-label" for="app_id">Application ID</label>
		<div class="col-md-9">
			<input  value="<?= $sso->app_id?>" id="app_id" name="app_id" type="text" 
			placeholder="App ID" class="form-control input-md">
			<span class="help-block"><?php echo form_error('app_id', '<p class="field_error">','</p>')?></span>  
		</div>
	</div>
	<div class="form-group">
		<label  class="col-md-3 control-label" for="token">Token</label>
		<div class="col-md-9">
			<input  value="<?= $sso->token_app?>" id="token_app" name="token_app" type="text" 
			placeholder="Token" class="form-control input-md">
			<span class="help-block"><?php echo form_error('token_app', '<p class="field_error">','</p>')?></span>  
		</div>
	</div>
	<legend></legend>
</fieldset>
<p>
<input type="submit" value="Simpan" id="simpan" class="btn btn-success"/>
<input type="button" value="Batal" id="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>admin/c_admin'"/>
</p>



<script>
function nav_active(){
	document.getElementById("a-sso").className = "collapsed active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
   <?php $flashmessage = $this->session->flashdata('message');
	echo ! empty($flashmessage) ? 'alertify.success("'.$flashmessage.'")' : ''; ?>
});
</script>