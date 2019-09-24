<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThirdCategory extends Model
{
    public $timestamps = false;
    protected $table = 'third_category';
    protected $fillable = ['id', 'concepto','second_category_id'];

    public function Categoria(){
    	return $this->hasOne('App\SecondCategory','id','second_category_id');
    }
}
