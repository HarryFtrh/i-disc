<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>
<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>
    <h3 class="font-weight-bold"><?= session('level') == 'user' ? 'Dashboard Anda' : 'Dashboard'; ?></h3>
    <div class="row">
        <div class="<?= session('level') == 'user' ? 'col-12' : 'col-md-6 col-xl-4'; ?>">
            <div class="card mb-3 widget-content bg-primary">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading"><?= session('level') == 'user' ? 'Total Pengajuan Anda' : 'Total Order'; ?></div>
                        <div class="widget-subheading">Bulan : <?= date('F-Y'); ?></div>
                    </div> 
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>
                            Rp. 
                            <?php
                                foreach ($pengajuan as $p) {
                                    echo ($p['itung']) ? number_format($p['itung']) : '0';   
                                }
                            ?>
                        </span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4 <?= session('level') == 'user' ? 'd-none' : ''; ?>">
            <div class="card mb-3 widget-content bg-success">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Total Sales</div>
                    </div> 
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>
                            <?php
                                foreach ($user as $p) {
                                    echo $p['user'];   
                                }
                            ?>
                            Orang
                        </span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4 <?= session('level') == 'user' ? 'd-none' : ''; ?>">
            <div class="card mb-3 widget-content bg-dark">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Total Toko</div>
                    </div> 
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>
                            <?php
                                foreach ($toko as $p) {
                                    echo $p['toko'];   
                                }
                            ?>
                            Buah
                        </span></div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="card">
            <div class="card-header"><?= session('level') == 'user' ? 'Grafik Order Barang Anda' : 'Grafik Order Barang'; ?> (<?= date('F-Y'); ?>)</div>
            <div class="card-body">
                <canvas id="order" height="100%"></canvas>
            </div>
        </div>
<?= $this->endSection('content'); ?>
<?= $this->Section('modals'); ?>

<?= $this->endSection('modals'); ?>
<?= $this->Section('js'); ?>
<script>
     const ctx = document.getElementById('order').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
        datasets: [{
            label: 'All orders this month',
            data: ["<?= $grafik_pengajuan['sen'] ?>","<?= $grafik_pengajuan['sel'] ?>","<?= $grafik_pengajuan['rab'] ?>", "<?= $grafik_pengajuan['kam'] ?>", "<?= $grafik_pengajuan['jum'] ?>", "<?= $grafik_pengajuan['sab'] ?>", "<?= $grafik_pengajuan['min'] ?>"],
            backgroundColor: '#343a40',
            borderColor: '#343a40',
            borderWidth: 1
        }]
    },    
});
</script>
<?= $this->endSection('js'); ?>

<?= $this->endSection('content'); ?>