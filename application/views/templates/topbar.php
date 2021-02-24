<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- about -->
            <a href="<?= base_url('user/about'); ?>"><i class="far fa-address-card fa-2x text-success" title="About"></i></a>

            <!-- github -->
            <!-- <div class="dropdown">
                <span style="color: #333;" id="instagramAccount" data-toggle="dropdown">
                    <i class="fab fa-fw fa-github fa-2x"></i>
                </span>
                <div class="dropdown-menu shadow animated--grow-in" aria-labelledby="instagramAccount">
                    <a href="https://github.com/Clouza" target="_blank" class="dropdown-item">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Siwananda
                    </a>
                </div>
            </div> -->

            <!-- instagram -->
            <!-- <div class="dropdown">
                <span style="color: #333;" id="instagramAccount" data-toggle="dropdown">
                    <i class="fab fa-fw fa-instagram fa-2x"></i>
                </span>
                <div class="dropdown-menu shadow animated--grow-in" aria-labelledby="instagramAccount">
                    <a href="https://instagram.com/siwanandarjsa" target="_blank" class="dropdown-item">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Siwananda
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="https://instagram.com/arditayp" target="_blank" class="dropdown-item">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Arditayasa
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="https://instagram.com/rubenchris_" target="_blank" class="dropdown-item">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Ruben
                    </a>
                </div>
            </div> -->

            <!-- Topbar Search -->
            <?php if ($this->uri->segment(2) == 'submenu') : ?>
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search anything in this page" name="keyword" autocomplete="off">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit" name="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                            <button class="btn btn-dark" name="refresh" title="Refresh this page">
                                <i class="fas fa-redo-alt fa-sm" title="Refresh this page"></i>
                            </button>
                        </div>
                    </div>
                </form>
            <?php endif; ?>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">


                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['name']; ?></span>
                        <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('user') ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="<?= base_url(); ?>" data-toggle="modal" data-target="#feedback">
                            <i class="fas fa-smile fa-sm fa-fw mr-2 text-gray-400"></i>
                            Give Feedback
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

            <!-- modal feedback -->
            <div class="modal fade" id="feedback" tabindex="-1" aria-labelledby="feedbackLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="feedbackLabel">Give Feedback</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('user/feedback') ?>" method="post">
                            <div class="modal-body">

                                <!-- feedback -->
                                <div class="form-group">
                                    <label for="feedback">You can write anything!</label>
                                    <textarea spellcheck="false" name="feedback" class="form-control" id="feedback" cols="30" rows="10" placeholder="Example: can you make feature like a infinity saldo? :v"></textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <small class="flex-start">Build with <s>brain</s> &#10084;</small>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </nav>
        <!-- End of Topbar -->