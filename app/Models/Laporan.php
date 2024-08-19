<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Laporan extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'user_id',
        'judul',
        'deskripsi',
        'lokasi',
        'file',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function divisiTerkait(){
        return $this->hasMany(DivisiTerkait::class);
    }

    public function foto(){
        return $this->hasMany(Foto::class);
    }

}
