<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-3">Detail Barang</h2>
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title"><?= $barang['nama_barang']; ?></h2>
                    <h6 class="card-subtitle mb-2 text-muted">spesifikasi: <?= $barang['spesifikasi']; ?></h6>
                    <h6 class="card-subtitle mb-2 text-muted d-inline">kondisi: <?= $barang['kondisi']; ?></h6>
                    <p class="card-text">Jumlah Barang: <?= $barang['jumlah_barang']; ?></p>
                    <form action="/barang/<?= $barang['id_barang']; ?>" method="POST" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-white" onclick="return confirm('yaqueen?');"><i class="fas fa-trash text-danger"></i></button>
                    </form>
                    <a href="/barang/edit/<?= $barang['slug']; ?>">
                        <i class="fas fa-pencil-alt text-warning"></i>
                    </a>
                    <br><br>
                    <a href="/barang" class="btn btn-dark">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>