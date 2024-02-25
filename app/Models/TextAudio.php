<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextAudio extends Model
{
    use HasFactory;
    protected $table = 'text_audio';
    protected $guarded = false;
}
