<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>
        <h3 class="font-weight-bold">Data User</h3>
        <button class="btn btn-primary my-2" data-toggle="modal" data-target="#tambahUser">Tambah data</button>
        <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
            <div class="card-header">Data Anda</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover text-center">
                        <thead>
                        <tr>
                            <th class="align-middle">No</th>
                            <th class="align-middle">Nama</th>
                            <th class="align-middle">Username</th>
                            <th class="align-middle">Bergabung</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                foreach($users as $usr):
                                    if($usr['username'] == session('username')):
                            ?>
                        <tr>
                            <td class="align-middle"><?= $no++; ?></td>
                            <td class="align-middle">
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">                                        
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading"><?= $usr['nama_user']; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle"><?= $usr['username']; ?></td>
                            <td class="align-middle">
                                <div class="badge badge-success"><?= $usr['created_at']; ?></div>
                            </td>                                                     
                        </tr>   
                        <?php endif;endforeach ?>                     
                        </tbody>
                    </table>
                </div>                
            </div>
            </div>
        </div>
        </div>
        <div class="row mt-1">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
            <div class="card-header">Data Manager</div>
            <div class="card-body">                
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover text-center" id="admin">
                        <thead>
                        <tr>
                            <th class="align-middle">No</th>
                            <th class="align-middle">Nama</th>
                            <th class="align-middle">Username</th>
                            <th class="align-middle">Bergabung</th>
                            <th class="align-middle">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                foreach($users as $usr):
                                    if($usr['level'] == 'admin'):
                            ?>
                        <tr>
                            <td class="align-middle"><?= $no++; ?></td>
                            <td class="align-middle">
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">                                        
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading"><?= $usr['nama_user']; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle"><?= $usr['username']; ?></td>
                            <td class="align-middle">
                                <div class="badge badge-success"><?= $usr['created_at']; ?></div>
                            </td>
                            <td class="align-middle">
                                    <div class="d-flex inline-block justify-content-center">
                                        <form action="<?= base_url(); ?>/usercontroller/delete/<?= $usr['id_user']; ?>" method="post">
                                            <button type="submit" class="btn btn-danger btn-sm mr-1" onclick="return confirm('Yakin ingin menghapus user ini?')"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                        <a href="<?= base_url(); ?>/data-user/edit/<?= $usr['id_user']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                    </div>
                            </td>
                        </tr>   
                        <?php endif;endforeach ?>                     
                        </tbody>
                    </table>
                </div>   
            </div>             
            </div>
        </div>
        </div>
        <div class="row mt-1">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
            <div class="card-header">Data Sales</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover text-center" id="sales">
                        <thead>
                        <tr>
                            <th class="align-middle">No</th>
                            <th class="align-middle">Nama</th>
                            <th class="align-middle">Username</th>
                            <th class="align-middle">Area</th>
                            <th class="align-middle">Bergabung</th>
                            <th class="align-middle">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                foreach($users as $usr):
                                    if($usr['level'] == 'user'):
                            ?>
                        <tr>
                            <td class="align-middle"><?= $no++; ?></td>
                            <td class="align-middle">
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">                                        
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading"><?= $usr['nama_user']; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle"><?= $usr['username']; ?></td>
                            <td class="align-middle"><?= $usr['area']; ?></td>
                            <td class="align-middle">
                                <div class="badge badge-success"><?= $usr['created_at']; ?></div>
                            </td>
                            <td class="align-middle">
                                    <div class="d-flex inline-block justify-content-center">
                                        <form action="<?= base_url(); ?>/usercontroller/delete/<?= $usr['id_user']; ?>" method="post">
                                            <button type="submit" class="btn btn-danger btn-sm mr-1" onclick="return confirm('Yakin ingin menghapus user ini?')"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                        <a href="<?= base_url(); ?>/data-user/edit/<?= $usr['id_user']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                    </div>
                            </td>
                        </tr>   
                        <?php endif;endforeach ?>                     
                        </tbody>
                    </table>
                </div>                
            </div>
            </div>
        </div>
        </div>  
        <div class="row mt-1">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
            <div class="card-header">Data Super Visor</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover text-center" id="spv">
                        <thead>
                        <tr>
                            <th class="align-middle">No</th>
                            <th class="align-middle">Nama</th>
                            <th class="align-middle">Username</th>
                            <th class="align-middle">Atur Area</th>
                            <th class="align-middle">Bergabung</th>
                            <th class="align-middle">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                foreach($users as $usr):
                                    if($usr['level'] == 'spv'):
                            ?>
                        <tr>
                            <td class="align-middle"><?= $no++; ?></td>
                            <td class="align-middle">
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">                                        
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading"><?= $usr['nama_user']; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle"><?= $usr['username']; ?></td>
                            <td class="align-middle">
                                <a class="btn btn-secondary btn-sm" href="<?= base_url(); ?>/atur-area-spv/<?= $usr['id_user']; ?>">Cek/Atur Area</a>
                            </td>
                            <td class="align-middle">
                                <div class="badge badge-success"><?= $usr['created_at']; ?></div>
                            </td>
                            <td class="align-middle">
                                    <div class="d-flex inline-block justify-content-center">
                                        <form action="<?= base_url(); ?>/usercontroller/delete/<?= $usr['id_user']; ?>" method="post">
                                            <button type="submit" class="btn btn-danger btn-sm mr-1" onclick="return confirm('Yakin ingin menghapus user ini?')"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                        <a href="<?= base_url(); ?>/data-user/edit/<?= $usr['id_user']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                    </div>
                            </td>
                        </tr>                           
                        <?php endif;endforeach ?>                     
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
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Form Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url(); ?>/usercontroller/tambahUser" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label class="form-label">Nama user</label>
                        <input name="nama" type="text" value="<?= old('nama'); ?>" class="form-control <?= ($valid->hasError('nama')) ? 'is-invalid' : ''; ?>" placeholder="Nama user...">
                        <div class="invalid-feedback">
                            <?= $valid->getError('nama'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Username</label>
                        <input name="username" type="text" value="<?= old('username'); ?>" class="form-control <?= ($valid->hasError('username')) ? 'is-invalid' : ''; ?>" placeholder="Username...">
                        <div class="invalid-feedback">
                            <?= $valid->getError('username'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input name="password" type="password" value="<?= old('password'); ?>" class="form-control <?= ($valid->hasError('password')) ? 'is-invalid' : ''; ?>" placeholder="Password...">
                        <div class="invalid-feedback">
                            <?= $valid->getError('password'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Konfirmasi Password</label>
                        <input name="passwordconf" type="password" value="<?= old('passwordconf'); ?>" class="form-control <?= ($valid->hasError('passwordconf')) ? 'is-invalid' : ''; ?>" placeholder="Konfirmasi password...">
                        <div class="invalid-feedback">
                            <?= $valid->getError('passwordconf'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Pilih Area</label>
                        <select name="area" class="form-control">
                            <?php foreach($area as $ar): ?>
                                <option value="<?= $ar['id_area']; ?>"><?= $ar['area']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tambahkan sebagai</label>
                        <select name="level" id="level" class="form-control">
                            <option value="Op">Operator</option>
                            <option value="spv">Super Visor</option>
                            <option value="admin">Admin</option>
                            <option value="user">Sales</option>
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
        $('#admin').DataTable({
            'ordering' : false
        });
        $('#sales').DataTable({
            'ordering' : false
        });
        $('#spv').DataTable({
            'ordering' : false
        });
        $('#level').change(function(){
            var level = $('#level').val();
            if (condition) {
                
            }
        });
    });    
</script>
<?= $this->endSection('js'); ?>
