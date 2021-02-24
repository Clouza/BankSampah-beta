<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <!-- error message -->
            <?php if ($this->session->flashdata('messageError')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('messageError'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <!-- success message -->
            <?php if ($this->session->flashdata('message')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('message'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>


            <form action="<?= base_url('user/cpassword'); ?>" method="post">
                <!-- current password -->
                <div class="form-group">
                    <label for="current">Current Password</label>
                    <input type="password" name="currentpw" class="form-control" id="current" aria-describedby="passwordHelp">
                    <?= form_error('currentpw', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <!-- change password -->
                <div class="form-group">
                    <label for="change">Change Password</label>
                    <input type="password" name="password1" class="form-control" id="change" aria-describedby="passwordHelp">
                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <!-- repeat password -->
                <div class="form-group">
                    <label for="repeat">Repeat Password</label>
                    <input type="password" name="password2" class="form-control" id="repeat" aria-describedby="passwordHelp">
                    <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->