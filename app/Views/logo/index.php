<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>
        <h3 class="font-weight-bold">Ganti Logo</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <h5 class="font-weight-bold">Logo Saat Ini :</h5>
                                <img src="<?= base_url(); ?>/img/logo/<?= $logo['image']; ?>" alt="logo" class="img-thumbnail" style="width: 15rem; height: 15rem;">
                            </div>
                            <div class="col-12 col-md-6">
                                <h5 class="font-weight-bold">Preview Logo Baru :</h5>
                                <img src="<?= base_url(); ?>/assets/lg/images/default.png" alt="logo" class="img-thumbnail img-preview" style="width: 16rem; height: 15rem;">                                
                            </div>
                        </div>
                        <h5 class="font-weight-bold mt-3">Ganti Logo :</h5>
                        <div class="row">
                            <div class="col-6">
                                <form action="<?= base_url(); ?>/logocontroller/update/<?= $logo['id_logo']; ?>/<?= $logo['image']; ?>" method="post" enctype="multipart/form-data">            
                                <?= csrf_field(); ?>    
                                <div class="input-group mb-3">                                
                                        <div class="custom-file">
                                            <input type="file"  onchange="return imgPreview()" class="custom-file-input <?= ($valid->hasError('logo')) ? 'is-invalid' : ''; ?> input-foto" id="inputGroupFile01" name="logo">
                                            <label class="custom-file-label label-input" for="inputGroupFile01">Pilih logo baru...</label>
                                            <div class="invalid-feedback">
                                                <?= $valid->getError('logo'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 mt-1">
                                    <button type="submit" class="btn btn-primary">Ganti Logo</button>
                                </form>
                                </div>
                            </div>                            
                    </div>
                </div>
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
