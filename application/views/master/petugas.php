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

    <div class="row">
        <div class="col-lg">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Telepon</th>
                        <th scope="col">Bank Sampah</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($banks as $b) : ?>
                        <?php if ($b['role_id'] == 12) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $b['name']; ?></td>
                                <td><?= $b['name']; ?></td>
                                <td><?= $b['address']; ?></td>
                                <?php if ($b['telp'] == 0 or $b['telp'] == '') : ?>
                                    <td>null</td>
                                <?php else : ?>
                                    <td><?= $b['telp']; ?></td>
                                <?php endif; ?>
                                <td><?= $b['nama_bank']; ?></td>
                                <td>
                                    <a href="<?= base_url('master/deletepetugas/') . $b['id']; ?>" class="badge badge-danger deleteBtn">delete</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->