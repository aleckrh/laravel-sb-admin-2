<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'ringkasan',
        'file'
    ];

    public function image(){
        return $this->hasMany(Image::class);
    }
}
