<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Nama tabel & primary key custom
    protected $table = 'user';
    protected $primaryKey = 'id_user';

    public $incrementing = true;
    protected $keyType = 'int';

    // Kolom yang boleh diisi
    protected $fillable = [
        'nama_user',
        'email_user',
        'no_hp',
        'password_user',
        'role_user',
        'google_id',
        'google_avatar',
    ];

    // Hidden fields
    protected $hidden = [
        'password_user',
        'remember_token',
    ];

    // Laravel auth pakai password_user
    public function getAuthPassword()
    {
        return $this->password_user;
    }

    // Relasi
    public function dokumen()
    {
        return $this->hasMany(
            \App\Models\Dokumen::class,
            'id_user',
            'id_user'
        );
    }
}