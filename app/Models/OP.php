<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OP extends Model
{
    use HasFactory;

    protected $fillable = ['OP', 'family'];
}
