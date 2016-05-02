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
                            <a href="<?php echo site_url('peta/c_pengelolaPeta/');?>" id="a-pengelola-peta" class=""><i class="fa fa-home fa-fw "></i> Beranda</a>
                        </li>
						<li>
							<a href="<?php echo site_url('peta/c_petaDasar/');?>" id="a-dasar" class="" ><i class="fa fa-globe fa-fw"></i> Peta Dasar</a>							
						</li>
						<li>
							<a href="<?php echo site_url('peta/c_petaBatasWilayah/');?>" id="a-batas" class="" ><i class="fa fa-chain fa-fw"></i> Peta Batas Wilayah</a>							
						</li>
						<li>
							<a href="<?php echo site_url('peta/c_petaTanah/');?>" id="a-tanah" class="" ><i class="fa fa-th-large fa-fw"></i> Peta Aset Tanah</a>							
						</li>
						<li>
							<a href="<?php echo site_url('peta/c_petaBangunan/');?>" id="a-bangunan" class="" ><i class="fa fa-building fa-fw"></i> Peta Aset Bangunan</a>							
						</li>
						<li>
							<a href="<?php echo site_url('peta/c_petaPotensi/');?>" id="a-potensi" class="" ><i class="fa fa-leaf fa-fw"></i> Peta Potensi</a>							
						</li>
						
						
			
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
        $("#map_canvas").toggleClass("active");
});
</script>