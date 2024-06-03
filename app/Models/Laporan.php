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
        'foto',
        'file'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
