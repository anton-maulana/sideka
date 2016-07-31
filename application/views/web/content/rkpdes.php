<<<<<<< HEAD
<h2>Rancangan RKP </h2>
<?php if($result_rkp){ ?>
<form class="form-inline">
  <div class="form-group">
    <h3><p>Tahun Anggaran <?php echo $result_rkp[0]->rkp_tahun ?></p></h3>

  </div>
  <div class="form-group pull-right">
    <label>
      Download
    </label>
    <button type="button" class="btn btn-success btn-sm "  title="Download Excell" id="downloadExcell">
      <a href="<?php echo site_url('web/c_rkpdes/export_excel/'.$result_rkp[0]->id_m_rancangan_rpjm_desa);?> "><i class="fa fa-file-excel-o"></i></a>
    </button>
  </div>
</form>
<?php } ?>

<legend></legend>
<div class="table-responsive" id="tableDetail">
      <table class="table table-bordered">
        <thead>
          <tr >
            <th rowspan="2"><p class="text-center">Bidang</p></th>
            <th rowspan="2"><p class="text-center">Jenis Kegiatan</p></th>
            <th rowspan="2"><p class="text-center">Lokasi</p></th>
            <th rowspan="2"><p class="text-center">Sasaran / Manfaat</p></th>
            <th rowspan="2"><p class="text-center">Waktu Pelaksanaan</p></th>
            <th rowspan="2"><p class="text-center">Jumlah biaya</p></th>
            <th colspan="3"><p class="text-center">Pola pelaksanaan</p></th>
            <th rowspan="2"><p class="text-center">Rencana Pelaksanaan kegiatan</p></th>
          </tr>
          <tr>
            <th>Swakelola</th>
            <th>Kerjasama Antar Desa</th>
            <th>Kerjasama Pihak Ketiga</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if($result_rkp){
           $rows=$result_rkp;
           $bidangBefore="";
           foreach ($rows as $row) {
               echo'
               <tr>
                <td>'.$row->bidang .'</td>
                <td>'.$row->jenis_kegiatan .'</td>
                <td>'.$row->lokasi .'</td>
                <td>'.$row->sasaran_manfaat .'</td>
                <td>'.$row->waktu_pelaksanaan .'</td>
                <td>'.rupiah_display($row->jumlah_biaya).'</td>
                <td>'.$row->swakelola .'</td>
                <td>'.$row->kerjasama_antar_desa.'</td>
                <td>'.$row->kerjasama_pihak_ketiga.'</td>
                <td>'.$row->rencana_pelaksanaan_kegiatan.'</td>
               </tr>'
               ;}
             }
          ?>
        </tbody>
      </table>
    </div>


<script>
  <?php if ($result_rkp) {
    ?>
    $('#tableDetail').show();
    $('#anggaran').show();
    $('#downloadExcell').show();
    <?php
  } else {
    ?>
    $('#tableDetail').hide();
    $('#anggaran').hide();
    $('#downloadExcell').hide();
    <?php
  }
  ?>
</script>

<style>
.table-responsive {
    width: 100%;
    margin-bottom: 15px;
    overflow-y: hidden;
    -ms-overflow-style: -ms-autohiding-scrollbar;
    border: 1px solid #ddd;
  }
  .table-responsive > .table {
    margin-bottom: 0;
  }
  .table-responsive > .table > thead > tr > th,
  .table-responsive > .table > tbody > tr > th,
  .table-responsive > .table > tfoot > tr > th,
  .table-responsive > .table > thead > tr > td,
  .table-responsive > .table > tbody > tr > td,
  .table-responsive > .table > tfoot > tr > td {
    white-space: nowrap;
  }
  .table-responsive > .table-bordered {
    border: 0;
  }
  .table-responsive > .table-bordered > thead > tr > th:first-child,
  .table-responsive > .table-bordered > tbody > tr > th:first-child,
  .table-responsive > .table-bordered > tfoot > tr > th:first-child,
  .table-responsive > .table-bordered > thead > tr > td:first-child,
  .table-responsive > .table-bordered > tbody > tr > td:first-child,
  .table-responsive > .table-bordered > tfoot > tr > td:first-child {
    border-left: 0;
  }
  .table-responsive > .table-bordered > thead > tr > th:last-child,
  .table-responsive > .table-bordered > tbody > tr > th:last-child,
  .table-responsive > .table-bordered > tfoot > tr > th:last-child,
  .table-responsive > .table-bordered > thead > tr > td:last-child,
  .table-responsive > .table-bordered > tbody > tr > td:last-child,
  .table-responsive > .table-bordered > tfoot > tr > td:last-child {
    border-right: 0;
  }
  .table-responsive > .table-bordered > tbody > tr:last-child > th,
  .table-responsive > .table-bordered > tfoot > tr:last-child > th,
  .table-responsive > .table-bordered > tbody > tr:last-child > td,
  .table-responsive > .table-bordered > tfoot > tr:last-child > td {
    border-bottom: 0;
  }
  </style>
=======
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
        window.location = _base_url + 'web/c_rkpdes/detail/' + id;
    }
function btn(com,grid)
{
    

}

$(function(){
  
});
</script>
<table id="flex1" style="display:none"></table>
>>>>>>> f116a20c8be190662fb8a357c43f3c153e02482b
