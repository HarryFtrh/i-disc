<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengajuanModel;
use App\Models\RegionModel;
use App\Models\TokoModel;

class TokoController extends BaseController
{
    protected $toko;
    protected $region;
    function __construct()
    {
        $this->toko = new TokoModel();
        $this->region = new RegionModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Toko I-Disc',
            'active' => 'toko',
            'toko' => $this->toko->findAll(),
            'region' => $this->region->orderBy('name', 'ASC')->findAll(),
            'valid' => \Config\Services::validation(),                    
        ];
        return view('toko/index', $data);
    }
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Toko I-Disc',
            'active' => 'toko',
            'toko' => $this->toko->find($id),
            'region' => $this->region->orderBy('name', 'ASC')->findAll(),
            'valid' => \Config\Services::validation()
        ];
        return view('toko/edit-toko', $data);
    }
    public function tambahToko()
    {
        if (!$this->validate([
            'kd_toko' => [
                'rules' => 'required|min_length[5]|numeric|is_unique[toko.kode_toko]',
                'errors' => [
                    'required' => 'Field ini harus diisi',
                    'min_length' => 'Minimal 5 karakter',
                    'numeric' => 'Harus berupa angka',
                    'is_unique' => 'Kode toko telah tersedia',
                ]
            ],
            'nama' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Field ini harus diisi',
                    'min_length' => 'Minimal 5 karakter'
                ]
            ],
            'alamat' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Field ini harus diisi',                                        
                    'max_length' => 'Maksimal 100 karakter'
                ]
            ],                     
        ])) {
            session()->setFlashdata('gagal', 'Data gagal ditambahkan');
            return redirect()->to(base_url('/data-toko'))->withInput();
        }else{
            $kd_toko = $this->request->getVar('kd_toko');
            $nama = $this->request->getVar('nama');
            $alamat = $this->request->getVar('alamat');
            $chanel = $this->request->getVar('chanel');
            $region = $this->request->getVar('region');
            $this->toko->insert([
                'kode_toko' => $kd_toko,
                'nama_toko' => $nama,
                'alamat_toko' => $alamat,
                'chanel' => $chanel,
                'region' => $region
            ]);
            session()->setFlashdata('success', 'Data berhasil ditambahkan');
            return redirect()->to(base_url('/data-toko'));
        }
    }
    public function update($id)
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'min_length[5]',
                'errors' => [                    
                    'min_length' => 'Minimal 5 karakter'
                ]
            ],
            'alamat' => [
                'rules' => 'max_length[100]',
                'errors' => [                                                            
                    'max_length' => 'Maksimal 100 karakter'
                ]
            ],                                      
        ])) {
            session()->setFlashdata('gagal', 'Data gagal diperbaharui');
            return redirect()->to(base_url('/data-toko/edit/' . $id))->withInput();
        }else{
            $nama = $this->request->getVar('nama');
            $alamat = $this->request->getVar('alamat');
            $chanel = $this->request->getVar('chanel');
            $region = $this->request->getVar('region');
            
            $this->toko->update($id, [
                'nama_toko' => $nama,
                'alamat_toko' => $alamat,
                'chanel' => $chanel,
                'region' => $region
            ]);
            session()->setFlashdata('success', 'Data berhasil perbaharui');
            return redirect()->to(base_url('/data-toko'));
        }
    }
    public function delete($id)
    {
        $this->toko->delete($id);
        session()->setFlashdata('success', 'Data toko berhasil dihapus');
        return redirect()->to(base_url('/data-toko'));
    }
}
