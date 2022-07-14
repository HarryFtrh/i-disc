                <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>    
                    <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <?php if(session('level') == 'Op'): ?>
                                <li class="app-sidebar__heading">Dashboard</li>
                                <li>
                                    <a href="<?= base_url(); ?>/dashboard" class="<?= $active == 'dashboard' ? 'mm-active' : ''; ?>">
                                        <i class="metismenu-icon fa-solid fa-chart-line"></i>
                                        Dashboard
                                    </a>
                                </li>  
                                <li class="app-sidebar__heading">Data Components</li>
                                <li>
                                    <a href="<?= base_url(); ?>/data-user" class="<?= $active == 'user' ? 'mm-active' : ''; ?>">
                                        <i class="metismenu-icon fa-solid fa-id-card"></i>
                                        Data User
                                    </a>
                                </li>                                                              
                                <li>
                                    <a href="<?= base_url(); ?>/data-barang" class="<?= $active == 'barang' ? 'mm-active' : ''; ?>">
                                        <i class="metismenu-icon fa-solid fa-wallet"></i>
                                        Data Barang
                                    </a>
                                </li>                                                              
                                <li>
                                    <a href="<?= base_url(); ?>/data-toko" class="<?= $active == 'toko' ? 'mm-active' : ''; ?>">
                                        <i class="metismenu-icon fa-solid fa-store"></i>
                                        Data Toko
                                    </a>
                                </li>                                                              
                                <li>
                                    <a href="<?= base_url(); ?>/data-program" class="<?= $active == 'disc' ? 'mm-active' : ''; ?>">
                                    <i class="metismenu-icon fa-solid fa-book-open"></i>
                                        Data Program
                                    </a>
                                </li>   
                                <li class="app-sidebar__heading">Forms</li>
                                <li>
                                <a href="<?= base_url(); ?>/form-pengajuan" class="<?= $active == 'pengajuan' ? 'mm-active' : ''; ?>">
                                        <i class="metismenu-icon fa-brands fa-wpforms"></i>
                                        Forms Pengajuan
                                    </a>
                                </li>                                                            
                                <li>
                                <a href="<?= base_url(); ?>/update-pengajuan" class="<?= $active == 'uppengajuan' ? 'mm-active' : ''; ?>">
                                        <i class="metismenu-icon fa-solid fa-pen-clip"></i>
                                        Update Pengajuan
                                    </a>
                                </li>                                                            
                                <li>
                                <a href="<?= base_url(); ?>/print-pengajuan" class="<?= $active == 'ppengajuan' ? 'mm-active' : ''; ?>">
                                <i class="metismenu-icon fa-solid fa-print"></i>
                                        Print Pengajuan Per Tanggal
                                    </a>
                                </li> 
                                <li class="app-sidebar__heading">Logo</li>
                                <li>
                                <a href="<?= base_url(); ?>/logo" class="<?= $active == 'logo' ? 'mm-active' : ''; ?>">
                                        <i class="metismenu-icon fa-solid fa-image"></i>
                                        Ganti Logo
                                    </a>
                                </li>  
                                <?php endif ?>    
                                <?php if(session('level') == 'admin'): ?>
                                <li class="app-sidebar__heading">Dashboard</li>
                                <li>
                                    <a href="<?= base_url(); ?>/dashboard" class="<?= $active == 'dashboard' ? 'mm-active' : ''; ?>">
                                        <i class="metismenu-icon fa-solid fa-chart-line"></i>
                                        Dashboard
                                    </a>
                                </li>  
                                <li class="app-sidebar__heading">Forms</li>                                                                                       
                                <li>
                                <a href="<?= base_url(); ?>/update-pengajuan" class="<?= $active == 'uppengajuan' ? 'mm-active' : ''; ?>">
                                        <i class="metismenu-icon fa-solid fa-pen-clip"></i>
                                        Update Pengajuan
                                    </a>
                                </li>                                                            
                                <li>
                                <a href="<?= base_url(); ?>/print-pengajuan" class="<?= $active == 'ppengajuan' ? 'mm-active' : ''; ?>">
                                <i class="metismenu-icon fa-solid fa-print"></i>
                                        Print Pengajuan Per Tanggal
                                    </a>
                                </li> 
                                <?php endif ?>  
                                <?php if(session('level') == 'user'): ?>
                                    <li class="app-sidebar__heading">Dashboard</li>
                                <li>
                                    <a href="<?= base_url(); ?>/dashboard" class="<?= $active == 'dashboard' ? 'mm-active' : ''; ?>">
                                        <i class="metismenu-icon fa-solid fa-chart-line"></i>
                                        Dashboard
                                    </a>
                                </li> 
                                <li class="app-sidebar__heading">Data Barang</li>                                                                                       
                                <li>
                                    <a href="<?= base_url(); ?>/data-barang" class="<?= $active == 'barang' ? 'mm-active' : ''; ?>">
                                        <i class="metismenu-icon fa-solid fa-wallet"></i>
                                        Data Barang
                                    </a>
                                </li> 
                                <li class="app-sidebar__heading">Forms</li>
                                <li>
                                <a href="<?= base_url(); ?>/form-pengajuan" class="<?= $active == 'pengajuan' ? 'mm-active' : ''; ?>">
                                        <i class="metismenu-icon fa-brands fa-wpforms"></i>
                                        Forms Pengajuan
                                    </a>
                                </li>                                                            
                                <li>
                                <a href="<?= base_url(); ?>/update-pengajuan" class="<?= $active == 'uppengajuan' ? 'mm-active' : ''; ?>">
                                        <i class="metismenu-icon fa-solid fa-pen-clip"></i>
                                        Data Pengajuan
                                    </a>
                                </li>                                                            
                                <li>                               
                                <?php endif ?>  
                                <?php if(session('level') == 'spv'): ?>
                                <li class="app-sidebar__heading">Dashboard</li>
                                <li>
                                    <a href="<?= base_url(); ?>/dashboard" class="<?= $active == 'dashboard' ? 'mm-active' : ''; ?>">
                                        <i class="metismenu-icon fa-solid fa-chart-line"></i>
                                        Dashboard
                                    </a>
                                </li> 
                                <li class="app-sidebar__heading">Forms</li>                                
                                <li>
                                <a href="<?= base_url(); ?>/update-pengajuan" class="<?= $active == 'uppengajuan' ? 'mm-active' : ''; ?>">
                                        <i class="metismenu-icon fa-solid fa-pen-clip"></i>
                                        Data Pengajuan
                                    </a>
                                </li>                                                                                                                         
                                <li class="app-sidebar__heading">Data Program</li>                                                                                       
                                <li>
                                    <a href="<?= base_url(); ?>/data-program" class="<?= $active == 'disc' ? 'mm-active' : ''; ?>">
                                    <i class="metismenu-icon fa-solid fa-book-open"></i>
                                        Data Program
                                    </a>
                                </li>                                   
                                <?php endif ?>  
  
                                                       
                            </ul>
                        </div>
                    </div>
                </div> 