<br><br>
<div class="navbar-default sidebar" role="navigation">
    <ul id="sidebar_menu" class="sidebar-nav nav">
        <li class="sidebar-brand" > 
            <a id="menu-toggle" href="#"><i class="fa fa-align-justify fa-fw "></i> <span>Menu</span></a>
        </li>
    </ul>
    <div id="sidebar-wrapper">

        <div class="sidebar-nav navbar-collapse">	

            <ul class="nav" id="side-menu">
                <li> 
                    <a href="<?php echo site_url('rencanaPembangunan/c_rencanaPembangunan/'); ?>" id="a-pengelola_perencanaan" class=""><i class="fa fa-home fa-fw "></i> Beranda</a>
                </li>

                <!---------------------DROPDOWN 1--------------------------------------------------------------->
                <li class="dropdownmenu">
                    <a id="a-data-perencanaan" class="collapsed" data-toggle="collapse" href="#perencanaan">
                        <i class="fa fa-suitcase fa-fw"></i> Perencanaan <span class="fa arrow"></span></a>
                    <div id="perencanaan" class="collapse">
                        <ul id="" class="nav nav-stacked nav-second-level">

                            <?php
                            /**
                             * Menu Rancangan RPJM Desa
                             * menu ini dibuat untuk mengakomodasi rancangan RPJM Desa
                             * 28-Januari-2016 
                             * @todo Sesuaikan jika ternyata yang dimaksud adalah rpjmdes
                             */
                            ?>

                            <li class="dropdownmenu">
                                <a id="a-data-rancangan_rpjm_desa" href="<?php echo site_url('rencanaPembangunan/c_rancangan_rpjm_desa/'); ?>" title="Rencana Pembangunan Jangka Menengah Daerah">
                                    <i class="fa fa-newspaper-o fa-fw"></i> RPJM Desa</span>
                                </a>
                            </li>

                            <?php
                            /**
                             * End menu Rancangan RPJM Desa
                             */
                            ?>
                            
                            <?php
                            /**
                             * Menu RKP
                             * menu ini dibuat untuk mengakomodasi rancangan RKP
                             * 28-Januari-2016 
                             */
                            ?>

                            <li class="dropdownmenu">
                                <a id="a-data-rkp_desa" href="<?php echo site_url('rencanaPembangunan/c_rkp/'); ?>" title="Rencana Kerja Pemerintah Desa">
                                    <i class="fa fa-newspaper-o fa-fw"></i> RKP Desa</span>
                                </a>
                            </li>

                            <?php
                            /**
                             * End menu RKP
                             */
                            ?>
                            
                            <?php
                            /**
                             * Menu APB Desa
                             * menu ini dibuat untuk mengakomodasi APBDesa
                             * 28-Januari-2016 
                             */
                            ?>

                            <li class="dropdownmenu">
                                <a id="a-data-apb_desa" href="<?php echo site_url('rencanaPembangunan/c_apbdes/'); ?>" title="Anggaran Pendapatan dan Belanja Desa">
                                    <i class="fa fa-newspaper-o fa-fw"></i> APB Desa</span>
                                </a>
                            </li>

                            <?php
                            /**
                             * End menu APBDesa
                             */
                            ?>

                            <?php
                            /**
                            <li class="dropdownmenu">
                                <a id="a-data-rpjmd" class="collapsed" data-toggle="collapse" href="#rpjmd" title="Rencana Pembangunan Jangka Menengah Daerah">
                                    <i class="fa fa-newspaper-o fa-fw"></i> RPJMD<span class="fa arrow"></span></a>
                                <div id="rpjmd" class="collapse">
                                    <ul id="yw6" class="nav nav-pills nav-stacked nav-third-level">								
                                        <li id="nav-list_rpjmd" class="">	
                                            <a href="<?php echo site_url('rencanaPembangunan/c_rpjmd/'); ?>"><i class="fa fa-list fa-fw"></i> List RPJMD</a>
                                        </li>
                                        <li id="nav-tree_rpjmd" class="">	
                                            <a href="<?php echo site_url('rencanaPembangunan/c_rpjmd/show_tree_rpjmd/'); ?>"><i class="fa fa-sitemap fa-fw"></i> Tree RPJMD</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="dropdownmenu">
                                <a id="a-data-rpjmdes" class="collapsed" data-toggle="collapse" href="#rpjmdes" title="Rencana Pembangunan Jangka Menengah Desa">
                                    <i class="fa fa-newspaper-o fa-fw"></i> RPJMDes<span class="fa arrow"></span></a>
                                <div id="rpjmdes" class="collapse">
                                    <ul id="yw6" class="nav nav-pills nav-stacked nav-third-level">								
                                        <li id="nav-list_rpjmdes" class="">	
                                            <a href="<?php echo site_url('rencanaPembangunan/c_rpjmdes/'); ?>"><i class="fa fa-list fa-fw"></i> List RPJMDes</a>
                                        </li>

                                        <li id="nav-detail_rpjmdes" class="">	
                                            <a href="<?php echo site_url('rencanaPembangunan/c_rpjmdes_detail/'); ?>"><i class="fa fa-table fa-fw"></i> Detil RPJMDes</a>
                                        </li>

                                        <li id="nav-tree_rpjmdes" class="">	
                                            <a href="<?php echo site_url('rencanaPembangunan/c_rpjmdes/show_tree_rpjmdes/'); ?>"><i class="fa fa-sitemap fa-fw"></i> Tree RPJMDes</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="dropdownmenu">
                                <a id="a-data-rkpdes" class="collapsed" data-toggle="collapse" href="#rkpdes" title="Rencana Kerja Pemerintah Desa">
                                    <i class="fa fa-newspaper-o fa-fw"></i> RKPDes<span class="fa arrow"></span></a>
                                <div id="rkpdes" class="collapse">
                                    <ul id="yw6" class="nav nav-pills nav-stacked nav-third-level">								
                                        <li id="nav-list_rkpdes" class="">	
                                            <a href="<?php echo site_url('rencanaPembangunan/c_rkpdes/'); ?>"><i class="fa fa-list fa-fw"></i> List RKPDes</a>
                                        </li>
                                        <li id="nav-tree_rkpdes" class="">	
                                            <a href="<?php echo site_url('rencanaPembangunan/c_rkpdes/show_tree_rkpdes/'); ?>"><i class="fa fa-sitemap fa-fw"></i> Tree RKPDes</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                             * 
                             */
                            ?>
                        </ul>
                    </div>
                </li>
                <!------------------------------------------------------------------------------------>

                <!---------------------DROPDOWN 2--------------------------------------------------------------->
                <li class="dropdownmenu">
                    <a id="a-data-anggaran" class="collapsed" data-toggle="collapse" href="#anggaran">
                        <i class="fa fa-money fa-fw"></i> Anggaran <span class="fa arrow"></span></a>
                    <div id="anggaran" class="collapse">
                        <ul id="" class="nav nav-pills nav-stacked nav-second-level">
                            <!--
                            <li id="nav-rkadesa" class="">
                                    <a href="<?php echo site_url(''); ?>" title="Rencana Kerja dan Anggaran Desa"><i class="fa fa-group fa-fw"></i> RKADesa</a>
                            </li>
                            -->
                            <li id="nav-rabdes" class="">
                                <a href="<?php echo site_url('rencanaPembangunan/c_rabdes/'); ?>" title="Rencana Anggaran Belanja Desa"><i class="fa fa-list fa-fw"></i> RABDesa</a>
                            </li>	
                            <li id="nav-spp" class="">
                                <a href="<?php echo site_url('rencanaPembangunan/c_spp/'); ?>" title="Surat Permintaan Pembayaran"><i class="fa fa-newspaper-o fa-fw"></i> SPP</a>
                            </li>
                            <li id="nav-lpj" class="">
                                <a href="<?php echo site_url('rencanaPembangunan/c_lpj/'); ?>" title="Laporan Penanggungjawaban"><i class="fa fa-newspaper-o fa-fw"></i> LPJ</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!------------------------------------------------------------------------------------>

                <!---------------------DROPDOWN 3--------------------------------------------------------------->
                <!--
                <li class="dropdownmenu">
                <a id="a-data-dokumen" class="collapsed" data-toggle="collapse" href="#dokumen">
                <i class="fa fa-file-text fa-fw"></i> Dokumen <span class="fa arrow"></span></a>
                <div id="dokumen" class="collapse">
                <ul id="" class="nav nav-pills nav-stacked nav-second-level">
                        <li id="nav-dpa" class="">
                                <a href="<?php echo site_url(''); ?>"><i class="fa fa-list fa-fw"></i> DPADesa</a>
                        </li>					
                </ul>
                </div>
                </li>
                -->


                <!------------------------------------------------------------------------------------>


                <!---------------------DROPDOWN 4--------------------------------------------------------------->
                <li class="dropdownmenu">
                    <a id="a-data-pustaka_per" class="collapsed" data-toggle="collapse" href="#pustaka_per">
                        <i class="fa fa-archive fa-fw"></i> Pustaka Perencanaan <span class="fa arrow"></span></a>
                    <div id="pustaka_per" class="collapse">
                        <ul class="nav nav-pills nav-stacked nav-second-level">
                            <li id="nav-periode">
                                <a href="<?php echo site_url('rencanaPembangunan/c_periode'); ?>"><i class="fa fa-calendar fa-fw"></i> Periode</a>
                            </li>
                            <li id="nav-tahun_anggaran">
                                <a href="<?php echo site_url('rencanaPembangunan/c_tahun_anggaran'); ?>"><i class="fa fa-calendar fa-fw"></i> Tahun Anggaran</a>
                            </li>
                            <li id="nav-bidang">
                                <a href="<?php echo site_url('rencanaPembangunan/c_bidang/'); ?>"><i class="fa fa-building fa-fw"></i> Bidang</a>
                            </li>	
                            <li id="nav-coa">	
                                <a href="<?php echo site_url('rencanaPembangunan/c_coa/'); ?>"><i class="fa fa-credit-card fa-fw"></i> Kode Rekening</a>
                            </li>
                            <li id="nav-sumber_dana">	
                                <a href="<?php echo site_url('rencanaPembangunan/c_sumber_dana/'); ?>"><i class="fa fa-money fa-fw"></i> Sumber Dana</a>
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
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#sidebar_menu").toggleClass("active");
        $("#sidebar-wrapper").toggleClass("active");
        $("#page-wrapper").toggleClass("active");

    });
</script>

