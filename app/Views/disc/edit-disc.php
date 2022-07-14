<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>
        <h3 class="font-weight-bold">Edit Data Program Diskon</h3>
        <form action="<?= base_url(); ?>/disccontroller/update/<?= $disc['id_disc']; ?>" method="post">
            <?= csrf_field(); ?>
            <div class="form-group">
                <label class="form-label">Disc Reguler</label>
                <input name="reguler" type="text" value="<?= $disc['disc_reguler']; ?>" class="form-control <?= ($valid->hasError('reguler')) ? 'is-invalid' : ''; ?>" placeholder="Masukan angka. Contoh : 1">
                <div class="invalid-feedback">
                    <?= $valid->getError('reguler'); ?>
                </div>
            </div>                                                                               
            <div class="form-group">
                <label class="form-label">Promo Tanggal</label>
                <input name="promotgl" type="text" value="<?= $disc['promotgl']; ?>" class="form-control <?= ($valid->hasError('promotgl')) ? 'is-invalid' : ''; ?>" placeholder="Masukan angka. Contoh : 1">
                <div class="invalid-feedback">
                    <?= $valid->getError('promotgl'); ?>
                </div>
            </div>                                               
            <div class="form-group">
                <label class="form-label">Disc Klaim</label>
                <input name="disc_klaim" type="text" value="<?= $disc['disc_klaim']; ?>" class="form-control <?= ($valid->hasError('disc_klaim')) ? 'is-invalid' : ''; ?>" placeholder="Masukan angka. Contoh : 1">
                <div class="invalid-feedback">
                    <?= $valid->getError('disc_klaim'); ?>
                </div>
            </div>                                               
            <div class="form-group">
                <a href="<?= base_url(); ?>/data-program" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-success">Update program</button>
            </div>       
        </form>           
<?= $this->endSection('content'); ?>
<?= $this->Section('js'); ?>
<script>     
     <?php if (session()->getFlashdata('gagal')) { ?>
        iziToast.error({
            title : 'Failed!',            
            message: "<?= session()->getFlashdata('gagal'); ?>",
            position: 'bottomLeft'
        });
    <?php } ?>
</script>
<?= $this->endSection('js'); ?>
