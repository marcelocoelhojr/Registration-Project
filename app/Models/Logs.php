<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $table = 'logs';
    protected $fillable = ['name', 'line', 'message', 'file', 'code'];
    public $timestamps = true;
    use HasFactory;
}
