<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = "users";
    protected $primaryKey = "username";
    protected $returnType = "object";
    protected $useTimestamps = true;
    protected $allowedFields = ['username', 'password', 'name', 'foto'];

    public function getUsers($username = false)
    {
        if (!$username) {
            return $this->findAll();
        }

        return $this->where(['username' => $username])->first();
    }
}
