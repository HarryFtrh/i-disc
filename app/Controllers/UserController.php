<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AreaModel;
use App\Models\SpvModel;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $user;
    protected $area;
    protected $areaSPV;
    function __construct()
    {
        $this->user = new UserModel();
        $this->area = new AreaModel();
        $this->areaSPV = new SpvModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Data User I-Disc',
            'active' => 'user',
            'users' => $this->user->join('area', 'user.id_area = area.id_area')->findAll(),
            'area' => $this->area->findAll(),
            'valid' => \Config\Services::validation()
        ];
        return view('user/index', $data);
    }
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data User I-Disc',
            'active' => 'user',
            'users' => $this->user->join('area', 'user.id_area = area.id_area')->find($id),
            'area' => $this->area->findAll(),
            'valid' => \Config\Services::validation()
        ];
        return view('user/edit-user', $data);
    }
    public function aturArea($id)
    {
        $data = [
            'title' => 'Atur Area Supervisor I-Disc',
            'active' => 'user',
            'users' => $this->user->join('area', 'user.id_area = area.id_area')->find($id),
            'area' => $this->area->query("SELECT area.*,(SELECT COUNT(id_area) FROM area_spv WHERE id_user = $id AND id_area = area.id_area) AS ok FROM area")->getResultArray(),
            'valid' => \Config\Services::validation()
        ];
        return view('user/atur-area', $data);
    }
    public function actAtur($id)
    {
        $ar = $this->area->findAll();
        if (!empty($ar)) {
            foreach ($ar as $arr) {
                $idAr = $this->request->getVar('areaSPV'.$arr['id_area']);
                if (!empty($idAr)) {
                    $cek = $this->areaSPV->where(['id_user' => $id, 'id_area' => $arr['id_area']])->first();                    
                    if (empty($cek)) {
                        $this->areaSPV->query("INSERT INTO area_spv VALUES($id,".$arr['id_area'].")");       
                    }else{
                        $this->areaSPV->query("UPDATE area_spv SET id_area = ".$arr['id_area']." WHERE id_user = $id AND id_area = ".$arr['id_area']."");                  
                    }
                }else{
                    $this->areaSPV->query("DELETE FROM area_spv WHERE id_user = $id AND id_area = ".$arr['id_area']."");
                }
            }
        }        
        session()->setFlashdata('success','Berhasil mengatur area untuk supervisor');
        return redirect()->to(base_url('/atur-area-spv/'.$id));
    }
    public function tambahUser()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Field ini harus diisi',
                    'min_length' => 'Minimal 5 karakter'
                ]
            ],
            'username' => [
                'rules' => 'required|is_unique[user.username]|min_length[5]',
                'errors' => [
                    'required' => 'Field ini harus diisi',
                    'is_unique' => 'Username telah digunakan',
                    'min_length' => 'Minimal 5 karakter'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Field ini harus diisi',                    
                    'min_length' => 'Minimal 5 karakter'
                ]
            ],
            'passwordconf' => [
                'rules' => 'required|min_length[5]|matches[password]',
                'errors' => [
                    'required' => 'Field ini harus diisi',                    
                    'min_length' => 'Minimal 5 karakter',
                    'matches' => 'Password konfirmasi tidak sesuai'
                ]
            ],
        ])) {
            session()->setFlashdata('gagal', 'Data gagal ditambahkan');
            return redirect()->to(base_url('/data-user'))->withInput();
        }else{
            $nama = $this->request->getVar('nama');
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $level = $this->request->getVar('level');
            $area = $this->request->getVar('area');
            $this->user->insert([
                'nama_user' => $nama,
                'username' => $username,
                'password' => $password,
                'level' => $level,
                'id_area' => $area,
                'avatar' => 'default.jpg'
            ]);
            session()->setFlashdata('success', 'Data berhasil ditambahkan');
            return redirect()->to(base_url('/data-user'));
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
        ])) {
            session()->setFlashdata('gagal', 'Data gagal diperbaharui');
            return redirect()->to(base_url('/data-user/edit/' . $id))->withInput();
        }else{
            $nama = $this->request->getVar('nama');
            $level = $this->request->getVar('level');
            $area = $this->request->getVar('area');
            
            $this->user->update($id, [
                'nama_user' => $nama,
                'level' => $level,
                'id_area' => $area
            ]);
            session()->setFlashdata('success', 'Data berhasil perbaharui');
            return redirect()->to(base_url('/data-user'));
        }
    }
    public function delete($id)
    {
        $this->user->delete($id);
        session()->setFlashdata('success', 'Data user berhasil dihapus');
        return redirect()->to(base_url('/data-user'));
    }
}
