<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_group',
        // 'group_id',
        // 'les_id',
    ];
    protected $table = 'studyGroup';
    protected $connection = 'mysql';

    function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
