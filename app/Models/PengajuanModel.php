<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'order_barang';
    protected $primaryKey       = 'id_pengajuan';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'id_toko','note' ,'id_disc','prsn_klaim','status_klaim', 'id_keranjang', 'total', 'status', 'tanggal_pengajuan', 'disc_rek'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    function pengajuan(){
        if (session('level') == 'user') {
            $pengajuan = $this->where(['status' => 'disetujui', 'id_user' => session('id_user')])->findAll();            
        }else{
            $pengajuan = $this->where('status','disetujui')->findAll();
        }
        $mon = 0;
        $tues = 0;
        $wed = 0;
        $thurs = 0;
        $fri = 0;
        $sat = 0;
        $sun = 0;
        foreach($pengajuan as $p){
            $date = $p['tanggal_pengajuan'];
            switch ((date('D-m-Y',strtotime($date)))) {
                case 'Mon-' . date('m') . '-' . date('Y'):
                    $mon+=$p['total'];
                    break;            
                case 'Tue-' . date('m') . '-' . date('Y'):
                    $tues+=$p['total'];
                    break;  
                case 'Wed-' . date('m') . '-' . date('Y'):
                    $wed+=$p['total'];
                    break;  
                case 'Thu-' . date('m') . '-' . date('Y'):
                    $thurs+=$p['total'];
                    break;  
                case 'Fri-' . date('m') . '-' . date('Y'):
                    $fri+=$p['total'];
                    break;  
                case 'Sat-' . date('m') . '-' . date('Y'):
                    $sat+=$p['total'];
                    break;  
                case 'Sun-' . date('m') . '-' . date('Y'):
                    $sun+=$p['total'];
                    break;  
                    
            }
        }
        $pengajuan = [
            'sen' => $mon,
            'sel' => $tues,
            'rab' => $wed,
            'kam' => $thurs,
            'jum' => $fri,
            'sab' => $sat,
            'min' => $sun,
        ];
        return $pengajuan; 
    }       
}
