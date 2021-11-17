<?php

namespace App\Models;

use CodeIgniter\Model;

class PinjamBarangModel extends Model
{
    protected $table = 'pinjam_barang';
    protected $useTimestamps = true;
    protected $primaryKey = 'id_pinjam';
    protected $allowedFields = ['id_pinjam', 'peminjam', 'tgl_pinjam', 'id_barang', 'nama_barang', 'tgl_kembali', 'kondisi', 'jml_barang'];

    public function getPinjamBarang($id_pinjam = false)
    {

        if (!$id_pinjam) {

            return $this->findAll();
        }

        return $this->where(['id_pinjam' => $id_pinjam])->first();
    }
}
