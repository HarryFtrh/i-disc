<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>
        <h3 class="font-weight-bold">Pengajuan Diskon</h3>
        <?php if(session('level') == 'user'): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                <div class="card-header">Data Pengajuan Diskon <?= (session('level') == 'user') ? 'Anda' : '(Proses)'; ?></div>
                <div class="card-body">                                              
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="disc4">
                            <thead>
                            <tr>
                                <th class="align-middle">No</th>
                                <th class="align-middle">Tanggal</th>
                                <th class="align-middle">Nama Sales</th>
                                <th class="align-middle">Nama Toko</th>
                                <th class="align-middle">Disc Reguler</th>
                                <th class="align-middle">Promo Tanggal 1-15</th>
                                <th class="align-middle">Disc Klaim</th>
                                <th class="align-middle">Total Disc Rekomendasi</th>
                                <th class="align-middle">Total</th>
                                <th class="align-middle">Status</th>
                                <th class="align-middle">Alasan (Bila ditolak)</th>
                                <th class="align-middle">Aksi</th>
                            </tr>
                            </thead>                            
                            <tbody style="text-transform: capitalize;">
                                <?php 
                                    $no = 1;                                    
                                    foreach($pengajuan as $p):
                                        if($p['id_user'] == session('id_user')):                                                                                      
                                ?>
                            <tr>
                                <td class="align-middle"><?= $no++; ?></td>
                                <td class="align-middle"><?= date('d-m-Y', strtotime($p['tanggal_pengajuan'])); ?></td>
                                <td class="align-middle"><?= $p['nama_user']; ?></td>
                                <td class="align-middle"><?= $p['nama_toko']; ?></td>
                                <td class="align-middle"><?= $p['disc_reguler']; ?>%</td>
                                <td class="align-middle"><?= ($date <= 15) ? $p['promotgl'] : '0'; ?>%</td>
                                <td class="align-middle"><?= round($p['prsn_klaim'], 2); ?>%</td>
                                <td class="align-middle"><?= $p['disc_rek']; ?>%</td>
                                <td class="align-middle">Rp. <?= number_format($p['total']); ?></td>
                                <td class="align-middle font-weight-bold">
                                    <?php if($p['status'] == 'diajukan'){ ?>
                                        Proses
                                    <?php }else if($p['status'] == 'disetujui'){ ?>
                                        Disetujui
                                        <?php }else{ ?>
                                        Ditolak
                                    <?php } ?>
                                </td>
                                <td class="align-middle"><?= ($p['note'] == null) ? '-' : $p['note']; ?></td>
                                <td class="align-middle">
                                    <?php if($p['status'] == 'diajukan'){ ?>
                                        <form action="<?= base_url(); ?>/pengajuancontroller/delete/<?= $p['id_pengajuan']; ?>" method="post">
                                            <button type="submit" onclick="return confirm('Yakin ingin menghapus pengajuan ini?')" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus pengajuan ini?')"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                    <?php }else if($p['status'] == 'disetujui'){ ?>
                                        <a href="<?= base_url(); ?>/print-pengajuan/print/<?= $p['id_pengajuan']; ?>" class="btn btn-success">Print</a>
                                    <?php }else{ ?>
                                        <form action="<?= base_url(); ?>/pengajuancontroller/delete/<?= $p['id_pengajuan']; ?>" method="post">
                                            <button type="submit" onclick="return confirm('Yakin ingin menghapus pengajuan ini?')" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus pengajuan ini?')"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                    <?php } ?>
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
        <?php endif ?>
        
        <?php if(session('level') != 'user'): ?>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                <div class="card-header">Data Pengajuan Diskon <?= (session('level') == 'user') ? 'Anda' : '(Proses)'; ?></div>
                <div class="card-body">       
                    <?php if(session('level') == 'spv'): ?>          
                        <div class="bg-light text-center py-4 mb-2">
                            <h6 class="text-uppercase">Area Anda :</h6>
                            <div class="d-flex inline-block justify-content-center">
                                <?php foreach($area_spv as $spv): ?>
                                    <div class="bg-white p-2" style="margin-right: 6px; font-size: 2rem;"><?= $spv['area']; ?></div>
                                <?php endforeach ?>
                            </div>
                        </div>                             
                    <?php endif ?>                                       
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="disc">
                            <thead>
                            <tr>
                                <th class="align-middle">No</th>
                                <th class="align-middle">Tanggal</th>
                                <th class="align-middle">Nama Sales</th>
                                <th class="align-middle">Area</th>
                                <th class="align-middle">Nama Toko</th>
                                <th class="align-middle">Disc Reguler</th>
                                <th class="align-middle">Promo Tanggal 1-15</th>
                                <th class="align-middle">Disc Klaim</th>
                                <th class="align-middle">Total Disc Rekomendasi</th>
                                <th class="align-middle">Total</th>
                                <th class="align-middle">Status</th>
                                <th class="align-middle">Aksi</th>
                            </tr>
                            </thead> 
                            <?php if(session('level') == 'spv'): ?>                           
                                <tbody style="text-transform: capitalize;">
                                    <?php 
                                        $no = 1;                                    
                                        foreach($pengajuan as $p):
                                            if($p['status'] == 'diajukanSPV' AND $p['ok'] >= 1):                                                                                      
                                    ?>
                                <tr>
                                    <td class="align-middle"><?= $no++; ?></td>
                                    <td class="align-middle"><?= date('d-m-Y', strtotime($p['tanggal_pengajuan'])); ?></td>
                                    <td class="align-middle"><?= $p['nama_user']; ?></td>
                                    <td class="align-middle font-weight-bold"><?= $p['area']; ?></td>
                                    <td class="align-middle"><?= $p['nama_toko']; ?></td>
                                    <td class="align-middle"><?= $p['disc_reguler']; ?>%</td>
                                    <td class="align-middle"><?= ($date <= 15) ? $p['promotgl'] : '0'; ?>%</td>
                                    <td class="align-middle"><?= round($p['prsn_klaim'], 2); ?>%</td>
                                    <td class="align-middle"><?= $p['disc_rek']; ?>%</td>
                                    <td class="align-middle">Rp. <?= number_format($p['total']); ?></td>
                                    <td class="align-middle font-weight-bold">Menunggu Persetujuan SPV</td>
                                    <td class="align-middle">
                                            <div class="d-flex inline-block justify-content-center">                                                                                       
                                                <form action="<?= base_url(); ?>/pengajuancontroller/setuju/<?= $p['id_pengajuan']; ?> " method="post">
                                                    <input type="hidden" value="spv" name="cek">
                                                    <button type="submit" class="btn btn-success btn-sm mr-1" onclick="return confirm('Yakin ingin menyetujui pengajuan ini?')"><i class="fa-solid fa-check"></i>Setujui</button>
                                                </form>
                                                <button type="button" onclick="return tolakModal(<?= $p['id_pengajuan']; ?>)" class="btn btn-danger btn-sm"><i class="fa-solid fa-xmark"></i> Tolak</button>
                                                                                                
                                            </div>
                                    </td>                                                  
                                </tr>   
                                                
                                <?php endif;endforeach ?>                     
                                </tbody>                            
                                <?php else: ?>                           
                                    <tbody style="text-transform: capitalize;">
                                        <?php 
                                            $no = 1;                                    
                                            foreach($pengajuan as $p):
                                                if($p['status'] == 'diajukanADM'):                                                                                      
                                        ?>
                                    <tr>
                                        <td class="align-middle"><?= $no++; ?></td>
                                        <td class="align-middle"><?= date('d-m-Y', strtotime($p['tanggal_pengajuan'])); ?></td>
                                        <td class="align-middle"><?= $p['nama_user']; ?></td>
                                        <td class="align-middle font-weight-bold"><?= $p['area']; ?></td>
                                        <td class="align-middle"><?= $p['nama_toko']; ?></td>
                                        <td class="align-middle"><?= $p['disc_reguler']; ?>%</td>
                                        <td class="align-middle"><?= ($date <= 15) ? $p['promotgl'] : '0'; ?>%</td>
                                        <td class="align-middle"><?= round($p['prsn_klaim'], 2); ?>%</td>
                                        <td class="align-middle"><?= $p['disc_rek']; ?>%</td>
                                        <td class="align-middle">Rp. <?= number_format($p['total']); ?></td>
                                        <td class="align-middle font-weight-bold">Menunggu Persetujuan Manager</td>
                                        <td class="align-middle">
                                                <div class="d-flex inline-block justify-content-center">                                                                                       
                                                    <form action="<?= base_url(); ?>/pengajuancontroller/setuju/<?= $p['id_pengajuan']; ?> " method="post">
                                                        <input type="hidden" value="adm" name="cek">
                                                        <button type="submit" class="btn btn-success btn-sm mr-1" onclick="return confirm('Yakin ingin menyetujui pengajuan ini?')"><i class="fa-solid fa-check"></i>Setujui</button>
                                                    </form>
                                                    <button type="button" onclick="return tolakModal(<?= $p['id_pengajuan']; ?>)" class="btn btn-danger btn-sm"><i class="fa-solid fa-xmark"></i> Tolak</button>

                                                </div>
                                        </td>                                                  
                                    </tr>   
                                    <?php endif;endforeach ?>                     
                                    </tbody>                            
                            <?php endif ?>                           
                        </table>
                    </div>  
                </div>
                </div>
            </div>
        </div>  

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                <div class="card-header">Data Pengajuan Diskon Disetujui</div>
                <div class="card-body">                                              
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="disc2">
                            <thead>
                            <tr>
                                <th class="align-middle">No</th>
                                <th class="align-middle">Tanggal</th>
                                <th class="align-middle">Nama Sales</th>
                                <th class="align-middle">Nama Toko</th>
                                <th class="align-middle">Disc Reguler</th>
                                <th class="align-middle">Promo Tanggal 1-15</th>
                                <th class="align-middle">Disc Klaim</th>
                                <th class="align-middle">Total Disc Rekomendasi</th>
                                <th class="align-middle">Total</th>
                                <th class="align-middle">Status</th>
                                <th class="align-middle">Aksi</th>
                            </tr>
                            </thead>                            
                            <tbody style="text-transform: capitalize;">
                                <?php 
                                    $no = 1;                                    
                                    foreach($pengajuan as $p):
                                        if($p['status'] == 'disetujui'):                                      
                                ?>
                            <tr>
                                <td class="align-middle"><?= $no++; ?></td>
                                <td class="align-middle"><?= date('d-m-Y', strtotime($p['tanggal_pengajuan'])); ?></td>
                                <td class="align-middle"><?= $p['nama_user']; ?></td>
                                <td class="align-middle"><?= $p['nama_toko']; ?></td>
                                <td class="align-middle"><?= $p['disc_reguler']; ?>%</td>
                                <td class="align-middle"><?= (date('m') <= 15) ? $p['promotgl'] : '0'; ?>%</td>
                                <td class="align-middle"><?= round($p['prsn_klaim'], 2); ?>%</td>
                                <td class="align-middle"><?= $p['disc_rek']; ?>%</td>
                                <td class="align-middle">Rp. <?= number_format($p['total']); ?></td>
                                <td class="align-middle font-weight-bold">Disetujui</td>
                                <td class="align-middle">
                                        <div class="d-flex inline-block justify-content-center">                                                                                       
                                            <form action="<?= base_url(); ?>/pengajuancontroller/delete/<?= $p['id_pengajuan']; ?>" method="post">
                                                <button type="submit" onclick="return confirm('Yakin ingin menghapus pengajuan ini?')" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus pengajuan ini?')"><i class="fa-solid fa-trash-can"></i></button>
                                            </form>
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

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                <div class="card-header">Data Pengajuan Diskon Ditolak</div>
                <div class="card-body">                                              
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="disc3">
                            <thead>
                            <tr>
                                <th class="align-middle">No</th>
                                <th class="align-middle">Tanggal</th>
                                <th class="align-middle">Nama Sales</th>
                                <th class="align-middle">Nama Toko</th>
                                <th class="align-middle">Disc Reguler</th>
                                <th class="align-middle">Promo Tanggal 1-15</th>
                                <th class="align-middle">Disc Klaim</th>
                                <th class="align-middle">Total Disc Rekomendasi</th>
                                <th class="align-middle">Total</th>
                                <th class="align-middle">Status</th>
                                <th class="align-middle">Alasan</th>
                                <th class="align-middle">Aksi</th>
                            </tr>
                            </thead>                            
                            <tbody style="text-transform: capitalize;">
                                <?php 
                                    $no = 1;
                                    $nom_diskon = 0;
                                    $total = 0;
                                    $promotgl = 0;
                                    $diskon = 0;
                                    $prsn_klaim =0;
                                    $disc_klaim = 0;
                                    foreach($pengajuan as $p):
                                        if($p['status'] == 'ditolak'):
                                        if(date('d') <= 15):
                                            $promotgl = $p['promotgl']/100;
                                        endif;                                        
                                ?>
                            <tr>
                                <td class="align-middle"><?= $no++; ?></td>
                                <td class="align-middle"><?= date('d-m-Y', strtotime($p['tanggal_pengajuan'])); ?></td>
                                <td class="align-middle"><?= $p['nama_user']; ?></td>
                                <td class="align-middle"><?= $p['nama_toko']; ?></td>
                                <td class="align-middle"><?= $p['disc_reguler']; ?>%</td>
                                <td class="align-middle"><?= ($date <= 15) ? $p['promotgl'] : '0'; ?>%</td>
                                <td class="align-middle"><?= round($p['prsn_klaim'], 2); ?>%</td>
                                <td class="align-middle"><?= $p['disc_rek']; ?>%</td>
                                <td class="align-middle">Rp. <?= number_format($p['total']); ?></td>
                                <td class="align-middle font-weight-bold">Ditolak</td>
                                <td class="align-middle"><?= $p['note']; ?></td>
                                <td class="align-middle">
                                        <div class="d-flex inline-block justify-content-center">                                                                                       
                                            <form action="<?= base_url(); ?>/pengajuancontroller/delete/<?= $p['id_pengajuan']; ?>" method="post">
                                                <button type="submit" onclick="return confirm('Yakin ingin menghapus pengajuan ini?')" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus pengajuan ini?')"><i class="fa-solid fa-trash-can"></i></button>
                                            </form>
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
        <?php endif ?>          
<?= $this->endSection('content'); ?>
<?= $this->Section('modals'); ?>
    <div class="modal fade" id="tolakForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alasan Penolakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-tolak" method="post">
                    <label for="" class="form-label">Masukan alasan penolakan</label>
                    <div class="form-group">
                        <textarea name="alasan" class="form-control" id="" rows="2"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tolak</button>
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
        $('#disc2').DataTable({
            'ordering' : false
        });
        $('#disc3').DataTable({
            'ordering' : false
        });
        $('#disc4').DataTable({
            'ordering' : false
        });
    });
    function tolakModal(id){
        $('#tolakForm').modal('show');
        $('#form-tolak').attr('action', '<?= base_url(); ?>/pengajuancontroller/tolak/'+id);
    }
</script>
<?= $this->endSection('js'); ?>
