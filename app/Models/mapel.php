<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class mapel extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function jadwal_absens()
    {
        return $this->hasMany(JadwalAbsen::class);
    }
}
