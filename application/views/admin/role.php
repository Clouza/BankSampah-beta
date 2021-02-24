<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Role Access Management</h1>


    <div class="row">
        <div class="col-lg-6">

            <!-- error message -->
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    The Role name field is required.
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


            <!-- add role button -->
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#role">Add Role</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($role as $rl) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $rl['role']; ?></td>
                            <td>
                                <a href="<?= base_url('admin/roleaccess/') . $rl['id']; ?>" class="text-warning" title="Access View"><i class="far fa-fw fa-eye"></i></a>
                                <a href="<?= base_url('admin/editrole/') . $rl['id']; ?>" class="text-success" title="Edit"><i class="fas fa-fw fa-edit"></i></a>
                                <a href="<?= base_url('admin/deleteRole/') . $rl['id']; ?>" class="text-danger deleteBtn" title="Delete"><i class="fas fa-fw fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="role" tabindex="-1" aria-labelledby="roleLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roleLabel">Add Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/role'); ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="role" name="role" placeholder="Role Name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->