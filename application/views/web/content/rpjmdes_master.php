<h2>Rancangan RPJM </h2>
<legend></legend>
<div class="table-responsive" id="tableDetail">
      <table class="table table-bordered">
        <thead>
          <tr >
            <th><p class="text-center">Tahun Anggaran</p></th>
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
          if($result_rpjm){
            foreach ($result_rpjm as $row) {
              echo'
              <tr>
               <td>'.$row->tahun_anggaran .'</td>
               <td>'.rupiah_display($row->total_bidang_1).'</td>
               <td>'.rupiah_display($row->total_bidang_2).'</td>
               <td>'.rupiah_display($row->total_bidang_3).'</td>
               <td>'.rupiah_display($row->total_bidang_4).'</td>
               <td>'.rupiah_display($row->total_keseluruhan).'</td>
               <td><a class="text-center" href="'.base_url().'web/c_rpjmdes/anggaran/'.$row->id_m_rancangan_rpjm_desa.'""><i class="glyphicon glyphicon-list"></i></a></td>
              </tr>'
              ;

            }
          }
          ?>
        </tbody>
      </table>
    </div>


<script>
  <?php if ($result) {
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
  <script type="text/javascript">
    $("tr").click(function() {
        window.location = 'your-controller/the-id-view-function/'+$(this).data('id');
    }
</script>
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
