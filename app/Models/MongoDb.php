<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class MongoDb extends Model
{
    protected $fillable = ['id'];
    protected $collection = 'mongodb_space_devs';
    protected $connection = 'mongodb';
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    
    use HasFactory;
}
