<div class="container">
<div class="navbar-header">
	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
</div>
<div class="navbar-collapse collapse">
	<ul class="nav navbar-nav">
		<li id="nav-home" class=""><a href="<?php echo site_url('web/c_home/');?>">Beranda</a></li>
		<li id="nav-profil" class="dropdown">
			<a class="dropdown-toggle dropdownhover" data-toggle="dropdown" href="#">Profil Desa <span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="<?php echo site_url('web/c_sejarah/');?>">Sejarah Desa</a></li>
				<li><a href="<?php echo site_url('web/c_demografi/');?>">Demografi</a></li>
				<li><a href="<?php echo site_url('web/c_visimisi/');?>">Visi dan Misi</a></li>
			</ul>
		</li>
		<li id="nav-berita" class="dropdown">
			<a class="dropdown-toggle dropdownhover" data-toggle="dropdown" href="#">Berita <span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="<?php echo site_url('web/c_berita/');?>">Berita</a></li>
				<li><a href="<?php echo site_url('web/c_jurnal_warga/');?>">Jurnalisme Desa</a></li>
			</ul>
		</li>
		<li id="nav-peta"><a href="<?php echo site_url('web/c_peta/');?>">Peta Desa</a></li>

		<li id="nav-lembaga" class="dropdown">
			<a class="dropdown-toggle dropdownhover" data-toggle="dropdown" href="#">Lembaga Desa <span class="caret"></span></a>
			<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
				<li><a href="<?php echo site_url('web/c_lembaga_desa/');?>">Pemerintah Desa</a></li>
				<li><a  href="<?php echo site_url('web/c_rt_rw/');?>">Lembaga Kemasyarakatan Desa</a></li>
			</ul>
		</li>

		<li id="nav-statistik" class="dropdown">
			<a class="dropdown-toggle dropdownhover" data-toggle="dropdown" href="#">
				Statistik Desa <span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
				<li><a href="<?php echo site_url('web/c_statistik_pekerjaan');?>">Pekerjaan</a></li>

				<li><a href="<?php echo site_url('web/c_statistik_pendidikan');?>">Pendidikan</a></li>
				<li><a href="<?php echo site_url('web/c_statistik_status_kawin');?>">Status Kawin</a></li>

				<li><a href="<?php echo site_url('web/c_statistik_goldar');?>">Golongan Darah</a></li>
				<li><a href="<?php echo site_url('web/c_statistik_agama');?>">Agama</a></li>


				<li><a href="<?php echo site_url('web/c_statistik_kelas_sosial');?>">Kelas Sosial</a></li>
				<li><a href="<?php echo site_url('web/c_statistik_raskin');?>">Raskin</a></li>
				<li><a href="<?php echo site_url('web/c_statistik_jamkesmas');?>">Jamkesmas</a></li>
				<li><a href="<?php echo site_url('web/c_statistik_pkh');?>">Program Keluarga Harapan</a></li>
				<li><a href="<?php echo site_url('web/c_statistik_kk');?>">Kepala Keluarga</a></li>
				<li><a href="<?php echo site_url('web/c_statistik_gizi_buruk');?>">Gizi Buruk</a></li>
				<li><a href="<?php echo site_url('web/c_statistik_kehamilan');?>">Kehamilan</a></li>
				<li><a href="<?php echo site_url('web/c_statistik_buruh_migran');?>">Buruh Migran</a></li>
				<li><a href="<?php echo site_url('web/c_statistik_bsm');?>">Bantuan Siswa Miskin</a></li>
				<li><a href="<?php echo site_url('web/c_statistik_piramida');?>">Piramida Penduduk</a></li>
			</ul>
		</li>

		<li id="nav-keuangan" class="dropdown">
			<a class="dropdown-toggle dropdownhover" data-toggle="dropdown" href="#">KEUANGAN DESA <span class="caret"></span></a>
			<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
				<li><a href="<?php echo site_url('web/c_rpjmdes/');?>">RPJMDES</a></li>
				<li><a href="<?php echo site_url('web/c_rkpdes/');?>">RKPDES</a></li>
				<li><a href="<?php echo site_url('web/c_apbdes/');?>">APBDES</a></li>
			</ul>
		</li>

		<li id="nav-regulasi"><a href="<?php echo site_url('web/c_regulasi/');?>">Regulasi</a></li>

	</ul>

<ul class="nav navbar-nav navbar-right">
	<li class="navbar-right" id="navbar-search">
		<a>
			<i class="fa fa-search"></i>
		</a>
		<div class="hidden" id="navbar-search-box">

		<?php $this->load->helper(array('form', 'search')); ?>
		<?php echo form_open('web/c_pages/search/');?>
		<?php echo validation_errors(); ?>
		<fieldset>
			<div class="input-group">
				<input type="text" class="form-control" name="keyword" id="keyword" autofocus placeholder="Masukkan Kata Kunci">
				<span class="input-group-btn">
					<button class="btn btn-default" value="Submit" name="submit" type="submit">Cari</button>
				</span>
			</div>
			</fieldset>
		<?php echo form_close(); ?>


		<li><a id="sso" href="<?php echo site_url('c_login/');?>"><i class="fa fa-user fa-fw"></i> LOGIN</a></li>
		</div>
	</li>
</ul>

</div>
</div>
