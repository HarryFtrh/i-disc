<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AreaModel;
use App\Models\UserModel;

class LoginController extends BaseController
{
    protected $user;
    protected $area;
    function __construct()
    {
        $this->user = new UserModel();
        $this->area = new AreaModel();
    }
    public function index()
    {
        return view('login/index');
    }
    public function proses()
    {
        $username = $this->request->getVar("username");
        $pass = $this->request->getVar("pass");
        $cekUser = $this->user->checkUser($username, $pass);
        if ($cekUser > 0) {
            if ($cekUser['level'] == 'Op') {
                session()->set([
                    'nama' => $cekUser['nama_user'],
                    'id_user' => $cekUser['id_user'],
                    'id_area' => $cekUser['id_user'],
                    'level' => 'Op',
                    'logged_in' => true,
                    'username' => $username,
                    'area' => $cekUser['area'],
                    'avatar' => $cekUser['avatar'],
                    'gabung' => $cekUser['created_at'],
                    'password' => $pass
                ]);
                return redirect()->to(base_url('/dashboard'));
            }else if ($cekUser['level'] == 'admin') {
                session()->set([
                    'nama' => $cekUser['nama_user'],
                    'id_user' => $cekUser['id_user'],
                    'id_area' => $cekUser['id_user'],
                    'level' => 'admin',
                    'logged_in' => true,
                    'username' => $username,
                    'area' => $cekUser['area'],
                    'avatar' => $cekUser['avatar'],
                    'gabung' => $cekUser['created_at'],
                    'password' => $pass
                ]);
                return redirect()->to(base_url('/dashboard'));
            }else if($cekUser['level'] == 'user'){
                session()->set([
                    'nama' => $cekUser['nama_user'],
                    'id_user' => $cekUser['id_user'],
                    'id_area' => $cekUser['id_area'],
                    'level' => 'user',
                    'logged_in' => true,
                    'username' => $username,
                    'area' => $cekUser['area'],
                    'avatar' => $cekUser['avatar'],
                    'gabung' => $cekUser['created_at'],
                    'password' => $pass
                ]);
                return redirect()->to(base_url('/data-barang'));
            }else{
                session()->set([
                    'nama' => $cekUser['nama_user'],
                    'id_user' => $cekUser['id_user'],
                    'id_area' => $cekUser['id_area'],
                    'level' => 'spv',
                    'logged_in' => true,
                    'username' => $username,
                    'area' => $cekUser['area'],
                    'avatar' => $cekUser['avatar'],
                    'gabung' => $cekUser['created_at'],
                    'password' => $pass
                ]);
                return redirect()->to(base_url('/update-pengajuan'));
            }
        }else{
            session()->setFlashdata('failed', 'Username atau Password salah!');
            return redirect()->to(base_url('/'));
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
    public function setting()
    {
        $data = [
            'title' => 'Setting account',
            'active' => 'account',
            'area' => $this->area->findAll(),
            'valid' => \Config\Services::validation()
        ];
        return view('setting', $data);
    }
    public function update_foto($id, $img_lama)
    {
        if (!$this->validate([
            'avatar' => [
                'rules' => 'uploaded[avatar]|max_size[avatar,1024]|mime_in[avatar,image/png,image/jpg,image/jpeg]|is_image[avatar]',
                'errors' => [
                    'uploaded' => 'Foto harus diisi',
                    'max_size' => 'Ukuran foto anda terlalu besar, Max : 1024kb',
                    'mime_in' => 'Yang anda upload bukan foto',
                    'is_image' => 'Yang anda upload bukan foto'
                ]
            ],
        ])) {
            session()->setFlashdata('failed', 'Foto profil gagal diganti');
            return redirect()->to(base_url('/setting-account'))->withInput();
        }
        $avatar = $this->request->getFile('avatar');
        if ($img_lama != 'default.jpg') {
            unlink('assets/image/avatars/'.$img_lama);
            $file = $avatar->getRandomName();
            $avatar->move('assets/image/avatars',$file);
            $this->user->update($id,[
                'avatar' => $file
            ]);
        }else{
            $file = $avatar->getRandomName();
            $avatar->move('assets/image/avatars',$file);
            $this->user->update($id,[
                'avatar' => $file
            ]);
        }
        session()->set(['avatar' => $file]);
        session()->setFlashdata('success', 'Foto berhasil diganti');
        return redirect()->to(base_url('/setting-account'));
    }
    public function update_pw($id)
    {
        if (!$this->validate([
            'passwordbr' => [
                'rules' => 'required|min_length[5]|max_length[50]',
                'errors' => [
                    'required' => 'Field ini harus diisi',
                    'max_length' => 'Maximal 50 karakter',
                    'min_length' => 'Minimal 5 karakter',
                ]
            ],
            'passwordconf' => [
                'rules' => 'required|min_length[5]|max_length[50]|matches[passwordbr]',
                'errors' => [
                    'required' => 'Field ini harus diisi',
                    'max_length' => 'Maximal 50 karakter',
                    'min_length' => 'Minimal 5 karakter',
                    'matches' => 'Password konfirmasi tidak sesuai',
                ]
            ],
            
        ])) {
            return redirect()->to(base_url('/setting-account'))->withInput();
        }
        $pass = $this->request->getVar('passwordbr');
        $this->user->update($id,[
            'password' => $pass
        ]);
        session()->set('password', $pass);
        session()->setFlashdata('success', 'Password berhasil diganti');
        return redirect()->to(base_url('/setting-account'));
    }
    public function update_usr($id)
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required|min_length[5]|max_length[50]|is_unique[user.username]',
                'errors' => [
                    'required' => 'Field ini harus diisi',
                    'max_length' => 'Maximal 50 karakter',
                    'min_length' => 'Minimal 5 karakter',
                    'is_unique' => 'Username telah digunakan',
                ]
            ],                        
        ])) {
            return redirect()->to(base_url('/setting-account'))->withInput();
        }
        $username = $this->request->getVar('username');
        $this->user->update($id,[
            'username' => $username
        ]);
        session()->set('username', $username);
        session()->setFlashdata('success', 'Username berhasil diganti');
        return redirect()->to(base_url('/setting-account'));
    }
    public function update_nm($id)
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|min_length[5]|max_length[50]',
                'errors' => [
                    'required' => 'Field ini harus diisi',
                    'max_length' => 'Maximal 50 karakter',
                    'min_length' => 'Minimal 5 karakter',
                ]
            ],                        
        ])) {
            return redirect()->to(base_url('/setting-account'))->withInput();
        }
        $nama = $this->request->getVar('nama');
        $this->user->update($id,[
            'nama_user' => $nama
        ]);
        session()->set('nama', $nama);
        session()->setFlashdata('success', 'Nama berhasil diganti');
        return redirect()->to(base_url('/setting-account'));
    }
    public function update_area($id)
    {        
        $area = $this->request->getVar('area');
        $nmarea = $this->area->find($area);
        $this->user->update($id,[
            'id_area' => $area
        ]);
        session()->set('area', $nmarea['area']);
        session()->set('id_area', $nmarea['id_area']);
        session()->setFlashdata('success', 'Nama berhasil diganti');
        return redirect()->to(base_url('/setting-account'));
    }
}
