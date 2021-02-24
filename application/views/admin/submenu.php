<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Submenu Management</h1>


    <div class="row">
        <div class="col-lg">

            <!-- error message -->
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= validation_errors(); ?>
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

            <!-- found query message -->
            <?php if ($this->session->flashdata('foundQuery')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('foundQuery'); ?> data found
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>



            <!-- add submenu button -->
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#subMenu">Add Submenu</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Submenu</th>
                        <th scope="col">Menu</th>
                        <th scope="col">URL</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sub_menu as $sm) : ?>
                        <tr>
                            <th scope="row"><?= ++$start; ?></th>
                            <td><?= $sm['title']; ?></td>
                            <td><?= $sm['menu']; ?></td>
                            <td><?= $sm['url']; ?></td>
                            <td><i class="<?= $sm['icon']; ?>"></i> <?= $sm['icon']; ?></td>
                            <?php if ($sm['is_active'] == 1) : ?>
                                <td class="text-primary">Active</>
                                <?php else : ?>
                                <td class="text-muted">Not Active</td>
                            <?php endif; ?>
                            <td>
                                <a href="<?= base_url('admin/editsubmenu/') . $sm['id']; ?>" class="text-success" title="Edit"><i class="fas fa-fw fa-edit"></i></a>
                                <a href="<?= base_url('admin/subdelete/') . $sm['id']; ?>" class="text-danger deleteBtn" title="Delete"><i class="fas fa-fw fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $this->pagination->create_links(); ?>
        </div>
    </div>


    <!-- Modal add submenu -->
    <div class="modal fade" id="subMenu" tabindex="-1" aria-labelledby="subMenuLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="subMenuLabel">Add Submenu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/addsubmenu'); ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Submenu Name">
                        </div>
                        <div class="form-group">
                            <select name="menu_id" id="menu_id" class="form-control">
                                <option value="">Select Menu</option>
                                <?php foreach ($menu as $m) : ?>
                                    <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon">
                            <small>More icon on <a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank">Font Awesome</a></small>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                                <label class="form-check-label" for="is_active">
                                    Submenu Active?
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Submenu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jika keyword  !== record or column -->
    <?php if (empty($sub_menu)) : ?>
        <div class="alert alert-danger" role="alert">
            Data not found!
        </div>
    <?php endif; ?>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->