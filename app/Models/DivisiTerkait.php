<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisiTerkait extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_divisi'
    ];

    public function laporan(){
        return $this->belongsTo(Laporan::class);
    }
}
