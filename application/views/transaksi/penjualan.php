<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tanggal Setor</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Kode Sampah</th>
                        <th scope="col">Jumlah Satuan</th>
                        <th scope="col">Satuan</th>
                        <th scope="col">Jumlah Rupiah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($penjualan as $p) : ?>
                        <?php if ($user['id'] == $p['user_id']) : ?>
                            <?php if ($p['is_sold'] == 1) : ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= date('d / M / Y', $p['tanggal']); ?></td>
                                    <td><?= $p['nama_sampah']; ?></td>
                                    <td><?= $p['kode_sampah']; ?></td>
                                    <td><?= $p['jumlah_satuan']; ?></td>
                                    <td style="text-transform: uppercase;"><?= $p['satuan']; ?></td>
                                    <td><?= $p['jual_jumlah']; ?></td>
                                </tr>
                            <?php endif; ?>
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