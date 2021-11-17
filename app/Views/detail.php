<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-3">Detail peminjaman</h2>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $pinjamBarang['peminjam']; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">tanggal pinjam: <?= $pinjamBarang['tgl_pinjam']; ?></h6>
                    <h6 class="card-subtitle mb-2 text-muted d-inline">tanggal kembali: <?= $pinjamBarang['tgl_kembali']; ?></h6>
                    <p class="card-text"><?= $pinjamBarang['nama_barang']; ?></p>
                    <form action="/pinjam/<?= $pinjamBarang['id_pinjam']; ?>" method="POST" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-white" onclick="return confirm('yaqueen?');"><i class="fas fa-trash text-danger"></i></button>
                    </form>
                    <a href="">
                        <i class="fas fa-pencil-alt text-warning"></i>
                    </a>
                    <br><br>
                    <a href="/home" class="btn btn-dark">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>