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

    <!-- daftar user -->
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Address</th>
                <th scope="col">Telp</th>
                <th scope="col">Role</th>
                <th scope="col">Bank</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <!-- foreach -->
        <?php foreach ($users as $u) : ?>
            <tr>
                <th><?= ++$start; ?></th>
                <td><?= $u['name']; ?></td>
                <td><?= $u['email']; ?></td>
                <?php if ($u['address'] == "") : ?>
                    <td>null</td>
                <?php else : ?>
                    <td><?= $u['address']; ?></td>
                <?php endif; ?>
                <?php if ($u['telp'] == 0) : ?>
                    <td>null</td>
                <?php else : ?>
                    <td><?= $u['telp']; ?></td>
                <?php endif; ?>
                <td><?= $u['role']; ?></td>
                <td><?= $u['nama_bank']; ?></td>
                <td>
                    <a href="<?= base_url('admin/editUsers/') . $u['id']; ?>" class="text-success" title="Edit"><i class="fas fa-fw fa-edit"></i></a>
                    <a href="<?= base_url('admin/deleteUser/') . $u['id']; ?>" class="deleteBtn text-danger" title="Delete"><i class="fas fa-fw fa-trash"></i></a>
                </td>
            </tr>
            <!-- end of foreach -->
        <?php endforeach; ?>

        </tbody>
    </table>
    <?= $this->pagination->create_links(); ?>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->