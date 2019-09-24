<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirstCategory extends Model
{
    public $timestamps = false;
    protected $table = 'first_category';
    protected $fillable = ['id', 'concepto'];
}
