<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // ✅ Tentukan primary key kustom
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    public $incrementing = true; // atau false jika id_user bukan auto-increment
    protected $keyType = 'int'; // atau 'string' jika UUID

    // ✅ Tentukan nama kolom password kustom
    protected $password = 'password_user';

    // ✅ Kolom yang bisa diisi mass-assignment
    protected $fillable = [
        'nama_user',
        'email_user',
        'no_hp',
        'password_user',
        'role_user',
    ];

    // ✅ Hidden attributes (tidak dikirim saat toJSON/toArray)
    protected $hidden = [
        'password_user',
        'remember_token',
    ];

    // ✅ Beritahu Laravel field mana yang digunakan untuk auth
    public function getAuthIdentifierName()
    {
        return 'id_user';
    }

    public function getAuthPassword()
    {
        return $this->password_user;
    }

    public function getAuthPasswordName()
    {
        return 'password_user';
    }
}