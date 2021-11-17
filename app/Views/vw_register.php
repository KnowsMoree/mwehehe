<?= $this->extend('layout/formTem'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="card mt-3">
        <div class="card-body">
            <h1>Register</h1>
            <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <h5>Kesalahan pada input</h5>
                    </hr />
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
            <form action="<?= base_url(); ?>/register/process" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Nama Anda" value="<?= old('username'); ?>">
                    </div>
                </div>
                <div class="row">
                    <label for="name" class="form-label">Name</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="name" name="name" placeholder="masukan nama lengkap anda" value="<?= old('name'); ?>">
                    </div>
                </div>
                <div class="row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-12">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password Anda" value="<?= old('password'); ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password_conf" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-12">
                        <input type="password" class="form-control" name="password_conf" id="password_conf" placeholder="Ulangi Password Anda" value="<?= old('password_conf'); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="foto" class="col-sm-2 col-form-label">foto</label>
                    <div class="col-sm-4">
                        <img src="/img/default.png" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <div class="input-group mb-3">
                            <input type="file" class="form-control <?= ($validation->hasError('foto') ? 'is-invalid' : ''); ?>" id="foto" name="foto" onchange="previewImg()">
                            <label class="input-group-text" for="foto">Avatar</label>
                            <div class="invalid-feedback">
                                <?= $validation->getError('foto'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn mt-3 regis">Register</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>