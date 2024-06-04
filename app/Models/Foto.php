<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $fillable = [
        'laporan_id',
        'foto'
    ];

    public function laporan(){
        return $this->belongsTo(Laporan::class);
    }
}
