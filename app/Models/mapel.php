<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class mapel extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($post) {
            $post->jadwal_absens()->delete();
        });
    }

    public function jadwal_absens()
    {
        return $this->hasMany(JadwalAbsen::class);
    }
}
