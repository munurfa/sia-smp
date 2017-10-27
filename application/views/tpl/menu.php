        <!-- Sidebar -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">

                <ul class="nav" id="side-menu">
                 
                    <li>
                        <a style="color: forestgreen" href="<?php base_url('/')?>" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <?php if($this->session->hak=='Guru'){ ?>
                    <li>
                        <a style="color: forestgreen" href="#"><i class="fa fa-sitemap fa-fw"></i> Guru<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a style="color: forestgreen" href="<?php echo base_url('absen')?>"> Absensi Siswa</a>
                            </li>
                            <li>
                                <a style="color: forestgreen" href="<?php echo base_url('nilai')?>"> Nilai Siswa</a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    <?php if($this->session->hak=='Siswa'){ ?>
                    <li>
                        <a style="color: forestgreen" href="#"><i class="fa fa-sitemap fa-fw"></i> Siswa<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a style="color: forestgreen" href="<?php echo base_url('datasiswa/absen')?>"> Absensi Siswa</a>
                            </li>
                            <li>
                                <a style="color: forestgreen" href="<?php echo base_url('datasiswa/nilai')?>"> Nilai Siswa</a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    <?php if($this->session->hak=='Admin'){?>
                    <li>
                        <a style="color: forestgreen" href="#"><i class="fa fa-sitemap fa-fw"></i> Admin<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <!-- <li>
                                <a style="color: forestgreen" href="<?php echo base_url('users')?>"> Data User</a>
                            </li> -->
                            <li>
                                <a style="color: forestgreen" href="<?php echo base_url('mapel')?>"> Data Mapel</a>
                            </li>
                            <li>
                                <a style="color: forestgreen" href="<?php echo base_url('guru')?>"> Data Guru</a>
                            </li>
                             <li>
                                <a style="color: forestgreen" href="<?php echo base_url('kelas')?>"> Data Kelas</a>
                            </li>
                            <li>
                                <a style="color: forestgreen" href="<?php echo base_url('siswa')?>"> Data Siswa</a>
                            </li>
                            
                           
                            <!-- <li>
                                <a style="color: forestgreen" href="#"> Data Absensi</a>
                            </li> -->
                        </ul>
                    </li>   
                    <?php } ?>  
                    <li>
                        <a style="color: forestgreen" href="<?php echo base_url('auth/logout');?>" class=""><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
   <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $pageTitle; ?></h1>
                </div>
            </div>