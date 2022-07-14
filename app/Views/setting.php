<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>
<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>
    <h3 class="font-weight-bold">Setting your account</h3>
    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-center">
                <img src="<?= base_url(); ?>/assets/image/avatars/<?= session('avatar'); ?>" class="img-thumbnail img-preview rounded-circle" style="width: 15rem; height: 15rem;" alt="avatars">                                                                        
            </div>
            <h4 class="font-weight-bold text-center mt-1"><?= session('nama'); ?></h4>
            <table class="font-weight-bold mt-4" style="font-size: 1.3rem;">
                <tr>
                    <td>Username</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?= session('username'); ?></td>
                </tr>
                <tr>
                    <td>Area</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?= session('area'); ?></td>
                </tr>
                <tr>
                    <td>Waktu Bergabung</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?= date('d F Y H:i:s', strtotime(session('gabung'))); ?></td>
                </tr>
            </table>    
            <h4 class="font-weight-bold mt-5">Perbaharui Akun</h4>
            <form action="<?= base_url(); ?>/logincontroller/update_foto/<?= session('id_user'); ?>/<?= session('avatar'); ?>" method="post" enctype="multipart/form-data">
                <div class="row d-flex align-items-center">            
                    <div class="col-12 col-md-6 ">
                        <label class="form-label font-weight-bold" style="font-size: 1.1rem;">Foto Profil :</label>                              
                        <div class="input-group mb-3">  
                            <div class="custom-file">
                                <input type="file"  onchange="return imgPreview()" class="custom-file-input <?= ($valid->hasError('avatar')) ? 'is-invalid' : ''; ?> input-foto" id="inputGroupFile01" name="avatar">
                                <label class="custom-file-label label-input" for="inputGroupFile01">Pilih profil baru...</label>
                                <div class="invalid-feedback">
                                    <?= $valid->getError('avatar'); ?>
                                </div>
                            </div>
                        </div>
                    </div>      
                    <div class="col-12 col-md-2">
                        <button type="submit" class="btn btn-primary mt-2 mt-md-3">Perbaharui Foto</button>
                    </div>
                </div>                        
            </form>
            <form action="<?= base_url(); ?>/logincontroller/update_usr/<?= session('id_user'); ?>" method="post">
                <div class="row d-flex align-items-center mb-3">            
                    <div class="col-12">
                        <label class="form-label font-weight-bold" style="font-size: 1.1rem;">Username :</label>                              
                        <div class="row d-flex align-items-center">                    
                            <div class="col-12 col-md-6">
                                <input type="text" name="username" class="form-control <?= ($valid->hasError('username')) ? 'is-invalid' : ''; ?>" placeholder="Username baru">
                                <div class="invalid-feedback">
                                    <?= $valid->getError('username'); ?>
                                </div>
                            </div>                    
                            <div class="col-12 col-md-3">
                                <button type="submit" class="btn btn-primary mt-2 mt-md-0">Perbaharui Username</button>
                            </div>
                        </div>
                        
                    </div>                  
                </div>                        
            </form>
            <form action="<?= base_url(); ?>/logincontroller/update_pw/<?= session('id_user'); ?>" method="post">
                <div class="row d-flex align-items-center mb-3">            
                    <div class="col-12">
                        <label class="form-label font-weight-bold" style="font-size: 1.1rem;">Password :</label>                              
                        <div class="row d-flex align-items-center">                    
                            <div class="col-12 col-md-3">
                                <input type="password" name="passwordbr" class="form-control <?= ($valid->hasError('passwordbr')) ? 'is-invalid' : ''; ?>" placeholder="Password baru">
                                <div class="invalid-feedback">
                                    <?= $valid->getError('passwordbr'); ?>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <input type="password" name="passwordconf" class="form-control mt-2 mt-md-0 <?= ($valid->hasError('passwordconf')) ? 'is-invalid' : ''; ?>" placeholder="Konfirmasi password baru">
                                <div class="invalid-feedback">
                                    <?= $valid->getError('passwordconf'); ?>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <button type="submit" class="btn btn-primary mt-2 mt-md-0">Perbaharui Password</button>
                            </div>
                        </div>
                        
                    </div>                  
                </div>                        
            </form>
            <form action="<?= base_url(); ?>/logincontroller/update_nm/<?= session('id_user'); ?>" method="post">
                <div class="row d-flex align-items-center mb-3">            
                    <div class="col-12">
                        <label class="form-label font-weight-bold" style="font-size: 1.1rem;">Nama :</label>                              
                        <div class="row d-flex align-items-center">                    
                            <div class="col-12 col-md-6">
                                <input type="text" name="nama" class="form-control <?= ($valid->hasError('nama')) ? 'is-invalid' : ''; ?>" placeholder="Nama baru">
                                <div class="invalid-feedback">
                                    <?= $valid->getError('nama'); ?>
                                </div>
                            </div>                    
                            <div class="col-12 col-md-3">
                                <button type="submit" class="btn btn-primary mt-2 mt-md-0">Perbaharui Nama</button>
                            </div>
                        </div>
                        
                    </div>                  
                </div>                        
            </form>
            <form action="<?= base_url(); ?>/logincontroller/update_area/<?= session('id_user'); ?>" method="post">
                <div class="row d-flex align-items-center mb-3">            
                    <div class="col-12">
                        <label class="form-label font-weight-bold" style="font-size: 1.1rem;">Area :</label>                              
                        <div class="row d-flex align-items-center">                    
                            <div class="col-12 col-md-6">
                                <select name="area" class="form-control">
                                    <?php foreach($area as $a): ?>
                                        <option value="<?= $a['id_area']; ?>"><?= $a['area']; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>                    
                            <div class="col-12 col-md-3">
                                <button type="submit" class="btn btn-primary mt-2 mt-md-0">Perbaharui Area</button>
                            </div>
                        </div>
                        
                    </div>                  
                </div>                        
            </form>
        </div>
    </div>

        
    
<?= $this->endSection('content'); ?>
<?= $this->Section('modals'); ?>

<?= $this->endSection('modals'); ?>
<?= $this->Section('js'); ?>
<script>
    <?php if (session()->getFlashdata('success')) { ?>
        iziToast.success({
            title : 'Success!',            
            message: "<?= session()->getFlashdata('success'); ?>",
            position: 'topCenter'
        });
    <?php } ?>

     <?php if (session()->getFlashdata('gagal')) { ?>
        iziToast.error({
            title : 'Failed!',            
            message: "<?= session()->getFlashdata('gagal'); ?>",
            position: 'topCenter'
        });
    <?php } ?>

    function imgPreview(){
        const foto = document.querySelector('.input-foto');
        const fotoLabel = document.querySelector('.label-input');
        const imgPreview = document.querySelector('.img-preview');

        fotoLabel.textContent = foto.files[0].name;

        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload = function(e) {
            imgPreview.src = e.target.result;
        }            
    }
</script>
<?= $this->endSection('js'); ?>

<?= $this->endSection('content'); ?>