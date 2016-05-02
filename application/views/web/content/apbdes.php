<?php
$attention_message = isset($attention_message) && $attention_message ? $attention_message : FALSE;
$id_m_rancangan_rpjm_desa = isset($id_m_rancangan_rpjm_desa) && $id_m_rancangan_rpjm_desa ? $id_m_rancangan_rpjm_desa : 0;
?>
<link href="<?=$this->config->item('base_url');?>css/flexigrid.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/jquery.pack.js"></script>
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/flexigrid.pack.js"></script>


<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>
<?php
echo $js_grid;
?>

<script type="text/javascript">
var _base_url = '<?= base_url() ?>';

function show_detail_program(id) {
        window.location = _base_url + 'web/c_apbdes/detail/' + id;
    }
function btn(com,grid)
{
    

}

$(function(){
  
});
</script>


<table id="flex1" style="display:none"></table>



<script>
function nav_active(){
	
	document.getElementById("navbar").className = "";
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>