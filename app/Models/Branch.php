<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan nama default
    protected $table = 'branches';

    // Tentukan kolom yang dapat diisi (fillable)
    protected $fillable = ['name', 'region'];

    // Relasi ke Customer (satu cabang memiliki banyak customer)
    public function customers()
    {
        return $this->hasMany(Customer::class, 'branch_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'branch_id');
    }
}
