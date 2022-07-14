<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\DiscModel;
use App\Models\KeranjangModel;
use App\Models\LogoModel;
use App\Models\PengajuanModel;
use App\Models\SpvModel;
use App\Models\TokoModel;

class PengajuanController extends BaseController
{
    protected $pengajuan;
    protected $barang;
    protected $disc;
    protected $toko;
    protected $logo;
    protected $keranjang;
    protected $areaSPV;
    function __construct()
    {
        $this->pengajuan = new PengajuanModel();
        $this->barang = new BarangModel();
        $this->disc = new DiscModel();
        $this->toko = new TokoModel();
        $this->logo = new LogoModel();
        $this->keranjang = new KeranjangModel();
        $this->areaSPV = new SpvModel();
    }
    public function index()
    {
        $cek = $this->keranjang->where(['id_user' => session('id_user'), 'status' => 'keranjang'])->first();
        $id_keranjang = (empty($cek)) ? '0' : $cek['id_keranjang'];
        $data = [
            'title' => 'Form Pengajuan Diskon I-Disc',
            'active' => 'pengajuan',            
            'valid' => \Config\Services::validation(),
            'barang' => $this->barang->findAll(),
            'discs' => $this->disc->findAll(),
            'toko' => $this->toko->findAll(),
            'id_keranjang' => $id_keranjang,
            'keranjang' => $this->keranjang->join('barang', 'keranjang.id_barang = barang.id_barang')->where(['status' => 'keranjang', 'id_user' => session('id_user')])->findAll()
        ];
        return view('pengajuan/index', $data);
    }
    public function add_keranjang()
    {
        $id_user = session('id_user');
        $id_barang = $this->request->getVar('id_barang');
        $jumlah = $this->request->getVar('jumlah');
        $cek = $this->keranjang->where(['id_barang' => $id_barang, 'id_user' => $id_user, 'status' => 'keranjang'])->first();
        if ($cek > 0) {
            $id_keranjang = $cek['id_keranjang'];
            $this->keranjang->update($id_keranjang,[
                'jumlah' => $jumlah  
            ]);
            session()->setFlashdata('success', 'Berhasil memperbaharui keranjang.');
        }else{
            $this->keranjang->insert([
                'id_user' => $id_user,
                'id_barang' => $id_barang,
                'jumlah' => $jumlah,
                'status' => 'keranjang'
            ]);
            session()->setFlashdata('success', 'Berhasil menambahkan barang ke keranjang.');
        }
        return redirect()->to(base_url('/form-pengajuan'));
    }
    public function delete_keranjang($id)
    {
        $this->keranjang->delete($id);
        session()->setFlashdata('success', 'Barang berhasil dihapus dari keranjang.');
        return redirect()->to(base_url('/form-pengajuan'));
    }
    public function updatePengajuan()
    {
        $id_user = session('id_user');
        if (session('level') == 'spv') {
            $peng = $this->pengajuan->query("SELECT a.*,b.*,c.*,d.*,e.*,f.*,(select count(id_area) FROM area_spv WHERE id_user = $id_user AND id_area = f.id_area) AS ok FROM order_barang a JOIN user b ON a.id_user = b.id_user JOIN keranjang c ON a.id_keranjang = c.id_keranjang JOIN program_disc d ON a.id_disc = d.id_disc JOIN toko e ON a.id_toko = e.id_toko JOIN area f ON b.id_area = f.id_area")->getResultArray();
        }else{
            $peng = $this->pengajuan->join('user', 'user.id_user = order_barang.id_user')->join('keranjang', 'keranjang.id_keranjang = order_barang.id_keranjang')->join('program_disc', 'program_disc.id_disc = order_barang.id_disc')->join('toko', 'toko.id_toko = order_barang.id_toko')->join('area','user.id_area = area.id_area')->findAll();
        }
        $data = [
            'title' => 'Update Pengajuan Diskon I-Disc',
            'active' => 'uppengajuan',
            'pengajuan' => $peng,
            'area_spv' => $this->areaSPV->query("SELECT * FROM area_spv JOIN area ON area_spv.id_area = area.id_area WHERE id_user = $id_user")->getResultArray(),
            'date' => date('m'),
        ];         
               
        return view('pengajuan/update', $data);
    }
    public function printPer()
    {
        $data = [
            'title' => 'Print Pengajuan Per Tanggal I-Disc',
            'active' => 'ppengajuan',
            'pengajuan' => $this->pengajuan->join('user', 'user.id_user = order_barang.id_user')->join('keranjang', 'keranjang.id_keranjang = order_barang.id_keranjang')->join('program_disc', 'program_disc.id_disc = order_barang.id_disc')->join('toko', 'toko.id_toko = order_barang.id_toko')->findAll(),
            'date' => date('m'),                    
        ];                        
        return view('pengajuan/printper', $data);
    }
    public function tambahPengajuan($id_keranjang, $disc_rek ,$total)
    {            
        $date = date('m')-1;
        $datenow = date('m');
        $prsn_klaim = 0;
        $diskon = 0;
        $disc_klaim = 0; 
        $totals = 0;
        $id_user = session('id_user');            
        $id_disc = $this->request->getVar('id_disc');   
        $id_toko = $this->request->getVar('id_toko');   
        $prog = $this->disc->find($id_disc);
        $ttl_bln = $this->pengajuan->where(['status' => 'disetujui', 'month(tanggal_pengajuan)' => $date, 'id_toko' => $id_toko])->selectSum('total', 'ttl')->first();        
        $klaim = $this->pengajuan->where(['status' => 'disetujui', 'month(tanggal_pengajuan)' => $datenow, 'id_toko' => $id_toko])->selectSum('status_klaim', 'klaim')->first();
        $promotgl = 0;
        if(date('d') <= 15):
            $promotgl = $prog['promotgl']/100;
        endif; 
        if($klaim['klaim'] < 2  AND !empty($ttl_bln)){
            $klaims = 1;
            $prsn_klaim = $ttl_bln['ttl']*($prog['disc_klaim']/100);
            $disc_klaim = $prsn_klaim/$total*(100/100);
            $diskon = $total*($disc_rek/100+$prog['disc_reguler']/100+$promotgl+$disc_klaim/100);
        } else{
            $klaims = 0;
            $diskon = $total*($disc_rek/100+$prog['disc_reguler']/100+$promotgl+$disc_klaim/100);
        }
        $totals = $total-$diskon; 
            $this->pengajuan->insert([
                'id_user' => $id_user,
                'id_toko' => $id_toko,
                'id_keranjang' => $id_keranjang,
                'id_disc' => $id_disc,
                'status_klaim' => $klaims,
                'prsn_klaim' => $disc_klaim,
                'total' => $totals,
                'disc_rek' => $disc_rek,
                'status' => 'diajukanSPV'
            ]);
            session()->setFlashdata('success', 'Pengajuan berhasil dikirimkan');
            return redirect()->to(base_url('/form-pengajuan'));        
    }
    public function setuju($id)
    {
        if ($this->request->getVar('cek') == "spv") {
            $this->pengajuan->update($id, [
                'status' => 'diajukanADM',            
            ]);            
        }else {
            $this->pengajuan->update($id, [
                'status' => 'disetujui',            
            ]);
        }
        session()->setFlashdata('success', 'Pengajuan berhasil disetujui');
        return redirect()->to(base_url('/update-pengajuan'));
    }
    public function tolak($id)
    {
        $this->pengajuan->update($id, [
            'status' => 'ditolak', 
            'note' => $this->request->getVar('alasan')           
        ]);
        session()->setFlashdata('success', 'Pengajuan berhasil ditolak');
        return redirect()->to(base_url('/update-pengajuan'));
    }    
    public function delete($id)
    {
        $this->pengajuan->delete($id);
        session()->setFlashdata('success', 'Pengajuan berhasil dihapus');
        return redirect()->to(base_url('/update-pengajuan'));
    }    
    public function print($id)
    {        
        $data = [
            'title' => 'Print',
            'active' => 'ppengajuan',
            'barang' => $this->keranjang->join('barang', 'barang.id_barang = keranjang.id_barang')->where('id_pengajuan', $id)->findAll(),
            'pengajuan' => $this->pengajuan->join('user', 'user.id_user = order_barang.id_user')->join('keranjang', 'keranjang.id_keranjang = order_barang.id_keranjang')->join('program_disc', 'program_disc.id_disc = order_barang.id_disc')->join('toko', 'toko.id_toko = order_barang.id_toko')->find($id),
            'date' => date('m'),    
            'logo' => $this->logo->first()                  
        ];                        
        return view('pengajuan/cetakPengajuan', $data);
    }
}
