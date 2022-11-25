<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalAbsen extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kelas()
    {
        return $this->belongsTo(kelas::class);
    }

    public function mapel()
    {
        return $this->belongsTo(mapel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
