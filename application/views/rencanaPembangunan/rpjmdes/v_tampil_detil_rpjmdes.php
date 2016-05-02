<link href="<?=$this->config->item('base_url');?>css/flexigrid.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/jquery.pack.js"></script>
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/flexigrid.pack.js"></script>


<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>
<legend></legend>
<div class="alert alert-info" for="=">
Berikut adalah detil program RPJMDes <b><?= $program ?></b> pada periode <b><?= $periode ?></b> .<br>
Silahkan menambahkan detil program RPJMDes <b><?= $program ?></b>. 
</div>
<?php
echo $js_grid;
?>

<script type="text/javascript">
var _base_url = '<?= base_url() ?>';

function edit_rpjmdes_detail(id) {
  window.location = _base_url + 'rencanaPembangunan/c_rpjmdes_detail/edit/' + id;
}

function btn(com,grid,id)
{
	if (com=='Back')
    {
		var id_parent_rpjmdes = '<?= $rpjmdes->id_parent_rpjmdes ?>';
		var id_top_rpjmdes = '<?= $rpjmdes->id_top_rpjmdes ?>';
		
		if(id_parent_rpjmdes == '')
		{
			window.location = _base_url + 'rencanaPembangunan/c_rpjmdes';
		}
		else
		{
			window.location = _base_url + 'rencanaPembangunan/c_rpjmdes/show_detail_program/'+ id_top_rpjmdes;
		}
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
		var id_rpjmdes = '<?= $rpjmdes->id_rpjmdes ?>';
		
		window.location = _base_url + 'rencanaPembangunan/c_rpjmdes/add_detail_rpjmdes/' + id_rpjmdes;
    }	
	
	if (com=='Delete Selected Items')
        {
           if($('.trSelected',grid).length>0)
		   {
			   if(confirm('Hapus ' + $('.trSelected',grid).length + ' item?'))
			   {
		            var items = $('.trSelected',grid);
		            var itemlist ='';
		        	for(i=0;i<items.length;i++)
					{
						itemlist+= items[i].id.substr(3)+",";
					}
					$.ajax
					({
					   type: "POST",
					   url: "<?=site_url("rencanaPembangunan/c_rpjmdes/delete_detail/");?>",
					   data: "items="+itemlist,
					  success: function(data)
					  {
					   	$('#flex1').flexReload();
					  	alertify.success("Data berhasil dihapus !");
					   } ,
						error: function() 
						{
							alertify.error("Maaf, data yang akan dihapus masih digunakan !");
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

$(function(){
  
});
</script>


<table id="flex1" style="display:none"></table>



<script>
function nav_active(){
	
	document.getElementById("a-data-perencanaan").className = "collapsed active";
	document.getElementById("perencanaan").className = "collapsed active";
	
	document.getElementById("a-data-rpjmdes").className = "collapsed active";
	document.getElementById("rpjmdes").className = "collapsed active";

	var d = document.getElementById("nav-list_rpjmdes");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>