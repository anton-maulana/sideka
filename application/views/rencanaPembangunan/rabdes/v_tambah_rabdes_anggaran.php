<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>
<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>
		
<?php echo form_open('rencanaPembangunan/c_rabdes/simpan_rabdes_anggaran/'); ?>
<legend></legend>
<div class="alert alert-warning" for="=">
Mohon untuk diperhatikan, bagi isian data yang diberikan tanda <b><label style="color:red;">( * ) </label> wajib diisi.</b><br>
</div>
<input  type="hidden" name="id_rabdes" id="id_rabdes" value="<?= $rabdes->id_rabdes ?>" /> 
<legend></legend>
	<div class="form-group">
		<label class="col-md-3 control-label" for="uraian"> Uraian Kegiatan <label style="color:red;"> *</label></label> 
		<div class="col-md-9">
			<span class="help-block">
				<input class="form-control input-md" type="text" name="uraian" id="uraian" placeholder="Uraian" /> 
			</span>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="volume"> Volume <label style="color:red;"> *</label></label> 
		<div class="col-md-9">
			<span class="help-block">
				<input class="form-control input-md" type="text" name="volume" id="volume" placeholder="Volume" 
				onkeypress='return event.charCode >= 48 && event.charCode <= 57' /> 
			</span>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="harga_satuan"> Harga Satuan <label style="color:red;"> *</label></label> 
		<div class="col-md-9">
			<span class="help-block">
			<div class="input-group">
				<span class="input-group-addon">
					<span class="fa">@&nbsp;</span>
				</span>
				<input class="form-control input-md" type="text" name="harga_satuan" id="harga_satuan" placeholder="Harga Satuan" 
				onkeypress='return event.charCode >= 48 && event.charCode <= 57' /> 
			</div>
			</span>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="jumlah"> Jumlah <label style="color:red;"> *</label></label> 
		<div class="col-md-9">
			<span class="help-block">
			<div class="input-group">
				<span class="input-group-addon">
					<span class="fa">Rp&nbsp;</span>
				</span>
				<input placeholder="( Volume  x  Harga Satuan )" value="" class="form-control input-md" type="text" name="jumlah" id="jumlah"  readonly/>
			</div>
				
			</span>
		</div>
	</div>
	
<p>
<legend></legend>

	<input type="submit" value="Simpan" class="btn btn-success" id="simpan"/>
	<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_rabdes/show_rabdes_anggaran/<?= $rabdes->id_rabdes ?>'"/>
</p>

<?php echo form_close(); ?>


<script>
function nav_active(){
	
	document.getElementById("a-data-anggaran").className = "collapsed active";
	document.getElementById("anggaran").className = "collapsed active";
	
	var d = document.getElementById("nav-rabdes");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});

$(document).ready(function() {
    $("#txtboxToFilter").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
             // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});
	

var $jumlah = $("#jumlah");	
$("#volume").keyup(function() {
    var value = parseFloat($("#volume").val());
    var value2 = parseFloat($("#harga_satuan").val());
    $jumlah.val(value2 * value);
});	
	
$("#harga_satuan").keyup(function() {
    var value = parseFloat($("#volume").val());
    var value2 = parseFloat($("#harga_satuan").val());
    $jumlah.val(value * value2);
});	


</script>