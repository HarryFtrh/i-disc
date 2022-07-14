<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>
        <h3 class="font-weight-bold">Edit Data barang</h3>
        <form action="<?= base_url(); ?>/barangcontroller/update/<?= $barang['id_barang']; ?>" method="post">
            <?= csrf_field(); ?>
            <div class="form-group">
                <label class="form-label">Nama Barang</label>
                <input name="nm_barang" type="text" value="<?= $barang['nama_barang']; ?>" class="form-control <?= ($valid->hasError('nm_barang')) ? 'is-invalid' : ''; ?>" placeholder="Nama barang...">
                <div class="invalid-feedback">
                    <?= $valid->getError('nm_barang'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Box/Pcs</label>
                <input name="pcs" type="text" value="<?= $barang['box/pcs']; ?>" class="form-control <?= ($valid->hasError('pcs')) ? 'is-invalid' : ''; ?>"  placeholder="Masukan angka...">
                <div class="invalid-feedback">
                    <?= $valid->getError('pcs'); ?>
                </div>
            </div>                                     
            <div class="form-group">
                <label class="form-label">Harga Barang</label>
                <input name="harga" type="text" value="<?= $barang['harga']; ?>" class="form-control <?= ($valid->hasError('harga')) ? 'is-invalid' : ''; ?>" placeholder="Masukan harga...">
                <div class="invalid-feedback">
                    <?= $valid->getError('harga'); ?>
                </div>
            </div>                                          
            <div class="form-group">
                <a href="<?= base_url(); ?>/data-barang" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-success">Update barang</button>
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
