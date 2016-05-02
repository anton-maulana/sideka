<link href="<?=$this->config->item('base_url');?>css/flexigrid.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/jquery.pack.js"></script>
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/flexigrid.pack.js"></script>


<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>
<legend></legend>
<?php
echo $js_grid;
?>

<script type="text/javascript">
var _base_url = '<?= base_url() ?>';

function edit_lpj(id) {
  window.location = _base_url + 'rencanaPembangunan/c_lpj/edit/' + id;
}

function cetak_lpj(id) {
  $("#MyModalBody").html('<iframe src="<?php echo base_url();?>rencanaPembangunan/c_lpj/cetak_lpj/'+id+'" width="100%" height="450" frameborder="no"></iframe>');
}

function btn(com,grid)
{
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
		window.location = _base_url + 'rencanaPembangunan/c_lpj/add';
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
					   url: "<?=site_url("rencanaPembangunan/c_lpj/delete/");?>",
					   data: "items="+itemlist,
					  success: function(data){
					   	$('#flex1').flexReload();
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


<table id="flex1" style="display:none"></table>

<!-- Modal -->
<div class="modal fade" id="dialog-print" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 90%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel" ><span class="fa fa-print"></span>&nbsp;CETAK LPJ</h4>
		<h5 class="modal-title" id="myModalLabel" >&nbsp;Laporan Penanggungjawaban</h5>
	
      </div>
      <div class="modal-body" id="MyModalBody" >
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-times"></span> Tutup</button>
        </div>
    </div>
  </div>
</div>
<!-- akhir kode modal dialog -->

<script>
function nav_active(){
	
	document.getElementById("a-data-anggaran").className = "collapsed active";
	document.getElementById("anggaran").className = "collapsed active";
	
	var d = document.getElementById("nav-lpj");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>