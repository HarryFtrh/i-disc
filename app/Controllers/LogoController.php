<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LogoModel;

class LogoController extends BaseController
{
    protected $logo;
    function __construct()
    {
        $this->logo = new LogoModel();
        
    }
    public function index()
    {
        $data = [
            'title' => 'Ganti Logo I-Disc',
            'active' => 'logo',  
            'logo' => $this->logo->first(),          
            'valid' => \Config\Services::validation(),            
        ];
        return view('logo/index', $data);
    }
    public function update($id,$image)
    {
        if (!$this->validate([
            'logo' => [
                'rules' => 'uploaded[logo]|max_size[logo,1024]|mime_in[logo,image/png,image/jpg,image/jpeg]|is_image[logo]',
                'errors' => [
                    'uploaded' => 'Foto harus diisi',
                    'max_size' => 'Ukuran foto anda terlalu besar, Max : 1024kb',
                    'mime_in' => 'Yang anda upload bukan foto',
                    'is_image' => 'Yang anda upload bukan foto'
                ]
            ],
        ])) {
            session()->setFlashdata('failed', 'Account gagal diperbaharui');
            return redirect()->to(base_url('/setting-account'))->withInput();
        }
        unlink('img/logo/'.$image);
        $foto = $this->request->getFile('logo');        
        $file = $foto->getRandomName();
        $foto->move('img/logo',$file);
        $this->logo->update($id, [
            'image' => $file
        ]);
        session()->setFlashdata('success', 'Logo berhasil diganti');
        return redirect()->to(base_url('/logo'));
        
        
    }
}
