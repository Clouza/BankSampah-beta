<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $users['id']; ?>">
                <!-- name -->
                <div class="form-group">
                    <label for="exampleInputname">Name</label>
                    <input type="text" class="form-control" id="exampleInputname" name="name" value="<?= $users['name']; ?>">
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <!-- email -->
                <div class="form-group">
                    <label for="exampleInputemail">Email</label>
                    <input type="email" class="form-control" id="exampleInputname" name="email" value="<?= $users['email']; ?>">
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <!-- address -->
                <div class="form-group">
                    <label for="exampleInputaddress">Address</label>
                    <input type="text" class="form-control" id="exampleInputname" name="address" value="<?= $users['address']; ?>">
                    <?= form_error('address', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <!-- telp -->
                <div class="form-group">
                    <label for="exampleInputtelp">Telp</label>
                    <input type="text" class="form-control" id="exampleInputname" name="telp" value="<?= $users['telp']; ?>">
                    <?= form_error('telp', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <!-- role -->
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="custom-select">
                        <?php foreach ($role as $r) : ?>
                            <?php if ($r['id'] == $users['role_id']) : ?>
                                <option value="<?= $r['id']; ?>" selected><?= $r['role']; ?></option>
                            <?php else : ?>
                                <option value="<?= $r['id']; ?>"><?= $r['role']; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- button -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->