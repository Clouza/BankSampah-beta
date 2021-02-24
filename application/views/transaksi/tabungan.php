<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col">
            <div class="col-lg-4 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Saldo</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($user['saldo'], 2, ',', '.'); ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">

            <!-- saldo kurang message -->
            <?php if ($this->session->flashdata('message')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('message'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <!-- saldo message -->
            <?php if ($this->session->flashdata('messagee')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('messagee'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <h5>Tarik Saldo</h5>

            <form action="<?= base_url('transaksi/withdraw') ?>" method="post">
                <!-- 10k -->
                <!-- <?php if ($user['saldo'] < 10000) : ?>
                    <button type="button" class="btn btn-secondary disabled">Rp. 10000</button>
                <?php else : ?>
                    <button type="button" class="btn btn-primary" name="sepuluh">Rp. 10000</button>
                <?php endif; ?> -->

                <!-- 20k -->
                <!-- <?php if ($user['saldo'] < 20000) : ?>
                    <button type="button" class="btn btn-secondary disabled">Rp. 20000</button>
                <?php else : ?>
                    <button type="button" class="btn btn-primary" name="duapuluh">Rp. 20000</button>
                <?php endif; ?> -->

                <!-- 50k -->
                <!-- <?php if ($user['saldo'] < 50000) : ?>
                    <button type="button" class="btn btn-secondary disabled">Rp. 50000</button>
                <?php else : ?>
                    <button type="button" class="btn btn-primary" name="limapuluh">Rp. 50000</button>
                <?php endif; ?> -->

                <select name="saldo" class="custom-select mb-3">
                    <option value="">-- Pilih Nominal --</option>
                    <option value="sepuluh" name="sepuluh">Rp. 10000</option>
                    <option value="duapuluh" name="duapuluh">Rp. 20000</option>
                    <option value="limapuluh" name="limapuluh">Rp. 50000</option>
                </select>

                <button type="submit" class="btn btn-success">Tarik Saldo</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->