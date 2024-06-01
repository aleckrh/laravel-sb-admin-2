<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    protected $fillable = [
        'laporan_id',
        'image'
    ];

    public function laporan(){
        return $this->belongsTo(Laporan::class);
    }
}
