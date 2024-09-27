<nav class="navbar navbar-light navbar-glass navbar-top sticky-kit navbar-expand">

    <button class="btn navbar-toggler-humburger-icon navbar-toggler mr-1 mr-sm-3" type="button" data-toggle="collapse" data-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
    <a class="navbar-brand mr-1 mr-sm-3" href="<?php echo site_url("admin2053/dashboard") ?>">
        <div class="d-flex align-items-center"><img class="mr-2" src="<?= base_url() ?>assets/img/logos/logo.svg" alt="" height="40" /></div>
    </a>
    <ul class="navbar-nav align-items-center d-none d-lg-block">
        <li class="nav-item">
            <!-- <div class="search-box">
        <form class="position-relative" data-toggle="search" data-display="static">

          <input class="form-control search-input" type="search" placeholder="Search..." aria-label="Search" />
          <span class="fas fa-search search-box-icon"></span>

        </form>
      </div> -->
        </li>
    </ul>
    <ul class="navbar-nav navbar-nav-icons ml-auto flex-row align-items-center">
        <li class="nav-item dropdown dropdown-on-hover"><a class="nav-link pr-0" id="navbarDropdownUser" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-xl">
                    <img class="rounded-circle" src="<?php if (session()->get('admin_picture')) {
                                                            echo base_url() . getenv('dir.upload.profile') . session()->get('admin_picture') ?><?php } else {
                                                                                                                                    echo base_url() ?>assets/img/team/avatar.png<?php } ?>" alt="Image" id="photo_profile_in_top_menu" />
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right py-0" aria-labelledby="navbarDropdownUser">
                <div class="bg-white rounded-soft py-2">
                    <a class="dropdown-item font-weight-bold text-warning" href="<?php echo site_url("admin2053/dashboard") ?>"><span class="fas fa-user mr-1"></span><span><?php echo session()->get('admin_name') ?></span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo site_url("admin2053/profile") ?>">Setting Profile</a>
                    <a class="dropdown-item" href="<?php echo site_url("admin2053/logout") ?>">Logout</a>
                </div>
            </div>
        </li>
    </ul>
</nav>