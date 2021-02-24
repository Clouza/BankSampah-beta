<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <form action="" method="post">
                <div class="form-group">
                    <label for="role">Role Name</label>
                    <input type="text" class="form-control" id="role" name="role" value="<?= $role['role'] ?>">
                    <?= form_error('role', '<small class="text-danger pl-3">',  '</small>') ?>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->