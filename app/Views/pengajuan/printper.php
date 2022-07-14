<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>
        <h3 class="font-weight-bold">Print Pengajuan Diskon</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                <div class="card-header">Print Pengajuan Per Tanggal</div>
                <div class="card-body">                                              
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="disc">
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
                                <td class="align-middle"><?= ($date <= 15) ? $p['promotgl'] : '0'; ?>%</td>
                                <td class="align-middle"><?= round($p['prsn_klaim'], 2); ?>%</td>
                                <td class="align-middle"><?= $p['disc_rek']; ?>%</td>
                                <td class="align-middle">Rp. <?= number_format($p['total']); ?></td>
                                <td class="align-middle font-weight-bold">
                                    Disetujui
                                </td>
                                <td class="align-middle">                                    
                                    <a href="<?= base_url(); ?>/print-pengajuan/print/<?= $p['id_pengajuan']; ?>" class="btn btn-success">Print</a>                                    
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

<?= $this->endSection('modals'); ?>
<?= $this->Section('js'); ?>
<script>     
    $(document).ready( function () {
        $('#disc').DataTable({
            'ordering' : false
        });        
    });
</script>
<?= $this->endSection('js'); ?>
