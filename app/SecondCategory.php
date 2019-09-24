<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondCategory extends Model
{
    public $timestamps = false;
    protected $table = 'second_category';
    protected $fillable = ['id', 'concepto','first_category_id'];
}
