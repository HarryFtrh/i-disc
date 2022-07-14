<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title><?= $title; ?></title>
    <style>
        *{
            font-family: 'Times New Roman', Times, serif;
        }
    </style>
  </head>
  <body>
    <div class="container py-4 mt-5" style="border: 1px solid #000;">
            <div class="row">
                <div class="col-10">
                    <h2 class="text-center fw-bold">Form Pesanan Produk</h2>
                    <div class="row mt-3" style="font-size: 20px;">
                        <div class="col-5">
                                <table>
                                <tr>
                                    <td>Kode Toko</td>
                                    <td>&nbsp;:&nbsp;</td>
                                    <td><?= $pengajuan['kode_toko']; ?></td>
                                </tr>
                                <tr>
                                    <td>Nama Toko</td>
                                    <td>&nbsp;:&nbsp;</td>
                                    <td><?= $pengajuan['nama_toko']; ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>&nbsp;:&nbsp;</td>
                                    <td><?= date('d-m-Y', strtotime($pengajuan['tanggal_pengajuan'])); ?></td>
                                </tr>
                                </table>                        

                            </div>
                            <div class="col-5">
                                <table>
                                    <tr>
                                        <td>Nama Sales</td>
                                        <td>&nbsp;:&nbsp;</td>
                                        <td><?= $pengajuan['nama_user']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total Rec.</td>
                                        <td>&nbsp;:&nbsp;</td>
                                        <td><?= $pengajuan['disc_rek']; ?>%</td>
                                    </tr>
                                    <tr>
                                        <td>Promo  Tanggal</td>
                                        <td>&nbsp;:&nbsp;</td>
                                        <td><?= $pengajuan['promotgl']; ?>%</td>    
                                    </tr>                                
                                </table>

                            </div>
                            </div>
                </div>
                <div class="col-2 d-flex align-items-center justify-content-end">
                    <img src="<?= base_url(); ?>/img/logo/<?= $logo['image']; ?>" alt="logo" style="width: 10rem; height: 10rem;">
                </div>
            </div>
            <table class="table table-bordered text-center mt-3" style="font-size: 1.4rem; border: 1px solid; width: 100%;">
                <thead>
                    <th class="align-middle">No</th>
                    <th class="align-middle">Kode Barang</th>
                    <th class="align-middle">Nama Barang</th>                    
                    <th class="align-middle">Pcs/Box</th>
                    <th class="align-middle">Harga</th>
                    <th class="align-middle">QTY</th>
                    <th class="align-middle">Prod. Recomendation</th>
                    <th class="align-middle">Harga Total</th>
                </thead>
                <tbody>
                    <?php 
                        $no=1; 
                        $total = 0; 
                        foreach($barang as $b):
                            $total += $b['jumlah']*$b['harga']; 
                    ?>
                        <tr>
                            <td class="align-middle"><?= $no++; ?></td>
                            <td class="align-middle"><?= $b['kode_barang']; ?></td>
                            <td class="align-middle"><?= $b['nama_barang']; ?></td>
                            <td class="align-middle"><?= $b['box/pcs']; ?></td>
                            <td class="align-middle"><?= $b['harga']; ?></td>
                            <td class="align-middle"><?= $b['jumlah']; ?></td>
                            <td class="align-middle"><?= $b['disc_rekomendasi']; ?>%</td>
                            <td class="align-middle"><?= number_format($b['jumlah']*$b['harga']); ?></td>
                        </tr>
                    <?php endforeach ?>
                        <tr>
                            <td class="align-middle" colspan="7">Total Disc Klaim</td>
                            <td class="align-middle"><?= round($pengajuan['prsn_klaim'], 2); ?>%</td>
                        </tr>                   
                        <tr>
                            <td class="align-middle" colspan="7">Total Sebelum Diskon</td>
                            <td class="align-middle"><?= number_format($total); ?></td>
                        </tr>
                        <tr>
                            <td class="align-middle" colspan="7">Total Setelah Diskon</td>
                            <td class="align-middle"><?= number_format($pengajuan['total']); ?></td>
                        </tr>
                </tbody>
            </table>
            <div class="mt-3 d-flex inline-block justify-content-end d-print-none">
                <a href="<?= base_url(); ?>/<?= (session('level') != 'user') ? 'print-pengajuan' : 'update-pengajuan'; ?>" class="btn btn-secondary">Back</a>
                &nbsp;&nbsp;
                <button class="btn btn-success d-flex justify-content-end" onclick="return window.print()">Print</button>
            </div>
        </div>        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>