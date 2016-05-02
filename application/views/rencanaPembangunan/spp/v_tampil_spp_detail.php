<link href="<?=$this->config->item('base_url');?>css/flexigrid.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/jquery.pack.js"></script>
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/flexigrid.pack.js"></script>

 
<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>
<legend></legend>
<div class="alert alert-success" for="=">
Berikut adalah <b>Detail SPP (Surat Permintaan Pembayaran)</b>, dari kegiatan RABDes <b><?= $kegiatan ?></b> .
</div>
<?php
echo $js_grid;
?>
<script type="text/javascript">
var _base_url = '<?= base_url() ?>';

function edit_spp_detail(id) {
  window.location = _base_url + 'rencanaPembangunan/c_spp/edit_spp_detail/' + id;
}

function add_spp_detail(id) {
  window.location = _base_url + 'rencanaPembangunan/c_spp/add_spp_detail/' + id;
}



function btn(com,grid,id)
{
	if (com=='Back')
    {
		window.location = _base_url + 'rencanaPembangunan/c_spp/';
    }
	
    if (com=='Select All')
    {
		$('.bDiv tbody tr',grid).addClass('trSelected');
    }

    if (com=='DeSelect All')
    {
		$('.bDiv tbody tr',grid).removeClass('trSelected');
    }
	
	if (com=='Add')
    {
		var id_spp = '<?= $spp->id_spp ?>';
		window.location = _base_url + 'rencanaPembangunan/c_spp/add_spp_detail/' +id_spp;
    }	
	
	if (com=='Delete Selected Items')
	{
	   if($('.trSelected',grid).length>0){
		   if(confirm('Hapus ' + $('.trSelected',grid).length + ' item?')){
			   var id_spp = '<?= $spp->id_spp ?>';
				var items = $('.trSelected',grid);
				var itemlist ='';
				for(i=0;i<items.length;i++){
					itemlist+= items[i].id.substr(3)+",";
				}
				$.ajax({
				   type: "POST",
				   url: "<?=site_url("rencanaPembangunan/c_spp/delete_spp_detail/");?>",
				   data: "items="+itemlist,
				  success: function(data){
					$('#flex_spp').flexReload();
					alertify.success("Data berhasil dihapus !");
					//setTimeout(function(){window.location.reload(1);},500);
				   },
					error: function() {
					alertify.error("Maaf, data yang akan dihapus masih digunakan !");
					//setTimeout(function(){window.location.reload(1);},1000);
					}
				});
			}
		}
		else 
		{
			return false;
		}
	}
}
</script>

<table id="flex_spp" style="display:none"></table>
<br>
<div id="tes" class="alert alert-info" for="=">
Total Rincian Permintaan Sekarang dari <b><?= $kegiatan ?>  </b> adalah  <b>Rp<?= $total ?> </b>,- 
</div>

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
</script>