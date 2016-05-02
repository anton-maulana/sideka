<link href="<?=$this->config->item('base_url');?>css/flexigrid.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/jquery.pack.js"></script>
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/flexigrid.pack.js"></script>

 
<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>
<legend></legend>
<div class="alert alert-success" for="=">
Berikut adalah detil kode rekening <b><?= $kode_rekening ?></b> dengan deskripsi <b><?= $deskripsi ?></b>. 
Anda diperkenankan untuk menambahkan sub kode rekening  <b><?= $kode_rekening ?></b> dengan deskripsi <b><?= $deskripsi ?></b>yang sudah anda pilih.<br>
</div>
<?php
echo $js_grid;
?>
<script type="text/javascript">
var _base_url = '<?= base_url() ?>';

function edit_coa(id) {
  window.location = _base_url + 'rencanaPembangunan/c_coa/edit/' + id;
}

function add_sub_coa(id) {
  window.location = _base_url + 'rencanaPembangunan/c_coa/add_sub_coa/' + id;
}

function show_tree_coa(id) {
  window.location = _base_url + 'rencanaPembangunan/c_coa/show_tree_coa/' + id;
}

function btn(com,grid)
{
	if (com=='Back')
    {
		window.location = _base_url + 'rencanaPembangunan/c_coa/';
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
		window.location = _base_url + 'rencanaPembangunan/c_coa/add';
    }	
	
	if (com=='Delete Selected Items')
        {
           if($('.trSelected',grid).length>0){
			   if(confirm('Hapus ' + $('.trSelected',grid).length + ' item?')){
		            var items = $('.trSelected',grid);
		            var itemlist ='';
		        	for(i=0;i<items.length;i++){
						itemlist+= items[i].id.substr(3)+",";
					}
					$.ajax({
					   type: "POST",
					   url: "<?=site_url("rencanaPembangunan/c_coa/delete_sub/");?>",
					   data: "items="+itemlist,
					  success: function(data){
					   	$('#flex_coa').flexReload();
					  	alertify.success("Data berhasil dihapus !");
					   } ,
						error: function() {
							alertify.error("Maaf, data yang akan dihapus masih digunakan !");
						}
					});
				}
			} else {
				return false;
			}
        }
}

$(function(){
  
});

</script>

<table id="flex_coa" style="display:none"></table>

<script>
function nav_active(){
	
	document.getElementById("a-data-pustaka_per").className = "collapsed active";
	
	document.getElementById("pustaka_per").className = "collapsed";

	var d = document.getElementById("nav-coa");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>