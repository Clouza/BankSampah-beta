<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">List Bank Sampah</h1>

    <div class="row">
        <div class="col-lg">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Bank Sampah</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Kontak Nama</th>
                        <th scope="col">Kontak WA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($bank as $b) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $b['nama_bank']; ?></td>
                            <td><?= $b['alamat']; ?></td>
                            <td><?= $b['kontak_nama']; ?></td>
                            <td>+62 <?= $b['telp']; ?></td>
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->