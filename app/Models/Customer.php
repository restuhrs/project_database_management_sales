<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'customers';

    protected $fillable = [
        'branch_id',
        'salesman_id',
        'nama',
        'alamat',
        'nomor_hp_1',
        'nomor_hp_2',
        'kelurahan',
        'kecamatan',
        'kota',
        'tanggal_lahir',
        'jenis_kelamin',
        'tipe_pelanggan',
        'jenis_pelanggan',
        'pekerjaan',
        'tenor',
        'tanggal_gatepass',
        'model_mobil',
        'nomor_rangka',
        'sumber_data',
        'progress',
        'alasan',
        'saved',
        'old_salesman',
    ];

    protected $casts = [
        'saved' => 'boolean',
        'deleted_at' => 'datetime',
    ];

    // Model Customer.php
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }


    // Relasi ke tabel users (Salesman)
    public function salesman()
    {
        return $this->belongsTo(User::class, 'salesman_id');
    }
}
