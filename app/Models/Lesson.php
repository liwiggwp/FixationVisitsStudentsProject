<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Comment;

class Lesson extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
        'class',
        'teacher',
        'group_id'
    ];
    protected $table = 'lessons';
    protected $connection = 'mysql';
    protected $dates = ['deleted_at'];

}
