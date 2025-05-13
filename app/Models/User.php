<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Auth\Authenticatable; // Import trait
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;  // Tambahkan Authenticatable trait

    protected $table = 'user';

    protected $fillable = [
        'branch_id',
        'username',
        'name',
        'password',
        'role',
        'status',
        ];

    // Relasi dengan FollowUp, Customer, dan History
    public function followUps()
    {
        return $this->hasMany(FollowUp::class, 'salesman_id');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'salesman_id');
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }

    public function supervisedSalesmen()
    {
        return $this->belongsToMany(User::class, 'supervisor_salesman', 'supervisor_id', 'salesman_id')
                    ->withTimestamps();
    }

    public function supervisors()
    {
        return $this->belongsToMany(User::class, 'supervisor_salesman', 'salesman_id', 'supervisor_id')
                    ->withTimestamps();
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }
}
