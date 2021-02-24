<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 ">Change Password for</h1>
                                    <h5 class="mb-4"><?= $this->session->userdata('reset_email'); ?></h5>
                                </div>

                                <?= $this->session->flashdata('message'); ?>
                                <form class="user" method="POST" action="<?= base_url('auth/changePassword'); ?>">
                                    <!-- password 1 -->
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Enter New password....">
                                        <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>

                                    <!-- password 2 -->
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat password....">
                                        <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-user btn-block">
                                        Change Password
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>