<h2>Rancangan APBDes </h2>

<?php if($result_apbdes){ ?>
<form class="form-inline">

  <div class="form-group pull-right">
    <label>
      Download
    </label>
    <button type="button" class="btn btn-success btn-sm "  title="Download Excell" id="downloadExcell">
      <a href="<?php echo site_url('web/c_apbdes/export_excel/'.$result_apbdes[0]->id_m_apbdes);?> "><i class="fa fa-file-excel-o"></i></a>
    </button>
  </div>
</form>
<?php } ?>

<legend></legend>
<div class="table-responsive" id="tableDetail">
      <table class="table table-bordered">
        <thead>
          <tr >
            <th rowspan="2"><p class="text-center">Kode Rekening</p></th>
            <th rowspan="2"><p class="text-center">Anggaran</p></th>
            <th rowspan="2"><p class="text-center">Keterangan</p></th>
          </tr>
        </thead>
        <tbody>
          <?php
          if($result_apbdes){
            foreach ($result_apbdes as $row) {
               echo'
               <tr>
                <td>'.$row->kode_rekening .'</td>
                <td>'.rupiah_display($row->anggaran).'</td>
                <td>'.$row->keterangan .'</td>
               </tr>';
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
