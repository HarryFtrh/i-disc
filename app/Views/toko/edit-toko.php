<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>
        <h3 class="font-weight-bold">Edit Data barang</h3>
        <form action="<?= base_url(); ?>/tokocontroller/update/<?= $toko['id_toko']; ?>" method="post">
            <?= csrf_field(); ?>
            <div class="form-group">
                <label class="form-label">Nama Toko</label>
                <input name="nama" type="text" value="<?= $toko['nama_toko']; ?>" class="form-control <?= ($valid->hasError('nama')) ? 'is-invalid' : ''; ?>" placeholder="Nama barang...">
                <div class="invalid-feedback">
                    <?= $valid->getError('nama'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Alamat Toko</label>
                <textarea name="alamat" class="form-control" rows="4" placeholder="Alamat toko..."><?= $toko['alamat_toko']; ?></textarea>
                <div class="invalid-feedback">
                    <?= $valid->getError('alamat'); ?>
                </div>
            </div>                                    
            <div class="form-group">
                <label class="form-label">Channel</label>
                <select name="chanel" class="form-control">
                    <option value="Apotek" <?= ($toko['chanel'] == 'Apotek') ? 'selected' : ''; ?>>Apotek</option>
                    <option value="PBF" <?= ($toko['chanel'] == 'PBF') ? 'selected' : ''; ?>>PBF</option>
                    <option value="Toko Obat" <?= ($toko['chanel'] == 'Toko Obat') ? 'selected' : ''; ?>>Toko Obat</option>
                </select>                        
            </div>   
            <div class="form-group">
                <label class="form-label">Region</label>
                <select name="region" class="form-control">
                    <option value="<?= $toko['region']; ?>" selected><?= $toko['region']; ?></option>
                    <?php foreach($region as $r): ?>
                        <option value="<?= $r['name']; ?>" class="<?= ($r['name'] == $toko['region']) ? 'd-none' : ''; ?>"><?= $r['name']; ?></option>
                    <?php endforeach ?>
                </select>
            </div>                          
            <div class="form-group">
                <a href="<?= base_url(); ?>/data-toko" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-success">Update toko</button>
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
