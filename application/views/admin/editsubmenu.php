<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <form action="" method="post">
                <!-- nama submenu -->
                <div class="form-group">
                    <label for="name">Submenu Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $submenu['title']; ?>">
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <!-- menu -->
                <div class="form-group">
                    <label for="menu">Menu</label>
                    <select name="menu" id="menu" class="custom-select">
                        <?php foreach ($menu as $m) : ?>
                            <?php if ($m['id'] == $submenu['menu_id']) : ?>
                                <option value="<?= $m['id']; ?>" selected><?= $m['menu']; ?></option>
                            <?php else : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- url -->
                <div class="form-group">
                    <label for="url">Submenu url</label>
                    <input type="text" class="form-control" id="url" name="url" value="<?= $submenu['url']; ?>">
                    <?= form_error('url', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <!-- icon -->
                <div class="form-group">
                    <label for="icon">Submenu icon</label>
                    <i class="<?= $submenu['icon']; ?>"></i>
                    <input type="text" class="form-control" id="icon" name="icon" value="<?= $submenu['icon']; ?>">
                    <small>More icon on <a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank">Font Awesome</a></small>
                    <?= form_error('icon', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <!-- active? -->
                <div class="form-group">
                    <div class="form-check">
                        <?php if ($submenu['is_active'] == 1) : ?>
                            <input type="checkbox" class="form-check-input" id="active" value="1" name="is_active" checked>
                        <?php else : ?>
                            <input type="checkbox" class="form-check-input" id="active" value="1" name="is_active">
                        <?php endif; ?>
                        <label for="active" class="form-check-label">Active?</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->