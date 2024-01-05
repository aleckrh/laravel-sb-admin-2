<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    protected $fillable = ['id_component','id_family','name', 'quantity'];

    public function receptions()
    {
        return $this->hasMany(Reception::class, 'id_component');
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class, 'id_component');
    }
}