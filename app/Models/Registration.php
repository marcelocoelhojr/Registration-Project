<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $table = 'registration';
    protected $fillable = ['name','email','cpf','address','company','telephone','cell','activity','course','password', 'uf', 'status', 'course_id'];

    public function course_value()
    {
        return $this->hasOne(Courses::class,'id');
    }

}
