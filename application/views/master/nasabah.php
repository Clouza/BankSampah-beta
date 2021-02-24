<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">List Nasabah</h1>


    <!-- success message -->
    <?php if ($this->session->flashdata('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('message'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- daftar user -->
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Address</th>
                <th scope="col">Bank Name</th>
                <th scope="col">Since</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- perulangan nomer -->
            <?php $i = 1; ?>

            <!-- daftar semua user -->
            <?php foreach ($banks as $u) : ?>

                <!-- hanya user dengan role 2 -->
                <?php if ($u['role_id'] == 2) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $u['name']; ?></td>
                        <td><?= $u['email']; ?></td>
                        <td><?= $u['address']; ?></td>

                        <!-- nama bank sampah -->
                        <td><?= $u['nama_bank']; ?></td>
                        <td><?= date('D, d F Y', $u['date_created']); ?></td>
                        <td>
                            <a href="<?= base_url('master/deleteNSB/') . $u['id']; ?>" class="badge badge-danger deleteBtn">delete</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <!-- tutup perulangan nomer -->
                <?php endif; ?>
                <!-- tutup user role 2 -->


            <?php endforeach; ?>
            <!-- tutup daftar user -->
        </tbody>
    </table>
</div>


</div>
<!-- End of Main Content -->