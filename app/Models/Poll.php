<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    protected $table = 'polls';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'option1',
        'option2',
        'option3',
        'status',
        'date_start',
        'date_end',
    ];
}
