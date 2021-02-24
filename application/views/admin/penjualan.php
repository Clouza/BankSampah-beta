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
                        <th scope="col">Nama Nasabah</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Kode Sampah</th>
                        <th scope="col">Jumlah Sampah</th>
                        <th scope="col">Satuan</th>
                        <th scope="col">Jumlah Jual</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($penjualan as $user) : ?>
                        <tr>
                            <th scope="row"><?= ++$start; ?></th>
                            <td><?= $user['name']; ?></td>
                            <td><?= $user['nama_sampah']; ?></td>
                            <td style="text-transform: uppercase;"><?= $user['kode_sampah']; ?></td>
                            <td><?= $user['jumlah_satuan']; ?></td>
                            <td style="text-transform: uppercase;"><?= $user['satuan']; ?></td>
                            <td>Rp. <?= $user['jual_jumlah']; ?></td>
                            <?php if ($user['is_sold'] == 1) : ?>
                                <td class="text-primary">Terjual</td>
                            <?php else : ?>
                                <td class="text-secondary">Belum Terjual</td>
                            <?php endif; ?>
                            <td>
                                <a href="<?= base_url('admin/jualBarang/') . $user['id']; ?>" class="badge badge-success">Jual</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $this->pagination->create_links(); ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->