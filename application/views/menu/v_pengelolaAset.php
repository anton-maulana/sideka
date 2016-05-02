<br>
<div class="navbar-default sidebar" role="navigation">
<ul id="sidebar_menu" class="sidebar-nav nav">
			<li class="sidebar-brand" > 
				<a id="menu-toggle" href="#"><i class="fa fa-navicon fa-fw "></i> <span></span></a>
			</li>
			</ul>
<div id="sidebar-wrapper">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">                      
                        <li> 
                            <a href="<?php echo site_url('aset/c_pengelolaAset/');?>" id="a-pengelola-aset" class=""><i class="fa fa-home fa-fw "></i> Beranda</a>
                        </li>
						<li>
							<a href="<?php echo site_url('aset/c_tanah/');?>" id="a-tanah" class="" ><i class="fa fa-th-large fa-fw"></i> Pengelola Tanah</a>							
						</li>
						
						<!---------------------DROPDOWN 1--------------------------------------------------------------->
						<li class="dropdownmenu">
						<a id="a-data-bangunan" class="collapsed" data-toggle="collapse" href="#bangunan">
						<i class="fa fa-university fa-fw"></i> Pengelola Bangunan <span class="fa arrow"></span></a>
						<div id="bangunan" class="collapse">
						<ul id="" class="nav nav-pills nav-stacked nav-second-level">
							<li id="nav-bangunan" class="">
								<a href="<?php echo site_url('aset/c_bangunan/');?>"><i class="fa fa-building fa-fw"></i> Data Bangunan </a>
							</li>
							
							<li id="nav-perawatan" class="">
								<a href="<?php echo site_url('aset/c_perawatan/');?>"><i class="fa fa-medkit fa-fw"></i> Data Perawatan</a>
							</li>
						</ul>
						</div>
						</li>
						<!------------------------------------------------------------------------------------>
						
						<li>
							<a href="<?php echo site_url('aset/c_ruangan/');?>" id="a-ruangan" class="" ><i class="fa fa-hotel fa-fw"></i> Pengelolaan Ruangan</a>
						</li>
						
						<!---------------------DROPDOWN 2--------------------------------------------------------------->
						<li class="dropdownmenu">
						<a id="a-data-aset" class="collapsed" data-toggle="collapse" href="#aset">
						<i class="fa fa-archive fa-fw"></i> Pengelolaan Aset <span class="fa arrow"></span></a>
						<div id="aset" class="collapse">
						<ul id="" class="nav nav-pills nav-stacked nav-second-level">
							<li id="nav-aset" class="">
								<a href="<?php echo site_url('aset/c_aset/');?>"><i class="fa fa-briefcase fa-fw"></i> Data Aset</a>
							</li>
							
							<li id="nav-pindah" class="">
								<a href="<?php echo site_url('aset/c_pindah/');?>"><i class="fa fa-exchange fa-fw"></i> Pindah Ruangan</a>
							</li>
						</ul>
						</div>
						</li>
						<!------------------------------------------------------------------------------------>
						
						<!---------------------DROPDOWN 3--------------------------------------------------------------->
						<li class="dropdownmenu">
						<a id="a-data-pustaka" class="collapsed" data-toggle="collapse" href="#pustaka">
						<i class="fa fa-list fa-fw"></i> Pustaka <span class="fa arrow"></span></a>
						<div id="pustaka" class="collapse">
						<ul id="" class="nav nav-pills nav-stacked nav-second-level">
							<li id="nav-kategori" class="">
								<a href="<?php echo site_url('aset/c_kategori/');?>"> Kategori Aset</a>
							</li>							
							<li id="nav-kepemilikan" class="">
								<a href="<?php echo site_url('aset/c_kepemilikan/');?>"> Kepemilikan Aset</a>
							</li>
							<li id="nav-asal" class="">
								<a href="<?php echo site_url('aset/c_asal/');?>"> Asal Aset</a>
							</li>
						</ul>
						</div>
						</li>
						<!------------------------------------------------------------------------------------>
			
					</ul>
                </div>
				</div>
                <!-- /.sidebar-collapse -->
            </div>
        <!-- /.navbar-static-side -->
<script>
$("#menu-toggle").click(function(e) {
        e.preventDefault();
		$("#sidebar_menu").toggleClass("active");
        $("#sidebar-wrapper").toggleClass("active");
        $("#page-wrapper").toggleClass("active");
});
</script>