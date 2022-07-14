<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>
        <h3 class="font-weight-bold">Atur Area Supervisor</h3>
        <div class="bg-light shadow-sm mb-3 p-3" style="font-size: 0.95rem;">
            <span class="text-danger text-uppercase">Note!!</span> Pengaturan ini digunakan untuk mengatur area persetujuan/penolakan pengajuan oleh sales.
            <h5 class="mt-3 text-uppercase font-weight-bold">Data Supervisor</h5>
            <div class="col-5 mt-2">
                <table class="table table-borderless text-uppercase" style="font-size: 1rem;">
                    <tr>
                        <td class="align-middle">Nama Supervisor</td>
                        <td class="align-middle">:</td>
                        <td class="align-middle"><?= $users['nama_user']; ?></td>
                    </tr>
                    <tr>
                        <td class="align-middle">Username</td>
                        <td class="align-middle">:</td>
                        <td class="align-middle"><?= $users['username']; ?></td>
                    </tr>
                </table> 
            </div>
            <h5 class="mt-3 text-uppercase font-weight-bold">Area Supervisor</h5>
            <form action="<?= base_url(); ?>/usercontroller/actAtur/<?= $users['id_user']; ?>" method="post">
                <?= csrf_field(); ?>
                <div class="d-flex justify-content-start my-4" style="font-size: 1.4rem;">
                    <?php foreach($area as $a): ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" <?= ($a['ok'] == 1) ? 'checked' : ''; ?> type="checkbox" id="inlineCheckbox<?= $a['id_area']; ?>" name="areaSPV<?= $a['id_area']; ?>" value="<?= $a['id_area']; ?>">
                            <label class="form-check-label" for="inlineCheckbox<?= $a['id_area']; ?>"><?= $a['area']; ?></label>
                        </div>
                    <?php endforeach ?>
                </div>
                <div class="form-group">
                    <a href="<?= base_url(); ?>/data-user" class="btn btn-sm text-uppercase font-weight-bold btn-secondary">Back</a>
                    <button type="submit" class="btn btn-sm text-uppercase font-weight-bold btn-success">Atur Area</button>
                </div>       
            </form>           
        </div>
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
     <?php if (session()->getFlashdata('success')) { ?>
        iziToast.success({
            title : 'Success!',            
            message: "<?= session()->getFlashdata('success'); ?>",
            position: 'bottomLeft'
        });
    <?php } ?>
</script>
<?= $this->endSection('js'); ?>
