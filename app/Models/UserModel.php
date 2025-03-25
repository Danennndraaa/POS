<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'm_user';
    protected $primaryKey = 'user_id';
    protected $fillable = ['username', 'nama', 'password', 'level_id', 'created_at', 'updated_at'];

    protected $hidden = ['password']; // jangan tampilkan password

    protected $casts = ['password' => 'hashed']; //casting password ke hashed
    
    // relasi ke table level
    public function level(): BelongsTo
    {
        return $this-> belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
    
    /**
     * Mendapatkan nama role
     */
    public function getRoleName(): string
    {
        return $this->level->level_nama;
    }

    /**
     * Cek apakah user memiliki role tertentu
     */
    public function hasRole(string $role): bool
    {
        return $this->level->level_kode == $role;
    }

    /**
     * Mendapatkan kode role
     */
    public function getRole()
    {
        return $this->level->level_kode;
    }

}
