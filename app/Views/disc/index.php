<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>
        <h3 class="font-weight-bold">Data Program Diskon</h3>
        <button class="btn btn-primary my-2" data-toggle="modal" data-target="#tambahUser">Tambah data</button>
        <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
            <div class="card-header">Data Program Diskon</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="disc">
                        <thead>
                        <tr>
                            <th class="align-middle">No</th>
                            <th class="align-middle">Disc Reguler</th>
                            <th class="align-middle">Promo Tanggal</th>
                            <th class="align-middle">Disc Klaim</th>
                            <th class="align-middle">Keterangan</th>
                            <th class="align-middle">Aksi</th>
                        </tr>
                        </thead>
                        <tbody style="text-transform: capitalize;">
                            <?php 
                                $no = 1;
                                foreach($disc as $disc):
                            ?>
                        <tr>
                            <td class="align-middle"><?= $no++; ?></td>
                            <td class="align-middle"><?= $disc['disc_reguler']; ?>%</td>
                            <td class="align-middle">
                                <?= $disc['promotgl']; ?>%
                            </td>                                                     
                            <td class="align-middle">
                                    <?= $disc['disc_klaim']; ?>%
                            </td>  
                            <td class="align-middle">
                                Promo Tanggal aktif di tanggal 1-15
                            </td>    
                            <td class="align-middle">
                                    <div class="d-flex inline-block justify-content-center">
                                        <form action="<?= base_url(); ?>/disccontroller/delete/<?= $disc['id_disc']; ?>" method="post">
                                            <button type="submit" class="btn btn-danger btn-sm mr-1" onclick="return confirm('Yakin ingin menghapus program diskon ini?')"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                        <a href="<?= base_url(); ?>/data-program/edit/<?= $disc['id_disc']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                    </div>
                            </td>                                                  
                        </tr>   
                        <?php endforeach ?>                     
                        </tbody>
                    </table>
                </div>                
            </div>
            </div>
        </div>
        </div>                   
<?= $this->endSection('content'); ?>
<?= $this->Section('modals'); ?>
<div class="modal fade" id="tambahUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Form Tambah Program Diskon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url(); ?>/disccontroller/tambahDisc" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label class="form-label">Disc Reguler</label>
                        <input name="reguler" type="text" value="<?= old('reguler'); ?>" class="form-control <?= ($valid->hasError('reguler')) ? 'is-invalid' : ''; ?>" placeholder="Masukan angka. contoh : 1">
                        <div class="invalid-feedback">
                            <?= $valid->getError('reguler'); ?>
                        </div>
                    </div>                                                                                                                                                                           
                    <div class="form-group">
                        <label class="form-label">Promo Tanggal</label>
                        <input name="promotgl" type="text" value="<?= old('promotgl'); ?>" class="form-control <?= ($valid->hasError('promotgl')) ? 'is-invalid' : ''; ?>" placeholder="Masukan angka. contoh : 1">
                        <div class="invalid-feedback">
                            <?= $valid->getError('promotgl'); ?>
                        </div>
                    </div>                                                                                                                                                                           
                    <div class="form-group">
                        <label class="form-label">Disc Klaim</label>
                        <input name="disc_klaim" type="text" value="<?= old('disc_klaim'); ?>" class="form-control <?= ($valid->hasError('disc_klaim')) ? 'is-invalid' : ''; ?>" placeholder="Masukan angka. contoh : 1">
                        <div class="invalid-feedback">
                            <?= $valid->getError('disc_klaim'); ?>
                        </div>
                    </div>                                                                                                                                                                           
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection('modals'); ?>
<?= $this->Section('js'); ?>
<script>
     <?php if (session()->getFlashdata('success')) { ?>
        iziToast.success({
            title : 'Success!',            
            message: "<?= session()->getFlashdata('success'); ?>",
            position: 'bottomLeft'
        });
    <?php } ?>

     <?php if (session()->getFlashdata('gagal')) { ?>
        iziToast.error({
            title : 'Failed!',            
            message: "<?= session()->getFlashdata('gagal'); ?>",
            position: 'bottomLeft'
        });
    <?php } ?>

    $(document).ready( function () {
        $('#disc').DataTable({
            'ordering' : false
        });
    });
</script>
<?= $this->endSection('js'); ?>
