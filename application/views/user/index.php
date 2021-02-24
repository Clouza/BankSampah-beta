<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- success message -->
    <?php if ($this->session->flashdata('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('message'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- jika alamat tidak terisi -->
    <?php if ($user['address'] == "") : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            Alamat masih kosong, isi alamat <a href="<?= base_url('user/edit'); ?>">disini</a>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- jika telepon tidak terisi -->
    <?php if ($user['telp'] == "") : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            Telepon masih kosong, isi telepon <a href="<?= base_url('user/edit'); ?>">disini</a>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- card v1 -->
    <!-- <div class="row">
        <div class="col-lg">
            <div class="card" style="width: 18rem;">
                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail" style="width: 300px; height: 200px;" alt="<?= $user['image']; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['name']; ?></h5>
                    <p class="card-text"><?= $user['email']; ?></p>
                    <p class="card-text"><?= $user['address']; ?></p>
                    <p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $user['date_created']); ?></small></p>
                    <a href="<?= base_url('user/delete') ?>" class="text-danger deleteBtn"><i class="fas fa-fw fa-trash"></i> delete account</a>
                </div>
            </div>
        </div>
    </div> -->


    <!-- card v2 -->
    <div class="card shadow-sm" style="width: 18rem;">
        <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="rounded" style="width: 100%;" alt="<?= $user['image']; ?>">
        <div class="card-body border-left-success ">
            <h5 class="card-title"><?= $user['name']; ?></h5>
            <p class="card-text"><?= $user['email']; ?></p>
            <p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $user['date_created']); ?></small></p>
        </div>
        <ul class="list-group list-group-flush border-left-primary">
            <li class="list-group-item"><?= $user['address']; ?></li>
            <li class="list-group-item"><?= $user['telp']; ?></li>
        </ul>
        <div class="card-body border-left-danger">
            <a href="<?= base_url('user/delete') ?>" class="text-danger deleteBtn"><i class="fas fa-fw fa-trash"></i> delete account</a>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->