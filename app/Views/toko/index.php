<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>
        <h3 class="font-weight-bold">Data Toko</h3>
        <button class="btn btn-primary my-2" data-toggle="modal" data-target="#tambahUser">Tambah data</button>
        <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
            <div class="card-header">Data Toko</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="toko">
                        <thead>
                        <tr>
                            <th class="align-middle">No</th>
                            <th class="align-middle">Kode Toko</th>
                            <th class="align-middle">Nama Toko</th>
                            <th class="align-middle">Alamat Toko</th>
                            <th class="align-middle">Channel</th>
                            <th class="align-middle">Region</th>
                            <th class="align-middle">Aksi</th>
                        </tr>
                        </thead>
                        <tbody style="text-transform: capitalize;">
                            <?php 
                                $no = 1;  
                                foreach($toko as $tk):                                                                        
                            ?>
                        <tr>
                            <td class="align-middle"><?= $no++; ?></td>
                            <td class="align-middle"><?= $tk['kode_toko']; ?></td>
                            <td class="align-middle"><?= $tk['nama_toko']; ?></td>
                            <td class="align-middle">
                                <?= $tk['alamat_toko']; ?>
                            </td>                                                     
                            <td class="align-middle">
                                    <?= $tk['chanel']; ?>
                            </td>   
                            <td class="align-middle">
                                    <?= $tk['region']; ?>
                            </td>                             
                            <td class="align-middle">
                                    <div class="d-flex inline-block justify-content-center">
                                        <form action="<?= base_url(); ?>/tokocontroller/delete/<?= $tk['id_toko']; ?>" method="post">
                                            <button type="submit" class="btn btn-danger btn-sm mr-1" onclick="return confirm('Yakin ingin menghapus toko ini?')"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                        <a href="<?= base_url(); ?>/data-toko/edit/<?= $tk['id_toko']; ?>" class="btn btn-sm btn-primary">Edit</a>
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
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Form Tambah Toko</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url(); ?>/tokocontroller/tambahToko" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label class="form-label">Kode Toko</label>
                        <input name="kd_toko" type="text" value="<?= old('kd_toko'); ?>" class="form-control <?= ($valid->hasError('kd_toko')) ? 'is-invalid' : ''; ?>" placeholder="Kode toko...">
                        <div class="invalid-feedback">
                            <?= $valid->getError('kd_toko'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama Toko</label>
                        <input name="nama" type="text" value="<?= old('nama'); ?>" class="form-control <?= ($valid->hasError('nama')) ? 'is-invalid' : ''; ?>" placeholder="Nama toko...">
                        <div class="invalid-feedback">
                            <?= $valid->getError('nama'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Alamat Toko</label>
                        <textarea name="alamat" class="form-control" rows="4" placeholder="Alamat toko..."><?= old('alamat'); ?></textarea>
                        <div class="invalid-feedback">
                            <?= $valid->getError('alamat'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Channel</label>
                        <select name="chanel" class="form-control">
                            <option value="Apotek">Apotek</option>
                            <option value="PBF">PBF</option>
                            <option value="Toko Obat">Toko Obat</option>
                        </select>                        
                    </div>
                    <div class="form-group">
                        <label class="form-label">Region</label>
                        <select name="region" class="form-control">
                            <?php foreach($region as $r): ?>
                                <option value="<?= $r['name']; ?>"><?= $r['name']; ?></option>
                            <?php endforeach ?>
                        </select>
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
        $('#toko').DataTable({
            'ordering' : false
        });
    });
</script>
<?= $this->endSection('js'); ?>
