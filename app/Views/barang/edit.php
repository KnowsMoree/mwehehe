<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="card mt-3">
        <div class="card-body">
            <h1>Tambah barang</h1>

            <form action="<?= base_url(); ?>/barang/update/<?= $barang['id_barang']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="slug" value="<?= $barang['slug']; ?>">
                <div class="row">
                    <label for="nama_barang" class="col-sm-2 col-form-label">Nama barang</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control <?= ($validation->hasError('nama_barang') ? 'is-invalid' : ''); ?>" name="nama_barang" id="nama_barang" placeholder="Nama Barang" value="<?= (old('nama_barang')) ? old('nama_barang') : $barang['nama_barang']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_barang'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="spesifikasi" class="col-sm-2 col-form-label">spesifikasi</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control <?= ($validation->hasError('spesifikasi') ? 'is-invalid' : ''); ?>" name="spesifikasi" id="spesifikasi" placeholder="Spesifikasi" value="<?= (old('spesifikasi')) ? old('spesifikasi') : $barang['spesifikasi']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('spesifikasi'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="kondisi" class="col-sm-2 col-form-label">kondisi</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control <?= ($validation->hasError('kondisi') ? 'is-invalid' : ''); ?>" name="kondisi" id="kondisi" placeholder="Kondisi" value="<?= (old('kondisi')) ? old('kondisi') : $barang['kondisi']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('kondisi'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="jumlah_barang" class="col-sm-2 col-form-label">Jumlah Barang</label>
                    <div class="col-sm-12">
                        <input type="number" class="form-control <?= ($validation->hasError('jumlah_barang') ? 'is-invalid' : ''); ?>" name="jumlah_barang" id="jumlah_barang" placeholder="Jumlah Barang" value="<?= (old('jumlah_barang')) ? old('jumlah_barang') : $barang['jumlah_barang']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('jumlah_barang'); ?>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn mt-3 regis">Ubah barang</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>