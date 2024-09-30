<nav class="navbar navbar-vertical navbar-expand-xl navbar-light navbar-vibrant">
    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">

            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-toggle="tooltip" data-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>

        </div><a class="navbar-brand" href="<?php echo site_url('admin2053/dashboard') ?>">
            <div class="d-flex align-items-center py-3"><img class="mr-2" src="<?= base_url() ?>assets/img/logos/logo.svg" alt="" height="38" /></div>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content perfect-scrollbar scrollbar">
            <?php if ((session()->get('admin_role') == 'superadmin') || (session()->get('admin_role') == 'admin')) { ?>
                <ul class="navbar-nav flex-column">
                    <li class="nav-item<?php if (current_url() === site_url('admin2053/dashboard')) { ?> active<?php } ?>">
                        <a class="nav-link" href="<?php echo site_url('admin2053/dashboard') ?>">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-home"></span></span><span class="nav-link-text">Dashboard</span>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="navbar-vertical-divider">
                    <hr class="navbar-vertical-hr my-2" />
                </div>
                <ul class="navbar-nav flex-column">
                    <li class="nav-item<?php if (current_url() === site_url('admin2053/layanan')) { ?> active<?php } ?>">
                        <a class="nav-link" href="<?php echo site_url('admin2053/layanan') ?>">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-street-view"></span></span><span class="nav-link-text">Layanan</span>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="navbar-vertical-divider">
                    <hr class="navbar-vertical-hr my-2" />
                </div>
                <ul class="navbar-nav flex-column">
                    <li class="nav-item<?php if (current_url() === site_url('admin2053/sasaran')) { ?> active<?php } ?>">
                        <a class="nav-link" href="<?php echo site_url('admin2053/sasaran') ?>">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-thumbs-up"></span></span><span class="nav-link-text">Sasaran</span>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="navbar-vertical-divider">
                    <hr class="navbar-vertical-hr my-2" />
                </div>
                <?php if (session()->get('admin_role') == 'superadmin') { ?>
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item<?php if (current_url() === site_url('admin2053/admin')) { ?> active<?php } ?>"><a class="nav-link" href="<?= site_url('admin2053/admin') ?>">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fas fa-users-cog"></i></span></span><span class="nav-link-text">
                                        Admins</span>
                                </div>
                            </a></li>
                    </ul>
                <?php } ?>
            <?php } ?>

        </div>
    </div>
</nav>