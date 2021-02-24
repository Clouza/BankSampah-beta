<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= form_open_multipart('user/edit'); ?>

            <!-- email -->
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" name="email" class="form-control" id="email" value="<?= $user['email']; ?>" readonly>
                    <small>Wanna change email? contact <u><a href="https://instagram.com/siwanandarjsa" target="_blank">Siwananda</a></u></small>
                </div>
            </div>

            <!-- name -->
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="name" value="<?= $user['name']; ?>">
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <!-- address -->
            <div class="form-group row">
                <label for="address" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-10">
                    <input type="text" name="address" class="form-control" id="address" value="<?= $user['address']; ?>">
                    <?= form_error('address', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <!-- telp -->
            <div class="form-group row">
                <label for="telp" class="col-sm-2 col-form-label">Telp</label>
                <div class="col-sm-10">
                    <input type="text" name="telp" class="form-control" id="telp" value="<?= $user['telp']; ?>">
                    <?= form_error('telp', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <!-- image -->
            <div class="form-group row">
                <div class="col-sm-2">Picture</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="<?= $user['image']; ?>" class="img-thumbnail">
                        </div>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image" name="image">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>

            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->