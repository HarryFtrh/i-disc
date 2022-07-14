<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengajuanModel;
use App\Models\TokoModel;
use App\Models\UserModel;

class DashboardController extends BaseController
{
    protected $pengajuan;
    protected $user;
    protected $toko;
    function __construct()
    {
        $this->pengajuan = new PengajuanModel();
        $this->user = new UserModel();
        $this->toko = new TokoModel();
    }
    public function index()
    {        
        $date = date('m');
        if (session('level') == 'user') {
            $id_user = session('id_user');
            $sum = $this->pengajuan->query("SELECT sum(total) as itung FROM order_barang WHERE status = 'disetujui' AND month(tanggal_pengajuan) = $date AND id_user = $id_user")->getResultArray();
        }else{
            $sum = $this->pengajuan->query("SELECT sum(total) as itung FROM order_barang WHERE status = 'disetujui' AND month(tanggal_pengajuan) = $date")->getResultArray();
        }
        $data = [
            'title' => 'Dashboard I-Disc',
            'active' => 'dashboard',
            'pengajuan' => $sum,
            'user' => $this->user->query("SELECT count(*) as user FROM user WHERE level = 'user'")->getResultArray(),
            'toko' => $this->toko->query("SELECT count(*) as toko FROM toko")->getResultArray(),
            'grafik_pengajuan' => $this->pengajuan->pengajuan()
        ];
        return view('dashboard/index', $data);
    }
}
