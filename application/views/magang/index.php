<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Bank Sampah</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('frontEnd/src/'); ?>Style.css" />
    <link rel="stylesheet" href="<?= base_url('frontEnd/src/'); ?>mobile-style.css">
</head>

<body>
    <header>
        <div class="container-fluid p-0">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="#">
                    BankSampah</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-right text-light"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="mr-auto"></div>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>">HOME
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('auth/registration'); ?>">DAFTAR</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="container text-center">
            <div class="row">
                <div class="col-md-7 col-sm-12  text-white">
                    <h1>BankSampah</h1>
                    <p>
                        punya banyak sampah menumpuk di rumah? daripada menuhin rumah di bank sampah bisa jadi uang loh, tinggal click tombol
                        dibawah untuk daftar
                    </p>
                    <a href="<?= base_url('auth/registration'); ?>">
                        <button class="btn btn-light px-5 py-2 primary-btn">
                            Bergabung Disini
                        </button>
                    </a>
                </div>
                <div class="col-md-5 col-sm-12  h-25">
                    <img src="<?= base_url('frontEnd/assets/'); ?>header-img.png" alt="" style="width: 120% ; height: 120%;" />
                </div>
            </div>
        </div>
    </header>
    <main>
        <section class="section-1">
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="pray">
                            <img src="<?= base_url('frontEnd/assets/'); ?>pexels-photo-1904769.jpg" alt="" class="" />
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="panel text-left">
                            <h1>Bank sampah</h1>
                            <p class="pt-4">
                                Bank sampah adalah suatu tempat yang digunakan untuk mengumpulkan sampah yang sudah dipilah-pilah
                                Hasil dari pengumpulan sampah yang sudah dipilah akan disetorkan ke tempat pembuatan kerajinan dari
                                sampah atau ke tempat pengepul sampah.
                                Bank sampah dikelola menggunakan sistem seperti perbankkan yang dilakukan oleh petugas sukarelawan
                                Penyetor adalah warga yang tinggal di sekitar lokasi bank serta mendapat buku tabungan seperti menabung
                                di bank
                            </p>
                            <p>
                                Bank sampah berdiri karena adanya keprihatinan masyarakat akan lingkungan hidup yang semakin lama
                                semakin dipenuhi dengan sampah baik organik maupun anorganik.
                                Sampah yang semakin banyak tentu akan menimbulkan banyak masalah, sehingga memerlukan pengolahan seperti
                                membuat sampah menjadi bahan yang berguna.
                                Pengelolaan sampah dengan sistem bank sampah ini diharapkan mampu membantu pemerintah dalam menangani
                                sampah dan meningkatkan ekonomi masyarakat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section 2 -->
        <section class="section-2 container-fluid p-0 mt-5">
            <div class="cover">
                <div class="overlay"></div>
                <div class="content text-center">
                    <h1>Beberapa Fitur yang membuat kita unik</h1>
                    <p>

                    </p>
                </div>
            </div>
            <div class="container-fluid text-center">
                <div class="numbers d-flex flex-md-row flex-wrap justify-content-center">
                    <div class="rect">
                        <h1>10</h1>
                        <p>Client</p>
                    </div>
                </div>
            </div>


            <!-- Section 4 -->
            <section class="section-4">
                <div class="container text-center">
                    <h1 class="text-dark">What Your Reader's Say about us</h1>
                    <p class="text-secondary"></p>
                </div>

                <div class="team row ">

                    <!-- 1 -->
                    <div class="col-md-4 col-12 text-center">
                        <div class="card mr-2 d-inline-block shadow-lg">
                            <div class="card-img-top">
                                <img src="<?= base_url('frontEnd/assets/'); ?>UI-face-1.jpg" class="img-fluid border-radius p-4" alt="">
                            </div>
                            <div class="card-body">
                                <h3 class="card-title">Ardita</h3>
                                <p class="card-text">

                                </p>
                                <a href="https://instagram.com/arditayp" target="_blank" class="text-secondary text-decoration-none">Instagram</a>
                                <p class="text-black-50">Anak Magang</p>
                            </div>
                        </div>
                    </div>

                    <!-- 3 -->
                    <div class="col-md-4 col-12 text-center">
                        <div class="card mr-2 d-inline-block shadow-lg">
                            <div class="card-img-top">
                                <img src="<?= base_url('frontEnd/assets/'); ?>UI-face-1.jpg" class="img-fluid border-radius p-4" alt="">
                            </div>
                            <div class="card-body">
                                <h3 class="card-title">Siwa</h3>
                                <p class="card-text">

                                </p>
                                <a href="https://instagram.com/siwanandarjsa" target="_blank" class="text-secondary text-decoration-none">Instagram</a>
                                <p class="text-black-50">Anak Magang</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-12 text-center">
                        <div class="card mr-2 d-inline-block shadow-lg">
                            <div class="card-img-top">
                                <img src="<?= base_url('frontEnd/assets/'); ?>UI-face-2.jpg" class="img-fluid border-radius p-4" alt="">
                            </div>
                            <div class="card-body">
                                <h3 class="card-title">Ruben</h3>
                                <p class="card-text">

                                </p>
                                <a href="https://instagram.com/rubenchris_" target="_blank" class="text-secondary text-decoration-none">Instagram</a>
                                <p class="text-black-50">Anak Magang</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </main>
    <footer>
        <div class="container-fluid p-0">
            <div class="row text-left">
                <div class="col-md-5 col-sm-5">
                    <h4 class="text-light">About us</h4>
                    <p class="text-muted">
                        Kami Bertiga Anak Magang Trial 2 bulan
                    </p>
                </div>
                <div class="col-md-5 col-sm-12">
                    <h4 class="text-light">Web lumonata</h4>
                    <a class="" href="https://www.lumonata.com/" . target="_blank">www.lumonata.com</a>
                    <form class="form-inline">
                        <div class="col pl-0">

                        </div>
                    </form>
                </div>
                <div class="col-md-2 col-sm-12">
                    <h4 class="text-light">Follow Us</h4>
                    <p class="text-muted">Let us be social</p>
                    <div class="column text-light">
                        <a href="https://id-id.facebook.com/lumonata" target="_blank" class="mr-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/lumonata/" target="_blank" class="mr-2"><i class="fab fa-instagram"></i></a>
                        <a href="https://twitter.com/lumonata" target="_blank" class="mr-2"><i class="fab fa-twitter"></i></a>
                        <a href="" target="_blank" class="mr-2"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="<?= base_url('frontEnd/src/'); ?>main.js"></script>
</body>

</html>