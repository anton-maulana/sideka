<h2>Rancangan APBDes <?php if($result_apbdes==null)echo "Belum Tersedia"; ?></h2>
<legend></legend>
<div class="table-responsive" id="tableDetail">
      <table class="table table-bordered">
        <thead>
          <tr >
            <th><p class="text-center">Tahun Anggaran</p></th>
            <th><p class="text-center">Total Pendapatan</p></th>
            <th><p class="text-center">Total Belanja</p></th>
            <th><p class="text-center">Total Pembayaran</p></th>
          </tr>
        </thead>
        <tbody>
          <?php
          if($result_apbdes){
            foreach ($result_apbdes as $row) {
              echo'
              <tr>
               <td>'.$row->rkp_tahun .'</td>
               <td>'.rupiah_display($row->total_pendapatan).'</td>
               <td>'.rupiah_display($row->total_belanja).'</td>
               <td>'.rupiah_display($row->total_pembiayaan).'</td>
               <td><a class="text-center" href="'.base_url().'web/c_apbdes/anggaran/'.$row->id_m_apbdes.'""><i class="glyphicon glyphicon-list"></i></a></td>
              </tr>'
              ;

            }
          }
          ?>
        </tbody>
      </table>
    </div>


<script>
  <?php if ($result_apbdes) {
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
