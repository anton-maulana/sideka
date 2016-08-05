<h2>Rancangan RKP <?php if($result_rkp==null)echo "Belum Tersedia"; ?></h2>
<legend></legend>
<div class="table-responsive" id="tableDetail">
      <table class="table table-bordered">
        <thead>
          <tr >
            <th><p class="text-center">Tahun Anggaran</p></th>
            <th><p class="text-center">Tahun RKP</p></th>
            <th><p class="text-center">Total Bidang 1</p></th>
            <th><p class="text-center">Total Bidang 2</p></th>
            <th><p class="text-center">Total Bidang 3</p></th>
            <th><p class="text-center">Total Bidang 4</p></th>
            <th><p class="text-center">Jumlah</p></th>
            <th><p class="text-center">Aksi</p></th>
          </tr>
        </thead>
        <tbody>
          <?php
          if($result_rkp){
            foreach ($result_rkp as $row) {
              echo'
              <tr>
               <td>'.$row->tahun_anggaran .'</td>
               <td>'.$row->rkp_tahun.'</td>
               <td>'.rupiah_display($row->total_bidang_1).'</td>
               <td>'.rupiah_display($row->total_bidang_2).'</td>
               <td>'.rupiah_display($row->total_bidang_3).'</td>
               <td>'.rupiah_display($row->total_bidang_4).'</td>
               <td>'.rupiah_display($row->total_keseluruhan).'</td>
               <td><a class="text-center" href="'.base_url().'web/c_rkpdes/anggaran/'.$row->id_m_rkp.'""><i class="glyphicon glyphicon-list"></i></a></td>
              </tr>'
              ;

            }
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
