<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'start', // Add this line
        'end',
        'description',
    ];


    public function users(){

        return $this->belongsToMany(\App\User::class);

    }


}
