<?php
  $post_data = isset($post_data) && !empty($post_data) && $post_data ? $post_data : FALSE;
?>
<h2>Rancangan RPJM</h2>
<h3>Rencana Pembangunan Jangka Menengah</h3>
<legend></legend>

<div class="form-group">
    <label class="col-md-2 control-label" for="tahun_anggaran"> Pilih Tahun Anggaran</label>
    <div class="col-md-2">
        <input type="hidden" id="anggaran" name="anggaran" value="" />
        <select  class="form-control inputsm" id="tahunAnggaran" name="tahunAnggaran"  aria-describedby="hlpBlock3">
            <option value="">Pilih Anggaran</option>
            <?php foreach ($master_rpjm as $anggaran): ?>
                <option value="<?php echo $anggaran->tahun_anggaran; ?>" <?php echo $post_data? "selected=\"selected\"" : ""; ?>><?php echo ucwords(strtolower($anggaran->tahun_anggaran)); ?></option>
            <?php endforeach; var_dump($post_data); ?>
        </select>
        <span id="hlpBlock3" class="help-block">
            <div id="tahunAnggaran" class="dvAlert"></div>
        </span>
    </div>

    <button type="button" class="btn btn-success btn-sm pull-right"  title="Download Excell">
      <i class="fa fa-file-excel-o"></i>
    </button>
</div>

<legend></legend>
<div class="table-responsive" >
      <table class="table table-bordered"  >
        <thead>
          <tr >
            <th colspan="3"><p class="text-center">Bidang / Jenis Kegiatan</p></th>
            <th rowspan="2"><p class="text-center">lokasi rt rw</p></th>
            <th rowspan="2"><p class="text-center">prakiraan volume</p></th>
            <th rowspan="2"><p class="text-center">Sasaran / Manfaat</p></th>
            <th rowspan="2"><p class="text-center">Waktu Pelaksanaan</p></th>
            <th colspan="2"><p class="text-center">Biaya Dan Sumber</p></th>
            <th colspan="3"><p class="text-center">Prakiraan Pola Pelaksanaan</p></th>
            <th rowspan="2"><p class="text-center">Rencana Pelaksanaan Kegiatan</p></th>

          </tr>
          <tr>
            <th>Bidang</th>
            <th>Sub Bidang</th>
            <th>Jenis Kegiatan</th>
            <th>Jumlah</th>
            <th>Sumber</th>
            <th>Swakelola</th>
            <th>Kerjasama Antar Desa</th>
            <th>Kerjasama Pihak Ketiga</th>
          </tr>
        </thead>
        <tbody>
          <?php

           $rows=$result;
           $bidangBefore="";
           $subBidBefore="";
           $sub_bidang="";
           foreach ($rows as $row) {

               $subject=$row->bidang;
               $search = "Bidang";
               $bidangTrimmed = str_replace($search, '', $subject);

               if($bidangBefore==$row->bidang)$bidangTrimmed="";
               $bidangBefore = $row->bidang;

               $thn_ke1=$row->tahun_pelaksanaan_1;
               $thn_ke2=$row->tahun_pelaksanaan_2;
               $thn_ke3=$row->tahun_pelaksanaan_3;
               $thn_ke4=$row->tahun_pelaksanaan_4;
               $thn_ke5=$row->tahun_pelaksanaan_5;
               $thn_ke6=$row->tahun_pelaksanaan_6;
               $swakelola=$row->swakelola;
               $krjantardesa=$row->kerjasama_antar_desa;
               $krjapihakketiga=$row->kerjasama_pihak_ketiga;
               if($thn_ke1==null||$thn_ke1==0)$thn_ke1="";else $thn_ke1="V" ;
               if($thn_ke2==null||$thn_ke2==0)$thn_ke2="";else $thn_ke2="V" ;
               if($thn_ke3==null||$thn_ke3==0)$thn_ke3="";else $thn_ke3="V" ;
               if($thn_ke4==null||$thn_ke4==0)$thn_ke4="";else $thn_ke4="V" ;
               if($thn_ke5==null||$thn_ke5==0)$thn_ke5="";else $thn_ke5="V" ;
               if($thn_ke6==null||$thn_ke6==0)$thn_ke6="";else $thn_ke6="V" ;
               if($swakelola==null||$swakelola==0)$swakelola="";else $swakelola="V" ;
               if($krjantardesa==null||$krjantardesa==0)$krjantardesa="";else $krjantardesa="V" ;
               if($krjapihakketiga==null||$krjapihakketiga==0)$krjapihakketiga="";else $krjapihakketiga="V" ;
               echo'
               <tr>
                <td>'.$bidangTrimmed .'</td>
                <td>'.$row->sub_bidang.'</td>
                <td>'.$row->jenis_kegiatan .'</td>
                <td>'.$row->lokasi_rt_rw .'</td>
                <td>'.$row->prakiraan_volume .'</td>
                <td>'.$row->sasaran_manfaat .'</td>
                <td>'.$thn_ke1.'</td>
                <td>'.$thn_ke2.'</td>
                <td>'.$thn_ke3.'</td>
                <td>'.$thn_ke4.'</td>
                <td>'.$thn_ke5.'</td>
                <td>'.$thn_ke6.'</td>
                <td>'.rupiah_display($row->jumlah_biaya) .'</td>
                <td>'.$row->sumber_biaya .'</td>
                <td>'.$swakelola.'</td>
                <td>'.$krjantardesa.'</td>
                <td>'.$krjapihakketiga .'</td>
               </tr>'
               ;}
          ?>
        </tbody>
      </table>
    </div>

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
