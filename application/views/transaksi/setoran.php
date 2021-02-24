<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <form action="<?= base_url('transaksi/setoran2'); ?>" method="post">
        <div class="row">
            <div class="col-lg-6">
                <!-- nama barang -->
                <div class="form-group">
                    <label for="exampleInputnama">Nama Barang</label>
                    <input type="text" class="form-control" id="exampleInputnama" name="namaBarang">
                </div>

                <!-- jumlah & satuan -->
                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" class="form-control mb-2" id="jumlah" name="jumlah" placeholder="Jumlah" required>
                    <select name="satuan" id="" class="custom-select">
                        <option value="">-- Satuan --</option>
                        <option name="kg" value="kg">KG</option>
                        <option name="gr" value="gram">GRAM</option>
                        <option name="ltr" value="liter">LITER</option>
                    </select>
                </div>

                <div class="form-group">
                    <!-- select option -->
                    <!-- jenis barang -->
                    <select name="jenis" id="jenis" class="custom-select">

                        <option value="" name="">-- Jenis Barang --</option>
                        <option value="plastik" name="plastik" class="text-primary">Plastik Lembaran</option>
                        <option value="pet" name="pet" class="text-success">PET</option>
                        <option value="besi" name="besi" class="text-danger">Besi Bekas</option>
                        <option value="kardus" name="kardus" class="text-warning">Kardus bekas</option>
                        <option value="kaleng" name="kaleng" class="text-info">Kaleng</option>
                        <option value="botol kaca" name="botol kaca" class="text-dark">Botol Kaca </option>
                        <option value="lain lain" name="lain lain" class="text-secondary">Lain - Lain</option>

                    </select>
                </div>

                <div class="form-group">
                    <!-- kode barang -->
                    <select name="kode" id="kode" class="custom-select">
                        <option value="" name="">-- Kode Barang --</option>

                        <!-- plastik -->
                        <option value="pls" name="pls" class="text-primary">PLS</option>
                        <option value="plk" name="plk" class="text-primary">PLK</option>
                        <option value="plc" name="plc" class="text-primary">PLC</option>
                        <option value="plb" name="plb" class="text-primary">PLB</option>
                        <option value="pes" name="pes" class="text-primary">PES</option>

                        <!-- pet -->
                        <option value="pet" name="pet" class="text-success">PET</option>
                        <option value="pbb" name="pbb" class="text-success">PBB</option>
                        <option value="pbm" name="pbm" class="text-success">PBM</option>
                        <option value="pbw" name="pbw" class="text-success">PBW</option>
                        <option value="pbt" name="pbt" class="text-success">PBT</option>
                        <option value="pba" name="pba" class="text-success">PBA</option>
                        <option value="gab" name="gab" class="text-success">GAB</option>

                        <!-- besi -->
                        <option value="bbk" name="bbk" class="text-danger">BBK</option>
                        <option value="bbb" name="bbb" class="text-danger">BBB</option>
                        <option value="alm" name="alm" class="text-danger">ALM</option>
                        <option value="omp" name="omp" class="text-danger">OMP</option>

                        <!-- kardus -->
                        <option value="krt" name="krt" class="text-warning">KRT</option>
                        <option value="hvs" name="hvs" class="text-warning">HVS</option>
                        <option value="kbr" name="kbr" class="text-warning">KBR</option>
                        <option value="dpl" name="dpl" class="text-warning">DPL</option>
                        <option value="krd" name="krd" class="text-warning">KTD</option>

                        <!-- kaleng -->
                        <option value="klg" name="klg" class="text-info">KLG</option>
                        <option value="kol" name="kol" class="text-info">KOL</option>
                        <option value="jrg" name="jrg" class="text-info">JRG</option>
                        <option value="emp" name="emp" class="text-info">EMP</option>

                        <!-- botol kaca -->
                        <option value="btl" name="btl" class="text-dark">BTL</option>
                        <option value="bbb" name="bbb" class="text-dark">BBB</option>
                        <option value="bbk" name="bbk" class="text-dark">BBK</option>

                        <!-- lain - lain -->
                        <option value="mjl" name="mjl" class="text-secondary">MJL</option>
                        <option value="mgt" name="mgt" class="text-secondary">MGT</option>
                    </select>
                    <small>Syarat jenis dan kode barang: <a href="<?= base_url('daftar') ?>"><u>klik disini</u></a></small>
                </div>
                <button type="submit" class="btn btn-primary">Setor Sekarang</button>
            </div>
        </div>
    </form>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->