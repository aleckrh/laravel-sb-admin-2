<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pallet extends Model
{
    use HasFactory;

    protected $fillable = ['ID', 'OP', 'status', 'creation_date', 'procedence'];
}
