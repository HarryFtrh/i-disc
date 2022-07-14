<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>
        <h3 class="font-weight-bold">Pengajuan Diskon</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Pilih Barang</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <th class="align-middle">No</th>
                                        <th class="align-middle">KD Barang</th>
                                        <th class="align-middle">Nama Barang</th>
                                        <th class="align-middle">Pcs/Box</th>
                                        <th class="align-middle">Harga</th>
                                        <th class="align-middle">Diskon Rekomendasi</th>
                                        <th class="align-middle">Jumlah Pembelian</th>
                                        <th class="align-middle">Aksi</th>
                                    </thead>
                                    <tbody>
                                        <?php $no =1; foreach($barang as $b): ?>
                                            <form action="<?= base_url(); ?>/pengajuancontroller/add_keranjang" method="post">
                                            <?= csrf_field(); ?>                                                              
                                            <input type="hidden" name="id_barang" value="<?= $b['id_barang']; ?>">                                                                                                                                                                                                                                                                                                                                              
                                            <tr>
                                                <td class="align-middle"><?= $no++; ?></td>
                                                <td class="align-middle"><?= $b['kode_barang']; ?></td>
                                                <td class="align-middle"><?= $b['nama_barang']; ?></td>
                                                <td class="align-middle"><?= $b['box/pcs']; ?></td>
                                                <td class="align-middle">Rp. <?= number_format($b['harga']); ?></td>
                                                <td class="align-middle"><?= $b['disc_rekomendasi']; ?>%</td>
                                                <td class="align-middle">
                                                    <input type="number" name="jumlah" class="form-control" placeholder="Masukan jumlah...">
                                                </td>
                                                <td class="align-middle">
                                                    <button class="btn btn-success"><i class="fa-solid fa-shopping-cart"></i></button>        
                                                </td>
                                                </tr>
                                            </form>                
                                        <?php endforeach ?>
                                    </tbody>
                                </table>                            
                            </div>
                        </div>
                </div>
            </div>                      
                <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-header">Keranjang Barang</div>
                                <div class="card-body">
                                <div class="table-responsive">
                                        <table class="table text-center">
                                            <thead>
                                                <tr>
                                                    <th class="align-middle">No</th>
                                                    <th class="align-middle">KD Barang</th>
                                                    <th class="align-middle">Nama Barang</th>
                                                    <th class="align-middle">Pcs/Box</th>
                                                    <th class="align-middle">Harga Satuan</th>
                                                    <th class="align-middle">Jumlah</th>
                                                    <th class="align-middle">Harga Total</th>
                                                    <th class="align-middle">Disc Rek.</th>
                                                    <th class="align-middle">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $no = 1; 
                                                    $total = 0; 
                                                    $disc_rek = 0; 
                                                    $disc = 0; 
                                                    $totalk = 0; 
                                                    foreach($keranjang as $k): 
                                                    $total += $k['jumlah']*$k['harga'];
                                                    $disc_rek += $k['disc_rekomendasi'];
                                                    $disc = $total*($disc_rek/100);
                                                    $totalk = $total-$disc;
                                                ?>
                                                    <tr>
                                                        <td class="align-middle"><?= $no++; ?></td>
                                                        <td class="align-middle"><?= $k['kode_barang']; ?></td>
                                                        <td class="align-middle"><?= $k['nama_barang']; ?></td>
                                                        <td class="align-middle"><?= $k['box/pcs']; ?></td>
                                                        <td class="align-middle"><?= number_format($k['harga']); ?></td>
                                                        <td class="align-middle"><?= $k['jumlah']; ?></td>
                                                        <td class="align-middle"><?= number_format($k['jumlah']*$k['harga']); ?></td>
                                                        <td class="align-middle"><?= $k['disc_rekomendasi']; ?>%</td>
                                                        <td class="align-middle">
                                                            <form action="<?= base_url(); ?>/pengajuancontroller/delete_keranjang/<?= $k['id_keranjang']; ?>" method="post">
                                                                <button type="submit" onclick="return confirm('Yakin ingin menghapus barang dari keranjang?')" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                                    <tr class="font-weight-bold">
                                                        <td class="align-middle" colspan="7">Total Disc Rekomendasi</td>
                                                        <td class="align-middle" colspan="2"><?= $disc_rek; ?>%</td>
                                                    </tr>
                                                    <tr class="font-weight-bold">
                                                        <td class="align-middle" colspan="7">Total Keseluruhan (belum dipotong diskon)</td>
                                                        <td class="align-middle" colspan="2">Rp. <?= number_format($total); ?></td>
                                                    </tr>
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>
                 </div>

            <div class="col-md-12">
                <div class="main-card mb-3 card">
                <div class="card-header">Form Pengajuan Diskon</div>
                <div class="card-body">                              
                    <form action="<?= base_url(); ?>/pengajuancontroller/tambahPengajuan/<?= $id_keranjang; ?>/<?= $disc_rek; ?>/<?= $total; ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label class="form-label">Nama Sales</label>
                            <input name="nama_sales" type="text" readonly value="<?= session('nama'); ?>" class="form-control <?= ($valid->hasError('nama_sales')) ? 'is-invalid' : ''; ?>" placeholder="Masukan angka. contoh : 1">
                            <div class="invalid-feedback">
                                <?= $valid->getError('nama_sales'); ?>
                            </div>
                        </div>    
                        <div class="form-group">
                                <label class="form-label">Kode Toko/Nama Toko</label>
                                <select name="id_toko" class="form-control" style="text-transform: capitalize;">
                                    <?php                                     
                                        foreach($toko as $t): 
                                    ?>
                                        <option value="<?= $t['id_toko']; ?>"><?= $t['kode_toko']; ?>/<?= $t['nama_toko']; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
                            <div class="form-group">
                                <label class="form-label">Program Diskon</label>
                                <select name="id_disc" class="form-control">
                                    <?php 
                                        $no = 1;
                                        $date = date('d');
                                        foreach($discs as $d): 
                                    ?>
                                        <option value="<?= $d['id_disc']; ?>">Program <?= $no++; ?> (Disc Reguler : <?= $d['disc_reguler']; ?>% <?= ($date <= 15) ? '& Promo Tanggal 1-15 : ' . $d['promotgl'].'%' : ''; ?> & Disc Klaim : <?= $d['disc_klaim']; ?>%)</option>
                                    <?php endforeach ?>
                                </select>
                            </div>                                                                                                                                                                          
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>  
                    </form>                
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

    $(document).ready( function () {
        $('#disc').DataTable({
            'ordering' : false
        });
    });
</script>
<?= $this->endSection('js'); ?>
