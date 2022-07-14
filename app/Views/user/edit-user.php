<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>
        <h3 class="font-weight-bold">Edit Data User</h3>
        <form action="<?= base_url(); ?>/usercontroller/update/<?= $users['id_user']; ?>" method="post">
            <?= csrf_field(); ?>
            <div class="form-group">
                <label class="form-label">Nama user</label>
                <input name="nama" type="text" value="<?= $users['nama_user']; ?>" class="form-control <?= ($valid->hasError('nama')) ? 'is-invalid' : ''; ?>" placeholder="Nama user...">
                <div class="invalid-feedback">
                    <?= $valid->getError('nama'); ?>
                </div>
            </div>                     
            <div class="form-group">
                <label class="form-label">Ganti Area</label>
                <select name="area" class="form-control">
                    <option value="<?= $users['area']; ?>"><?= $users['area']; ?></option>
                    <?php 
                    foreach($area as $ar): 
                        if($ar['area'] != $users['area']):
                    ?>
                    <option value="<?= $ar['id_area']; ?>"><?= $ar['area']; ?></option>
                    <?php endif;endforeach ?>
                </select>               
            </div>
            <div class="form-group">
                <label class="form-label">Ganti bagian</label>
                <select name="level" class="form-control">
                    <option value="Op" <?= ($users['level'] == 'Op') ? 'selected' :''; ?>>Operator</option>
                    <option value="admin" <?= ($users['level'] == 'admin') ? 'selected' :''; ?>>Admin</option>
                    <option value="user" <?= ($users['level'] == 'user') ? 'selected' :''; ?>>Sales</option>
                </select>               
            </div>
            <div class="form-group">
                <a href="<?= base_url(); ?>/data-user" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-success">Update user</button>
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
