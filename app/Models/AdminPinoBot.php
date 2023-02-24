<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPinoBot extends Model
{
    use HasFactory;

    # Table Name
    protected $table = 'list_admin_telebot_tables';

    # Guarded 
    protected $guarded = [];
}
