<h2>Rancangan RKP <?php if($result_rkp==null)echo "Belum Tersedia"; ?></h2>
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
           $swakelola=$row->swakelola;
           $krjantardesa=$row->kerjasama_antar_desa;
           $krjapihakketiga=$row->kerjasama_pihak_ketiga;
           if($swakelola==null||$swakelola==0)$swakelola="";else $swakelola="V" ;
           if($krjantardesa==null||$krjantardesa==0)$krjantardesa="";else $krjantardesa="V" ;
           if($krjapihakketiga==null||$krjapihakketiga==0)$krjapihakketiga="";else $krjapihakketiga="V" ;
           foreach ($rows as $row) {
               echo'
               <tr>
                <td>'.$row->bidang .'</td>
                <td>'.$row->jenis_kegiatan .'</td>
                <td>'.$row->lokasi .'</td>
                <td>'.$row->sasaran_manfaat .'</td>
                <td>'.$row->waktu_pelaksanaan .'</td>
                <td>'.rupiah_display($row->jumlah_biaya).'</td>
                <td>'.$swakelola.'</td>
                <td>'.$krjantardesa.'</td>
                <td>'.$krjapihakketiga .'</td>
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
