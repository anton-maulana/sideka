<<<<<<< HEAD
<h1>Berita</h1>
<legend></legend>
			<div class="row">
=======
<h1>Berita</h1>	
<legend></legend>
			<div class="row">			
>>>>>>> f116a20c8be190662fb8a357c43f3c153e02482b
		<?php
			//$i=0;
			foreach($berita as $berita)
			{
			//$i++;
		?>
<<<<<<< HEAD
			<?php
			$idberita = $berita->id_berita;
			$judul = $berita->judul_berita;
			$gbr = $berita->gambar;
			$isi_berita = substr($berita->isi_berita,0,460);
			//$isi = $berita->isi_berita;
			$tempTanggal = date("d-m-Y", strtotime($berita->waktu));
			$tempWaktu = date("G:i", strtotime($berita->waktu));
=======
			<?php 	
			$idberita = $berita->id_berita;
			$judul = $berita->judul_berita;			
			$gbr = $berita->gambar;
			$isi_berita = substr($berita->isi_berita,0,460);
			//$isi = $berita->isi_berita;
			$tempTanggal = date("d-m-Y", strtotime($berita->waktu));	
			$tempWaktu = date("G:i", strtotime($berita->waktu));	
>>>>>>> f116a20c8be190662fb8a357c43f3c153e02482b
			$nama = $berita->nama_pengguna;
			$penulis = $berita->penulis;
			?>

<<<<<<< HEAD

=======
		
>>>>>>> f116a20c8be190662fb8a357c43f3c153e02482b
		<a href="<?php echo site_url('web/c_berita/get_detail_berita/'.$idberita);?>" title="<?php echo $judul;?>" class="link-berita">
		<div class="col-xs-12 col-sm-6 col-md-4" >
			<div class="bg berita-content">
				<div class="img-responsive berita-content-img">
					<?php //echo $gbr;?>
<<<<<<< HEAD
					<img class="displayPhoto" src='<?php echo site_url($gbr);?>'>
				</div>
				<div class="berita-content-text">
					<h3>
						<?php
=======
					<img class="displayPhoto" src='<?php echo site_url($gbr);?>'> 
				</div>	
				<div class="berita-content-text">
					<h3>
						<?php 
>>>>>>> f116a20c8be190662fb8a357c43f3c153e02482b
						if(strlen($judul)<70)
						{
							echo $judul;
						}
						else
<<<<<<< HEAD
						{
							$judul = substr($judul,0,70);
							echo $judul.'...';
						}


						?>
					</h3>

						<div class="clearfix visible-sm"></div>

=======
						{							
							$judul = substr($judul,0,70);
							echo $judul.'...';
						}
						
							
						?>
					</h3>
				
						<div class="clearfix visible-sm"></div>
						
>>>>>>> f116a20c8be190662fb8a357c43f3c153e02482b
					 <!--i class="fa fa-pencil-square-o">
						<?php if($penulis == null)
						{
							//echo $nama.', ';
						}
						else
						{
							//echo $penulis.', ';
						}
						?>
					</i>
					<i class="fa fa-calendar">
						<?php //echo $tempTanggal.', ' ;?>
<<<<<<< HEAD
					</i>
					<i class="fa fa-clock-o">
						<?php //echo $tempWaktu.' ' ;?>
					</i-->
				</div>
=======
					</i>	
					<i class="fa fa-clock-o">
						<?php //echo $tempWaktu.' ' ;?>
					</i-->	
				</div>			
>>>>>>> f116a20c8be190662fb8a357c43f3c153e02482b
				<div class="text-berita">
					<legend></legend>
					<?php echo $isi_berita;?>
				</div>
				<div class="text-berita-next">
				<legend></legend>
					<h6>Selanjutnya &raquo;</h6>
				</div>
<<<<<<< HEAD

			</div>
		</div>

	</a>

		<?php
	}
	?>

=======
					
			</div>
		</div>
		
	</a>
	
		<?php
	}
	?>
	
>>>>>>> f116a20c8be190662fb8a357c43f3c153e02482b
	<div class="col-sm-12">
	<!-- <button type="button" class="btn btn-berita btn-block">MEMUAT BERITA SELANJUTNYA</button> -->
	<?php echo $this->pagination->create_links(); ?>
	</div>
	</div>
<<<<<<< HEAD
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
			/* masuk ke dalam berita.php */
	</script>

	<style>

	</style>
=======
	<script type="text/javascript" charset="utf-8">			
			 function nav_active(){
				var r = document.getElementById("nav-home");
				r.className = "";
				
				var d = document.getElementById("nav-berita");
				d.className = d.className + "active";
				}
		$(document).ready(function(){  
			//document.getElementById("displayPhoto").src = <?php echo site_url($berita);?>;
			});
	</script>
	
	<style>
	
	</style>
>>>>>>> f116a20c8be190662fb8a357c43f3c153e02482b
