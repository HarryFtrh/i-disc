<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DiscModel;
use App\Models\KeranjangModel;
use App\Models\PengajuanModel;

class DiscController extends BaseController
{
    protected $disc;
    protected $pengajuan;
    protected $keranjang;
    function __construct()
    {
        $this->disc = new DiscModel();
        $this->pengajuan = new PengajuanModel();
        $this->keranjang = new KeranjangModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Program I-Disc',
            'active' => 'disc',
            'disc' => $this->disc->findAll(),
            'valid' => \Config\Services::validation()
        ];
        return view('disc/index', $data);
    }
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Program Diskon I-Disc',
            'active' => 'disc',
            'disc' => $this->disc->find($id),
            'valid' => \Config\Services::validation()
        ];
        return view('disc/edit-disc', $data);
    }
    public function tambahDisc()
    {
        if (!$this->validate([            
            'reguler' => [
                'rules' => 'required|numeric|min_length[1]',
                'errors' => [
                    'required' => 'Field ini harus diisi',                                        
                    'numeric' => 'Harus berupa angka',                                        
                    'min_length' => 'Minimal 1 angka',                                        
                ]
            ],                                    
            'promotgl' => [
                'rules' => 'required|numeric|min_length[1]',
                'errors' => [
                    'required' => 'Field ini harus diisi',                                        
                    'numeric' => 'Harus berupa angka',                                        
                    'min_length' => 'Minimal 1 angka',                                        
                ]
            ],            
            'disc_klaim' => [
                'rules' => 'required|numeric|min_length[1]',
                'errors' => [
                    'required' => 'Field ini harus diisi',                                        
                    'numeric' => 'Harus berupa angka',                                        
                    'min_length' => 'Minimal 1 angka',                                        
                ]
            ],            
        ])) {
            session()->setFlashdata('gagal', 'Data gagal ditambahkan');
            return redirect()->to(base_url('/data-program'))->withInput();
        }else{
            $reguler = $this->request->getVar('reguler');            
            $promotgl = $this->request->getVar('promotgl');            
            $disc_klaim = $this->request->getVar('disc_klaim');            
            $this->disc->insert([
                'disc_reguler' => $reguler,
                'promotgl' => $promotgl,
                'disc_klaim' => $disc_klaim,
            ]);
            session()->setFlashdata('success', 'Data berhasil ditambahkan');
            return redirect()->to(base_url('/data-program'));
        }
    }
    public function update($id)
    {
        if (!$this->validate([
            'reguler' => [
                'rules' => 'numeric|min_length[1]',
                'errors' => [
                    'numeric' => 'Harus berupa angka',                                        
                    'min_length' => 'Minimal 1 angka',                                        
                ]
            ],                                   
            'promotgl' => [
                'rules' => 'numeric|min_length[1]',
                'errors' => [
                    'numeric' => 'Harus berupa angka',                                        
                    'min_length' => 'Minimal 1 angka',                                        
                ]
            ],                                              
            'disc_klaim' => [
                'rules' => 'numeric|min_length[1]',
                'errors' => [
                    'numeric' => 'Harus berupa angka',                                        
                    'min_length' => 'Minimal 1 angka',                                        
                ]
            ],                                              
        ])) {
            session()->setFlashdata('gagal', 'Data gagal diperbaharui');
            return redirect()->to(base_url('/data-program/edit/' . $id))->withInput();
        }else{
           
            $reguler = $this->request->getVar('reguler');            
            $promotgl = $this->request->getVar('promotgl');    
            $disc_klaim = $this->request->getVar('disc_klaim');  
            $pengajuan = $this->pengajuan->join('user', 'user.id_user = order_barang.id_user')->join('keranjang', 'keranjang.id_keranjang = order_barang.id_keranjang')->join('program_disc', 'program_disc.id_disc = order_barang.id_disc')->join('toko', 'toko.id_toko = order_barang.id_toko')->where(['order_barang.id_disc' => $id])->findAll();            
            foreach($pengajuan as $p){
                $date = date('m', strtotime($p['tanggal_pengajuan']))-1;                  
                $ttl = 0;
                $id_toko = $p['id_toko'];
                $ker = $this->keranjang->join('barang', 'barang.id_barang = keranjang.id_barang')->where('id_pengajuan', $p['id_pengajuan'])->findAll();
                foreach($ker as $k){
                    $ttl += $k['jumlah']*$k['harga'];
                    $total = 0;
                    $promotgal = 0;
                    $diskon = 0;
                    $prsn_klaim =0;
                    $nom_klaim = 0;                      
                    $id_pengajuan = $p['id_pengajuan'];
                    if(date('d') <= 15):
                        $promotgal = $promotgl/100;
                    endif;
                        $klaim = $this->pengajuan->where(['status' => 'disetujui', 'month(tanggal_pengajuan)' => $date, 'id_toko' => $id_toko])->selectSum('total','ttl')->first();
                        if ($klaim['ttl'] > 0 AND $p['prsn_klaim'] != 0) {
                            $prsn_klaim = $klaim['ttl']*($disc_klaim/100);
                            $nom_klaim = $prsn_klaim/$ttl*(100/100);
                            $diskon = $ttl*($p['disc_rek']/100+$reguler/100+$promotgal+$nom_klaim/100);                        
                        }else{             
                            $nom_klaim = 0;                                 
                            $diskon = $ttl*($p['disc_rek']/100+$reguler/100+$promotgal+$nom_klaim/100);                        
                        }                                                            
                        $total = $ttl-$diskon; 
                        $this->pengajuan->update($id_pengajuan,[
                            'prsn_klaim' => $nom_klaim,
                            'total' => $total,                            
                        ]);      
                }
                }                            
            $this->disc->update($id, [
                'disc_reguler' => $reguler,
                'promotgl' => $promotgl,
                'disc_klaim' => $disc_klaim,
            ]);
            session()->setFlashdata('success', 'Data berhasil perbaharui');
            return redirect()->to(base_url('/data-program'));

                             
        }
    }
    public function delete($id)
    {
        $this->disc->delete($id);
        session()->setFlashdata('success', 'Data program berhasil dihapus');
        return redirect()->to(base_url('/data-program'));
    }
}
