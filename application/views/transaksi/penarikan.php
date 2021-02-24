<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Riwayat <?= $title; ?></h1>

    <div class="row">
        <div class="col">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jumlah (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <!-- foreach -->
                    <?php foreach ($users as $u) : ?>

                        <?php if ($user['id'] == $u['user_id']) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= date('j M, Y (H:i:s a)', $u['date']); ?></td>
                                <td><?= $u['total']; ?></td>
                            </tr>
                            <?php $i++; ?>
                        <?php endif; ?>

                        <!-- endforeach -->
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->