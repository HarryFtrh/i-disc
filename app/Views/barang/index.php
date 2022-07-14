<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>
        <h3 class="font-weight-bold">Data Barang</h3>
        <button class="btn btn-primary my-2 <?= (session('level') == 'user') ? 'd-none' : ''; ?>" data-toggle="modal" data-target="#tambahUser">Tambah data</button>
        <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
            <div class="card-header">Data Barang</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="barang">
                        <thead>
                        <tr>
                            <th class="align-middle">No</th>
                            <th class="align-middle">Kode Barang</th>
                            <th class="align-middle">Nama Barang</th>
                            <th class="align-middle">Box/Pcs</th>
                            <th class="align-middle">Harga</th>
                            <th class="align-middle">Diskon Rekomendasi</th>
                            <th class="align-middle <?= (session('level') == 'user') ? 'd-none' : ''; ?>">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                foreach($barang as $brg):
                            ?>
                        <tr>
                            <td class="align-middle"><?= $no++; ?></td>
                            <td class="align-middle"><?= $brg['kode_barang']; ?></td>
                            <td class="align-middle"><?= $brg['nama_barang']; ?></td>
                            <td class="align-middle">
                                <?= $brg['box/pcs']; ?> Pcs
                            </td>                                                     
                            <td class="align-middle">
                                Rp. <?= number_format($brg['harga']); ?>
                            </td>   
                            <td class="align-middle">
                                <?= $brg['disc_rekomendasi']; ?>%
                            </td>                                                     
                            <td class="align-middle <?= (session('level') == 'user') ? 'd-none' : ''; ?>">
                                    <div class="d-flex inline-block justify-content-center">
                                        <form action="<?= base_url(); ?>/barangcontroller/delete/<?= $brg['id_barang']; ?>" method="post">
                                            <button type="submit" class="btn btn-danger btn-sm mr-1" onclick="return confirm('Yakin ingin menghapus barang ini?')"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                        <a href="<?= base_url(); ?>/data-barang/edit/<?= $brg['id_barang']; ?>" class="btn btn-sm btn-primary">Edit</a>
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
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Form Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url(); ?>/barangcontroller/tambahBarang" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label class="form-label">Kode Barang</label>
                        <input name="kd_barang" type="text" value="<?= old('kd_barang'); ?>" class="form-control <?= ($valid->hasError('kd_barang')) ? 'is-invalid' : ''; ?>" placeholder="Kode barang...">
                        <div class="invalid-feedback">
                            <?= $valid->getError('kd_barang'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama Barang</label>
                        <input name="nm_barang" type="text" value="<?= old('nm_barang'); ?>" class="form-control <?= ($valid->hasError('nm_barang')) ? 'is-invalid' : ''; ?>" placeholder="Nama barang...">
                        <div class="invalid-feedback">
                            <?= $valid->getError('nm_barang'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Box/Pcs</label>
                        <input name="pcs" type="text" value="<?= old('pcs'); ?>" class="form-control <?= ($valid->hasError('pcs')) ? 'is-invalid' : ''; ?>" placeholder="Masukan angka...">
                        <div class="invalid-feedback">
                            <?= $valid->getError('pcs'); ?>
                        </div>
                    </div>                                     
                    <div class="form-group">
                        <label class="form-label">Harga Barang</label>
                        <input name="harga" type="text" value="<?= old('harga'); ?>" class="form-control <?= ($valid->hasError('harga')) ? 'is-invalid' : ''; ?>" placeholder="Masukan harga...">
                        <div class="invalid-feedback">
                            <?= $valid->getError('harga'); ?>
                        </div>
                    </div>   
                    <div class="form-group">
                        <label class="form-label">Disc Rekomendasi Barang</label>
                        <input name="rekomend" type="text" value="0" class="form-control <?= ($valid->hasError('rekomend')) ? 'is-invalid' : ''; ?>" placeholder="Masukan angka. contoh : 1">
                        <div class="invalid-feedback">
                            <?= $valid->getError('rekomend'); ?>
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
        $('#barang').DataTable({
            'ordering' : false
        });
    });
</script>
<?= $this->endSection('js'); ?>
