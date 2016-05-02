<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>
<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>
<?php 
 echo form_open('rencanaPembangunan/c_spp/simpan_spp_detail/'); ?>
<legend></legend>
<!--
<div class="alert alert-warning" for="=">
Mohon untuk diperhatikan, bagi isian data yang diberikan tanda <b><label style="color:red;">( * ) </label> wajib diisi.</b><br>
</div>
-->
<input  type="hidden" name="id_spp" id="id_spp" value="<?= $spp->id_spp ?>" /> 
<!--<legend></legend>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="id_rabdes">Pilih RABDes Anggaran	<label style="color:red;"> *</label></label>
		<div class="col-md-9">
		<span class="help-block">
			<div class="button-group">
				<button type="button" class="btn btn-default btn-md dropdown-toggle" data-toggle="dropdown">
				- Pilih RABDes Anggaran - <span class="caret"></span>
				</button>
				
				<ul class="dropdown-menu">
				<?php
				$i=0;
				foreach($rabdes_anggaran as $rows)
				{
					$i++;
					$id_rabdes_anggaran = $rows->id_rabdes_anggaran;
					$uraian = $rows->uraian;
				?>
					  <li>
					  <a href="#" class="small" data-value="<?php echo $id_rabdes_anggaran;?>" tabIndex="-1">
					  <input name="" id="" type="checkbox" class="<?php echo $uraian;?>"/>&nbsp;<?php echo $uraian;?>
					  </a>
					  </li>
				<?php
				}
				?>
				</ul>
			</div>
		</span>
		</div>
	</div>
-->
<div class="table-responsive">
  <table border="0" class="table table-striped table-hover">
    <tr>
		<!--<td style="text-align:center;">ID</td>-->
		<td style="text-align:center;">AKSI</td>
		<td style="text-align:center;">URAIAN</td>
		<td style="text-align:center;">PAGU ANGGARAN</td>
		<!--<td style="text-align:center;">PENCAIRAN S.D. YG LALU</td>-->
		<td style="text-align:center;">PERMINTAAN SEKARANG</td>
		<td style="text-align:center;">JUMLAH SAAT INI</td>
		<td style="text-align:center;">SISA DANA</td>
		
	</tr>
	<tr>
		<td style="text-align:center;">1</td>
		<td style="text-align:center;">2</td>
		<td style="text-align:center;">3</td>
		<td style="text-align:center;">4</td>
		<td style="text-align:center;">5</td>
		<td style="text-align:center;">6</td>
		<!--
		<td style="text-align:center;">7</td>
		<td style="text-align:center;">8</td>
		-->
	</tr>
	
	
	<?php
	$i=0;
	foreach($rabdes_anggaran as $rows)
	{
		$i++;
		$id_rabdes_anggaran = $rows->id_rabdes_anggaran;
		$uraian = $rows->uraian;
		$pagu_anggaran = $rows->jumlah;
		$jumlah_saat_ini = $rows->jumlah_saat_ini;
		$sisa_dana = $rows->sisa_dana;
	?>
	<tr>
		
		<input style="text-align:center; width:50px;"	class="form-control input-sm" type="hidden" name="id_rabdes_anggaran<?php echo $id_rabdes_anggaran;?>" id="id<?php echo $id_rabdes_anggaran;?>" value="<?php echo $id_rabdes_anggaran;?> "/> 
		
		<td style="text-align:center;">
		<input name="cekbox<?php echo $id_rabdes_anggaran;?>" id="ck<?php echo $id_rabdes_anggaran;?>" type="checkbox" onclick="cek('<?php echo $id_rabdes_anggaran;?>');" />
		</td>
		<td style="text-align:center;"><?php echo $uraian;?></td>
		<td style="text-align:center;">
			<input style="text-align:right;" disabled="disabled" class="form-control input-sm" type="text" name="pagu_anggaran<?php echo $id_rabdes_anggaran;?>" id="pa<?php echo $id_rabdes_anggaran;?>" value="<?php echo $pagu_anggaran;?> "/>
		</td>
		<!--
		<td style="text-align:center;">0</td>
		-->
		<td style="text-align:center;">
			<input style="text-align:right;" disabled="disabled" class="form-control input-sm" type="text" name="permintaan_sekarang<?php echo $id_rabdes_anggaran;?>" id="ps<?php echo $id_rabdes_anggaran;?>" placeholder="Permintaan Sekarang"
			onkeypress='return event.charCode >= 48 && event.charCode <= 57' /> 
		</td>
		<td style="text-align:center;">
			<input style="text-align:right;" disabled="disabled" class="form-control input-sm" type="text" name="jumlah_saat_ini" id="jsi<?php echo $id_rabdes_anggaran;?>" placeholder="Jumlah Saat Ini"/> 
		</td>
		<td style="text-align:center;">
			<input style="text-align:right;" readonly="readonly" class="form-control input-sm" type="text" name="sisa_dana<?php echo $id_rabdes_anggaran;?>" id="sd<?php echo $id_rabdes_anggaran;?>" value="<?php echo $sisa_dana;?>" placeholder="Sisa Dana"/> 
			<input style="text-align:right;" readonly="readonly" class="form-control input-sm" type="hidden" name="sisa_dana1<?php echo $id_rabdes_anggaran;?>" id="sd1<?php echo $id_rabdes_anggaran;?>" value="<?php echo $sisa_dana;?>" placeholder="Sisa Dana"/> 
		</td>
		
	</tr>
	<?php
	}
	?>
  </table>
</div>

	
<p>
<legend></legend>
 <input  type="hidden" name="id_rabdes_anggaran" id="id_rabdes_anggaran" value="" />
	<input type="submit" value="Simpan" class="btn btn-success" id="simpan"/>
	<!--
	<input type="button" value="Selanjutnya" class="btn btn-info" id="selanjutnya" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_spp/add2_spp_detail/<?= $spp->id_spp ?>'"/>
	-->
	<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_spp/show_spp_detail/<?= $spp->id_spp ?>'"/>
</p>

<?php echo form_close(); ?>

<script>

function nav_active(){
	
	document.getElementById("a-data-anggaran").className = "collapsed active";
	document.getElementById("anggaran").className = "collapsed active";
	
	var d = document.getElementById("nav-spp");
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
	
function hai() {
    var list = document.getElementById("apa");
    list.removeChild(list.childNodes[0]);
	
	return true;
}


function cek(id){
	var str = $("form").serializeArray();
	//var tmp = JSON.stringify($("form").nestable('serialize'));
	//console.log(str);
	
	//console.log(id);
	var formidrabdesanggaran = document.getElementById('id'+id);
	var formpermintaan = document.getElementById('ps'+id);
	var formpagu = document.getElementById('pa'+id);
	var formjumlah = document.getElementById('jsi'+id);
	var formsisa = document.getElementById('sd'+id);
	var formsisa1 = document.getElementById('sd1'+id);
	if(formpermintaan.disabled == false)
	{
		formpermintaan.disabled = true;
		$(formpermintaan).keyup(function(){
			formjumlah.value = formpermintaan.value;
			formsisa.value = formpagu.value - formpermintaan.value;
			if(parseFloat(formpermintaan.value) >= parseFloat(formpagu.value))
			{
				formpermintaan.value = "";
				formjumlah.value = "";
				formsisa.value = formpagu.value;
				alertify.error("Inputan Permintaan tidak boleh lebih dari Sisa Dana !");	
			}
		});
	}
	else if(formpermintaan.disabled == true)
	{	
		formpermintaan.disabled = false;
		if(formsisa.value == "")
		{
			$(formpermintaan).keyup(function(){
			formjumlah.value = formpermintaan.value;
			formsisa.value = formpagu.value - formpermintaan.value;
			if(parseFloat(formpermintaan.value) >= parseFloat(formpagu.value))
			{
				formpermintaan.value = "";
				formjumlah.value = "";
				formsisa.value = formpagu.value;
				alertify.error("Inputan Permintaan tidak boleh lebih dari Sisa Dana !");	
			}
			});
		}
		if(!formsisa.value == "")
		{
			$(formpermintaan).keyup(function(){
			formjumlah.value = formpermintaan.value;
			formsisa.value = formsisa1.value - formpermintaan.value;
			if(parseFloat(formpermintaan.value) >= parseFloat(formsisa.value))
			{
				formpermintaan.value = "";
				formjumlah.value = "";
				formsisa.value = formsisa1.value;
				alertify.error("Inputan Permintaan tidak boleh lebih dari Sisa Dana !");	
			}
			});
		}
		
	}
}

$('#submit').click(function() {
  //var tmp = JSON.stringify($('.myforma').nestable('serialize'));
  var tmp = $("form").serializeArray();
  // tmp value: [{"id":21,"children":[{"id":196},{"id":195},{"id":49},{"id":194}]},{"id":29,"children":[{"id":184},{"id":152}]},...]
  $.ajax({
    type: 'POST',
    url: "<?php echo site_url('rencanaPembangunan/c_spp/simpan_spp_detail/')?>",
    data: {'categories': tmp},
    success: function(msg) {
      alert(msg);
    }
  });
});

/* var options = [];
//var itu ;
var $id = $("#id_rabdes_anggaran");	
//var $apa = $("#apa");	
$( '.dropdown-menu a' ).on( 'click', function( event ) {
	var $target = $( event.currentTarget ),
	val = $target.attr( 'data-value' ),
	$inp = $target.find( 'input' ),
	idx;
   if ( ( idx = options.indexOf( val ) ) > -1 ) 
   {
		options.splice( idx, 1 );
		setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
   }
   else 
   {	
		//options.push( '"'+val+'"' ); 
		options.push( val );
		setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
   }
   $( event.target ).blur();
   console.log( options );
   $id.val('['+options+']' );
   //$apa.html(itu);
   return false;
}); */
</script>