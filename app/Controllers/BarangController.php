<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\PengajuanModel;

class BarangController extends BaseController
{
    protected $barang;
    protected $pengajuan;
    function __construct()
    {
        $this->barang = new BarangModel();
        $this->pengajuan = new PengajuanModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Barang I-Disc',
            'active' => 'barang',
            'barang' => $this->barang->findAll(),
            'valid' => \Config\Services::validation()
        ];
        return view('barang/index', $data);
    }
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Barang I-Disc',
            'active' => 'barang',
            'barang' => $this->barang->find($id),
            'valid' => \Config\Services::validation()
        ];
        return view('barang/edit-barang', $data);
    }
    public function tambahBarang()
    {
        if (!$this->validate([
            'kd_barang' => [
                'rules' => 'required|min_length[5]|is_unique[barang.kode_barang]',
                'errors' => [
                    'required' => 'Field ini harus diisi',
                    'min_length' => 'Minimal 5 karakter',
                    'is_unique' => 'Kode barang telah tersedia',
                ]
            ],
            'nm_barang' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Field ini harus diisi',
                    'min_length' => 'Minimal 5 karakter'
                ]
            ],
            'pcs' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Field ini harus diisi',                                        
                    'numeric' => 'Harus berupa angka'
                ]
            ],
            'harga' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Field ini harus diisi',                                        
                    'numeric' => 'Harus berupa angka'
                ]
            ],
            'rekomend' => [
                'rules' => 'numeric',
                'errors' => [
                    'numeric' => 'Harus berupa angka',                                        
                ]
            ],             
        ])) {
            session()->setFlashdata('gagal', 'Data gagal ditambahkan');
            return redirect()->to(base_url('/data-barang'))->withInput();
        }else{
            $kd_barang = $this->request->getVar('kd_barang');
            $nm_barang = $this->request->getVar('nm_barang');
            $pcs = $this->request->getVar('pcs');
            $harga = $this->request->getVar('harga');
            $rekomend = $this->request->getVar('rekomend');
            $this->barang->insert([
                'kode_barang' => $kd_barang,
                'nama_barang' => $nm_barang,
                'box/pcs' => $pcs,
                'harga' => $harga,
                'disc_rekomendasi' => $rekomend
            ]);
            session()->setFlashdata('success', 'Data berhasil ditambahkan');
            return redirect()->to(base_url('/data-barang'));
        }
    }
    public function update($id)
    {
        if (!$this->validate([
            'nm_barang' => [
                'rules' => 'min_length[5]',
                'errors' => [                    
                    'min_length' => 'Minimal 5 karakter'
                ]
            ],
            'pcs' => [
                'rules' => 'numeric',
                'errors' => [                                                            
                    'numeric' => 'Harus berupa angka'
                ]
            ],
            'harga' => [
                'rules' => 'numeric',
                'errors' => [                                                            
                    'numeric' => 'Harus berupa angka'
                ]
            ],                                     
        ])) {
            session()->setFlashdata('gagal', 'Data gagal diperbaharui');
            return redirect()->to(base_url('/data-barang/edit/' . $id))->withInput();
        }else{
            $nm_barang = $this->request->getVar('nm_barang');
            $pcs = $this->request->getVar('pcs');
            $harga = $this->request->getVar('harga');
            $rekomend = $this->request->getVar('rekomend');
            $pengajuan = $this->pengajuan->join('user', 'user.id_user = order_barang.id_user')->join('keranjang', 'keranjang.id_pengajuan = order_barang.id_pengajuan')->join('barang', 'barang.id_barang = keranjang.id_barang')->join('program_disc', 'program_disc.id_disc = order_barang.id_disc')->join('toko', 'toko.id_toko = order_barang.id_toko')->where(['keranjang.id_barang' => $id, 'order_barang.status' => 'disetujui'])->findAll();            
            $date = date('m')-1;      
            $klaim = $this->pengajuan->query("SELECT o.* , sum(total) AS ttl FROM order_barang o Where status = 'disetujui' AND month(tanggal_pengajuan) = $date GROUP BY id_toko")->getResultArray();
            foreach($pengajuan as $p){
                $hrgtotal = 0;
                $total = 0;
                $promotgal = 0;
                $diskon = 0;
                $prsn_klaim =0;
                $nom_klaim = 0;      
                $id_pengajuan = $p['id_pengajuan'];
                if(date('d') <= 15):
                    $promotgal = $p['promotgl']/100;
                endif;
                $hrgtotal = $p['harga']*$p['jumlah'];                 
                foreach($klaim as $t){  
                    if ($t['id_toko'] == $p['id_toko'] AND $p['tanggal_pengajuan'] != $t['tanggal_pengajuan']) {
                        $prsn_klaim = $t['ttl']*($p['disc_klaim']/100);
                        $nom_klaim = $prsn_klaim/$hrgtotal*(100/100);
                        $diskon = $hrgtotal*($rekomend/100+$p['disc_reguler']/100+$promotgal+$nom_klaim/100);                        
                    }                                                             
                    $total = $hrgtotal-$diskon; 
                    $this->pengajuan->update($id_pengajuan,[
                        'total' => $total
                    ]);      
                }                
            }


            $this->barang->update($id, [
                'nama_barang' => $nm_barang,
                'box/pcs' => $pcs,
                'harga' => $harga,
                'disc_rekomendasi' => $rekomend
            ]);
            session()->setFlashdata('success', 'Data berhasil perbaharui');
            return redirect()->to(base_url('/data-barang'));
        }
    }
    public function delete($id)
    {
        $this->barang->delete($id);
        session()->setFlashdata('success', 'Data barang berhasil dihapus');
        return redirect()->to(base_url('/data-barang'));
    }
}
