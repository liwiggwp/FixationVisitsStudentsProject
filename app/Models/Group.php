<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'group_id',
        'les_id',
    ];
    protected $table = 'groups';
    protected $connection = 'mysql';

}
