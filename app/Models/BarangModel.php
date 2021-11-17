<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $useTimestamps = true;
    protected $primaryKey = 'id_barang';
    protected $allowedFields = ['id_barang', 'nama_barang', 'slug', 'spesifikasi', 'kondisi', 'jumlah_barang', 'created_at', 'updated_at'];

    public function getBarang($slug = false)
    {

        if (!$slug) {

            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}
