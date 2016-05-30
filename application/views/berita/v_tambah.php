<h1>Tambah Berita</h1>
<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>



<?php echo form_open('admin/c_berita/simpan_berita'); ?>
<legend></legend>

<div class="panel panel-success col-md-12">
<div class="panel-body">
<div class="col-md-12">
	<div class="form-group has-success">
		<label class="col-md-2 control-label" for="">Judul Berita*</label>
		<div class="col-md-10 col-sm-12 col-xs-12">
		<input class="form-control input-md"  type="text" name="judul" id="judul" placeholder="Judul Berita" required/>
		<span class="help-block"><?php echo form_error('judul', '<p class="field_error">', '</p>'); ?>
		</span>
		</div>
	</div>
	<div class="form-group has-success">
			<div class="image-editor">
			<label class="col-md-2 control-label" for="">Gambar Berita*</label>
				<div class="col-md-10">
					<div id="lihat">
						<div class="cropit-image-preview" ></div>
						<input type="range" class="cropit-image-zoom-input" style="width:692px">
						<input type="file" id="userfile" class="cropit-image-input custom" accept="image/*">
						<input type="hidden" name="image-data" class="hidden-image-data" />
						 <span class="help-block">
							<div align="left">Gambar harus bertipe .jpg</div>
						</span>
					</div>
				</div>
			</div>
		</div>
	<legend></legend>
	<div class="form-group has-success">
		<label class="col-md-2 control-label" for="">Isi Berita*</label>
		<div class="col-md-10">
			 <textarea class="form-control input-md textarea" id="some-textarea" placeholder="Tulis Berita" name="isi" rows="8" ></textarea>
		<span class="help-block"></span>
		</div>
	</div>

	<legend></legend>
	<div class="form-group has-success">
		<span class="help-block">
				<input type="submit" class="btn btn-success" value="Simpan" id="simpan"/>
				<input type="button" class="btn btn-danger" value="Batal" id="batal" onclick="location.href='<?= base_url() ?>admin/c_berita'"/>
		</span>
	</div>


</div>
</div>



<?php echo form_close(); ?>


<script src="<?php echo base_url(); ?>assetku/fronteditor/dist/bootstrap3-wysihtml5.all.min.js"></script>

<link rel="Stylesheet" type="text/css" href="<?php echo base_url(); ?>assetku/fronteditor/dist/bootstrap3-wysihtml5.css" />

<script src="<?php echo base_url(); ?>assetku/cropit/jquery.cropit.js"></script>
<style>
	/* Show load indicator when image is being loaded */
	.cropit-image-preview.cropit-image-loading .spinner {
	opacity: 1;
	}

	/* Show move cursor when image has been loaded */
	.cropit-image-preview.cropit-image-loaded {
	cursor: move;
	}

	/* Gray out zoom slider when the image cannot be zoomed */
	.cropit-image-zoom-input[disabled] {
	opacity: .2;
	}


  .cropit-image-preview {
	background-color: #f8f8f8;
	background-size: cover;
	border: 1px solid #ccc;
	border-radius: 3px;
	margin-top: 7px;
	width: 692px;
	height: 252px;
	cursor: move;
  }

  .cropit-image-background {
	opacity: .2;
	cursor: auto;
  }

  .image-size-label {
	margin-top: 10px;
  }

  input {
	display: block;
  }

 }
</style>

<script>
$(function() {

$('#some-textarea').wysihtml5({
  toolbar: {

    link: false, //Button to insert a link. Default true
    image: false, //Button to insert an image. Default true
  }
});

$('.image-editor').cropit({
  imageState: {
	src: '<?php echo site_url('uploads/defaultFotoPenduduk.jpg');?>'
  }
});

$('form').submit(function() {
	  // Move cropped image data to hidden input
	 var imageData = $('.image-editor').cropit('export', {
		  type: 'image/jpeg',
		  quality: 1,
		  originalSize: false
		});
	  $('.hidden-image-data').val(imageData);

	  // Prevent the form from actually submitting
	  return true;
	});
  });

	function nav_active(){
		document.getElementById("a-data-web").className = "collapsed active";
		var r = document.getElementById("pengelola_data_web");
		r.className = "collapsed";

		var d = document.getElementById("nav-berita");
		d.className = d.className + "active";
		}

// very simple to use!
$(document).ready(function() {
  nav_active();
  <?php $flashmessage = $this->session->flashdata('message');
		echo ! empty($flashmessage) ? 'alertify.success("'.$flashmessage.'")' : ''; ?>
});
</script>

<script>
function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#userfile').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#userfile").change(function(){
    readURL(this);
	{document.getElementById("lihat").style.display = "block";}
});
</script>
