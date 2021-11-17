<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <?php if (session()->getFlashdata('logged')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>hallo <?= session()->get('name'); ?></h5>
            </hr />
            <?php echo session()->getFlashdata('logged'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="container bg-white rounded-20 p-5">
                <div class="row">
                    <div class="col">
                        <h2 class="fw-bold">data pinjaman</h2>
                    </div>
                    <div class="col">
                        <button class="btn btn-plus float-end">
                            <i class="fas fa-plus" style="color: #3554d1"></i>
                        </button>
                    </div>
                </div>

                <div class="row">
                    <div class="col">No</div>
                    <div class="col">Nama barang</div>
                    <div class="col">peminjam</div>
                    <div class="col">tgl pinjam</div>
                    <div class="col">tgl kembali</div>
                    <div class="col">Action</div>
                </div>
                <?php $i = 1; ?>
                <?php foreach ($pinjamBarang as $us) : ?>
                    <div class="row my-4 p-2 border-dark border-bottom">
                        <div class="col"><?= $i++; ?></div>
                        <div class="col"><?= $us['nama_barang']; ?></div>
                        <div class="col"><?= $us['peminjam']; ?></div>
                        <div class="col"><?= $us['tgl_pinjam']; ?></div>
                        <div class="col"><?= $us['tgl_kembali']; ?></div>
                        <div class="col">
                            <button class="btn px-1">
                                <a href="/pinjam/<?= $us['id_pinjam']; ?>">
                                    <i class="fas fa-eye text-dark"></i>
                                </a>
                            </button>
                            <!-- <button class="btn px-1">
                                    <a href="">
                                        <i class="fas fa-pencil-alt text-warning"></i>
                                    </a>
                                </button>
                                <button class="btn px-1">
                                    <a href="">
                                        <i class="fas fa-trash text-danger"></i>
                                    </a>
                                </button> -->
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>