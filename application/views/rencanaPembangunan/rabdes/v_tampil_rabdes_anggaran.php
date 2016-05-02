<link href="<?=$this->config->item('base_url');?>css/flexigrid.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/jquery.pack.js"></script>
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/flexigrid.pack.js"></script>

 
<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>
<legend></legend>
<div class="alert alert-success" for="=">
Berikut adalah Rincian Anggaran RABDes, dari kegiatan <b><?= $kegiatan ?></b> .
</div>
<?php
echo $js_grid;
?>
<script type="text/javascript">
var _base_url = '<?= base_url() ?>';

function edit_rabdes_anggaran(id) {
  window.location = _base_url + 'rencanaPembangunan/c_rabdes/edit_rabdes_anggaran/' + id;
}

function add_rabdes_anggaran(id) {
  window.location = _base_url + 'rencanaPembangunan/c_rabdes/add_rabdes_anggaran/' + id;
}

function btn(com,grid,id)
{
	if (com=='Back')
    {
		window.location = _base_url + 'rencanaPembangunan/c_rabdes/';
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
		var id_rabdes = '<?= $rabdes->id_rabdes ?>';
		window.location = _base_url + 'rencanaPembangunan/c_rabdes/add_rabdes_anggaran/' +id_rabdes;
    }	
	
	if (com=='Delete Selected Items')
	{
	   if($('.trSelected',grid).length>0){
		   if(confirm('Hapus ' + $('.trSelected',grid).length + ' item?')){
			   var id_rabdes = '<?= $rabdes->id_rabdes ?>';
				var items = $('.trSelected',grid);
				var itemlist ='';
				for(i=0;i<items.length;i++){
					itemlist+= items[i].id.substr(3)+",";
				}
				$.ajax({
				   type: "POST",
				   url: "<?=site_url("rencanaPembangunan/c_rabdes/delete_rabdes_anggaran/");?>",
				   data: "items="+itemlist,
				  success: function(data){
					$('#flex_rabdes').flexReload();
					alertify.success("Data berhasil dihapus !");
					setTimeout(function(){window.location.reload(1);},500);
				   },
					error: function() {
					alertify.error("Maaf, data yang akan dihapus masih digunakan !");
					setTimeout(function(){window.location.reload(1);},500);
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

<table id="flex_rabdes" style="display:none"></table>
<br>
<div id="tes" class="alert alert-info" for="=">
Total Rincian Anggaran dari <b><?= $kegiatan ?></b> adalah  <b>Rp <?= $total ?></b>,-
</div>
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
</script>