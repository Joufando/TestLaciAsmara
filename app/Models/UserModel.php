<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // Nama tabel database
    protected $primaryKey = 'id'; // Nama kolom primary key

    protected $allowedFields = ['name', 'email']; // Kolom yang diperbolehkan untuk diisi

    protected $validationRules = [
        'name' => 'required|min_length[3]',
        'email' => 'required|valid_email'
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
}
