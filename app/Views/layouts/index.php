<?php require_once 'head.php'; ?>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <h5 class="font-weight-bold">I-Disc</h5>
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
            <div class="app-header__content">              
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                <img src="<?= base_url(); ?>/assets/image/avatars/<?= session('avatar'); ?>" class="img-thumbnail rounded-circle" style="width: 3rem; height: 3rem;" alt="avatars">                                                                        
                                </div>
                                <div class="widget-content-left  ml-1 header-user-info">
                                    <div class="widget-heading">
                                        <?= session('nama'); ?>
                                    </div>
                                    <div class="widget-subheading">
                                        <?= session('area'); ?>
                                    </div>
                                </div>
                                <div class="widget-content-right header-user-info">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <img width="42" class="rounded-circle" src="assets/images/avatars/1.jpg" alt="">
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <a href="/setting-account" tabindex="0" class="dropdown-item">Account</a>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <a href="/logout" tabindex="0" class="dropdown-item">Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>        
                </div>
            </div>
        </div>                      
        <div class="app-main">
                <?php require_once 'sidebar.php'; ?>   
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <?= $this->renderSection('content'); ?>
                    </div>
                    <?php require_once 'foot.php'; ?> 
                </div>
            </div>
            <?= $this->renderSection('modals'); ?>
        </div>
        <script src="<?= base_url(); ?>/assets/plugins/jquery/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="<?= base_url(); ?>/template/assets/scripts/main.js"></script></body>
    <script src="<?= base_url(); ?>/assets/plugins/alert/iziToast.min.js"></script>
    <script src="<?= base_url(); ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?= $this->renderSection('js'); ?>
</body>    
</html>