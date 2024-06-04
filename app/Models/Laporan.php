<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul',
        'ringkasan',
        'deskripsi',
        'file'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function foto(){
        return $this->hasMany(Foto::class);
    }

}
