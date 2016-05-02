<h1>Berita</h1>	
<legend></legend>
			<div class="row">			
		<?php 	$idberita = $berita->id_berita;
					$judul = $berita->judul_berita;
					$gbr = $berita->gambar;
					$isi = $berita->isi_berita; 
					$tempTanggal = date("d-m-Y", strtotime($berita->waktu));	
					$tempWaktu = date("G:i", strtotime($berita->waktu));	
					$nama = $berita->nama_pengguna;
					$penulis = $berita->penulis;
					
			?>

			<div class="col-sm-12" >
			<div class="bg berita-detail">
				<div class="bg img-responsive berita-detail-img">
					<?php //echo $gbr;?>
					<img id="displayPhoto" src='<?php echo site_url($gbr);?>'> 
				</div>	
				<div class="bg berita-detail-text">
					<h3><?php echo $judul;?></h3>
					 <i class="fa fa-pencil-square-o"> Penulis:
						<?php if($penulis == null)
						{
							echo $nama;
						}
						else
						{
							echo $penulis;
						}
						?></i>
						|
					<i class="fa fa-calendar"> Tanggal: <?php echo $tempTanggal ;?></i>
						
						|
					<i class="fa fa-clock-o"> Jam: <?php echo $tempWaktu ;?></i>
						
							<legend></legend>
					<p>
					<?php echo $isi;?>
					</p>
				</div>		
			</div>
		</div>

	</div>
	<script type="text/javascript" charset="utf-8">			
			 function nav_active(){
				var r = document.getElementById("nav-home");
				r.className = "";
				
				var d = document.getElementById("nav-berita");
				d.className = d.className + "active";
				}
				$(document).ready(function(){  
			document.getElementById("displayPhoto").src = <?php echo site_url($berita);?>;
			});
	</script>