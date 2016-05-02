<!DOCTYPE html>
<html>
<head>
	<title>404 Halaman Tidak Ditemukan</title>

	<!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assetku/css/bootstrap.min.css">
	<link href="<?php echo base_url(); ?>assetku/font/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">

</head>
<body>

	
	<div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-4">
                <div class="centered panel " style="text-align:center;">
					
                    <div class="panel-heading">
						<img src="<?php echo base_url(); ?>assetku/img/logo_sideka.png" style="height:75px; width:auto; text-align:center;"> 						
                    </div>
					<div class="panel-footer">
					<h2>404 - Halaman Tidak Ditemukan</h2>
					<legend></legend>
					<a title="Kembali ke Halaman Sebelumnya" href="javascript:history.go(-1);" class="btn btn-default btn-md"><i class="fa fa-arrow-circle-left"></i>
									Halaman Sebelumnya
					</a>
					</div>
                </div>
            </div>
        </div>
    </div>

<style>



.centered {
  position: fixed;
  top: 50%;
  left: 50%;
  /* bring your own prefixes */
  transform: translate(-50%, -50%);
}

body{
  background:#f8f8f8;
  font-family:tahoma,verdana,arial,sans-serif;
  font-size:14px;
}

.panel-heading{background:rgba(245, 245, 245, 0.09);}
.panel-footer{text-align:center;}
.panel-body{margin-top:-50px;}

.panel {
  margin-bottom: 20px;
  background-color: #fff;
  border: 3px solid rgb(102, 102, 102);
  border-radius: 5px;
  -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
  box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
</style>
</body>
</html>